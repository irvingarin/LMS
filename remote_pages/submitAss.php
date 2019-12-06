		<form method="post" action="run_cmd.php?c=<?=$_GET['c']?>&a=<?=$_GET['a']?>" enctype="multipart/form-data">
			<div class="md-form">
			<div class="file-field">
	            <div class="btn btn-primary btn-sm float-left">
	                <span>Choose files</span>
	                <input type="file" name="file" accept=".doc,.docx">
	            </div>
	            <div class="file-path-wrapper">
	                <input class="file-path form-control validate" type="text" placeholder="Upload one or more files">
	            </div>
	          </div>
	      	</div>
	      	<br />
	      	<button name="btnSubmitAss" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Submit</button>
          </form>