<?php 
    $gid = $_GET['group'];
    $classes_ = getClassbyID($_GET['group'],$conn);
    $class_row = mysqli_fetch_object($classes_);
    $creator = mysqli_fetch_object(getMemberByid_no($class_row->id_no,$conn));
    $link = "";
    if(isset($_GET['t'])){
        if($_GET['t']=="modules"){
            $link = "<a href='#'' data-remote='remote_pages/new_module.php?c=<?=$gid?>'' data-size='modal-md' title='Add New Materials' class='poop'><i class='fa fa-plus'></i></a>";
        }
        if($_GET['t']=="activities"){
             $link = "<a href='#'' data-remote='remote_pages/new_activities.php?c=<?=$gid?>'' data-size='modal-md' title='Add New Activities' class='poop'><i class='fa fa-plus'></i></a>";
        }
    }
    //$url =  "{$_SERVER['REQUEST_URI']}";

//$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
//echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
?>
<div class="container-fluid">
                    <div class="row">
                        <div class="view max-width timeline-bg">
                            <div class="timeline-up justify-content-center">
                                <h2><?=strtoupper($class_row->subject_desc)?></h2>
                                <span><?=strtoupper($creator->st_fname)?> <?=strtoupper($creator->st_lname)?>
                                <?php if($_SESSION['lms_m_type']=="Teacher"){?>
                                 | <i class="fa fa-key"></i> <?=$class_row->security_code?>
                             <?php } ?>
                                    </span>
                            </div>
                            <div class="timeline-nav">
                                <ul class="lms-time-nav">
                                   
                                    <li>
                                        <a href="dashboard.php?group=<?=$gid?>&t=materials" class="materials" title="Materials" data-activity="View all Materials"><i class="fa fa-book fa-fw"></i></a>
                                    </li>
                                    <?php 
                                        if($class_row->dept_code == "BSIT"){
                                    ?>
                                    <li>
                                        <a href="dashboard.php?group=<?=$gid?>&t=activities" class="activities" data-activity="View All Exercises" title="Activities"><i class="fa fa-code fa-fw"></i></a>
                                    </li>
                                    <?php }?>
                                    <li>
                                        <a href="dashboard.php?group=<?=$gid?>&t=assignments" class="assignments" data-activity="View All Exercises" title="Assignments"><i class="fa fa-pencil fa-fw"></i></a>
                                    </li>
                                    
                                    <li>
                                        <a href="dashboard.php?group=<?=$gid?>&t=quiz" class="quiz" data-activity="View All Exercises" title="Quiz"><i class="fa fa-edit fa-fw"></i></a>
                                    </li>
                                    
                                    <li>
                                        <a href="dashboard.php?group=<?=$gid?>&t=members" class="members" data-activity="View All Members" title="Members"><i class="fa fa-users fa-fw"></i></a>
                                    </li>

                                    <!-- <li class="pull-right">
                                        <a href="#" class="dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false"><i class="fa fa-cog fa-fw"></i></a>
                                        <div class="dropdown-menu color-box">
                                            <?php 
                                                $color = gerAllColors($conn);
                                                while($color_r = mysqli_fetch_object($color)){
                                            ?>
                                            <a class="dropdown-item" href="#"><div class="color-box-item" style="background-color: <?=$color_r->hexvalue?>"></div></a>
                                        <?php } ?>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        
                        <!--
                        <div class="col-xl-6 col-md-6 mb-r">
                            <div class="card card-cascade narrower">
                                 <div class="view gradient-card-header">
                                    <i class="fa fa-bars primary-color"></i>
                                    <div class="data">
                                        <p>Examinees</p>
                                        <h4><strong>2952</strong></h4>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <p class="card-text">Examinees this year </p>
                                </div>
                            </div>
                        -->
                        </div>
                        <?php 
                            if(!isset($_GET['mod_view'])){
                        ?>
                        
                        <?php 
                        }else{
                            $mdr = viewModule($_GET['mod_view'],$conn);
                            viewPlusOne($_GET['mod_view'],$conn);
                            ?>
                        <div class="row">
                            <div class="card max-width">
                              <div class="card-header">
                                <?php 
                                    echo  strtoupper($mdr->mod_title);
                                ?>
                              </div>
                              <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                  <p><?=$mdr->mod_desc?></p>
                                  <footer class="blockquote-footer"> Date Added : <cite title="Source Title"><?=$mdr->date_added?></cite> - Views <cite><?=$mdr->views?></cite></footer>
                                </blockquote>
                                <hr />
                                <iframe src="classes/class_<?=$_GET['group']?>/<?=$mdr->mod_file?>" class="scroll-lms scrollbar-primary"></iframe>
                              </div>
                            </div>
                        </div>
                            <?php

                        }
                            if(isset($_GET['t'])){
                                if($_GET['t']=="materials"){
                                    include("remote_pages/modules_lists.php");
                                }
                                if($_GET['t']=="activities"){
                                    include("remote_pages/activity_list.php");
                                }
                                if($_GET['t']=="members"){
                                    include("remote_pages/class_members.php");
                                }
                                if($_GET['t']=="assignments"){
                                    include("remote_pages/assignments.php");
                                }
                                if($_GET['t']=="quiz"){
                                    include("remote_pages/lms_quiz.php");
                                }
                            } 
                        ?>
                    </div>
                </div>