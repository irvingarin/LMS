    <?php 
     // $adl = $_GET['e'];
    ?>
    <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                    <?php 
                                        echo strtoupper($_GET['t']);
                                        $d = getModules($gid,$conn);
                                    ?>
                                    
                              </div>

                              <?php 
                                if(isset($_GET['e'])){
                                  $act = mysqli_fetch_object(getOneActivity($_GET['e'],$conn));
                                  $exe = getExcerciseList($_GET['e'],$conn);
                                  
                              ?>
                              <div class="card-body">
                                  <h4><?=$act->act_title?></h4>
                                  <hr />
                                  <table id="dtatable" class="table table-condensed table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Student Name</th>
                                              <th>Date Saved</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                          while($exer = mysqli_fetch_object($exe)){


                                        ?>
                                          <tr>
                                              <td><?=$exer->st_lname?>, <?=$exer->st_fname?></td>
                                              <td><?=$exer->date_saved?></td>
                                              <td>
                                                <a href="download.php?f=<?=$exer->file_path?>/<?=$exer->filename?>" target="_blank" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-download"></i> Download</a>
                                                <a href="cppide.php?f=<?=$exer->file_path?>&fl=<?=$exer->filename?>&e=<?=$_GET['e']?>" target="_blank" class="btn btn-rounded btn-sm btn-success"><i class="fa fa-code"></i> Test</a>
                                              </td>
                                          </tr>
                                        <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                                <?php
                                }else{
                              ?>
                              <div class="card-body">
                                <?php 
                                    while($dr = mysqli_fetch_object($d)){
                                      $act = getActivities($dr->mod_id,$conn);
                                ?>
                                <blockquote class="blockquote mb-0">
                                  <div class="row mb-3">
                                      <div class="col-md-1 col-2">
                                        <i class="fa fa-book fa-2x indigo-text"></i>
                                      </div>
                                      <div class="col-md-11 col-10">
                                        <h5 class="font-weight-bold mb-3"><a href="dashboard.php?group=<?=$gid?>&mod_view=<?=$dr->mod_id?>"><?=$dr->mod_title?></a>
                                          <?php 
                                            if($_SESSION['lms_m_type']=="Teacher"){
                                          ?>
                                        <div class="pull-right">
                                            <a href='#'' data-remote='remote_pages/new_activity.php?c=<?=$gid?>&mod=<?=$dr->mod_id?>'' data-size='modal-md' title='Add New Exercise' class='poop'><i class='fa fa-plus'></i></a>
                                        </div>

                                      <?php } ?>
                                      </h5>
                                        
                                        <!-- Activities -->
                                        <?php 
                                          if(mysqli_num_rows($act)==0){
                                            echo "<h5 class='pink-text'>There are 0 Exercise Available</h5>";
                                          }else{
                                          while($acr = mysqli_fetch_object($act)){
                                        ?>
                                        <blockquote class="blockquote mb-0">
                                            <div class="row mb 3">
                                                <div class="col-md-1 col-2">
                                                  <i class="fa fa-coffee indigo-text"></i>
                                                </div>
                                                <div class="col-md-11 col-10">
                                                     <h5 class="font-weight-bold mb-3"><?=$acr->act_title?> 
                                                     <?php if($_SESSION['lms_m_type']=="Teacher"){?>
                                                       <a href="#" data-remote="remote_pages/edit_act.php?g=<?=$_GET['group']?>&actid=<?=$acr->mod_ac_id?>" title="Edit Activity" class="pull-right poop text-success"><i class="fa fa-pencil"></i></a>
                                                       <?php }?>
                                                     </h5>
                                                      <p class="grey-text"><?=$acr->activities_desc?></p>
                                                </div>
                                            </div>
                                            <footer class="blockquote-footer">
                                                <a href="cppide.php?g=<?=$gid?>&x=<?=$acr->mod_ac_id?>" target="_blank" class="btn btn-success btn-sm btn-rounded">Go To Editor</a>
                                                <?php 
                                                  if($_SESSION['lms_m_type']=="Teacher"){
                                                ?>
                                                <a href="dashboard.php?group=<?=$gid?>&t=activities&e=<?=$acr->mod_ac_id?>" class="btn btn-success btn-sm btn-rounded">View </a>
                                                <?php } ?>
                                            </footer>
                                        </blockquote>
                                        <?php } 
                                          }
                                        ?>
                                        <!-- /Activities -->
                                      </div>
                                    </div>
                                    <footer class="blockquote-footer"> Date Added : <cite title="Source Title"><?=$dr->date_added?></cite> - Views <cite><?=$dr->views?></cite></footer>
                                </blockquote>
                                <hr />
                                <?php } ?>
                              </div>

                              <?php } ?>


                            </div>
                        </div>