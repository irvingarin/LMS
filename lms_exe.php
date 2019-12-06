<?php session_start();
	include("conn.php");
	include ("admin_fn.php");


	function sanitize($text) {
		  $text = htmlspecialchars($text, ENT_QUOTES);
		  $text = str_replace("\n\r","\n",$text);
		  $text = str_replace("\r\n","\n",$text);
		  $text = str_replace("\n","<br>",$text);
		  return $text;
	}

	if(isset($_POST['btn-saveMission'])){
		$mission = sanitize($_POST['txtmission']);
		$vision = sanitize($_POST['txtvision']);
		$obj = sanitize($_POST['txtobjectives']);

		$m = inLmsSettings($mission, $vision, $obj);
		if($m==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! Successfully added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Adding failed.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=settings");
	}

	if(isset($_POST['btn-saveP'])){
		$p = sanitize($_POST['txtprogram']);
		$d = sanitize($_POST['txtdesc']);
		$i = inProgram($p, $d,$conn);
		if($i==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New College Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add new College.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=college");
	}
	if(isset($_POST['btn-upMission'])){
		
		$mission = sanitize($_POST['txtmission']);
		$vision = sanitize($_POST['txtvision']);
		$obj = sanitize($_POST['txtobjectives']);
		$sid = $_POST['txtsetid'];

		$m = updateSettings($mission, $vision, $obj, $sid,$conn);
		if($m==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! Successfully updated.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Update failed.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=settings");
	}

	if(isset($_POST['btn-editP'])){
		$pid = $_POST['txtpid'];
		$p = sanitize($_POST['txtprogram']);
		$d = sanitize($_POST['txtdesc']);

		$s = upProgram($pid, $p, $d,$conn);
		// if($s=="exist"){
		// 	$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! College Already Exist</span><a href="#" target="_blank" data-notify="url"></a></div>';
		// }else{
			if($s==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success!  College Updated.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to update college.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
		// }
		header("Location: lms_admin.php?d=college");
	}

	if(isset($_POST['btn-saveS'])){
		$sc = sanitize($_POST['txtsubcode']);
		$sd = sanitize($_POST['txtsubdesc']);

		$i = inSubjects($sc, $sd);

		if($i == true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New Subject Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add new subject.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=subjects");
	}
	if(isset($_POST['btn-saveE'])){
		$en = sanitize($_POST['txtevent']);
		$ed = sanitize($_POST['txtdesc']);
		$es = $_POST['txtstart'];
		$ee = $_POST['txtend'];

		$i = inEvent($en, $ed, $es, $ee);
		if($i == true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New Event Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			createCalendar();
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add new event.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=events");
	}
	if(isset($_POST['btn-upEv'])){
		$en = $_POST['txtevent'];
		$ed = $_POST['txtdesc'];
		$es = $_POST['txtstart'];
		$ee = $_POST['txtend'];
		$eid = $_POST['txteid'];

		$edit = editEvent($en, $ed, $es, $ee, $eid,$conn);
		if($edit==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success!  Event Updated.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			createCalendar($conn);
		}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to edit new event.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=events");
	}
	if(isset($_POST['btn-saveF'])){
		$idno = sanitize($_POST['txtid_no']);
		$fname = sanitize($_POST['txtfname']);
		$lname = sanitize($_POST['txtlname']);
		$mi = sanitize($_POST['txtmi']);
		$un = sanitize($_POST['txtusername']);
		$pw = sanitize($_POST['txtcpassword']);
		$dept_code = sanitize($_POST['txtdept']);
		$exist = ifExist($idno);
		if($exist > 0){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Id no. already exist.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
		$lms_r = in_members($idno, $fname, $lname, $mi, $un, $pw);
		$tag = tag_faculty($idno,$dept_code);
			if($lms_r==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New Faculty Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add new faculty.</span><a href="#" target="_blank" data-notify="url"></a></div>';
				
			}
		}
		header("Location: lms_admin.php?d=faculty");
	}

	if(isset($_POST['btn-upF'])){
		$idno = sanitize($_POST['txtid_no']);
		$fname = sanitize($_POST['txtfname']);
		$lname = sanitize($_POST['txtlname']);
		$mi = sanitize($_POST['txtmi']);
		$dept_code = sanitize($_POST['txtdept']);
		$up = updateF($idno,$fname,$lname,$mi,$conn);
		$tag = uptag_faculty($idno,$dept_code,$conn);
		if($up==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Update Successful.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to update faculty.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=faculty");
	}

	if(isset($_POST['btn-savePar'])){
		$fn = sanitize($_POST['txtfname']);
		$ln = sanitize($_POST['txtlname']);
		$mi = sanitize($_POST['txtmi']);
		$un = sanitize($_POST['txtusername']);
		$pw = sanitize($_POST['txtcpassword']);

		$i = inParents($fn,$ln,$mi,$un,$pw);
		if($i ==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New Parent Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add new Parent.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: index.php");
	}

	if(isset($_POST['btn-saveM'])){
		$mt = sanitize($_POST['txttitle']);
		$md = sanitize($_POST['txtdesc']);

		$fileName = $_FILES['txtfile']['name'];
		$tmpName  = $_FILES['txtfile']['tmp_name'];
		$fileSize = $_FILES['txtfile']['size'];
		$fileType = $_FILES['txtfile']['type'];

		function getExtension($str) {
					 $i = strrpos($str,".");
					 if (!$i) { return ""; }
					 $l = strlen($str) - $i;
					 $ext = substr($str,$i+1,$l);
					 return $ext;
			 }
			 
			 $extension = getExtension($fileName);
			 $extension = strtolower($extension);
			 $final_filename = time().".".$extension;
			 $folder_name = "syllabus/";
			 if( !file_exists("materials/".$folder_name) ){
			 	mkdir("materials/".$folder_name);
			 }
			 $copied = move_uploaded_file($tmpName, "materials/".$folder_name."/". $final_filename)or die();
			 $i = inSyllabus($mt,$md,1,$final_filename,'Syllabus');

			 if($i == true){
			 	$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New Faculty Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			 }else{
			 	$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add new faculty.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			 }

			 header("Location: lms_admin.php?d=materials");

	}

	if(isset($_POST['btn-adLogin'])){
		$u = sanitize($_POST['txtusername']);
		$p = sanitize($_POST['txtpassword']);

		$auth = authAdmin($u, $p);

		if(mysql_num_rows($auth)!=0){
			$_SESSION['ad_username'] = $u;
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Welcome Admin.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			header("Location: lms_admin.php");
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Incorrect Username or Password.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			header("Location: authadmin.php");
		}
	}

	if(isset($_POST['btn-saveChild'])){
		$st = sanitize($_POST['txtstno']);
		$p = sanitize($_GET['p']);

		$a = adChild($st,$p);

		if($a == true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! New Child Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add Child</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=parents");
	}

	if(isset($_POST['btn-saveDean'])){
		$fname = sanitize($_POST['txtfname']);
		$lname = sanitize($_POST['txtlname']);
		$mi = sanitize($_POST['txtmi']);
		$degree = sanitize($_POST['txtdegre']);

		$col = sanitize($_POST['txtprog']);

		$i = inDeans($fname,$mi,$lname, $col,$degree,$conn);

		if($i===true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Success! Dean Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			if($i=="Exist"){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Already Exist!</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add dean</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
		}
		
		header("Location: lms_admin.php?d=deans");
	}

	if(isset($_POST['btn-upStat'])){
		$stat = $_POST['txtstat'];
		$id = $_POST['id_no'];
		$ups=updateStatus($id,$stat,$conn);

		if($ups==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Status Updated.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Update Failed</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location:lms_admin.php?d=faculty");
	}

	if(isset($_POST['btn-assSub'])){
		$id = $_POST['id_no'];
		$sub_id = sanitize($_POST['txtsubid']);

		$sub = sub_ass($id,$sub_id);
		if($sub==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">success.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to assign subtitute</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}

		header("Location: lms_admin.php?d=faculty");
	}
	if(isset($_POST['btn-SaveAcad'])){
		$sy = $_POST['txtsy'];
		$sem = $_POST['txtsem'];
		$i = addAcad($sy, $sem);

		if($i==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Saved.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to save.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=acadsettings");
	}

	if(isset($_GET['stat'])){
		$st = "";
		$ms = "";
		$acd = $_GET['acad'];
		if($_GET['stat']=="Active"){
			$st = "Active";
			$ms = "Activated";
		}else{
			$st = "Inactive";
			$ms = "Deactivated";
		}
		$ac = ActivateDeactivate($acd,$st,$conn);
		if($ac==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">'.$ms.'</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to update.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
		header("Location: lms_admin.php?d=acadsettings");

	}

	if(isset($_POST['btn-saveDep'])){
		$code = sanitize($_POST['txtdept']);
		$desc = sanitize($_POST['txtdesc']);

		$prog_id = sanitize($_POST['txtprogram']);
		if(ExistDept($code,$conn)==0){
			$inD = newDepartment($code,$desc,$prog_id,$conn);

			if($inD==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">New Department Added.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to add department.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Department Already Exist.</span><a href="#" target="_blank" data-notify="url"></a></div>';	
		}
		header("Location: lms_admin.php?d=department");
	}
	if(isset($_POST['btn-upDept'])){
		$code = sanitize($_POST['txtdept']);
		$desc = sanitize($_POST['txtdesc']);

		$prog_id = sanitize($_POST['txtprogram']);
		$id = $_POST['txtdeptid'];

		// if(ExistDept($code)==0){
			$upD = upDepartment($code,$desc,$prog_id,$id,$conn);
			if($upD==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message"> Department Updated.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to update department.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}

		// }
		header("Location: lms_admin.php?d=department");

	}
	if(isset($_POST['btn-upDean'])){
		// $name = sanitize($_POST['txtname']);
		$did = $_POST['deanid'];
		$prog = $_POST['txtprog'];
		$fname = sanitize($_POST['txtfname']);
		$lname = sanitize($_POST['txtlname']);
		$mi = sanitize($_POST['txtmi']);
		$degree = sanitize($_POST['txtdegre']);

		// $edit = editDean($name,$prog,$did);
		$edit =editDean($fname,$lname,$mi,$prog,$did,$degree,$conn);
		if($edit==true){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Dean has been Updated.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			if($edit != "exist"){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Already Exist!.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to update dean.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
		}
		header("Location: lms_admin.php?d=deans");
	}
	if(isset($_POST['btnConfirm'])){
		$id = $_GET['id'];
		if($_GET['mode']=="college"){
			$s = delProgram($id,$conn);
			if($s==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Deleted.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to delete.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
			header("Location: lms_admin.php?d=".$_GET['mode']);
		}
		if($_GET['mode']=="department"){
			$s = removeDept($_GET['id'],$conn);

			if($s==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Deleted.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to delete.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
			header("Location: lms_admin.php?d=".$_GET['mode']);
		}
		if($_GET['mode']=="settings"){
			$s = removeSettings($_GET['id']);

			if($s==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Deleted.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Failed to delete.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
			header("Location: lms_admin.php?d=".$_GET['mode']);
		}

	}
	if(isset($_GET['emode'])){

		$eid = $_GET['e'];

		if($_GET['emode']=="postevent"){
			$mode = "Active";
			$s=upEvent($mode,$eid,$conn);
			if($s==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Status Change to Published.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Failed to Change Status.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
		}
		if($_GET['emode']=="unpost"){
			$mode = "Inactive";
			$s=upEvent($mode,$eid,$conn);
			if($s==true){
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Status Change to unpublish	.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}else{
				$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Failed to Change Status.</span><a href="#" target="_blank" data-notify="url"></a></div>';
			}
		}
		header("Location: lms_admin.php?d=events");

	}
	if(isset($_POST['btn-changePass'])){
		
		$currpasswrod = sanitize($_POST['txtoldpassword']);
		$user = $_SESSION['lms_admin_'];
		$chk = verifyChangePass($user,$currpasswrod);

		$npass = sanitize($_POST['txtnpassword']);
		$cpass = sanitize($_POST['txtcpassword']);
		if($chk==0){
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Incorrect Current Password.</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}else{
			if($npass==$cpass){
				$change = AdminchangePassword($user,$cpass);
				if($change==true){
					$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Password Changed.</span><a href="#" target="_blank" data-notify="url"></a></div>';	
				}else{
					$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Failed to change password.</span><a href="#" target="_blank" data-notify="url"></a></div>';
				}
			}
		else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container " class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Password did not mathced</span><a href="#" target="_blank" data-notify="url"></a></div>';
		}
	}
		header("Location: lms_admin.php");
	}
?>
