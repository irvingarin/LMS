<?php 
    include("../conn.php");
    include("../functions.php");
    $title = "";
    $desc = "";
    $deadline = "";
    $time = "";
    if(isset($_GET['e'])){
      $a = mysql_fetch_object(getAssbyID($_GET['e']));

      $title = $a->ass_title;
      $desc = $a->ass_desc;
      $deadline = date("Y-m-d", strtotime($a->end_time));
      $time = date("H:i", strtotime($a->end_time));

    }
  $c = $_GET['c'];
?>

	<form method="post" action="run_cmd.php?c=<?=$c?>" enctype="multipart/form-data">
		    <div class="md-form">
           <input type="hidden" name="txtasid" id="txtasid" class="form-control" required="" value="<?=$_GET['e']?>"> 
           <input type="text" name="txtass" id="txtass" class="form-control" required="" value="<?=$title?>">
           <label for="txtass" class="font-weight-light active">Title *</label>
        </div>
         <div class="md-form">
           <textarea type="text" name="txtdesc" id="txtdesc" class="md-textarea form-control" required=""><?=$desc?></textarea>
           <label for="txtdesc" class="font-weight-light active">Description *</label>
        </div>
        <div class="md-form">
            <input type="date" name="txtend" id="txtend" class="form-control" min="<?=date("Y-m-d")?>" required="" value="<?=$deadline?>">
            <label for="txtend" class="font-weight-light active">Deadline *</label>
        </div>
        <div class="md-form">
            <input type="time" name="txttime" id="txttime" class="form-control" value="<?=$time?>"  required="">
            <label for="txttime" class="font-weight-light active">Time *</label>
        </div>
        <div class="md-form">
          <div class="file-field">
            <div class="btn btn-primary btn-sm float-left">
                <span>Choose files</span>
                <input type="file" name="file"  accept=".doc,.docx">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more files">
            </div>
          </div>
          <small class="form-text text-muted">
                File type must be (.doc or .docx)
           </small>
        </div>

       <!--  <div class="md-form">
          <div class="file-field">
            <div class="btn btn-primary btn-sm float-left">
                <span>Choose files</span>
                <input type="file" name="file" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more files">
            </div>
          </div>
        </div> -->
        
       <br />
        <button name="btnUpdateAss" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Update</button>
	</form>
