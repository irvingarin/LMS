<?php 
	$fname="";
	$lname="";
	$mi="";
	$degree="";
	$pid="";
	$btnName = "btn-saveDean";
	$btnVal = "Save";
	$selected="";
	$dean="";


	if(isset($_GET['mode'])){
		$s = mysqli_fetch_object(getDeanByID($_GET['e'],$conn));
		$fname=$s->dean_fname;
		$lname=$s->dean_lname;
		$mi=$s->dean_mname;
		$degree=$s->highest_degre;
		$did=$s->dean_id;
		$pid = $s->prog_id;
		$btnName = "btn-upDean";
		$btnVal = "Update";
	}
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Add Dean</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
	              				<input type="hidden" name="deanid" value="<?=$did?>">
                                <input type="text" name="txtfname" id="txtfname" value="<?=$fname?>" class="form-control" required="">
                                <label for="txtfname" class="font-weight-light">First Name</label>
	              		</div>
	              		<div class="md-form">
	              				
                                <input type="text" name="txtmi" id="txtmi" value="<?=$mi?>" class="form-control">
                                <label for="txtmi" class="font-weight-light">MI</label>
	              		</div>
	              		<div class="md-form">
	              				
                                <input type="text" name="txtlname" id="txtlname" value="<?=$lname?>" class="form-control" required="">
                                <label for="txtlname" class="font-weight-light">Last Name</label>
	              		</div>
	              		<div class="md-form">
	              				
                                <input type="text" name="txtdegre" id="txtdegre" value="<?=$degree?>" class="form-control" required="">
                                <label for="txtdegre" class="font-weight-light">Highest Degree</label>
	              		</div>
	              		<div class="md-form">
	              				<select class="form-control" name="txtprog" id="txtprog">
	              					<?php 
	              						$programs = getAllP($conn);
	              						while($pr = mysqli_fetch_object($programs)){
	              							if($did==$pr->prog_id){
	              								$selected="selected=''";
	              							}else{
	              								$selected="";
	              							}
	              					?>
	              						<option value="<?=$pr->prog_id?>" <?=$selected?>><?=$pr->program?></option>
	              				<?php } ?>
	              				</select>
                                <label for="txtprog" class="font-weight-light active">College</label>
	              		</div>
	              		<button type="submit" name="<?=$btnName?>" class="btn btn-primary btn-round float-right"><?=$btnVal?></button>
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
	                <h5 class="card-title">Deans</h5>
	                <p class="card-category">List of all Deans</p>
	              </div>
	              <div class="card-body ">
	              		<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
						      aria-selected="true">Active</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="log-tab" data-toggle="tab" href="#tablogs" role="tab" aria-controls="log"
						      aria-selected="false">Logs</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 
	              			<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">Name
						      </th>
						      <th class="th-sm">College
						      </th>
						      <th>Degree</th>
						      <th></th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = allDeans($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  			$p =  mysqli_fetch_object(getAllPbyID($gr->prog_id,$conn));
						  			$name = $gr->dean_lname.", ".$gr->dean_fname." ".$gr->dean_mname;
						  	?>
						    <tr>
						      <td><?=ucfirst($name)?></td>
						      <td><?=$p->description?></td>
						      
						      <td><?=$gr->highest_degre?></td>
						      <td>
						      	<a href="?d=deans&mode=e&e=<?=$gr->dean_id?>" class="btn btn-primary btn-round btn-sm"><i class="fa fa-pencil"></i></a>
						      </td>
						    </tr>
						    <?php } ?>
						  </tbody>

					</table>
					</div>
					<div class="tab-pane" id="tablogs" role="tabpanel" aria-labelledby="log-tab"> 
						<table id="dtBasicExample1" class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>College</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
							<?php 
						  		$l = allDeansInactive($conn);
						  		while($lr = mysqli_fetch_object($l)){
						  			$pr =  mysqli_fetch_object(getAllPbyID($lr->prog_id,$conn));
						  			$dname = $lr->dean_lname.", ".$lr->dean_fname." ".$lr->dean_mname;
						  	?>
								<tr>
									<td><?=$dname?></td>
									<td><?=$pr->description?></td>
									<td><?=$lr->date_added?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

	              </div>
	              <div class="card-footer ">
	                <hr>
	                
	              </div>
	            </div>
	          </div>
        </div>