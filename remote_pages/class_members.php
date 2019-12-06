  <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                    <?php 
                                        echo strtoupper($_GET['t']);
                                        $d = getClassMembers($gid,$conn);
                                    ?>
                              </div>
                              <div class="card-body">
                                <table id="dtatable" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Student No</th>
                                      <th>Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      while($dr = mysqli_fetch_object($d)){
                                    ?>
                                    <tr>
                                      <td><?=$dr->id_no?></td>
                                      <td><?=$dr->st_lname?>, <?=$dr->st_fname?></td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                                
                              </div>
                            </div>
                        </div>

                        
                       
                      