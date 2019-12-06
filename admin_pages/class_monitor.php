<?php 
  $acad = mysqli_fetch_object(getActiveAcadYear($conn));
  $u = getDeanProg($_SESSION['lms_admin_'],$conn);
  if(mysqli_num_rows($u)>0){
    $user = mysqli_fetch_object($u);
    $class= getClassInDept($user->prog_id,$conn);
  }else{
  
  // $feed = getFeed($user->prog_id);
    $class = getFclass($conn);
  }
?>
<div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-badge text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Classes</p>
                      <p class="card-title"><?=mysqli_num_rows($class)?>
                        </p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-refresh"></i> Update Now -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-book-bookmark text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Subjects</p>
                      <p class="card-title">
                        </p><?=countSubject($conn)?><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-calendar-o"></i> Last day -->
                </div>
              </div>
            </div>
          </div>
           <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-book-bookmark text-primary"></i>
                      <!-- nc-favourite-28 -->
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Course Materials</p>
                      <p class="card-title"><?=countAllCourseMaterial($conn)?>
                        </p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-refresh"></i> Update now -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-circle-10 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Students</p>
                      <p class="card-title"><?=countMembersByacad($conn)?>
                        </p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-clock-o"></i> In the last hour -->
                </div>
              </div>
            </div>
          </div>
         
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Classes of</h5>
                <p class="card-category"><?=$acad->sy_sem?></p>
              </div>
              <div class="card-body ">
                <table id="dtBasicExample" class="table table-condensed table-borderd">
                    <thead>
                        <tr>
                           <th>Class</th>
                           <th>Instructor</th>
                           <th>College</th>
                           <th>Department</th>
                           <th>No of Student</th>
                           <th>Materials</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        while($class_row=mysqli_fetch_object($class)){
                          $f = mysqli_fetch_object(allFacultyByID($class_row->id_no,$conn));
                          $t = mysqli_fetch_object(getMytag($class_row->id_no,$conn));
                          $co = mysqli_fetch_object(getMyCollByDeptCode($t->dept_code,$conn));
                      ?>
                      <tr>
                        <td><?=$class_row->subject_code?></td>
                        <td><?=$f->st_lname?>, <?=$f->st_fname?></td>
                        <td><?=$co->program?></td>
                        <td><?=$class_row->dept_code?></td>
                        <td><?=countClassMember($class_row->class_id,$conn)?></td>
                        <td><?=countClassMaterials($class_row->class_id,$conn)?></td>
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


