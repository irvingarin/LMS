<?php 
		$idno="";
		$fname="";
		$lname="";
		$mi="";
		$readonly = "";
		$btnV = "Save";
		$btnN = "btn-saveF";
	
		if(isset($_GET['e'])){
			$f=mysqli_fetch_object(allFbyID($_GET['e'],$conn));
			$idno = $f->id_no;
			$fname = $f->st_fname;
			$lname=$f->st_lname;
			$mi=$f->st_mname;
			$readonly="readonly";
			$btnV = "Update";
			$btnN = "btn-upF";
		}
		$user = mysqli_fetch_object(getDeanProg($_SESSION['lms_admin_'],$conn));

?>
		<div class="row">
			<div class="col-md-4">
				<div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">New Faculty</h5>
	                <p class="card-category"></p>
	              </div>
	              <div class="card-body ">
	              	<form method="post" action="lms_exe.php">
	              		 <!-- Material form register -->
                            <!-- Material input text -->
                           <!--  <div class="md-form">
                            	<label for="expiration">Credit Card Expiration Month</label>
    								<input id="expiration" type="tel" placeholder="BAYA-00000" class="masked" pattern="BAYA-" data-valid-example="BAYA-0000">
    								<input id="cc" type="text" data-inputmask="'mask': '9999 9999 9999 9999'" />
                            </div> -->
                            <div class="md-form">
                                <input type="text" name="txtid_no" id="txtid_no" class="form-control mask" <?=$readonly?> value="<?=$idno?>" data-inputmask="BAYA-00000" max=""10 required="">
                                <label for="txtid_no" class="font-weight-light">ID Number *</label>
                            </div>
                            <div class="md-form">
                            	<select class="form-control" name="txtdept">
                            	<?php 	
                            	if($_SESSION['lms_adm_type']=="dean"){
                            		display_dept_by_id($user->prog_id,$conn);
                            	}else{
                            		display_dept_all($conn);
                            	}
                            	?>
                            	</select>
                            	<label for="txtid_no" class="font-weight-light active">Department *</label>
                            </div>
                             <div class="md-form">
                                <input type="text" name="txtfname" id="txtfname" class="form-control" value="<?=$fname?>" required="">
                                <label for="txtfname" class="font-weight-light">First Name *</label>
                            </div>
							<div class="md-form">
                                <input type="text" value="<?=$mi?>" name="txtmi" id="txtmi" class="form-control">
                                <label for="txtmi" class="font-weight-light">Middle Initial</label>
                            </div>
                             <div class="md-form">
                                <input type="text" name="txtlname" id="txtlname" class="form-control" value="<?=$lname?>" required="">
                                <label for="txtlname" class="font-weight-light">Last Name *</label>
                            </div>

                            
  							<?php if(!isset($_GET['e'])) {?>
                            <div class="md-form">
                                <input type="text" name="txtusername" id="txtusername" class="form-control" required="">
                                <label for="txtusername" class="font-weight-light">Username *</label>
                            </div>
                          
                            <!-- Material input email -->
                            <div class="md-form">
                                <input type="password" name="txtpassword" id="txtpassword" class="form-control" required="">
                                <label for="txtpassword" class="font-weight-light">Password *</label>
                            </div>
                            <div class="md-form">
                                <input type="password" name="txtcpassword" id="txtcpassword" class="form-control" required="">
                                <label for="txtcpassword" class="font-weight-light">Confirm Password *</label>
                            </div>
                        <?php } ?>
                            <div class="text-center py-4 mt-3">
                                <button type="submit" name="<?=$btnN?>" class="btn btn-primary btn-round float-right"><?=$btnV?></button>
                            </div>
                         
                       
	              		
	              	</form>
	              </div>
	              <div class="card-footer ">
	                <hr>
	                <div class="stats">
	                 	
	                </div>
	              </div>
	            </div>
			</div>
	          <div class="col-md-8">
	            <div class="card ">
	              <div class="card-header ">
	                <h5 class="card-title">Faculty</h5>
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
						      <th class="th-sm">Status
						      </th>
						      <th>Action</th>
						    </tr>
						  </thead>

						  <tbody>
						  	<?php 
						  		if($_SESSION['lms_adm_type']=="dean"){
						  			$g = getFabyProg($user->prog_id,$conn);
						  		}else{
						  		$g = allFaculty($conn);	
						  		}
						  		
						  		
						  		while($gr = mysqli_fetch_object($g)){
						  	?>
						    <tr>
						      <td><?=$gr->id_no?></td>
						      <td><?=ucfirst($gr->st_lname)?>, <?=ucfirst($gr->st_fname)?> <?=ucfirst($gr->st_mname)?></td>
						      <td><?=$gr->status?></td>
						      <td>
						      	<a href="lms_admin.php?d=faculty&e=<?=$gr->id_no?>" class="btn btn-primary btn-round btn-sm" title="Edit Faculty"><i class="nc-icon nc-ruler-pencil"></i></a> 
						      	<a href="#" class="poop btn btn-warning btn-round btn-sm" data-remote='remote_pages/upStat.php?id=<?=$gr->id_no?>' title="<?=$gr->id_no?>"><i class="nc-icon nc-settings-gear-65"></i></a>
						      	<?php 
						      		if($gr->status=="AWOL"){
						      			?>
						      			<a href="#" class="poop btn btn-success btn-round btn-sm" data-remote='remote_pages/assSub.php?id=<?=$gr->id_no?>' title="Assign Substitute Faculty"><i class="nc-icon nc-single-02 "></i></a>
						      			<?php
						      		}
						      	?>
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
