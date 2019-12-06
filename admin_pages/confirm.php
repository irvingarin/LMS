<?php 
	$warning = "";
	if(isset($_GET['m'])){
		//if($_GET['m']=='college'){
			$warning = $_GET['m'];
		//}
	}
	if(isset($_GET['s'])){
		if($_GET['s']=="inuse"){
			?>
			<p ><h5 class="text-warning text-center"><i class="fa fa-warning"></i> <?=$warning?> is already in use.</h5></p>
			<hr />
			<div class="col-sm-12">
				<button type="button" class="close btn btn-primary btn-rounded btn-sm btn-block " data-dismiss="modal">OK</button>
			</div>
			<?php
		}else{
?>
<form method="post" action="lms_exe.php?mode=<?=$_GET['m']?>&id=<?=$_GET['id']?>">
	<div class="container-fluid">
		<p class="text-danger"><i class="fa fa-warning fa-2x"></i> Delete this <?=$warning?>?</p>
		<div class="row">
			<div class="col-sm-6">
				<button type="submit" name="btnConfirm" class="btn btn-primary btn-rounded btn-sm btn-block">Yes</button>
			</div>
			<div class="col-sm-6">
				<button type="button" class="close btn btn-danger btn-rounded btn-sm btn-block " data-dismiss="modal">No</button>
			</div>
		</div>
		<br />
	</div>
</form>
<?php } 
	}
?>