<?php 
	
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">New School Year and Semester</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
	              				<?php 
                                		$sy = date("Y");
                                		$sy2 = $sy-1;
                                		$sy1 = $sy+1;
                                ?>
                                <select class="form-control" name="txtsy">
                                	<option value="<?=$sy2?>-<?=$sy?>"><?=$sy2?>-<?=$sy?></option>
                                	<option value="<?=$sy?>-<?=$sy1?>"><?=$sy?>-<?=$sy1?></option>
                                </select>
                                <label for="txysy" class="font-weight-light active">School Year</label>
	              		</div>
	              		<div class="md-form">
                                <select name="txtsem" class="form-control">
                                	<option>1st Semester</option>
                                	<option>2nd Semester</option>
                                	<option>Mid Year</option>
                                </select>
                                <label for="txtsem" class="font-weight-light active">Semester</label>
	              		</div>
	              		
	              		<button type="submit" name="btn-SaveAcad" class="btn btn-primary btn-round float-right">Save</button>
	              	</form>
	              </div>
	              <div class="card-footer ">
	                <!-- <hr>
	                <div class="stats">
	                  <i class="fa fa-history"></i> Updated 3 minutes ago
	                </div> -->
	              </div>
	            </div>
			</div>
	          <div class="col-md-8">
	            <div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Events</h5>
	                <p class="card-category">List of all Events</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">School Year
						      </th>
						      <th class="th-sm">Semester
						      </th>
						      <th class="th-sm">Status
						      </th>
						      <th>Action</th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = allAcad($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->school_year?></td>
						      <td><?=$gr->semester?></td>
						      <td><?=$gr->status?></td>
						      <td>
						      	<?php 
						      		if($gr->status=='Inactive'){
						      	?>
						      	<a href="lms_exe.php?acad=<?=$gr->acad_id?>&stat=Active" class='btn btn-round btn-primary btn-sm'>Activate</a>
						      	<?php } else{?>
						      	<a href="lms_exe.php?acad=<?=$gr->acad_id?>&stat=Inactive" class='btn btn-round btn-danger btn-sm'>
						      	Deactivate</a>
						      	<?php }?>
						      </td>
						    </tr>
						    <?php } ?>
						  </tbody>
					</table>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <div class="stats">
	                  <!-- <i class="fa fa-history"></i> Updated 3 minutes ago -->
	                </div>
	              </div>
	            </div>

	          </div>
        </div>