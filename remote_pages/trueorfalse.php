<?php 
    include("../conn.php");
    include("../functions.php");

    $question = "";
    $strue = "";
    $sfalse = "";
    $btnName = "btnSaveQuestion";
    $btnValue = "Create";

    if(isset($_GET['m'])){
        if($_GET['m']=="edit"){
            $btnName = "btnUpdateQuestion";
            $btnValue = "Update";
            $ed=mysqli_fetch_object(getQuestionByID($_GET['ques'],$conn));
            $question = $ed->question;

            $k = mysqli_fetch_object(getKey($_GET['ques'],$conn));
            if($k->question_ans=="True"){
                $strue="Selected='Selected'";
                $sfalse="Selected=''";
            }else{
                $sfalse="Selected='Selected'";
                $strue="Selected=''";
            }
        }
    }
?>
	<form method="post" action="run_cmd.php?c=<?=$_GET['c']?>&qid=<?=$_GET['qid']?>">
		<input type="hidden" name="txttype" value="truefalse" />
        <input type="hidden" name="txtquesid" value="<?=$_GET['ques']?>" />
		<div class="form-group">
			<label for="txtquestion" class="font-weight-light">Question Prompt</label>
			<textarea type="text" name="txtquestion" id="txtquestion" class="form-control" required=""><?=$question?></textarea>
        </div>
        <br />
        <hr />
        
        <div class="form-group">
        	<label for="txtans" class="font-weight-light"><strong>Correct Answer</strong></label>
            <select class="form-control" name="txtans">
                <option value="True" <?=$strue?>>True</option>
                <option value="False" <?=$sfalse?>>False</option>
            </select>
        </div>

        <button name="<?=$btnName?>" class="btn btn-success btn-rounded btn-sm waves-effect waves-light" type="submit"><?=$btnValue?></button>
    </form>