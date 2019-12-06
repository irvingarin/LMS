<?php session_start();
    include("conn.php");
    include("functions.php");

    if(isset($_GET['g'])){
        if($_GET['g']=="out"){
            session_destroy();
             header("Location: index.php");
        }
    }
    if(!isset($_SESSION['lms_parent_id'])){
        header("Location: index.php");
    }
    $gid = "";
    if(isset($_GET['group'])){
        $gid = $_GET['group'];
    }
    $id_no = $_SESSION['lms_parent_id'];
    $current_user = getCurrentUserParent($id_no,$conn);

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
            <div class="wrapper"><a href="dashboard.php" class="navbar-brand text-white"> <img src="img/logo2-white.svg" width="35px"> </a></div>
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
                                <h5 class="grey-text"><?=strtoupper($current_user->fname)?> <?=strtoupper($current_user->lname)?></h5>
                                <?php 
                                    // echo $_SESSION['lms_m_type'];

                                ?>
                                <h5>Parent</h5>

                                <!-- Material form register -->
                               
                                <!-- Material form register -->

                            </div>
                            <!-- Card body -->
      
                </div>
                <br />
                <div class="card">
                    <div class="padded">
                        <h5 class="grey-text">Child</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><a class="class-li poop" href="#" data-remote="admin_pages/addchild.php?p=<?=$id_no?>" title="Add Child">Add Child</a></li>
                            </ul>
                                <hr />
                          <?php 
                           
                                echo '<ul class="list-group">';
                                display_my_child($id_no,$conn);
                                echo "</ul>";
                               
                          ?>
                          <hr />
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="?g=out" class="class-li" data-activity="Logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                                </li>
                            </ul>
                        
                       
                            
                       
                        <br />
                        <br />

                    </div>
                </div>

            </div>
            <div class="col-xl-9 col-md-9">
                <?php 
                    // if(isset($_GET['group'])){
                    //     include("remote_pages/get_classes.php");
                    // }else{
                        ?>
                        <div class="row">
                            <div class="view max-width timeline-bg">
                            <div class="timeline-up justify-content-center">
                                <?php 
                                    if(isset($_GET['ch'])){
                                        $rr = mysqli_fetch_object(getMemberByid_no($_GET['ch'],$conn));
                                        echo "<h2>".strtoupper($rr->st_lname).", ".strtoupper($rr->st_fname)."</h2>";
                                    }else{
                                        echo "<h2>Welcome</h2>";
                                    }
                                ?>
                            </div>
                            <div class="timeline-nav">
                                <ul class="lms-time-nav">
                                   
                                    <li class="pull-rigth">
                                     <!--    <a href="dashboard.php?f=materials" data-activity="Materials" title="Materials"><i class="fa fa-archive fa-fw"></i></a> -->
                                    </li>
                                 <!--    <li class="pull-right">

                                        <a href="#" class="dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false"><i class="fa fa-cog fa-fw"></i></a>
                                        <div class="dropdown-menu color-box">
                                            <?php 
                                                $color = gerAllColors();
                                                while($color_r = mysql_fetch_object($color)){
                                            ?>
                                            <a class="dropdown-item" href="#"><div class="color-box-item" style="background-color: <?=$color_r->hexvalue?>"></div></a>
                                        <?php } ?>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        </div>

                        <!--News feed -->
                        <div class="row">
                            <div class="card max-width">
                                <div class="card-header">
                                   <h5>Progress Report</h5> 
                                </div>
                                 <div class="card-body">
                                    <table class="table table-condesed table-bordered" id="dtatable">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Assignment</th>
                                                <th>Quiz</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(isset($_GET['ch'])){
                                                $cla = getMyClass($_GET['ch']);
                                                while($clr = mysql_fetch_object($cla)){
                                            ?>
                                            <tr>
                                                <td><?=$clr->subject_code?></td>
                                                <td><?=countSubmitted($clr->class_id)?>/<?=displayTotalAssPerClass($clr->class_id)?></td>
                                                <td><?=countQuizTaken($clr->class_id)?>/<?=mysql_num_rows(countQuiz($clr->class_id))?> 
                                                <a href="#" class="poop text-primary pull-right" data-size='modal-md' title="Quiz Results" data-remote="remote_pages/vewprogress.php?id_no=<?=$_GET['ch']?>&cid=<?=$clr->class_id?>"><i class="fa fa-eye"></i> View</a></td>
                                                <!-- <td></td> -->
                                            </tr>
                                        <?php } }?>
                                        </tbody>
                                    </table>
                                <hr />
                                <!-- News Content -->
                                
                                <!-- News Content -->
                              </div>
                            </div>
                        </div>
                        <!--/News feed -->
                        <?php
                    // }
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

