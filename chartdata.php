<?php session_start();
	include("connection.php");
	include("functions.php");

	if(isset($_POST['chart'])){
		$d = allExaminee();
		$dk = '';
		$k = "";
		$c = mysql_num_rows($d);
		$x = 1;
		while($r = mysql_fetch_object($d)){
			if($x!=$c){
				$dk.=$r->program.'|';
				$k.="$r->course|";
			}else{
				$dk.=$r->program;
				$k.="$r->course";
			}
			
			
			$x++;
		}
		header("Content-Type: application/json");
		echo '
			{
				"label":"'.addcslashes($dk,'"').'",
				"no":"'.$k.'"
			}';
	}
?>