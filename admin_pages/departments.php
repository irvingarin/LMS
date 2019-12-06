<?php 
	$dept = "";
	$desc = "";
	$btnName = "btn-saveDep";
	$btnValue = "Save";
	if(isset($_GET['mode'])){
		 $r = mysqli_fetch_object(getAllDepartmentByCode($_GET['e'],$conn));
		 $dept = $r->dept_code;
		 $desc = $r->dept_desc;

		 $btnName = "btn-upDept";
		 $btnValue = "Update";

	}
?>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
	              <div class="card-header ">
	                <h5 class="card-title">Add Department</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		<div class="md-form">
	              				<input type="hidden" name="txtdeptid" value="<?=$_GET['e']?>" class="form-control">
                                <input type="text" name="txtdept" id="txtdept" value="<?=$dept?>" class="form-control">
                                <label for="txtdept" class="font-weight-light">Department</label>
	              		</div>
	              		<div class="md-form">
                                <textarea class="form-control" name="txtdesc" id="txtdesc"><?=$desc?></textarea>
                                <label for="txtdesc" class="font-weight-light">Description</label>
	              		</div>
	              		<div class="md-form">
                                <select class="form-control" name="txtprogram">
                                	<?php 
                                		displayProgram($conn);
                                	?>
                                </select>
                                <label for="txtprogram" class="font-weight-light active">College</label>
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
	                <h5 class="card-title">Departments</h5>
	                <p class="card-category">List of all Departments</p>
	              </div>
	              <div class="card-body ">
	              		<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
						  <thead>
						    <tr>
						      <th class="th-sm">Department
						      </th>
						      <th class="th-sm">Description
						      </th>
						      <th>College</th>
						      <th>Action</th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		$g = getAllDepartment($conn);
						  		while($gr = mysqli_fetch_object($g)){
						  			$assoc = countDeptAsoc($gr->dept_code,$conn);
						  			$pr = mysqli_fetch_object(getAllPbyID($gr->prog_id,$conn));
						  	?>
						    <tr>
						      <td><?=$gr->dept_code?></td>
						      <td><?=$gr->dept_desc?></td>
						      <td><?=$pr->program?></td>
						      <td>
						      	
						     	<?php 
						     	$disable="";
						     		if($assoc==0){
						     			$disable="do";
						     		}else{
						     			$disable="inuse";
						     		}
						     	?>
						     	<a href="lms_admin.php?d=department&mode=e&e=<?=$gr->dept_id?>" class="btn btn-primary btn-round btn-sm"><i class="fa fa-pencil"></i></a>
						      		<a href="admin_pages/confirm.php?m=<?=$_GET['d']?>&id=<?=$gr->dept_id?>&d=<?=$_GET['d']?>&s=<?=$disable?>" title="Delete" class="poop btn btn-danger btn-round btn-sm"><i class="fa fa-trash-o"></i></a>
						      	<?php ?>
						      </td>
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