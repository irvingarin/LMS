<?php 
		include("conn.php");

		if(isset($_POST['f'])){
			if($_POST['f']=='t'){
				$id_no = $_POST['t'];
				$su = mysql_query("SELECT * FROM lms_class WHERE id_no='$id_no'");
					echo "<option value=''>-Select Subject-</option>";
				while($sr = mysql_fetch_object($su)){
					echo "<option value='$sr->subject_code'>$sr->subject_code</option>";
				}
			}
			if($_POST['f']=='s'){
					$id_no = $_POST['t'];
				$su = mysql_query("SELECT * FROM lms_class WHERE id_no='$id_no'");
					echo "<option value=''>-Select Subject-</option>";
				while($sr = mysql_fetch_object($su)){
					echo "<option value='$sr->subject_code'>$sr->subject_code</option>";
				}	
			}

		}
		
?>