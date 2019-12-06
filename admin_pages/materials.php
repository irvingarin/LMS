<?php 
	
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Course Syllabus</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php" enctype="multipart/form-data">
	              		 <!-- Material form register -->
                  
                            <!-- Material input text -->
                             <div class="md-form">
                                <input type="text" name="txttitle" id="txttitle" class="form-control" required="">
                                <label for="txttitle" class="font-weight-light">Subject Code</label>
                            </div>

                             <div class="md-form">
                                <input type="text" name="txtdesc" id="txtdesc" class="form-control" required="">
                                <label for="txtdesc" class="font-weight-light">Description</label>
                            </div>

                            <div class="md-form">
                                <input type="file" name="txtfile" id="txtfile" class="form-control" accept="application/pdf">
                                <label for="txtfile" class="font-weight-light active">File</label>
                            </div>
 
                            <div class="text-center py-4 mt-3">
                                <button type="submit" name="btn-saveM" class="btn btn-primary btn-round float-right">Save</button>
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
	                <h5 class="card-title">Materials</h5>
	                <p class="card-category">List of Materials</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">Subject Code
						      </th>
						      <th class="th-sm">Description
						      </th>
						      <th></th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = allSyllabus();
						  		while($gr = mysql_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->mat_title?></td>
						      <td><?=$gr->mat_desc?></td>
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