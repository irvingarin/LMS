<?php 
	$pid = "";
	$coll = "";
	$desc = "";

	$btnName = "btn-saveP";
	$btnVal = "Save";
	$readonly = "";

	if(isset($_GET['mode'])){
		$s = mysqli_fetch_object(programbyid($_GET['e'],$conn));
		$coll = $s->program;
		$desc = $s->description;
		$pid = $_GET['e'];
		$readonly="readonly=''";
		$btnName = "btn-editP";
		$btnVal = "Update";
	}
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Add College</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
	              				<input type="hidden" name="txtpid" value="<?=$pid?>">
                                <input type="text" name="txtprogram" id="txtprogram" value="<?=$coll?>" class="form-control" <?=$readonly?> required="">
                                <label for="txtprogram" class="font-weight-light">College</label>
	              		</div>
	              		<div class="md-form">
                                <input type="text" name="txtdesc" id="txtdesc" class="form-control" value="<?=$desc?>" required="">
                                <label for="txtdesc" class="font-weight-light">Description</label>
	              		</div>
	              		<button type="submit" name="<?=$btnName?>" class="btn btn-primary btn-round float-right"><?=$btnVal?></button>
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
	                <h5 class="card-title">College</h5>
	                <p class="card-category">List of all College</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">College
						      </th>
						      <th class="th-sm">Description
						      </th>
						      <th></th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = getAllP($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  			$d = dept_by_college($gr->prog_id,$conn);
						  			$countD = mysqli_num_rows($d);
						  	?>
						    <tr>
						      <td><?=$gr->program?></td>
						      <td><?=$gr->description?></td>
						      <td>
						      		
						      		<?php 
						      		$disable = "";
						      			if($countD>0){
						      				$disable = "inuse";
						      			} else{
						      				$disable = "go";
						      			}
						      		?>
						      		<a href="?d=college&mode=e&e=<?=$gr->prog_id?>" class="btn btn-primary btn-sm btn-round"><i class="fa fa-pencil"></i></a>
						      		<a href="admin_pages/confirm.php?m=<?=$_GET['d']?>&id=<?=$gr->prog_id?>&d=<?=$_GET['d']?>&s=<?=$disable?>" title="Delete" class="btn btn-danger btn-round btn-sm poop"><i class="fa fa-trash-o"></i></a>
						      		
						      </td>
						    </tr>
						    <?php } ?>
						  </tbody>
					</table>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <!-- <div class="stats">
	                  <i class="fa fa-history"></i> Updated 3 minutes ago
	                </div> -->
	              </div>
	            </div>
	          </div>
        </div>