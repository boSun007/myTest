<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'test';

$mysql = new mysqli($host, $user, $password, $database);
if($mysql->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysql->set_charset("utf8mb4");


$sql = 'CREATE TABLE MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )';
// $mysql->query($sql);


$guests = [
    'guest' => [
        'firstname' => 'bo',
        'lastname' => 'sun',
        'email' => 'bo@sun.com',
    ],
];

/**insert std */
$guest = implode("','", $guests['guest']);
$sql = "insert into MyGuests(firstname,lastname,email) values('$guest')";
if (!$mysql->query($sql)) {
    die(mysqli_error($mysql));
}

/**insert STMT */
$sql = "insert into MyGuests(firstname,lastname,email) values(?,?,?)";
$stmt = $mysql->prepare($sql);
$stmt->bind_param('sss',$guests['guest']['firstname'],$guests['guest']['lastname'],$guests['guest']['email']);
if($stmt->execute()){
    echo 'INFO: '.$mysql->info.PHP_EOL;
    
    echo 'INSERT_ID: '.$mysql->insert_id.PHP_EOL;
}else{
    die(mysqli_error($mysql));
}




/**select std */

$sql = "SELECT * FROM MyGuests";
if (!$result = $mysql->query($sql)) {
    die(mysqli_error($mysql));
}
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
// var_dump($row);


/**select STMT */
$id=0;
$sql = "SELECT * FROM MyGuests where id>?";
if (!$stmt = $mysql->prepare($sql)) {
    die(mysqli_error($mysql));
}
$stmt->bind_param('i',$id);
$stmt->execute();


$result = $stmt->get_result();
$row = $result->fetch_all(MYSQLI_ASSOC); 
// $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
var_dump($row);
$result->close();


/**update Info test */
$newName = 'bruce';
$id =4;
$stmt = $mysql->prepare("UPDATE MyGuests SET firstname = ? WHERE id =?");
$stmt->bind_param("si", $newName,$id);
$stmt->execute();
$stmt->close();
echo $mysql->info;


