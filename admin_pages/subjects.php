<?php 
	
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Add Subjects</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
                                <input type="text" name="txtsubcode" id="txtsubcode" class="form-control">
                                <label for="txtsubcode" class="font-weight-light">Subject Code</label>
	              		</div>
	              		<div class="md-form">
                                <input type="text" name="txtsubdesc" id="txtsubdesc" class="form-control">
                                <label for="txtsubdesc" class="font-weight-light">Subject Description</label>
	              		</div>
	              		<button type="submit" name="btn-saveS" class="btn btn-primary btn-round float-right">Save</button>
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
	                <h5 class="card-title">Subjects</h5>
	                <p class="card-category">List of all Subjects</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">Program
						      </th>
						      <th class="th-sm">Description
						      </th>
						      <th></th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = getAllSub($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->subj_code?></td>
						      <td><?=$gr->subj_desc?></td>
						      <td><a href="#"><i class="nc-icon nc-ruler-pencil"></i></a></td>
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