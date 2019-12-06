<?php session_start();
	include("../conn.php");
	include("../functions.php");
	// echo $_SESSION['lms_m_id_no'];

?>

<form method="post" action="run_cmd.php">
		<div class="md-form">
			<input type="hidden" name="txtmid" value='<?=$_GET['mod']?>'>
			<select class="form-control" name="shareto[]" id="shareto" multiple="">
				<option value='All'>All With Same Subject</option>
				<?php 
				$f = getFacSameCsub($_GET['esub']);
				while($fr=mysql_fetch_object($f)){
					echo "<option value='$fr->id_no'>$fr->st_lname, $fr->st_fname</option>";
				}
				?>
			</select>
			 <label for="shareto" class="font-weight-light active">Share to</label>
		</div>
        <button name="btnShare" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Share</button>		
</form>