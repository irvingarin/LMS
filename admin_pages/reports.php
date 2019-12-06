<?php 
	$classes =getFclass();
	$user = mysql_fetch_object(getDeanProg($_SESSION['lms_admin_']));
?>
		<div class="row">
			<!-- <div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Reports</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              		
	              </div>
	              <div class="card-footer ">
	                <hr>
	               
	              </div>
	            </div>
			</div> -->
	          <div class="col-md-12">
	            <div class="card ">
	              <div class="card-header ">
	              	 <a href="admin_pages/rptnomat.php" class="btn btn-primary btn-round btn-sm float-right" target="_blank"><i class="fa fa-print"></i> Print</a>
	                <h5 class="card-title">Faculty Who Did Not Submit Materials</h5>
	                <p class="card-category">List of all Faculty</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">ID No
						      </th>
						      <th class="th-sm">Name
						      </th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = allfacultynomat($user->prog_id);
						  		while($gr = mysql_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->id_no?></td>
						      <td><?=$gr->st_lname?>, <?=$gr->st_fname?></td>
						    </tr>
						    <?php } ?>
						  </tbody>
					</table>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                
	                 
	                
	              </div>
	            </div>
	          </div>
        </div>