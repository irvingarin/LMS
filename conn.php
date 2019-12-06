<?php 
	$sqlhost = "127.0.0.1";
	$sqlusername = "root";
	$sqlpw="";
	$sqldbname="npsulmsdb";
	$conn = mysqli_connect($sqlhost,$sqlusername,$sqlpw)or die(mysql_error());
	$db = mysqli_select_db($conn,$sqldbname)or die(mysql_error());
?>