<?php 
	// $p = $_GET['p'];
?>
<form method="post" action="lms_exe.php">
	<div class="md-form">
		<input type="password" name="txtoldpassword" class="form-control" id="txtpassword" required="">
		<label for="txtpassword" class="font-weight-light">Current Password</label>
	</div>
	<div class="md-form">
		<input type="password" name="txtnpassword" class="form-control" id="txtnpassword" required="">
		<label for="txtnpassword" class="font-weight-light">New Password</label>
	</div>
	<div class="md-form">
		<input type="password" name="txtcpassword" class="form-control" id="txtcpassword" required="">
		<label for="txtcpassword" class="font-weight-light">Confirm Password</label>
	</div>
	<button type="submit" name="btn-changePass" class="btn btn-primary btn-sm btn-rounded float-right">Submit</button>
</form>