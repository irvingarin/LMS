<?php 
  include("../conn.php");
  include("../admin_fn.php");
  $f = mysqli_fetch_object(allFbyID($_GET['id'],$conn));
  $af = allActiveFaculty($conn);
?>
	<form method="post" action="lms_exe.php">
      <p>Assign subtitute of <?=$f->st_lname?>, <?=$f->st_fname?></p>

		    <div class="md-form">
           <input type="hidden" name="id_no" value="<?=$_GET['id']?>">
           <select class="form-control" name="txtsubid" required="">
              <?php 
                while($afr=mysqli_fetch_object($af)){
                  echo "<option value='$afr->id_no'>$afr->st_lname, $afr->st_fname</option>";
                }
              ?>
           </select>
           <!-- <input type="text" name="txtsubid" id="txtsubid" class="form-control" /> -->
           <label for="txtsubid" class="font-weight-light active">Select Faculty</label>
        </div>

        <button name="btn-assSub" class="btn btn-primary btn-round float-right waves-effect waves-light" type="submit">Assign</button>
	</form>
