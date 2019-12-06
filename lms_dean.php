<?php 
	session_start();
	include("conn.php");
	include("admin_fn.php");

	$msg = "";
	$dboard="Dashboard";
	
	if(isset($_SESSION['notif'])){
		$msg = $_SESSION['notif'];
		session_unset($_SESSION['notif']);
	}
	if(isset($_GET['d'])){
		$dboard=$_GET['d'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title></title>
	<?php 
		include("lmsa/head.php");
	?>
</head>
<body>
	<?=$msg?>
	<div class="wrapper">
		<?php 
			include("lmsa/sidebar.php?user=dean");
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
		            <form>
		              <div class="input-group no-border">
		                <input type="text" value="" class="form-control" placeholder="Search...">
		                <div class="input-group-append">
		                  <div class="input-group-text">
		                    <i class="nc-icon nc-zoom-split"></i>
		                  </div>
		                </div>
		              </div>
		            </form>
		            <ul class="navbar-nav">
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
		            </ul>
		          </div>
		        </div>
		      </nav>
			<!-- End Nav-->
			<div class="content">
			<?php 
				if(isset($_GET['d'])){
					if($_GET['d']=='programs'){
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
				}else{
					include("admin_pages/dashboard.php");	
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