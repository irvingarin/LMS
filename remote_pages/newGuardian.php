<?php 
  include("../conn.php");
  include("../functions.php");

  $fname = "";
  $lname = "";
  $mname = "";
  $btnName = "btnNguard";
  $btnValue = "Add";
  if(isset($_GET['m'])){
      $g = mysql_fetch_object(getGuardiansID($_GET['i']));
      $fname = $g->fname;
      $lname = $g->lname;
      $mname = $g->mname;

      $btnName = "btnUguard";
      $btnValue = "Update";
  }

?>
 <form action="run_cmd.php" method="post">
                                      <div class="md-form">
                                        <?php if(isset($_GET['i'])){?>
                                          <input type="hidden" name="id" value="<?=$_GET['i']?>">
                                        <?php }?>
                                          <input type="text" name="txtfname" id="txtfname" class="form-control validate" value="<?=$fname?>" required="">
                                          <label for="txtfname" data-error="Please Enter First Name" data-success="" class="font-weight-light active">First Name</label>
                                      </div>
                                      <div class="md-form">
                                          <input type="text" name="txtmname" id="txtmname" class="form-control validate" value="<?=$mname?>">
                                          <label for="txtmname" data-error="" data-success="" class="font-weight-light active">Middle Name</label>
                                      </div>
                                      <div class="md-form">
                                          <input type="text" name="txtlname" id="txtlname" class="form-control validate" value="<?=$lname?>">
                                          <label for="txtlname" data-error="" data-success="" class="font-weight-light active">Last Name</label>
                                      </div>
                                      
                                      <button type="submit" name="<?=$btnName?>" class="btn btn-primary btn-rounded btn-sm"><?=$btnValue?></button>
                                </form>