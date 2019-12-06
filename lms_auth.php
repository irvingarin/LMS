<?php 
	session_start();
	include("conn.php");
	function sanitize($text) {
		  $text = htmlspecialchars($text, ENT_QUOTES);
		  $text = str_replace("\n\r","\n",$text);
		  $text = str_replace("\r\n","\n",$text);
		  $text = str_replace("\n","<br>",$text);
		  return $text;
	}
	include("admin_fn.php");
	if(isset($_POST['btnlogin'])){
		$un = sanitize($_POST['txtusername']);
		$pw = sanitize($_POST['txtpassword']);

		$auth = auth_admin($un, $pw,$conn);

		if(mysqli_num_rows($auth)!=0){
			$_SESSION['lms_admin_']=$un;
			$tr = mysqli_fetch_object($auth);
			$type = $tr->type;
			 $_SESSION['lms_adm_type'] = $type;
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-primary alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Welcome '.$tr->adm_name.' </span><a href="#" target="_blank" data-notify="url"></a></div>';

				header("Location: lms_admin.php");

		}else{
			$_SESSION['notif'] = '<div id="toast-container" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon toast-top-right animated slideInUp" role="alert" data-notify-position="top-right" ><button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class="nc-icon nc-simple-remove"></i></button><span data-notify="icon" class="nc-icon nc-bell-55"></span> <span data-notify="title"></span> <span data-notify="message">Error! Incorrect username or password.</span><a href="#" target="_blank" data-notify="url"></a></div>';

				header("Location: lms_login.php");
		}
	}
?>