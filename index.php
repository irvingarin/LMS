<?php session_start();
    include("conn.php");
    include("functions.php");
    $msg="";
    $lms_notif = "";
    if(isset($_SESSION['notif'])){
        $lms_notif = $_SESSION['notif'];
        unset($_SESSION['notif']);
    }
    
    $sv = mysqli_fetch_object(getActiveMision($conn));
    

?>
<!DOCTYPE html>
<html lang="en">
<?php 
    include("component/headandnav.php");
?>
<body id="home">
    <?php 
        include("component/nav.php");
    ?>
<!-- Navigation Bar -->
    <!-- Start your project here-->
   
   <div class="view intro-2 gradient">

        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

          <!-- Content -->
          <div class="container">
 <br />
 <br />
            <!--Grid row-->
            <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">

              <!--Grid column-->
              <div class="col-md-6 mb-4 white-text text-center text-md-left">

                <h2 class="display-4 font-weight-bold">Learn about LMS</h2>

                <hr class="hr-light">

                <p>
                  <strong></strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                  <strong>A learning management system is a software application for the administration, documentation, tracking, reporting, and delivery of educational courses, training programs, or learning and development programs. The learning management system concept emerged directly from e-Learning.</strong>
                </p>

               

              </div>
              <!--Grid column-->

              <!--Grid column-->
              <div class="col-md-6 col-xl-5 mb-4">

                <!--Card-->
              
                <!--/.Card-->

              </div>
              <!--Grid column-->

            </div>
            <!--Grid row-->

          </div>
          <!-- Content -->

        </div>
    <!--
            <div class="full-bg-img">
                <div class="mask rgba-black-light flex-center">
                    <div class="container text-center white-text">
                        <div class="white-text text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <h1 class="animated fadeIn mb-4">Pangasinan State University LMS</h1>
                            <h5 class="animated fadeIn mb-3">Thank you for choosing us. We're glad you're with us.</h5>
                            <br>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
    -->
    </div>
    <div class="container-fluid lms-padded" id="mission">
        <div class="row">
            <div class="col-sm-7">
                <div style="height: 100vh">
                    <div class="flex-center flex-column">
                        <h1 class="animated fadeIn mb-4">Vision</h1>

                        <h5 class="animated fadeIn mb-3"><?=$sv->lms_vision?></h5>
                        <br />
                        <h1 class="animated fadeIn mb-4">Mission</h1>
                        <h5 class="animated fadeIn mb-3 text-center"><?=$sv->lms_mission?></h5>
                        <!-- <p class="animated fadeIn text-muted">IT-Team</p> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="container-fluid">
                   <div style="height: 100vh">
                    <div class="flex-center flex-column">
                        <h1 class="animated fadeIn mb-4">Guiding Philosophy</h1>

                        <h5 class="animated fadeIn mb-3"><?=$sv->lms_objectives?></h5>

                        <!-- <p class="animated fadeIn text-muted">IT-Team</p> -->
                    </div>
                </div>
                </div>
            </div>
        </div>
       
    </div>
   

    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <?php 
        include("component/footer.php");
    ?>
    <?=$lms_notif?>
    <!--
    <div id="toast-container" class="toast-top-right animated slideInUp">
                        <div class="toast-message toast-success"> Yow! </div>
                    </div> -->
</body>

</html>
