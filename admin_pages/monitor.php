<?php 
	$user = mysqli_fetch_object(getDeanProg($_SESSION['lms_admin_'],$conn));
	$feed = getFeed($user->prog_id,$conn);
	// echo "user ".$user->prog_id." ".$_SESSION['lms_admin_'];

?>
		<div class="row">
			<div  class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="card ">
							<div class="card-header">
								<h5>Faculty</h5>
								<hr />
							</div>
							<div class="card-body">
								<?php 

								?>
								<table class="table table-condensed">
									<thead>
										<tr>
											<th>ID No</th>
											<th>Name</th>
											<th>Status</th>
											<th>No <br />Materials</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$d = facindept($user->prog_id,$conn);
											while($dr=mysqli_fetch_object($d)){
												$cc = countFeed($dr->id_no,$conn);

										?>
										<tr>
											<td><?=$dr->id_no?></td>
											<td><?=ucfirst($dr->st_fname)?></td>
											<td><?=$dr->status?></td>
											<td><span class="badge badge-primary text-center"><?=mysqli_num_rows($cc)?></span></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="container-fluid"  style="height: 500px; overflow-y: auto ">
				<?php 
					
					while($feedRow = mysqli_fetch_object($feed)){
						$fa = mysqli_fetch_object(allFbyID($feedRow->id_no,$conn));
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
			              <div class="card-header ">
			              	<span class="float-right"><?=date("M d, Y h:i:s A",strtotime($feedRow->date_added))?></span>
			                <p class="card-category"><?=$fa->st_fname?> <?=$feedRow->action?></p>
			                <hr />
			              </div>
			              <div class="card-body ">
			              		<h4><?=$feedRow->title?></h4>
			              </div>
			              <!-- <div class="card-footer ">
			                <hr>
			                <div class="stats">
			                  <i class="fa fa-history"></i> Updated 3 minutes ago
			                </div>
			              </div> -->
			            </div>
		        	</div>
	        	</div>
	        <?php }?>
	        	</div>
			</div>
	         
        </div>