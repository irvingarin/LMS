
	<form method="post" action="lms_exe.php">
		    <div class="md-form">
           <input type="hidden" name="id_no" value="<?=$_GET['id']?>">
           <select name="txtstat" class="form-control" id="txtstat">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
              <option value="AWOL">AWOL</option>
           </select>
           <label for="txtstat" class="font-weight-light active">Update Status</label>
        </div>
        <button name="btn-upStat" class="btn btn-primary btn-round float-right waves-effect waves-light" type="submit">Update</button>
	</form>
