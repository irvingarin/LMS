<?php 
	
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Parents</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		 <!-- Material form register -->
                  
                            <!-- Material input text -->
                             <div class="md-form">
                                <input type="text" name="txtfname" id="txtfname" class="form-control" required="">
                                <label for="txtfname" class="font-weight-light">First Name</label>
                            </div>

                             <div class="md-form">
                                <input type="text" name="txtlname" id="txtlname" class="form-control" required="">
                                <label for="txtlname" class="font-weight-light">Last Name</label>
                            </div>

                            <div class="md-form">
                                <input type="text" name="txtmi" id="txtmi" class="form-control">
                                <label for="txtmi" class="font-weight-light">Middle Initial</label>
                            </div>

                            <div class="md-form">
                                
                                <input type="text" name="txtusername" id="txtusername" class="form-control" required="">
                                <label for="txtusername" class="font-weight-light">Username</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                <input type="password" name="txtpassword" id="txtpassword" class="form-control" required="">
                                <label for="txtpassword" class="font-weight-light">Password</label>
                            </div>
                            <div class="md-form">
                                <input type="password" name="txtcpassword" id="txtcpassword" class="form-control" required="">
                                <label for="txtcpassword" class="font-weight-light">Confirm Password</label>
                            </div>

                            <div class="text-center py-4 mt-3">
                                <button type="submit" name="btn-savePar" class="btn btn-primary btn-round float-right">Save</button>
                            </div>
                         
                       
	              		
	              	</form>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <div class="stats">
	                  <i class="fa fa-history"></i> Updated 3 minutes ago
	                </div>
	              </div>
	            </div>
			</div>
	          <div class="col-md-8">
	            <div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Parents</h5>
	                <p class="card-category">List of Parents</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">Username
						      </th>
						      <th class="th-sm">Name
						      </th>
						      <th></th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = allParents($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->username?></td>
						      <td><?=$gr->lname?>, <?=$gr->fname?></td>
						      <td><a href="#" title="Edit Parent" class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="nc-icon nc-ruler-pencil"></i></a>&nbsp; <a href="#" title="Add Child" data-remote="/addchild.php?p=<?=$gr->parent_id?>" class="btn btn-sm btn-outline-success btn-round btn-icon poop"><i class="nc-icon nc-single-02"></i></a></td>
						    </tr>
						    <?php } ?>
						  </tbody>
					</table>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <div class="stats">
	                  <i class="fa fa-history"></i> Updated 3 minutes ago
	                </div>
	              </div>
	            </div>
	          </div>
        </div>