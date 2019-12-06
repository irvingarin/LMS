<?php 
  include("../conn.php");
  include("../functions.php");

  $act_name="";
  $problem="";
  $act_id = "";
  if(isset($_GET['actid'])){
    $ar = mysql_fetch_object(getOneActivity($_GET['actid']));
    $act_id=$_GET['actid'];
    $act_name=$ar->act_title;
    $problem=$ar->activities_desc;


  }
?>

	<form method="post" action="run_cmd.php?c=<?=$_GET['g']?>" enctype="multipart/form-data">
		    <div class="md-form">
            <input type="hidden" name="txtid" value="<?=$act_id?>">
           <input type="text" name="txtactname" id="txtactname" class="form-control" value="<?=$act_name?>" required="">
           <label for="txtactname" class="font-weight-light active">Activity Name</label>
        </div>
         <div class="md-form">
           <textarea type="text" name="txtactdesc" id="txtactdesc" class="md-textarea form-control" required=""><?=$problem?></textarea>
           <label for="txtactdesc" class="font-weight-light active">Problem Description</label>
        </div>
        <button name="btnUpdateActivity" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Update</button>
	</form>
