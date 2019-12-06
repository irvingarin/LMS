<?php session_start();
	 include("conn.php");
	 include("functions.php");
	
	 if(isset($_POST['ac'])){
	 	$act = sanitize($_POST['act']);
	 	$page = sanitize($_POST['pg']);
	 	$id_no=$_SESSION['lms_m_id'];

	 	$d = activityLog($act.">Clicked", $page, $id_no);
	 }

?>