<?php session_start();
    include("conn.php");
    include("functions.php");


    if(isset($_GET['g'])){
        if($_GET['g']=="out"){
            session_destroy();
             header("Location: index.php");
        }
    }
    if(!isset($_SESSION['lms_m_id_no'])){
        header("Location: index.php");
    }
    if(isset($_GET['qid'])){
        $q = mysqli_fetch_object(getQuiz($_GET['qid'],$conn));
        $minutes_to_add = $q->time_limit;
      $time = new DateTime();
      $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

      $stamp = $time->format('Y-m-d H:i');

      $cookie_name = $_SESSION['lms_m_id_no']."_q_".$q->quiz_id;
      if(!isset($_COOKIE[$cookie_name])){
        setcookie($cookie_name, $stamp, time() + (86400 * 30), "/");
        // $_COOKIE[$cookie_name] = $stamp;
      }
    }
    $gid = "";
    if(isset($_GET['group'])){
        $gid = $_GET['group'];
    }
    $id_no = $_SESSION['lms_m_id_no'];
    $current_user = getCurrentUser($_SESSION['lms_m_id_no'],$conn);

    $lms_notif = "";
    if(isset($_SESSION['notif'])){
        $lms_notif = $_SESSION['notif'];
        unset($_SESSION['notif']);
    }

    

?>
<!DOCTYPE html>
<html lang="en">
<?php 
    include("component/headandnav.php");
?>
<body>
  <!--  <div id="side-out" class="side-nav lms-left-nav maroon mdb-sidenav blue-gradient" >
        <ul>
            <li class="li-logo">
                <div class="logo">
                    <?php echo file_get_contents("img/logo.svg"); ?>
                </div>
            </li>
            <li>
                <ul id="side-menu" class="collapsible collapsible-accordion">
                    <li class=""><a href="#" class="collapsible-header waves-effect arrow-r active" ><i class="fa fa-home"></i> Home</a></li>     
                   
                    <li><a href="?g=req"><i class="fa fa-bar-chart-o"></i> Progress</a></li>
                    <li><a href="?g=req"><i class="fa fa-book"></i> Library</a></li>
                    <li><a href="?g=out"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
                

            </li>
            
        </ul>
    </div> -->
    
    <nav class="navbar navbar-expand-lg fixed-top navbar-expand-lg navbar-dark scrolling-navbar dash">
        <div class="container">
        <!--<div class="flaot-left">
            <a href="#" data-activates="side-out" class="button-collapse"><i class="fa fa-bars fa-fw white-text fa-2x"></i></a>
        </div>-->
            <div class="wrapper"><a href="dashboard.php" class="navbar-brand text-white"> <img src="img/logo2-white.svg" width="35px"> PSU-LMS</a></div>
            <a href="?g=out" class="class-li text-white" data-activity="Logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
        </div>
    </nav>
  
<!-- Navigation Bar -->
    <!-- Start your project here-->
   
    <div class="container-fluid">
        <div class="container">
        <!-- Main Content-->
        <br />
        <br />
        <br />
       
        <div class="row">
            <div class="col-xl-3 col-md-3">
                
                <div class="card testimonial-card">
                             <div class="card-up lms-blue agri">
                             </div>
                             <div class="avatar mx-auto white"><img src="img/logo1.svg" class="rounded-circle">
                             </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <h5 class="grey-text"><?=strtoupper($current_user->st_fname)?> <?=strtoupper($current_user->st_lname)?></h5>
                                <?php 
                                    echo $_SESSION['lms_m_type'];
                                ?>
                                <h5></h5>
                                <!-- <h5><a href="#">Guardian</a></h5> -->
                                <!-- Material form register -->
                               
                                <!-- Material form register -->

                            </div>
                            <!-- Card body -->
      
                </div>
                <br />
                <div class="card">
                    <div class="padded">
                        <h5 class="grey-text">Classes</h5>
                        
                          <?php 
                            if($_SESSION['lms_m_type']=="Teacher"){
                                echo '<ul class="list-group">';
                                display_classes($id_no,$conn);
                                echo "</ul>";
                                // echo "<hr />";
                                // echo "<h5>Other Subjects</h5>";
                                echo '<ul class="list-group">';
                                display_sub_classes($id_no,$conn);
                                echo "</ul>";
                            }else{
                                echo '<ul class="list-group">';
                                display_My_classes($id_no,$conn);
                                echo "</ul>";
                            }
                          ?>
                        
                        
                        <hr />

                        <ul class="list-group">
                        <?php 
                            if($_SESSION['lms_m_type']=="Teacher"){
                        ?>
                          <!-- <li class="list-group-item"><a href="#" class="class-li"><i class="fa fa-plus fa-fw" data-activity="Manage Class"></i>Manage Class</a></li>
                          <li class="list-group-item"><a href="#" data-remote="remote_pages/cclass.php" data-activity="Create Class"  title="Create a Class" class="class-li poop"><i class="fa fa-cog fa-fw"></i>Create a Class</a></li> -->
                          <li class="list-group-item"><a href="#" data-remote="remote_pages/import_class.php" data-activity="Create Class"  title="Import" class="class-li  poop"><i class="fa fa-cog fa-fw"></i>Import Class</a></li>
                        <?php }else{ ?>
                          <li class="list-group-item"><a href="#" data-remote="remote_pages/join_class.php" class="class-li poop" data-activity="Join Class" title="Join Class"><i class="fa fa-users fa-fw"></i>Join Class</a></li>
                      <?php }?>
                        </ul>
                        <hr />    
                        <ul class="list-group"> 
                            <li class="list-group-item"><a href="?s=settings&k=password" class="class-li" data-activity="Account Settings"><i class="fa fa-cog fa-fw"></i>Account Settings</a></li>
                        </ul>
                        <?php 
                            if(isset($_GET['mod_view'])){
                                $mods = getModules($gid,$conn);
                              ?>
                              <h4 class="grey-text">Material</h4>
                              <ul class="list-group">
                                <?php 
                                    while($mr = mysqli_fetch_object($mods)){
                                ?>
                                  <li class="list-group-item"><a href="dashboard.php?group=<?=$gid?>&mod_view=<?=$mr->mod_id?>" class="class-li" data-activity="View modlue id=<?=$mr->mod_id?>"><i class="fa fa-plus fa-fw"></i> <?=$mr->mod_title?></a></li>
                              <?php } ?>
                              </ul>
                              <?php  
                            }
                        ?>
                        <br />
                        <br />

                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-9">
                <?php 
                    if(isset($_GET['group'])){
                        include("remote_pages/get_classes.php");
                    }
                    // if(isset($_GET['t'])){
                    //     include("");
                    // }
                    if(isset($_GET['s'])){
                        include("remote_pages/change_pass.php");   
                    }else{
                        if(!isset($_GET['group'])){
                        ?>
                        
                        <div class="row">
                            <div class="view max-width timeline-bg">
                            <div class="timeline-up justify-content-center">
                                <h2>
                                    <?php 
                                        if(isset($_GET['t'])){
                                            echo strtoupper($_GET['t']);
                                        }else{
                                    ?>
                                    News feed
                                    <?php }?>

                                </h2>
                            </div>
                            <div class="timeline-nav">
                                <ul class="lms-time-nav">
                                    <!-- <li class="pull-rigth">
                                        <a href="dashboard.php?f=materials" data-activity="Materials" title="Materials"><i class="fa fa-archive fa-fw"></i></a>
                                    </li> -->
                                    <?php 
                                         if($_SESSION['lms_m_type']!="Teacher"){
                                    ?>
                                    <li class="">

                                        <a href="#" class="dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false"><i class="fa fa-bell fa-fw"></i></a>
                                        <div class="dropdown-menu">
                                            <ul class="activity-list">
                                            <?php 
                                                $fe = getmyfeed($_SESSION['lms_m_id_no']);
                                                while($fer = mysql_fetch_object($fe)){
                                            ?>
                                                <li><?=date("M d, Y H:i:s A",strtotime($fer->date_added))?> (<?=$fer->description?>)</li>
                                        <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php }else{
                                        ?>
                                        <li>
                                            <a href="?d=d&tt=library" class="library"><i class="fa fa-archive"></i></a>
                                        </li>
                                         <li>
                                            <a href="?d=d&tt=history" class="history"><i class="fa fa-calendar"></i></a>
                                        </li>
                                        <?php
                                    } ?>
                                </ul>

                            </div>
                        </div>
                        </div>

                        <!--News feed -->

                        <?php 
                        }
                            if(isset($_GET['tt'])){
                                // if(!isset($_GET['group'])){

                                ?>
                                    <?php 
                                    if($_GET['tt']=="library"){
                                        include("remote_pages/library.php");
                                    }
                                    if($_GET['tt']=="history"){
                                        include("remote_pages/history.php");
                                    }

                                    ?>
                                <?php //}
                            }else{
                                if(!isset($_GET['group'])){
                        ?>
                        <div class="row"><!-- End Notifications -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="container-fluid">
                                          <h5>Events</h5>
                                          <hr />
                                      </div>
                                </div>
                        <?php 
                            $u = upcommingEvents($conn);

                            while($ur = mysqli_fetch_object($u)){
                        ?>
                        <div class="row">
                            <div class="card col-md-11">
                                <div class="card-header">
                                   <h5><i class="fa fa-calendar fa-fw"></i><?=$ur->event_name?></h5> 
                                </div>
                                 <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                  <p><?=$ur->event_details?></p>
                                  <footer class="blockquote-footer"> Date: <?=date("M d, Y",strtotime($ur->event_start)) ?> to <?=date("M d, Y",strtotime($ur->event_end))?></footer>
                                </blockquote>
                                <hr />
                                <!-- News Content -->
                                
                                <!-- News Content -->
                              </div>
                            </div>
                        </div>
                        <br />
                        <?php 
                            }
                        ?>
                        <!--/News feed -->
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="container-fluid">
                                          <h5>Notifications</h5>
                                          <hr />
                                      </div>
                                </div>
                            <div class="row">
                            <div class="container-fluid" style="height: 350px; overflow-y: auto; padding: 20px;">
                        <?php 
                            $u = getfeed(0,$_SESSION['lms_m_id_no'],$conn);

                            while($ur = mysqli_fetch_object($u)){
                        ?>
                        <div class="row">
                            <div class="card col-md-12">
                                <div class="card-header">
                                    <small class="text-grey text-muted float-right"><?=date("M d, y h:i:s a",strtotime($ur->date_added))?></small>
                                   <h5><a href="<?=$ur->link?>"><i class="fa fa-bell fa-fw"> </i><?=$ur->title?></a></h5> 
                                </div>
                                 <div class="card-body">
                                
                                  <p><?=$ur->description?></p>
                                  
                                
                               
                                <!-- News Content -->
                                
                                <!-- News Content -->
                              </div>
                            </div>
                        </div>
                        <br />
                        <?php 
                            }
                        ?>
                        <!--/News feed -->
                    </div>
                        </div>
                            </div>
                        </div><!-- End Notifications -->

                        <?php
                            }
                        }// end of isset($_GET['t'])
                    }
                ?>
            </div>
            
        </div>
        <!-- /Main Content-->
        </div>
    </div>
    
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <br />
    <br />
    <?php 
        include("component/footer.php");
    ?>
     <div id="sidenav-overlay"></div>
    <?=$lms_notif?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".button-collapse").click(function(e){
                e.preventDefault();
                var target = $(this).attr("data-activates");
                $("#"+target).toggleClass("fixed");
                $("#sidenav-overlay").show();
            });
            $("#sidenav-overlay").click(function(e){
                e.preventDefault();
               $("#sidenav-overlay").hide(); 
                $("#side-out").toggleClass("fixed");
            });
        });
    </script>
    <!--
    <div id="toast-container" class="toast-top-right animated slideInUp">
                        <div class="toast-message toast-success"> Yow! </div>
                    </div> -->
</body>

</html>

