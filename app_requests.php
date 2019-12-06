<?php 
include("conn.php");
include("functions.php");
$key = $_GET['s'];
$s = mysql_query("SELECT * FROM lms_members WHERE st_fname like '$key%'")or die(mysql_error());//get_AllMembers();
$col = array();
 while($r=mysql_fetch_array($s)){
 	//$col=$r;
 	array_push($col, $r);
}
header("Content-Type: application/json");
//print_r($col)

	print(json_encode($col));
	//number_format($price,2);
?>