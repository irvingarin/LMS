<?php 
  
?>
  <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                   <?=strtoupper($_GET['t'])?>
                                    <?php 
                                      if($_SESSION['lms_m_type']=="Teacher"){

                                    ?>
                                    <div class="pull-right"><a href="#" data-activity="Create Quiz" data-remote="remote_pages/create_quiz.php?c=<?=$gid?>" data-size="modal-md" title="Create Quiz" class="poop"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <?php } ?>
                              </div>
                              
                            </div>
                        </div>

                        
             <?php 
            if(!isset($_GET['qid'])){
            ?>          
<div class="row">
  <div class="card max-width">
    <div class="card-header">
       My Quizzes
    </div>
    <div class="card-body">
      <div class="row">
         <div class="col-md-12">
          <table class="table table-condensed quiz_list">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Date Modified</th>
                  <th>Due Date</th>
                  <th>Action</th>
                </tr>
              </thead>
               <tbody>
              <?php 
              $q_list="";
                if($_SESSION['lms_m_type']=="Student"){
                  $q_list=allQuizStudent($_GET['group'],$conn);
                }else{

                $q_list = allQuiz($_GET['group'],$conn);
              }

                while($qr = mysqli_fetch_object($q_list)){
                  $dd=alreadyExam($qr->quiz_id, $_SESSION['lms_m_id_no'],$conn)
              ?>
                <tr>
                  <td><i class="fa fa-check-circle-o"></i></td>
                  <td><?=$qr->quiz_title?></td>
                  <td><?=date("M d, Y",strtotime($qr->date_added))?></td>
                  <td><?=date("M d, Y", strtotime($qr->duedate))?></td>
                  <?php 
                    if($_SESSION['lms_m_type']=="Student"){
                    
                      
                  ?>
                  <td>
                    <?php 
                    
                      if(mysqli_num_rows($dd)==0){
                      if(date("Y-m-d")<=date("Y-m-d", strtotime($qr->duedate))){
                        ?>
                        <a href="?group=<?=$_GET['group']?>&t=quiz&qid=<?=$qr->quiz_id?>" class="btn btn-primary btn-rounded btn-sm ripple"><i class="fa fa-play"></i> Start</a>
                        <?php
                         }else{
                    ?>
                        <label class="text-danger">Ended</label>
                    <?php
                  }
                     ?>
                    
                  <?php }else{?>
                    <a href="?group=<?=$_GET['group']?>&t=quiz&qid=<?=$qr->quiz_id?>" class="btn btn-primary btn-rounded btn-sm ripple"><i class="fa fa-eye"></i> Result</a>
                  </td>
                <?php }
                 
              } else{ ?>
                  <td>

                    <a href="?group=<?=$_GET['group']?>&t=quiz&qid=<?=$qr->quiz_id?>" class="text-primary" title="Manage"><i class="fa fa-cog"></i></a>
                    <a href="remote_pages/quiz_result.php?qid=<?=$qr->quiz_id?>" class="text-success poop" data-size="modal-lg" title="Quiz Result" title="Manage"><i class="fa fa-eye"></i></a>
                    <?php if($qr->status=="Inactive"){?>
                    <a href="run_cmd.php?group=<?=$_GET['group']?>&t=quiz&qid=<?=$qr->quiz_id?>&post=true" class="text-success" title="Post"><i class="fa fa-play"></i></a>
                    <?php } else{?>
                      <a href="run_cmd.php?group=<?=$_GET['group']?>&t=quiz&qid=<?=$qr->quiz_id?>&post=false" class="text-warning" title="Pause"><i class="fa fa-pause"></i></a>
                    <?php }?>
                  </td>
                <?php } ?>
              
              <?php } ?>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
                                
                            
    </div>
  </div>
</div>
  <?php 
  }else{
    $qd = mysqli_fetch_object(getQuiz($_GET['qid'],$conn));
      if($_SESSION['lms_m_type']=="Teacher"){
        include("remote_pages/quiz_t.php");
      }
      if($_SESSION['lms_m_type']=="Student"){
        // $minutes_to_add = $qd->time_limit;

        // $time = new DateTime();
        // $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

        // $stamp = $time->format('Y-m-d H:i');
        // $cookie_name = $_SESSION['lms_m_id_no'];
        // $cookie_value = $stamp;
        // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $done = alreadyExam($_GET['qid'], $_SESSION['lms_m_id_no'],$conn);
        if(mysqli_num_rows($done)>0){
          include("remote_pages/quiz_r.php");
        }else{
          include("remote_pages/quiz_s.php");
        }
      }
   ?> 
    
   <?php 
  }
  ?>

