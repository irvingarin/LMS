<?php 
?>

	<form method="post" action="run_cmd.php" enctype="multipart/form-data">
      <p>Import Class From Excel</p>
		    <div class="md-form">
           <input type="hidden" name="id_no" value="<?=$_GET['id']?>">
           <input type="file" name="txtfile" id="txtfile" class="form-control" />
           <label for="txtfile" class="font-weight-light active">Select File</label>
        </div>
        <button name="btn-importClass" class="btn btn-primary btn-round float-right waves-effect waves-light" type="submit">Go</button>
	</form>
