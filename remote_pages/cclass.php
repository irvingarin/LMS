<?php 

?>
<div class="container-fluid">
	<form method="post" action="run_cmd.php">
		<div class="md-form">
           <input type="text" name="txtcoursecode" id="txtcoursecode" class="form-control" required="">
           <label for="txtcoursecode" class="font-weight-light">Course Code</label>
        </div>
        <div class="md-form">
           <input type="text" name="txtclasscode" id="txtclasscode" class="form-control" required="">
           <label for="txtclasscode" class="font-weight-light">Class code of your class</label>
        </div>
        
        <div class="md-form">
           <textarea type="text" name="txtdesc" id="txtdesc" class="form-control" required=""></textarea>
           <label for="txtdesc" class="font-weight-light">Course Description</label>
        </div>
        <button name="btnCreate" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Create</button>
	</form>
</div>