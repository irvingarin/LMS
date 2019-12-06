<div class="row">
  <div class="card max-width">
    <div class="card-header">
       <?=strtoupper($qd->quiz_title)?>
    </div>
    <div class="card-body">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                  
              </div>
              <div class="col-md-8">
                  <div class="md-form">
                    <select class="form-control qtype" data-groupid="<?=$_GET['group']?>" data-quizid="<?=$_GET['qid']?>">
                        <option value="multi">Multiple Choice</option>
                        <option value="true">True or False</option>
                        <option value="ident">Identification</option>
                    </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <br />
                    <a href="#" data-remote="remote_pages/multiple_choice.php?c=<?=$_GET['group']?>&qid=<?=$_GET['qid']?>" class="btn btn-rounded btn-primary btn-sm poop addQ" data-size="modal-md" title='Add Question'><i class="fa fa-plus"></i></a>

              </div>

            </div>
            <div class="row">
              
            <div class="col-md-2">
            <ul class="nav nav-tabs block-nav" id="myTab" role="tablist">
              <li class="nav-item lms_navitem disabled">
              <a class="nav-link" id="question-tab" data-toggle="tab" href="#" role="tab" aria-controls="question"
                aria-selected="true">Questions</a>
            </li>
            <?php 
                $q = getQuestions($_GET['qid'],$conn);
                $count = mysqli_num_rows($q);
                $qcount = 1;
                if($count<=0){
                  ?>
                  <li class="nav-item lms_navitem">
                    <a class="nav-link active" id="q<?=$qcount?>-tab" data-toggle="tab" href="#q<?=$qcount?>" role="tab" aria-controls="q<?=$qcount?>"
                      aria-selected="true"><?=$qcount?></a>
                  </li>
                  <?php
                }
                else{
                  //$qcount=0; 
                  $selected="true";
                  $active = "active";
                for($x=1;$x<=$count; $x++){
                  $qcount=$x;
                  if($x>1){
                    $selected="false";
                    $active="";
                  }

            ?>
            <li class="nav-item lms_navitem">
              <a class="nav-link <?=$active?>" id="q<?=$qcount?>-tab" data-toggle="tab" href="#q<?=$qcount?>" role="tab" aria-controls="q<?=$qcount?>"
                aria-selected="<?=$selected?>"><?=$qcount?></a>
            </li>
            <?php 
                }
              } 
            ?>
          </ul>
          </div>
          <div class="col-md-10">

              <div class="tab-content" id="myTabContent">
                <?php 
                  if($count<=0){
                    ?>
                    <div class="tab-pane lms-q-tab fade show active" id="q1" role="tabpanel"aria-labelledby="q1">
                         <?php 
                           // include("remote_pages/multiple_choice.php");
                          ?>
                    </div>
                    <?php
                  }else{
                  $qqcount=0;
                  $activeshow = "active show";
                  $lnk = "";
                  while($qrow=mysqli_fetch_object($q)){
                    $qqcount+=1;
                    if($qqcount>1){
                      $activeshow = "";
                    }
                    if($qrow->q_type=="multi"){
                      $lnk = "remote_pages/multiple_choice.php?c=".$_GET['group']."&qid=".$_GET['qid']."&ques=".$qrow->question_id."&m=edit";
                    }
                    if($qrow->q_type=="true"){
                      $lnk = "remote_pages/trueorfalse.php?c=".$_GET['group']."&qid=".$_GET['qid']."&ques=".$qrow->question_id."&m=edit";
                    }
                    if($qrow->q_type=="ident"){
                      $lnk = "remote_pages/indentification.php?c=".$_GET['group']."&qid=".$_GET['qid']."&ques=".$qrow->question_id."&m=edit";
                    }
                ?>
                <div class="tab-pane lms-q-tab fade <?=$activeshow?>" id="q<?=$qqcount?>" role="tabpanel"aria-labelledby="q<?=$qqcount?>">
                  
                    <div class="row">
                        <div class="container-fluid">
                          <h4 class="text-primary">Question 
                            <a href="#" title="Confirm Deletion" data-remote="remote_pages/confirm.php?c=<?=$_GET['group']?>&qid=<?=$_GET['qid']?>&ques=<?=$qrow->question_id?>&m=question" class="pull-right poop"><i class="fa fa-trash-o text-danger"></i></a>

                            <a href="#" title="Edit Question" data-remote="<?=$lnk?>" data-size="modal-md" class="pull-right poop"><i class="fa fa-pencil"></i> &nbsp;</a>

                          </h4>
                          <p><?=$qrow->question?></p>

                          <hr />
                          <div class="row">
                             
                              <div class="col-md-6">
                                  <?php if($qrow->q_type=="multi"){?>
                                  <h5 class="text-primary">Choices</h5>
                                   <?php 
                                  }
                                      $ch = getChoises($qrow->question_id,$conn);
                                      while($chr = mysqli_fetch_object($ch)){

                                    ?>
                                      <h5><?=$chr->choice_letter?>: <?=$chr->choices?></h5> 
                                  <?php } ?>     
                              </div>
                              <div class="col-md-6">
                                  <?php 
                                    $k = mysqli_fetch_object(getKey($qrow->question_id,$conn));
                                  ?>
                                  <h5 class="text-success">Correct Answer: <?=$k->question_ans?></h5>
                              </div>
                            
                          </div>
                          
                        
                        </div>
                    </div>
                  
                </div>
                <?php 
                  }
                }
                ?>  
              </div>
            </div>
              </div>
          </div>
      </div>
                                
                            
    </div>
  </div>
</div>