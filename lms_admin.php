<?php 
	session_start();
	include("conn.php");
	include("admin_fn.php");

	$msg = "";
	$dboard="Dashboard";
	
	if(!isset($_SESSION['lms_admin_'])){
		header("Location: lms_login.php");
	}

	if(isset($_SESSION['notif'])){
		$msg = $_SESSION['notif'];
		unset($_SESSION['notif']);
	}
	if(isset($_GET['d'])){
		if($_GET['d']=="out"){
			session_destroy();
			header("Location: lms_login.php");
		}
	}
	$tit="";
	if(isset($_GET['d'])){
		$dboard=$_GET['d'];
		$tit=$_GET['d'];
	}else{
		$tit="";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?=strtoupper($_SESSION['lms_adm_type'])?> | <?=strtoupper($tit)?></title>
	<?php 
		include("lmsa/head.php");
	?>
</head>
<body>
	<?=$msg?>
	<div class="wrapper">
		<?php 
			include("lmsa/sidebar.php");
		?>	
		<div class="main-panel ps-container ps-theme-default ps-active-y">
			<!-- Nav -->
			<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
		        <div class="container-fluid">
		          <div class="navbar-wrapper">
		            <div class="navbar-toggle">
		              <button type="button" class="navbar-toggler">
		                <span class="navbar-toggler-bar bar1"></span>
		                <span class="navbar-toggler-bar bar2"></span>
		                <span class="navbar-toggler-bar bar3"></span>
		              </button>
		            </div>
		            <a class="navbar-brand" href="#"><?=$dboard?></a>
		          </div>
		          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
		            <span class="navbar-toggler-bar navbar-kebab"></span>
		            <span class="navbar-toggler-bar navbar-kebab"></span>
		            <span class="navbar-toggler-bar navbar-kebab"></span>
		          </button>
		          <div class="navbar-collapse justify-content-end collapse" id="navigation" style="">
		            <p class="text-info font-weight-light"><i class="nc-icon nc-circle-10"></i> <?=$use->adm_name?>!</p>
		           <!--  <ul class="navbar-nav">
		              <li class="nav-item">
		                <a class="nav-link btn-magnify" href="#pablo">
		                  <i class="nc-icon nc-layout-11"></i>
		                  <p>
		                    <span class="d-lg-none d-md-block">Stats</span>
		                  </p>
		                </a>
		              </li>
		              <li class="nav-item btn-rotate dropdown">
		                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                  <i class="nc-icon nc-bell-55"></i>
		                  <p>
		                    <span class="d-lg-none d-md-block">Some Actions</span>
		                  </p>
		                </a>
		                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		                  <a class="dropdown-item" href="#">Action</a>
		                  <a class="dropdown-item" href="#">Another action</a>
		                  <a class="dropdown-item" href="#">Something else here</a>
		                </div>
		              </li>
		              <li class="nav-item">
		                <a class="nav-link btn-rotate" href="#pablo">
		                  <i class="nc-icon nc-settings-gear-65"></i>
		                  <p>
		                    <span class="d-lg-none d-md-block">Account</span>
		                  </p>
		                </a>
		              </li>
		            </ul> -->
		          </div>
		        </div>
		      </nav>
			<!-- End Nav-->
			<div class="content">
			<?php 
				if(isset($_GET['d'])){
					if($_GET['d']=='college'){
						include("admin_pages/program.php");
					}
					if($_GET['d']=='subjects'){
						include("admin_pages/subjects.php");
					}
					if($_GET['d']=='events'){
						include("admin_pages/events.php");
					}
					if($_GET['d']=='faculty'){
						include("admin_pages/faculties.php");
					}
					if($_GET['d']=='deans'){
						include("admin_pages/deans.php");
					}
					if($_GET['d']=='students'){
						include("admin_pages/students.php");	
					}
					if($_GET['d']=='parents'){
						include("admin_pages/parents.php");	
					}
					if($_GET['d']=="materials"){
						include("admin_pages/materials.php");		
					}
					if($_GET['d']=="department"){
						include("admin_pages/departments.php");		
					}
					if($_GET['d']=="monitor"){
						include("admin_pages/monitor.php");		
					}
					if($_GET['d']=="settings"){
						include("admin_pages/lms_settings.php");		
					}
					if($_GET['d']=="faculty list"){
						include("admin_pages/facultylist.php");
					}
					if($_GET['d']=="class monitor"){
						//include("admin_pages/class_monitor.php");	
					}
					if($_GET['d']=="reports"){
						include("admin_pages/reports.php");		
					}
					if($_GET['d']=="acadsettings"){
						include("admin_pages/acadsettings.php");		
					}
				}else{
					include("admin_pages/class_monitor.php");	
				}
				
			?>
			</div>
			<?php 
				include("lmsa/footer.php");
			?>
		</div>
	</div>

	<?php 
		include("lmsa/plugins.php");
	?>
</body>
</html>