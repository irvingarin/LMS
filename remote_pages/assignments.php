  <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                    <?php 
                                        echo strtoupper($_GET['t']);
                                        $d = getAllAss($gid,$conn);
                                    ?>
                                    <?php 
                                      if($_SESSION['lms_m_type']=="Teacher"){

                                    ?>
                                    <div class="pull-right"><a href="#" data-activity="Add Assignment" data-remote="remote_pages/new_ass.php?c=<?=$gid?>" data-size="modal-md" title="New Assignment" class="poop"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <?php } ?>
                              </div>
                              
                            </div>
                        </div>

                        
             <?php 
             if(!isset($_GET['v'])){
                                    while($dr = mysqli_fetch_object($d)){
                                     
                                ?>          
<div class="row">
  <div class="card max-width">
    <div class="card-header">
       <h5><?=$dr->ass_title?>
         <?php 
            if($_SESSION['lms_m_type']=="Teacher"){
              echo "<span class='pull-right'>";
              echo "<a href='#' data-remote='remote_pages/editAss.php?e=$dr->ass_id&c=".$_GET['group']."' data-size='modal-md' class='poop' title='Edit Assignment'><i class='fa fa-pencil'></i></a> ";
              echo "<a href='#' data-remote='remote_pages/confirm.php?m=assignment&c=".$_GET['group']."&qid=$dr->ass_id' title='Delete' class='poop text-danger'><i class='fa fa-trash-o'></i></a>";
              echo "</span>";
            }
         ?>
       </h5>
       <p class="pull-right deadline" data-deadline="<?=$dr->end_time?>"><i></i></p>
    </div>
    <div class="card-body">
                                
                                
                                  <div class="row mb-3">
                                      
                                      <div class="col-md-11 col-10">
                                       
                                        <p>
                                          <?=$dr->ass_desc?>
                                        </p>
                                      
                                      </div>
                                    </div>
                                    <footer class="blockquote-footer"> Date Added : <cite title="Source Title"><?=date("M d, Y - h:i:s",strtotime($dr->date_added))?></cite></footer>
                                
                                 <div class="timeline-nav ">
                                    <ul class="lms-time-nav nav-sm">
                                      <?php if($_SESSION['lms_m_type']=="Student"){ 
                                            $nowdate = date(strtotime(date("Y-m-d h:i:s a")));
                                            $deadline = date(strtotime($dr->end_time));
                                            $dif = $deadline-$nowdate;
                                             $myass = getAllMyAssignment($dr->ass_id,$_SESSION['lms_m_id_no'],$conn);
                                            if($dif<=0){
                                              echo"<li><small>";
                                               
                                              if(mysqli_num_rows($myass)!=0){
                                                echo "<a href='#' data-remote='remote_pages/myass.php?as_id=$dr->ass_id' style='color:#c0c0c0' class='poop btn btn-primary btn-sm btn-rounded' title='My Assignment'><i class='fa fa-eye'></i></a>";
                                              }else{
                                                
                                                echo "<p class='text-warning'>No Assignment Submitted</p>";
                                              }
                                              echo "</small></li>";
                                            }
                                            if($dif>0){
                                              echo"<li><small>";
                                              if($dr->filename==""){
                                              $lnk = "<p class='text-danger'>No Attachment</p>";
                                            }else{
                                              $lnk = "<a href='class_".$_GET['group']."' class='btn btn-primary btn-rounded btn-sm'><i class='fa fa-download'></i>Download Attachment</a>";
                                            }
                                            echo "</small></li>";

                                        ?>
                                        <li><small>

                                          <?php
                                            if(mysqli_num_rows($myass)!=0){
                                                 echo "<a href='#' data-remote='remote_pages/myass.php?as_id=$dr->ass_id' style='color:#c0c0c0' class='poop btn btn-primary btn-sm btn-rounded' title='My Assignment'><i class='fa fa-eye'></i></a>";
                                            }
                                           ?>
                                            <a href="remote_pages/submitAss.php?c=<?=$_GET['group']?>&a=<?=$dr->ass_id?>" data-activity="submit-assignement" class="btn btn-primary btn-sm btn-rounded poop" title="<?=$dr->ass_title?>"><i class="fa fa-rocket fa-fw"></i>Submit</a>
                                            <?php 

                                            ?></small>
                                        </li>
                                        <li><small><?=$lnk?></small></li>
                                      <?php }
                                        } else{
                                          if($dr->filename==""){
                                            $lnk = "<p class='text-danger'>No Attachment</p>";
                                          }else{
                                            $lnk = "<a href='class_".$_GET['group']."' class='btn btn-primary btn-rounded btn-sm'><i class='fa fa-download'></i>Download Attachment</a>";
                                          }

                                          ?>
                                         <li><small>

                                            <a href="dashboard.php?group=<?=$_GET['group']?>&t=assignments&v=<?=$dr->ass_id?>" data-activity="submit-assignement" class="btn btn-primary btn-rounded btn-sm" title="View Submision"><i class="fa fa-eye fa-fw"></i> View</a>
                                          </small>

                                        </li>
                                        <li><?=$lnk?></li>

                                      <?php } ?>
                                    </ul>
                                </div>
                                <br />
                            
                              </div>
  </div>
</div>
  <?php }
  }else{
    $dr=mysqli_fetch_object(getAssbyID($_GET['v']),$conn);
 ?>
<div class="row">
  <div class="card max-width">
    <div class="card-header">
       <?=$dr->ass_title?>
       <p class="pull-right deadline" data-deadline="<?=$dr->end_time?>"><i></i></p>
    </div>
    <div class="card-body">
                                
                                
                                  <div class="row mb-3">
                                      
                                      <div class="col-md-11 col-10">
                                       
                                        <p>
                                          <?=$dr->ass_desc?>
                                        </p>
                                      
                                      </div>
                                    </div>
                                    <footer class="blockquote-footer"> Date Added : <cite title="Source Title"><?=date("M d, Y - h:i:s",strtotime($dr->date_added))?></cite></footer>
                                
                                 
                                <br />
                            
                              </div>
  </div>
</div>
<?php  
    $ms = "";
    $ss = getAllSubmisions($_GET['v'],$conn);

?>
<div class="row">
  <div class="card max-width">
    <div class="card-header">
       Submitted
    </div>
    
    <div class="card-body">
        <?php 
       
        if(mysqli_num_rows($ss)==0){
            echo "<p class='text-danger'>No records found.</p>";
        }else{
            //$ms = mysql_num_rows($ss);
    ?>
         
          <div class="row">
               <div class="container-fluid">
                 <table id="dtatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                        <th>Student No.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php while($ssr = mysqli_fetch_object($ss)){ 
                           $mem = getMemberByid_no($ssr->id_no,$conn);
                           $mr = mysqli_fetch_object($mem);
                           $path = "classes/ass_".$_GET['v']."/".$ssr->filename;
                      ?>
                    <tr>
                        <td><?=$ssr->id_no?></td>
                        <td><?=$mr->st_lname?>, <?=$mr->st_fname?></td>
                        <td><?=date("Y-m-d", strtotime($ssr->date_uploaded))?></td>
                        <td><a href="<?=$path?>" class="text-primary"><i class="fa fa-download"></i> Download</a></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                 </table>
               </div>
           </div>
         <?php 
         } ?>
    </div>
<?php } ?>
</div>
</div>
