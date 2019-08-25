<?php
require_once "./config/db_connect.php";
?>
<?php
$currency = "&#163;";
$current_date = date("Ymd"); // date(Ymd) means 20080602 equals to 2008-06-02
$discard_date = 900; //set the date to valid the date, 5 equals to 5 day, 100 equal 1 month eg 20080521 means 2008-05-21; 
$valid_date = $current_date - $discard_date;


//turn page over function code
if (isset($_GET['page']))
{
	$page = intval($_GET['page']);
}
else
{
	$page = 1;
}
$PageSize = 10;//number deside how many records to show per page

$sql = "select count(*) as amount from Product_In_Store";
$result =  mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_array($result);
$amount = $row['amount'];

if ($amount != 0)
{
	if ( $amount < $PageSize)
	{
		$page_count = 1;
	}
	if ($amount % $PageSize)
	{
		$page_count = (int)($amount / $PageSize) + 1;
	}
	else
	{
		$page_count = $amount / $PageSize;
	}
}
$page_string = "";

if ($page == 1)
{
	$page_string .= "First Page | Last Page";
}
else
{
	$page_string .= "<a href =?page=1>First Page</a>|<a href=?page=".($page-1).">Last page</a>|";
}
if (($page == $page_count) || ($page_count == 0))
{
	$page_string .= " | Next | End";
}
else
{
	
	$page_string .="<a href =?page=".($page+1)."> NEXT</a>|<a href =?page=".$page_count."> End</a>";
}

if($amount)
{
//break of the turn page over function insert the table content info



$sql = "SELECT * FROM Product_In_Store WHERE Upload_Date > '$valid_date' limit ".($page-1)*$PageSize.",$PageSize";
$result = mysql_query($sql) or die (mysql_error());
while ($row = mysql_fetch_array($result) )
{
	//get product in store discount information
	$p_id = $row['P_ID'];
	$s_id = $row['S_ID'];
	$p_c_price = $row['P_C_Price'];
	$p_o_price = $row['P_O_Price'];
	$discount_info = $row['Discount_Info'];
	$pm_start_date = $row['PM_Start_Date'];
	$pm_end_date = $row['PM_End_Date'];
	$upload_date = $row['Upload_Date'];
	
	//get product information
	$p_sql = "SELECT * FROM Product WHERE P_ID = '$p_id'";
	$p_result = mysql_query($p_sql) or die (mysql_error());
	$p_row = mysql_fetch_array($p_result) or die (mysql_error());
	$p_name = $p_row['P_Name'];
	$p_color = $p_row['P_Color'];
	$p_size = $p_row['P_Size'];
	$p_model = $p_row['P_Model'];
	$p_desc = $p_row['P_Desc'];
	$p_pic_exe = $p_row['P_Pic_Exe'];
	
	$pt_id = $p_row['PT_ID'];
	$b_id = $p_row['B_ID'];
	
	//get brand informaiton
	$b_sql = "SELECT * FROM Brand WHERE B_ID = '$b_id'";
	$b_result = mysql_query($b_sql) or die(mysql_error());
	$b_row = mysql_fetch_array($b_result) or die (mysql_error());
	$b_name = $b_row['B_Name'];
	$b_ext = $b_row['B_Ext'];
	
	//get store information
	$s_sql = "SELECT * FROM Store WHERE S_ID = '$s_id'";
	$s_result = mysql_query($s_sql) or die (mysql_error());
	$s_row = mysql_fetch_array($s_result) or die (mysql_error());
	$s_name = $s_row['S_Name'];
	$l_id = $s_row['L_ID'];
	$s_ext = $s_row['S_Ext'];
	
	//get local information
	$l_sql = "SELECT * FROM Local WHERE L_ID = '$l_id'";
	$l_result = mysql_query($l_sql) or die (mysql_error());
	$l_row = mysql_fetch_array($l_result) or die (mysql_error());
	$l_name = $l_row['L_Name'];


//output the information
$output =<<<EOD
<table width = "100%" border = "1"  align = "center">

<tr>
	<td valign = "top" rowspan = "5" width = "192" height = "270"><img width = "192" height = "270" src = "./product_pic/$p_id$p_pic_exe" /></td>
	<td colspan = "5">Promo Starts:	$pm_start_date		Promo Ends:	$pm_end_date 	Uploaded at:	$upload_date</td>
</tr>
<tr>
	<td colspan = "5"><b id = "Old_Price">Was: $currency$p_o_price</b>		<b id = "Current_Price">Now: $currency$p_c_price</b>		<b id = "Discount_Info">$discount_info</b></td>
</tr>
<tr>
	<td>$p_name</td>
	<td>$p_model</td>
	<td>$p_color</td>
	<td>$p_size</td>
	<td><img width = "88" height = "33" src = "./brand_pic/$b_name$b_ext" /></td>
</tr>
<tr>
	<td height = "140"colspan = "5">$p_desc</td>
</tr>
<tr>
	<td valign = "top" height = "33" colspan = "5"><a href = "search.php?type=store&s_id=$s_id"><img width = "88" height = "33" src = "./store_pic/$s_name$s_ext" /> at $l_name</a></td>
</tr>
EOD;
echo $output;
}
?>
<tr>
<td colspan = "12" align = "right"><?php echo $page_string;?></td>
</tr>


<?php
}
else
{
	$name = array();
}
//end of the turn page over function code
?>
</table>