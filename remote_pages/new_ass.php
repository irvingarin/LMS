<?php 
  $c = $_GET['c'];
?>

	<form method="post" action="run_cmd.php?c=<?=$c?>" enctype="multipart/form-data">
		    <div class="md-form">
           <input type="text" name="txtass" id="txtass" class="form-control" required="">
           <label for="txtass" class="font-weight-light">Title *</label>
        </div>
         <div class="md-form">
           <textarea type="text" name="txtdesc" id="txtdesc" class="md-textarea form-control" required=""></textarea>
           <label for="txtdesc" class="font-weight-light">Description *</label>
        </div>
        <div class="md-form">
            <input type="date" name="txtend" id="txtend" class="form-control" min="<?=date("Y-m-d")?>" required="">
            <label for="txtend" class="font-weight-light active">Deadline *</label>
        </div>
        <div class="md-form">
            <input type="time" name="txttime" id="txttime" class="form-control"  required="">
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
        <button name="btnSaveAss" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Create</button>
	</form>
