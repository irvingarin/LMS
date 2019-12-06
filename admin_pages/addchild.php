<?php 
	$p = $_GET['p'];
?>
<form method="post" action="run_cmd.php?p=<?=$p?>">
	<div class="md-form">
		<input type="text" name="txtstno" class="form-control" id="txtstno" required="">
		<label for="txtstno" class="font-weight-light">Student No *</label>
	</div>
	<button type="submit" name="btn-saveChild" class="btn btn-primary btn-sm btn-rounded float-right">Save</button>
</form>