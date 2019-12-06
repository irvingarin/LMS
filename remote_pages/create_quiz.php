<?php 
?>

<form method="post" action="run_cmd.php?c=<?=$_GET['c']?>">
	<div class="row">
		
			<div class="col-md-6">
				<div class="md-form">
					<input type="text" name="txtquiz_title" id="txtquiz_title" class="form-control" required="">
			        <label for="txtquiz_title" class="font-weight-light">Quiz Title</label>		
				</div>
			</div>
			<div class="col-md-6">
				<div class="md-form">
					<input type="text" name="txtduration" id="txtduration" class="form-control" required="">
			        <label for="txtduration" class="font-weight-light">Time Limit</label>		
			        <small class="form-text text-muted">
			        	Enter No of Minutes
			        </small>
				</div>
			</div>
			
	</div>
	<div class="md-form">
			<input type="date" name="txtendate" id="txtendate" class="form-control" min="<?=date("Y-m-d")?>" required="">
			 <label for="txtendate" class="font-weight-light active">Due Date</label>
	</div>
	<div style="clear:both;"></div>
			<br />
        <button name="btnCreateQuiz" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit">Create</button>		
</form>