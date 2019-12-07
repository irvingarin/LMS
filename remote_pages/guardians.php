<?php 
  $gg = getGuardians($_SESSION['lms_m_id_no'],$conn);
?>
  <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                    Guardian Informations
                                    <a href="#" class="pull-right poop" data-remote="remote_pages/newGuardian.php" title="Add New Guardian"><i class="fa fa-plus"></i> New Guardian</a>
                              </div>
                              <div class="card-body">
                                
                                <table id="dtatable" class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                          <th>Guardian</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        while($ggr =mysqli_fetch_object($gg)){
                                          $name = $ggr->lname.", ".$ggr->fname." ".$ggr->mname;
                                      ?>
                                        <tr>
                                          <td><?=$name?></td>
                                          <td><a href="#"  data-remote="remote_pages/newGuardian.php?m=e&i=<?=$ggr->gid?>" title="Update Details" class="text-primary poop" ><i class="fa fa-pencil"></i> Update</a></td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>