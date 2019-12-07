<?php session_start();
include("../conn.php");
include("../admin_fn.php");
$user = mysqli_fetch_object(getDeanProg($_SESSION['lms_admin_'],$conn));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	 <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/calendar.css" rel="stylesheet">
    <link href="../css/paper-dashboard.min.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
	<link href="../css/addons/datatables.min.css" rel="stylesheet">
	<style type="text/css">
		body{
			background: #fff!important;
		}
		h1{
			font-family: "Old English Text MT";
			margin-bottom: 5px!important;
		}
		hr {
			border: 3px double #2b2b2b;
		}
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
	<div class="prtheader text-center">
		<img src="../img/logo.png" class="float-right" width="100px">
		<p><h1>Pangasinan State University</h1>
			Lingayen Pangasinan<br />
		Website: www.psu.edu.ph<br />
		Telephone:(075) 206-0802 Telefax: (075) 542-4261/4057</p>
		<hr />

	</div>
	<br />
	<br />
	<h5 class="text-center">Faculty Who Did Not Submit Materials</h5>
	<p class="text-center">As of <?=date("M, Y")?></p>
	<br />
	<br />
	<div class="container-fluid">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>ID No</th>
					<th>Name</th>
					<!-- <th>Subject</th> -->
				</tr>
			</thead>
			<tbody>
				<?php 
				$f = allfacultynomat($user->prog_id,$conn);
				while($fr = mysqli_fetch_object($f)){
					$name =$fr->st_lname.", ". $fr->st_fname
				?>
				<tr>
					<td><?=$fr->id_no?></td>
					<td><?=ucfirst($name)?></td>
					<!-- <td></td> -->
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>


