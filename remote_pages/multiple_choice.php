<?php 
	include("../conn.php");
	include("../functions.php");
	$question = "";
	$answer = "";
	$option1 = "";
	$option2 = "";
	$option3 = "";
	$ans="";
	$btnName = "btnSaveQuestion";
	$btnValue = "Create";
	if(isset($_GET['m'])){
		if($_GET['m']=="edit"){
			$btnName = "btnUpdateQuestion";
			$btnValue = "Update";
			$ed=mysqli_fetch_object(getQuestionByID($_GET['ques'],$conn));
			$question = $ed->question;
			$x = 0;
			$cc = getChoises($_GET['ques'],$conn);
			
			$k = mysqli_fetch_object(getKey($_GET['ques'],$conn));
			$ans=$k->question_ans;
		}
	}
?>
	<form method="post" action="run_cmd.php?c=<?=$_GET['c']?>&qid=<?=$_GET['qid']?>">
		<input type="hidden" name="txttype" value="multi" />
		<input type="hidden" name="txtquesid" value="<?=$_GET['ques']?>" />
		<div class="form-group">
			<label for="txtquestion" class="font-weight-light">Question Prompt</label>
			<textarea type="text" name="txtquestion" id="txtquestion" class="form-control" required=""><?=$question?></textarea>
        </div>
        <br />
        <hr />
        Responses
        <?php 
        	if(isset($_GET['m'])){
        ?>
        <div class="responses">
        	<?php 
        		$ch = "A";
        		while($choice = mysqli_fetch_object($cc)){
					// $x++;
					// if($x==1){
					// 	$option1=$choice->choices;	
					// }
					// if($x==2){
					// 	$option2=$choice->choices;	
					// }
					// if($x==3){
					// 	$option3=$choice->choices;	
					// }
				
        	?>
	        <div class="form-group">
	        	<label for="txtop<?=$ch?>" class="font-weight-light"><strong><?=$ch?></strong></label>
	           	<input type="text" name="txtop[]" id="txtop<?=$ch?>" value="<?=$choice->choices?>" class="form-control" required="">
	        </div>
	       
	    <?php 
	    		$ch++;
			} 
		?>
        </div>
        <button type="button" data-opt="<?=$ch?>" class="btn btn-primary btn-rounded btn-sm adChoice">Add Choice</button>
        <?php 	}else{ ?>
        <div class="responses">
	        <div class="form-group">
	        	<label for="txtopA" class="font-weight-light"><strong>A</strong></label>
	           	<input type="text" name="txtop[]" id="txtopA" value="<?=$option1?>" class="form-control" required="">
	        </div>
        </div>
        <button type="button" data-opt="B" class="btn btn-primary btn-rounded btn-sm adChoice">Add Choice</button>
        <?php }?>
       
        <br />
        <hr />
        <div class="form-group">
        	<label for="txtans" class="font-weight-light"><strong>Correct Answer</strong></label>
           	<input type="text" name="txtans" id="txtans" class="form-control" value="<?=$ans?>" required="">
        </div>
        <button name="<?=$btnName?>" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit"><?=$btnValue?></button>
    </form>

    