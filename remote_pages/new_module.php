<?php 
  $c = $_GET['c'];
?>
<div class="container-fluid">
	<form method="post" action="run_cmd.php?c=<?=$c?>" enctype="multipart/form-data">
		    <div class="md-form">
           <input type="text" name="txtmodulename" id="txtmodulename" class="form-control" required="">
           <label for="txtmodulename" class="font-weight-light">Name</label>
           <small  class="form-text text-muted">
                Name of Materials eg(Course Syllabus, Chapter I - Introduction)
           </small>
        </div>
         <div class="md-form">
           <textarea type="text" name="txtmod_desc" id="txtmod_desc" class="md-textarea form-control" required=""></textarea>
           <label for="txtmod_desc" class="font-weight-light">Material Description</label>
           <small  class="form-text text-muted">
                Description of Course Materials
           </small>
        </div>
        <div class="md-form">
          <div class="file-field">
            <div class="btn btn-primary btn-sm float-left">
                <span>Choose files</span>
                <input type="file" name="file" multiple accept=".pdf,.ppt,.doc,.docx" required="">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more files">
            </div>
          </div>
          <small class="form-text text-muted">
                File type must be (.PDF, .PPT, .Doc or .Doc)
           </small>
        </div>
        
       
        <button name="btnsave_module" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Create</button>
	</form>
</div>