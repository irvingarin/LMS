<?php 
  $links = "";
?>
  <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                    <?php 
                                        echo strtoupper($_GET['t']);
                                        $d = getModules($gid,$conn);
                                    ?>
                                    <?php 
                                      if($_SESSION['lms_m_type']=="Teacher"){

                                    ?>
                                    <div class="pull-right"><a href="#" data-activity="Add Materials" data-remote="remote_pages/new_module.php?c=<?=$gid?>" data-size="modal-md" title="Add New Materials" class="poop"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <?php } ?>
                              </div>
                              <div class="card-body">
                                <?php 
                                if(mysqli_num_rows($d)!=0){
                                    while($dr = mysqli_fetch_object($d)){
                                        if($_SESSION['lms_m_type']=="Teacher"){                                      
                                           $links = "<a href='#' data-remote='editmodule.php?mod=<?=$dr->mod_id?>' class='poop'><i class='fa fa-pencil fa-fw'></i></a> <a href='#' data-remote='confirm.php?type=module&del=<?=$dr->mod_id?>' class='poop red-text'><i class='fa fa-trash-o fa-fw'></i></a>";
                                       }
                                ?>
                                <blockquote class="blockquote mb-0">
                                  <div class="row mb-3">
                                      <div class="col-md-1 col-2">
                                        <i class="fa fa-book fa-2x indigo-text"></i>
                                      </div>
                                      <div class="col-md-11 col-10">
                                        <h5 class="font-weight-bold mb-3"><a href="dashboard.php?group=<?=$gid?>&mod_view=<?=$dr->mod_id?>" data-activity="View Materials id=<?=$dr->mod_id?>"><?=$dr->mod_title?></a> 
                                          <div class="pull-right">
                                            <?php 
                                              echo "$links";
                                            ?>
                                          </div></h5>
                                        <p class="grey-text"><?=$dr->mod_desc?></p>
                                      </div>
                                    </div>
                                    <footer class="blockquote-footer"> Date Added : <cite title="Source Title"><?=$dr->date_added?></cite> - Views <cite><?=$dr->views?></cite></footer>
                                </blockquote>
                                <hr />
                                <?php } 
                              }
                                ?>
                              </div>
                            </div>
                        </div>