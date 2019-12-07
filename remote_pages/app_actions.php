<?php
	include("../conn.php");
	include("../functions.php");

	
			if(isset($_POST["idnum"])){
				$id_no = sanitize($_POST['idnum']);
				$fname = sanitize($_POST['fname']);
				$lnane = sanitize($_POST['lname']);
				$mi = sanitize($_POST['mi']);
				$username = sanitize($_POST['un']);
				$pw = sanitize($_POST['pw']);

				$n = lms_register($id_no, $fname, $lname, $mi, $username, $pw,$conn);
				$res = "";
					$res='{"res":"'.$n.'"}';
				header("Content-Type: application/json");
				echo $res;
			}
			//$res='{"res":"no-app"}';
			//	header("Content-Type: application/json");
			//	echo $res;
		
?>