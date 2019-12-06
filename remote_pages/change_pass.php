<?php 

?>
<div class="container-fluid">
                    <div class="row">
                        <div class="view max-width timeline-bg">
                            <div class="timeline-up justify-content-center">
                                <h2>Account Settings</h2>
                                <span></span>
                            </div>
                            <div class="timeline-nav">
                                <ul class="lms-time-nav">
                                   
                                    <li>
                                        <a href="dashboard.php?s=settings&k=password" title="Change Password" data-activity="Change Password"><i class="fa fa-lock fa-fw"></i></a>
                                    </li>
                                    <?php 
                                        if($_SESSION['lms_m_type']=="Student"){
                                    ?>
                                    <li>
                                        <a href="dashboard.php?s=settings&k=guardians" data-activity="Guardians" title="Guardians"><i class="fa fa-users fa-fw"></i></a>
                                    </li>
                                    <?php } ?>
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
                            $mdr = viewModule($_GET['mod_view']);
                            viewPlusOne($_GET['mod_view']);
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
                            if(isset($_GET['k'])){
                                if($_GET['k']=="password"){
                                    include("remote_pages/cpassword.php");
                                }
                                if($_GET['k']=="guardians"){
                                    include("remote_pages/guardians.php");
                                }
                            } 
                        ?>
                    </div>
                </div>