<?php 
	$warning = "";
	if(isset($_GET['m'])){
		if($_GET['m']=='question'){
			$warning = $_GET['m'];
		}
	}
?>

<form method="post" action="run_cmd.php?c=<?=$_GET['c']?>&qid=<?=$_GET['qid']?>">
	<input type="hidden" name="txtques" value="<?=$_GET['qid']?>">
	<input type="hidden" name="txtmode" value="<?=$_GET['m']?>">
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