<?php 
  $mod = $_GET['mod'];
  $c = $_GET['c'];
?>

	<form method="post" action="run_cmd.php?c=<?=$c?>&m=<?=$mod?>" enctype="multipart/form-data">
    <p class="text-danger"><strong>Note: <i>For C++ Subjects Only</i></strong></p>
		    <div class="md-form">
           <input type="text" name="txtactname" id="txtactname" class="form-control" required="">
           <label for="txtactname" class="font-weight-light">Exercise Name</label>
        </div>
         <div class="md-form">
           <textarea type="text" name="txtactdesc" id="txtactdesc" class="md-textarea form-control" required=""></textarea>
           <label for="txtactdesc" class="font-weight-light">Problem Description</label>
        </div>
        <button name="btnSaveActivity" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Create</button>
	</form>
