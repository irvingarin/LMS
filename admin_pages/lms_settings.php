<?php 
	$mission = "";
	$vision = "";
	$guiding = "";
	$btnName = "btn-saveMission";
	$btnValue = "Save";
	if(isset($_GET['mode'])){
		 $r = mysqli_fetch_object(editSettings($_GET['e'],$conn));
		 $mission = $r->lms_mission;
		 $vision = $r->lms_vision;
		 $guiding = $r->lms_objectives;

		 $btnName = "btn-upMission";
		 $btnValue = "Update";

	}
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
	              <div class="card-header ">
	                <h5 class="card-title">LMS Settings</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
	              				<input type="hidden" name="txtsetid" value="<?=$_GET['e']?>" class="form-control">
                                <textarea class="form-control" id="txtmission" name="txtmission"  required=""><?=$mission?></textarea>
                                <label for="txtmission" class="font-weight-light">Mission</label>
	              		</div>
	              		<div class="md-form">
                                <textarea class="form-control" name="txtvision" id="txtvision"><?=$vision?></textarea>
                                <label for="txtvision" class="font-weight-light">Vision</label>
	              		</div>
	              		<div class="md-form">
                            	<textarea class="form-control" name="txtobjectives" id="txtobjectives"><?=$guiding?></textarea>
                                <label for="txtobjectives" class="font-weight-light active">Guiding Philosophy</label>
	              		</div>
	              		
	              		<button type="submit" name="<?=$btnName?>" class="btn btn-primary btn-round float-right"><?=$btnValue?></button>
	              	</form>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <!-- <div class="stats">
	                  <i class="fa fa-history"></i> Updated 3 minutes ago
	                </div> -->
	              </div>
	            </div>
			</div>
	          <div class="col-md-8">
	            <div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Mission Vision and Guiding Philosophy</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">Mission
						      </th>
						      <th class="th-sm">Vision
						      </th>
						      <th>Objectives</th>
						      <th>Action</th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = activeSettings($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  			// $assoc = countDeptAsoc($gr->dept_code);
						  	?>
						    <tr>
						      <td><?=shorten($gr->lms_mission, 150)?></td>
						      <td><?=shorten($gr->lms_vision, 150)?></td>
						      <td>
						      	<?=shorten($gr->lms_objectives, 150)?>
						      </td>
						      <td>
						      	<a href="lms_admin.php?d=settings&mode=e&e=<?=$gr->setting_id?>" class="btn btn-primary btn-sm btn-round" title="edit"><i class="fa fa-pencil"></i></a>
						      	<a href="admin_pages/confirm.php?m=<?=$_GET['d']?>&id=<?=$gr->setting_id?>&d=<?=$_GET['d']?>&s=" title="Delete" class="btn btn-danger btn-round btn-sm poop"><i class="fa fa-trash-o"></i></a>
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