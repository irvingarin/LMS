<?php 
    include("../conn.php");
    include("../functions.php");

    $question = "";
    $ans = "";
    $btnName = "btnSaveQuestion";
    $btnValue = "Create";

    if(isset($_GET['m'])){
        if($_GET['m']=="edit"){
            $btnName = "btnUpdateQuestion";
            $btnValue = "Update";
            $ed=mysql_fetch_object(getQuestionByID($_GET['ques']));
            $question = $ed->question;

            $k = mysql_fetch_object(getKey($_GET['ques']));
            $ans=$k->question_ans;
        }
    }
?>
	<form method="post" action="run_cmd.php?c=<?=$_GET['c']?>&qid=<?=$_GET['qid']?>">
		<input type="hidden" name="txttype" value="ident" />
        <input type="hidden" name="txtquesid" value="<?=$_GET['ques']?>" />
		<div class="form-group">
			<label for="txtquestion" class="font-weight-light">Question Prompt</label>
			<textarea type="text" name="txtquestion" id="txtquestion" class="form-control" required=""><?=$question?></textarea>
        </div>
        <br />
        <hr />
        
        <div class="form-group">
        	<label for="txtans" class="font-weight-light"><strong>Correct Answer</strong></label>
            <input type="text" class="form-control" value="<?=$ans?>" name="txtans" />
        </div>

        <button name="<?=$btnName?>" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit"><?=$btnValue?></button>
    </form>