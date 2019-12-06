<?php 
    $qr = getQuizResult($_GET['qid'], $_SESSION['lms_m_id_no'],$conn);
    $correct = coutCorrect($_GET['qid'], $_SESSION['lms_m_id_no'],$conn)  
  
  // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<div class="row">
  <div class="card max-width">
    <div class="card-header">
       <strong><?=strtoupper($qd->quiz_title)?></strong> Result
    </div>
    <div class="card-body">
      <div class="row">
         <div class="col-md-12">
            <div>
              <h3 class="text-center">You've Got <?=$correct?> out of <?=mysqli_num_rows($qr)?></h3>
            </div>
            <hr />
            <table class="table table-condensed">
                <thead>
                  <tr>
                    <th>Question</th>
                    <th>Your Anwer</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  
                    $anser = "";

                    $coloor_correct="";
                    while($qrow = mysqli_fetch_object($qr)){
                      $type=$qrow->q_type;

                      if($qrow->status=="Correct"){
                        $coloor_correct = "class='lms-light-green-2'";
                      }else{
                        $coloor_correct="";
                      }
                      if($type=="multi"){
                        $anser = getKeyByQ($qrow->question_id,$qrow->answer,$conn);
                      }else{
                        $anser = $qrow->answer;
                      }

                  ?>
                  <tr <?=$coloor_correct?>>
                    <td><?=$qrow->question?></td>
                    <td><?=$anser?></td>
                    <td><?=$qrow->status?></td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>   
         </div>
      </div>
                                
                            
    </div>
  </div>
</div>
