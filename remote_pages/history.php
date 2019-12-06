                        <div class="row">
                                        
                                            <div class="card col-md-12">
                                                <div class="card-header">
                                                   <h5  class='text-primary'><i class="fa fa-calendar fa-fw"></i>History</h5> 
                                                </div>
                                                 <div class="card-body">
                                                    <div class="row">
                                                        
                                                        <!-- <ul class="nav nav-tabs" id="filetab" role="tablist" style="width:100%">
                                                          <li class="nav-item">
                                                            <a class="nav-link active" id="myfiles-tab" data-toggle="tab" href="#myfiles" role="tab" aria-controls="myfiles"
                                                              aria-selected="true">My Files</a>
                                                          </li>
                                                          <li class="nav-item">
                                                            <a class="nav-link" id="sharedFiles-tab" data-toggle="tab" href="#sharedFiles" role="tab" aria-controls="sharedFiles"
                                                              aria-selected="false">Shared Files</a>
                                                          </li>
                                                        </ul> -->
                                                        <div class="col-md-12">
                                                                 <table id="dtatable1" class="table table-bordered table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Subject</th>
                                                                            <th>Course Year & Sec</th>
                                                                            <th>Academic Year</th>
                                                                            <!-- <th>Actions</th> -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            $sm = getClasses($id_no,$conn);
                                                                            // $rr = mysql_fetch_array($sm);

                                                                            while($smr =  mysqli_fetch_object($sm)){
                                                                                $acad = mysqli_fetch_object(getActiveAcadByid($smr->acad_id,$conn));
                                                                                // $m = mysql_fetch_object(getSharedModule($smr->mat_id));
                                                                                // $cr =mysql_fetch_object(class_by_id($m->class_id));
                                                                        ?>
                                                                        <tr>
                                                                            <td><?=$smr->subject_code?> (<i><?=$smr->subject_desc?></i>)</td>
                                                                            <td><?=$smr->dept_code?> <?=$smr->year_lvl?></td>
                                                                            <td><?=$acad->school_year?> <?=$acad->semester?></td>
                                                                            <!-- <th> -->
                                                                                <!-- <a href="remote_pages/share_mat.php?esub=<?=$cr->class_id?>&mod=<?=$smr->mod_id?>"  title="Share Module" class='text-primary poop'><i class="fa fa-share-square"></i> Share</a> -->
                                                                                
                                                                            <!-- </th> -->
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                             
                                                        </div>
                                                        
                                                    </div>
                                                <!-- News Content -->
                                                
                                                <!-- News Content -->
                                                 </div>
                                            </div>
                                        
                                    </div>