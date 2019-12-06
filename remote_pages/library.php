                        <div class="row">
                                        
                                            <div class="card col-md-12">
                                                <div class="card-header">
                                                   <h5  class='text-primary'><i class="fa fa-archive fa-fw"></i>My Library</h5> 
                                                </div>
                                                 <div class="card-body">
                                                    <div class="row">
                                                        
                                                        <ul class="nav nav-tabs" id="filetab" role="tablist" style="width:100%">
                                                          <li class="nav-item">
                                                            <a class="nav-link active" id="myfiles-tab" data-toggle="tab" href="#myfiles" role="tab" aria-controls="myfiles"
                                                              aria-selected="true">My Files</a>
                                                          </li>
                                                          <li class="nav-item">
                                                            <a class="nav-link" id="sharedFiles-tab" data-toggle="tab" href="#sharedFiles" role="tab" aria-controls="sharedFiles"
                                                              aria-selected="false">Shared Files</a>
                                                          </li>
                                                        </ul>

                                                        <div class="tab-content" style="width:100%" id="myTabContent">
                                                              <div class="tab-pane fade show active" id="myfiles" role="tabpanel" aria-labelledby="myfiles-tab" style="background:#fff; color:#2b2b2b!important; border:thin solid #ccc">
                                                                <table id="dtatable" class="table table-bordered table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Description</th>
                                                                            <th>Subject</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            $sm = getAllModules1($id_no,$conn);
                                                                            while($smr =  mysqli_fetch_object($sm)){
                                                                                $cr =mysqli_fetch_object(class_by_id($smr->class_id));
                                                                        ?>
                                                                        <tr>
                                                                            <td><?=$smr->mod_title?></td>
                                                                            <td><?=$smr->mod_desc?></td>
                                                                            <td><?=$cr->subject_code?></td>
                                                                            <th>
                                                                                <a href="remote_pages/share_mat.php?esub=<?=$cr->class_id?>&mod=<?=$smr->mod_id?>"  title="Share Module" class='text-primary poop'><i class="fa fa-share-square"></i> Share</a>
                                                                                <?php 
                                                                                    if($smr->status=="Inactive"){
                                                                                ?>
                                                                                <a href="run_cmd.php?modid=<?=$smr->mod_id?>&mp=publish"  title="Publish" class='text-success'><i class="fa fa-play"></i> Publish</a>
                                                                                <?php }else{?>
                                                                                    <a href="run_cmd.php?modid=<?=$smr->mod_id?>&mp=unpublish"  title="unpublish" class='text-primary'><i class="fa fa-pause"></i> Unpublish</a>
                                                                                <?php }?>
                                                                                
                                                                            </th>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                              </div>
                                                              <div class="tab-pane fade" id="sharedFiles" role="tabpanel" aria-labelledby="sharedFiles-tab" style="background:#fff; color:#2b2b2b!important; border:thin solid #ccc">
                                                                 <table id="dtatable1" class="table table-bordered table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Description</th>
                                                                            <th>Subject</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            $sm = getShared($id_no);
                                                                            // $rr = mysql_fetch_array($sm);

                                                                            while($smr =  mysql_fetch_object($sm)){

                                                                                $m = mysql_fetch_object(getSharedModule($smr->mat_id));
                                                                                $cr =mysql_fetch_object(class_by_id($m->class_id));
                                                                        ?>
                                                                        <tr>
                                                                            <td><?=$m->mod_title?></td>
                                                                            <td><?=$m->mod_desc?></td>
                                                                            <td><?=$cr->subject_code?></td>
                                                                            <th>
                                                                                <a href="download.php?f=classes/class_<?=$m->class_id?>/<?=$m->mod_file?>"  title="Download Materials" class='text-primary'><i class="fa fa-share-square"></i> Download</a>
                                                                                
                                                                            </th>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                              </div>
                                                        </div>
                                                        
                                                    </div>
                                                <!-- News Content -->
                                                
                                                <!-- News Content -->
                                                 </div>
                                            </div>
                                        
                                    </div>