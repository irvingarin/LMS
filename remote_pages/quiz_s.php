<?php 
  $minutes_to_add = $qd->time_limit;
  $time = new DateTime();
  $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

  $stamp = $time->format('Y-m-d H:i');

  $cookie_name = $_SESSION['lms_m_id_no']."_q_".$qd->quiz_id;
  if(!isset($_COOKIE[$cookie_name])){
    // setcookie($cookie_name, $stamp, time() + (86400 * 30), "/");
    $_COOKIE[$cookie_name] = $stamp;
  }
  
  // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<form action="run_cmd.php?c=<?=$_GET['group']?>&qid=<?=$_GET['qid']?>" method="post">
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
                    
                  </div>
              </div>
              <div class="col-md-2">
                  <br />
                  <?php 
                    $tl = date("i:s",strtotime("00:".$qd->time_limit.":00"));
                    $tll = $_COOKIE[$cookie_name];
                  ?>
                  <p><i class="fa fa-clock-o"></i> <span class="lms_timer" data-limit='<?=$tll?>'><?=$tl?></span> Left</p>

              </div>

            </div>

            <div class="row">
              
            <div class="col-sm-2 col-md-2">
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

          <div class="col-sm-10 col-md-10">

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
                  $max = mysqli_num_rows($q);
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
                            <?php 
                              if($qqcount<$max){
                            ?>
                            <!-- <label class="float-right" for="q<?=$qqcount+1?>-tab">
                            <a class="" data-qid="<?=$qrow->question_id?>" id="qq<?=$qqcount+1?>-tab" href="#q<?=$qqcount+1?>" role="tab"><i class="fa fa-save"></i></a>
                            </label> -->
                            <?php }else{?>
                              <button type="submit" class="float-right btn btn-primary btn-sm btn-rounded" name="btnSubmitAns">Submit</button>
                            <?php } ?>
                          </h4>
                          <p><?=$qrow->question?></p>
                          <input type="hidden" name="txtqid[]" value="<?=$qrow->question_id?>">
                          <hr />
                          <div class="row">
                             
                              <div class="col-md-6">
                                  <?php if($qrow->q_type=="multi"){?>
                                  <h5 class="text-primary">Multiple Choice</h5>
                                  
                                   <?php 
                                  
                                      $ch = getChoises($qrow->question_id,$conn);
                                      while($chr = mysqli_fetch_object($ch)){

                                    ?>
                                    
                                      <div class="custom-control custom-radio">
                                        <input type="radio" value="<?=$chr->choice_letter?>" required="" class="custom-control-input" id="option<?=$chr->choice_id?>" name="txtans<?=$qrow->question_id?>">
                                        <label class="custom-control-label" for="option<?=$chr->choice_id?>"><?=$chr->choice_letter?>: <?=$chr->choices?></label>
                                      </div>
                                   


                                  <?php }
                                  }
                                  if($qrow->q_type=="truefalse"){
                                   ?> 
                                   
                                   <h5 class="text-primary">True or False</h5>
                                   <div class="custom-control custom-radio">
                                      <input type="radio" value="True" class="custom-control-input" id="txttrue<?=$qrow->question_id?>" required="" name="txtans<?=$qrow->question_id?>">
                                      <label class="custom-control-label" for="txttrue<?=$qrow->question_id?>">True</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" value="False" class="custom-control-input" id="txtfalse<?=$qrow->question_id?>" required="" name="txtans<?=$qrow->question_id?>">
                                      <label class="custom-control-label" for="txtfalse<?=$qrow->question_id?>">False</label>
                                    </div>
                                   
                                <?php }
                                  if($qrow->q_type=="ident"){
                                 ?> <h5 class="text-primary">Identification</h5>
                                  <div class="form-group">

                                    <input type="text" name="txtans<?=$qrow->question_id?>" class="form-control" required="" />
                                    <label class="control-label">Enter Answer</label>
                                  </div> 
                               <?php }?>
                              </div>
                              <div class="col-md-6">
                                  <?php 
                                    $k = mysqli_fetch_object(getKey($qrow->question_id,$conn));
                                  ?>
                                  
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
</form>