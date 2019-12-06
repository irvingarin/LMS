<?php 
	$event_name = "";
	$details = "";
	$start = "";
	$end="";
	$btnName ="btn-saveE";
	$btnValue="Save";
	if(isset($_GET['mode'])){
		$e=mysqli_fetch_object(eventById($_GET['e'],$conn));

		$event_name = $e->event_name;
		$details = $e->event_details;
		$start = date("Y-m-d", strtotime($e->event_start));
		$end = date("Y-m-d", strtotime($e->event_end));
		$btnName ="btn-upEv";
		$btnValue="Update";
	}
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Add Events</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
	              				<input type="hidden" name="txteid" value="<?=$_GET['e']?>" class="form-control">
                                <input type="text" name="txtevent" id="txtevent" value="<?=$event_name?>" class="form-control">
                                <label for="txtevent" class="font-weight-light">Event Name</label>
	              		</div>
	              		<div class="md-form">
                                <textarea name="txtdesc" id="txtdesc" class="form-control"><?=$details?></textarea>
                                <label for="txtdesc" class="font-weight-light">Event Details</label>
	              		</div>
	              		<div class="form-group">
	              				<label for="txtstart" class="font-weight-light">Start Date</label>
                                <input type="date" name="txtstart" id="txtstart" value="<?=$start?>" class="form-control">
                                
	              		</div>
	              		<div class="form-group">
	              			 <label for="txtend" class="font-weight-light">End Date</label>
                                <input type="date" name="txtend" id="txtend" value="<?=$end?>" class="form-control">
                               
	              		</div>
	              		<button type="submit" name="<?=$btnName?>" class="btn btn-primary btn-round float-right"><?=$btnValue?></button>
	              	</form>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <div class="stats">
	                  <!-- <i class="fa fa-history"></i> Updated 3 minutes ago -->
	                </div>
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
						      <th class="th-sm">Event
						      </th>
						      <th class="th-sm">Details
						      </th>
						      <th class="th-sm">Event Date
						      </th>
						      <th>Action</th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = allEvent($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->event_name?></td>
						      <td><?=$gr->event_details?></td>
						      <td><?=date("F d",strtotime($gr->event_start))?>-<?=date("d Y",strtotime($gr->event_end))?></td>
						      <td>
						      	<?php 
						      		if($gr->status=="Active"){
						      	?>
						      	<a href="lms_exe.php?emode=unpost&e=<?=$gr->event_id?>" class='btn btn-round btn-primary btn-sm' title="Unpublish"><i class="nc-icon nc-button-pause"></i> Unpublish</a>
						      	<?php }else{
						      		?>
								<a href="lms_exe.php?emode=postevent&e=<?=$gr->event_id?>" class='btn btn-round btn-primary btn-sm' title="Publish"><i class="nc-icon nc-button-play"></i> Publish</a>
								<a href="lms_admin.php?d=events&mode=e&e=<?=$gr->event_id?>" title="Edit" class='btn btn-round btn-success btn-sm'><i class="fa fa-pencil"></i> </a>
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

	            <div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Calendar of Events</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              		<div id="calendar"></div>
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