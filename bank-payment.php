<?php
// auto load classes
spl_autoload_register('myAutoloader');

$template = new Template();
$config = new Config();
$barclay = $config->getBarclaysDetails();
$barclaysForm = $template->getBarclaysPage('payment');
$date = new DateTime();
$currentDate = $date->format('Y-m-d-Hi');
$currency = $config->getCurrency();
$db = new Query();
$file = new File(); // create object for checking if we have data back from XML API
/**
 * Set the form for submit and create sha sign for the payment
 * using secrete key 1
 */
if (isset($_POST['details'])) {
	$_SESSION['details'] = $_POST['details'];
	$details = $_SESSION['details'];
	$result = $_SESSION['searchResult'];
	$room = new Room($result);

	$hotel = $room->getHotelByID($_SESSION['hotel']);
	$room->setHotels($hotel);
	$rooms = $room->getRooms(0);
	$ROOMIDs = $_SESSION['roomID'];
	$tradeRef = "-";
	if ($config->getWebDetail('webName') == 'rmidirect') {
		$tradeRef = $_POST['reference'];
	} else {
		$_SESSION['tradeRef'] = $config->getWebDetail('tradeID') . $currentDate;
	}

	/**
	 * If we have voucher discount
	 */
	if (! empty($details['voucher'])) {
		$voucher = $details['voucher'];
	} else {
		$voucher = null;
	}

	// Need validation of booking details
	$validation = new Validation();
	$errors = array();
	if (! $validation->mailCheck(clean_str($details['mail'])) && $validation->validStrLen(clean_str($details['mail']), 5, 50)) {
		$errors['mail'] = "Please enter valid email address.";
	}

	if (! $validation->postcode(clean_str($details['postcode']), $config->getCurrency()) && $validation->validStrLen(clean_str($details['postcode']), 3, 15)) {
		$errors['postcode'] = "Please enter valid postcode.";
	}

	if (! $validation->telNumber(clean_str($details['tel']), $config->getCurrency())) {
		$errors['tel'] = "Please enter valid phone number.";
	}

	if (! $validation->name(clean_str($details['city'])) && $validation->validStrLen(clean_str($details['city']), 3, 30)) {
		$errors['city'] = "Please enter valid city.";
	}

	if (! empty($errors)) {
		echo json_encode($errors);
		die();
	}

	$bookRooms = array();
	for ($i = 1; $i <= count($ROOMIDs); $i ++) {
		$bookRooms[] = $room->getRoomByID($rooms, $ROOMIDs[$i - 1], $i);
	}

	try {
		$xml = new Xml();
		
		$xmlFile = $xml->BookRequest($_SESSION['arrival'], $_SESSION['duration'], $bookRooms, $details, $tradeRef, $voucher);
		if(isset($_SESSION['bookResponse']) && $_SESSION['bookResponse']!= '' && isset($_SESSION['bookRequest']) && $_SESSION['bookRequest'] == md5(json_encode([$_SESSION['arrival'], $_SESSION['duration'], $bookRooms, $details, $tradeRef, $voucher]))){
			$respond = $_SESSION['bookResponse'];//did the booking
		}else{
			$respond = $xml->getXmlData($xmlFile);//did the booking
		}
		
		$file->setXmlFile($respond);
		if($file->checkStatus()){
			
			$_SESSION['bookRequest']= md5(json_encode([$_SESSION['arrival'], $_SESSION['duration'], $bookRooms, $details, $tradeRef, $voucher]));
			$_SESSION['bookResponse'] =$respond;
		}
	} catch (Exception $e) {
		$file->setTitle('Booking Request');
		$file->setMessage($e->getMessage());
		$file->sendErrorDataDog();
		$msg = " =================== " . PHP_EOL . "<h1>Booking Request</h1>" . PHP_EOL;
		$msg .= "Date: " . $date->format('Y-m-d H:i:s') . PHP_EOL;
		$msg .= "Error Exception caught -> " . $e->getMessage() . PHP_EOL;
		$msg .= "XML Book Request: " . $xmlFile . PHP_EOL;
		$path = $config->getLOG('errors');
		$filename = "Booking-Req-" . $currentDate . ".log";
		$file->createLog($msg, $path, $filename);
		echo 'Something went wrong please contact our department.';
		die();
	}

	$booking = new Booking($file->getFile());
	$payment = new Payment($currency);
	$customer = $booking->getLeadGuest();
	$guest = new Guest($customer['Title'], $customer['FirstName'], $customer['LastName']);
	$country = $db->getCountryByID($details['country']);
	$amount = str_replace(".", "", $payment->exchangeCurrency($booking->getTotalPrice()));
	$town = clean_str($customer['TownCity']);
	$tel = clean_str($customer['Phone']);
	$postcode = clean_str($customer['Postcode']);
	$email = clean_str($customer['Email']);
	$adress = clean_str($customer['Address1']);
	$secret = $barclay['SharedSecret1'];
	$orderID = $booking->getBookingReference();
	$date->setTimezone(new DateTimeZone($_POST['timezone']));
	
	$shaSign = "ACCEPTURL=" . $barclay['redirectURL'] . $secret;
	$shaSign .= "AMOUNT=" . $amount . $secret;
	$shaSign .= "CANCELURL=" . $barclay['cancelUrl'] . $secret;
	$shaSign .= "CN=" . $guest->getFullName(true) . $secret;
	$shaSign .= "CURRENCY=" . $currency . $secret;
	$shaSign .= "DECLINEURL=" . $barclay['declineUrl'] . $secret;
	$shaSign .= "EMAIL=" . $email . $secret;
	$shaSign .= "EXCEPTIONURL=" . $barclay['exceptionUrl'] . $secret;
	$shaSign .= "ORDERID=" . $orderID . $secret;
	$shaSign .= "OWNERADDRESS=" . $adress . $secret;
	$shaSign .= "OWNERCTY=" . $country . $secret;
	$shaSign .= "OWNERTELNO=" . $tel . $secret;
	$shaSign .= "OWNERTOWN=" . $town . $secret;
	$shaSign .= "OWNERZIP=" . $postcode . $secret;
	$shaSign .= "PSPID=" . $barclay['MerchandId'] . $secret;

	$temp = '';
	foreach (str_split_unicode($shaSign) as $character) {
		if (strlen($character) >= 2) {
			$temp .= $character[1];
		} else {
			$temp .= $character;
		}
	}

	$finalForm = parseTemplate($barclaysForm, array(
		'[+action+]' => $barclay['PaymentUrl'],
		'[+Accept+]' => $barclay['redirectURL'],
		'[+Amount+]' => $amount,
		'[+Back+]' => $barclay['cancelUrl'],
		'[+CN+]' => $guest->getFullName(true),
		'[+Currency+]' => $currency,
		'[+Decline+]' => $barclay['declineUrl'],
		'[+Email+]' => $email,
		'[+Exception+]' => $barclay['exceptionUrl'],
		'[+orderID+]' => $orderID,
		'[+Adress+]' => $adress,
		'[+country+]' => $country,
		'[+tel+]' => $tel,
		'[+town+]' => $town,
		'[+poscode+]' => $postcode,
		'[+PSPID+]' => $barclay['MerchandId'],
		'[+SHAsign+]' => strtoupper(sha1($temp))
	));

	$msg = "--------------------Payment send Information DATE: " . $currentDate . "--------------------" . PHP_EOL;
	$msg .= "Booking Reference: " . $booking->getBookingReference() . PHP_EOL;
	$msg .= "Customer : " . $guest->getFullName() . PHP_EOL;
	$msg .= "Amount : " . str_replace(".", "", $amount) . PHP_EOL;
	$msg .= "Currency : " . $config->getCurrency() . PHP_EOL;
	$msg .= "Email : " . $email . PHP_EOL;
	$msg .= "Order ID : " . $orderID . PHP_EOL;
	$msg .= "Address : " . $adress . PHP_EOL;
	$msg .= "City/Town : " . $town . PHP_EOL;
	$msg .= "Tel : " . $tel . PHP_EOL;
	$msg .= "Postcode : " . $postcode . PHP_EOL;
	$msg .= "Country : " . $country . PHP_EOL;
	$msg .= "PSPID : " . $barclay['MerchandId'] . PHP_EOL;
	$msg .= "SHAsign : " . strtoupper(sha1($temp)) . PHP_EOL;
	$msg .= "SHAsign generated from (pre-encrypted): " . $shaSign . PHP_EOL;
	$path = $config->getLOG('payment');
	$filename = $config->getWebDetail('PageTitle') . '-send-ref(' . $booking->getBookingReference() . ')' . $currentDate . ".log";

	$file->createLog($msg, $path, $filename);

	// echo $shaSign . '<br>' . strtoupper(sha1($temp)) . '<br>';

	$_SESSION['paymentForm'] = $finalForm;
	die();
}

/**
 * Get the respond from bank
 * Sort all parameters alphabetical and to upper case
 * Create sha sign using secrete key 2 so, we could check if is match with bank
 * Create logs file
 * Redirect to confirmation page
 */
if (isset($_GET['ACCEPTANCE'])) {

	$secret2 = $barclay['SharedSecret2'];
	$params = array();
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$url_components = parse_url($url);
	parse_str($url_components['query'], $params);

	$sorted_array = array();
	foreach ($params as $key => $value) {
		if ($key === 'page' || $key === 'SHASIGN') {
			continue;
		}
		$sorted_array[strtoupper($key)] = $value;
	}

	ksort($sorted_array);
	$str = '';
	foreach ($sorted_array as $key => $value) {
		$str .= $key . '=' . $value . $secret2;
	}

	$temp = '';
	foreach (str_split_unicode($str) as $character) {
		if (strlen($character) >= 2) {
			$temp .= $character[1];
		} else {
			$temp .= $character;
		}
	}
	$shaSign = strtoupper(sha1($temp));

	// Update the booking trade reference in table for xenon export
	$db->update("Booking", "BookingReference={$sorted_array['ORDERID']}", array(
		"TradeReference" => $_SESSION['tradeRef']
	));

	$msg = "--------------------Payment respond from Bank Information DATE: " . $currentDate . "--------------------" . PHP_EOL;
	$msg .= "Booking Reference : " . substr($sorted_array['ORDERID'], 0, 7) . PHP_EOL;
	$msg .= "Amount : " . $sorted_array['AMOUNT'] . PHP_EOL;
	$msg .= "CN : " . $sorted_array['CN'] . PHP_EOL;
	$msg .= "Currency : " . $sorted_array['CURRENCY'] . PHP_EOL;
	$msg .= "Order ID : " . $sorted_array['ORDERID'] . PHP_EOL;
	$msg .= "Brand : " . $sorted_array['BRAND'] . PHP_EOL;
	$msg .= "PM : " . $sorted_array['PM'] . PHP_EOL;
	$msg .= "PAYID : " . $sorted_array['PAYID'] . PHP_EOL;
	$msg .= "NCERROR : " . $sorted_array['NCERROR'] . PHP_EOL;
	$msg .= "SHAsign-BARCLAYS : " . $_GET['SHASIGN'] . PHP_EOL;
	$msg .= "SHAsign-calculated : " . $shaSign . PHP_EOL;
	$msg .= "SHAsign generated from (pre-encrypted): " . $str . PHP_EOL;
	$path = $config->getLOG('payment');
	$filename = $config->getWebDetail('PageTitle') . "-recieved-ref(" . substr($sorted_array['ORDERID'], 0, 7) . ")-" . $currentDate . ".log";

	$file->createLog($msg, $path, $filename);

	if ($shaSign !== $_GET['SHASIGN']) {
		$shaMsg = 'Sha sign did not match! Most likely corrupted data, please check Payment respond log for more Information.';
		$file->setTitle('Barclays SHA sign');
		$file->setMessage($shaMsg);
		$file->sendErrorDataDog();
	}

	echo "<p id='confirm'>confirmation<p>";
}











