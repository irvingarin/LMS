<?php session_start();
    if(isset($_SESSION['lms_admin_'])){
        header("Location: lms_admin.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <?php 
        include("lmsa/head.php");
    ?>
<style type="text/css">
    .wrapper-log{
        width: 1080px;
        max-width: 85%;
        margin: 0 auto;
    }
    .wrapper-log *{
        box-sizing: border-box!important;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
         <div class="container-fluid">
                  <div class="navbar-wrapper">
                     <a class="navbar-brand" href="#">PSU-Learning Management System</a>
                  </div>
        </div>
    </nav>

    <div class="wrapper-log">
      
        <div style="height: 100vh;">
           <div class="flex-center">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-4 col-md-offset-3">
            <div class="card card-stats">

              <div class="card-body ">
                <div class="row ">
                 
                  <div class="col-md-12">
                      <form action="lms_auth.php" method="post">
                            <br />
                            <div class="login-logo">
                                <svg width="100%" height="100%" version="1.1" viewBox="0 -10 140 170" xmlns="http://www.w3.org/2000/svg">
                                     <g transform="translate(-32.44012,-10.221502)">
                                      <path d="m73.062917 133.1832c-3.083376-0.66997-6.984698-2.82187-9.283359-5.12053-2.025215-2.02522-4.238543-5.7976-4.933636-8.40886-0.357032-1.34128-0.495676-1.49038-1.181098-1.2701-0.427111 0.13727-1.88957 0.53722-3.249907 0.8888-2.831785 0.73184-3.26653 0.55008-3.432117-1.43489-0.09853-1.18138-0.05142-1.22976 1.665302-1.70907 5.849252-1.63314 5.476862-1.45792 5.476862-2.57707 0-0.73854-0.177118-1.04366-0.618357-1.06534-0.340088-0.0168-2.049406-0.21805-3.798468-0.44743l-3.180112-0.41704 0.04252-1.34414c0.02337-0.73928 0.18822-1.48987 0.366339-1.66798 0.196232-0.19623 1.806863-0.14515 4.087145 0.12967l3.763304 0.4535 1.46947-2.96552c2.77688-5.60398 8.035429-9.446065 14.210405-10.382634 8.006461-1.214351 16.104942 3.027247 19.570403 10.250054l1.365333 2.84566h7.066914l1.36534-2.84566c3.46547-7.222807 11.56394-11.464405 19.5704-10.250054 6.20018 0.940391 11.43189 4.775374 14.23681 10.435934 1.37996 2.78485 1.56743 3.00641 2.41902 2.85877 2.89428-0.50178 6.93731-0.82025 7.19111-0.56646 0.16201 0.16202 0.38867 0.87431 0.50363 1.58287 0.24994 1.54008 0.40343 1.4693-4.38654 2.02225-3.60898 0.41662-3.62178 0.4215-3.62178 1.38471 0 0.92884 0.14852 1.00732 3.79846 2.00669l3.79847 1.04003-0.10137 1.22203c-0.17424 2.09932-0.56107 2.20808-4.29709 1.20827-3.45066-0.92346-3.88613-0.85745-3.8997 0.59119-2e-3 0.3176-0.6612 1.88766-1.46271 3.48904-1.95739 3.91073-4.58893 6.52799-8.49079 8.44473-5.69994 2.8-11.15184 2.8-16.85178 0-6.46241-3.17456-10.62451-9.89457-10.64866-17.19304l-6e-3 -1.85506h-5.300178l-6e-3 1.85506c-0.0405 12.25239-11.325083 21.39563-23.217248 18.81162zm8.433979-5.11364c9.072849-2.83163 12.767436-14.21783 7.062587-21.7659-6.957093-9.204923-21.170799-6.922428-24.747882 3.97412-3.565331 10.86074 6.724584 21.21261 17.685295 17.79178zm43.461524 0c7.36357-2.29817 11.52126-10.42456 9.10278-17.79178-1.8797-5.72592-7.42789-9.77502-13.39404-9.77502-5.97931 0-11.66022 4.1625-13.43297 9.84257-3.41174 10.93157 6.79266 21.13597 17.72423 17.72423zm-72.226208-22.79663c-0.132297-0.38866-2.084522-7.066913-4.338265-14.840521-4.089437-14.105302-4.097274-14.139538-3.881423-16.960597 0.715792-9.35513 3.483304-18.097887 7.717727-24.380858 1.738185-2.579095 4.763403-6.120543 5.61995-6.57895 0.568774-0.304407 0.556575-0.161175-0.13046 1.531516-1.190505 2.93314-2.056864 6.254591-2.29533 8.799883-0.244185 2.606206 0.129875 6.566271 0.575507 6.093115 0.15813-0.167853 1.818991-4.311263 3.690838-9.20753 4.02189-10.520223 6.281759-15.820455 7.159671-16.792072 1.19389-1.321324 7.986108-5.623572 12.263191-7.767611 6.874476-3.446069 16.630068-6.939217 21.942842-7.856996 1.32703-0.229244 1.23308-0.13238-1.537999 1.585561-3.616556 2.242083-7.537209 5.876614-8.512472 7.891235-1.282373 2.649042-1.131554 2.749749 2.365208 1.57931 11.658753-3.902419 27.152513-4.753258 40.899773-2.246015 8.10537 1.478273 10.24788 1.684525 15.65317 1.506906 4.29151-0.141019 5.66977-0.326108 7.93051-1.065054 4.20475-1.374342 7.21199-3.617018 10.06722-7.507685l0.77792-1.060037 0.0109 1.604153c0.0609 8.715327-7.87643 16.512986-21.56885 21.189529-1.83196 0.625688-3.41034 1.221-3.50751 1.32291-0.0971 0.101919 1.86081 0.08075 4.35106-0.04703 5.26597-0.270185 10.3717-1.186988 13.77925-2.47419l2.40642-0.909028-0.23927 0.787223c-0.13158 0.432972-0.95592 2.61579-1.83184 4.850699-2.59809 6.62908-5.03117 11.10129-7.94093 14.596171l-1.4146 1.699042 1.62851 4.328705c0.89567 2.38079 1.6285 4.603746 1.6285 4.939912 0 0.431631-7.61999 30.206824-8.95714 35.000174-0.0489 0.17519-0.35641-2.13038-0.6834-5.123515-0.68297-6.25152-1.65967-10.529422-3.10301-13.59119-1.75874-3.730806-7.05275-8.388063-14.74049-12.967532l-3.65785-2.178919 1.70213-0.810353c2.05953-0.980505 3.30843-1.081968-12.16513 0.988314l-11.39389 1.524441-15.388383-2.231479c-8.463196-1.227318-15.475473-2.143979-15.582419-2.037032-0.10697 0.10697 0.313212 0.932324 0.933705 1.834169 0.620485 0.901846 1.073079 1.67738 1.005762 1.723408-0.06732 0.04603-1.238424 0.511506-2.602459 1.034383-5.950643 2.281072-11.445293 6.833197-13.518592 11.199675-1.984653 4.179772-4.039714 12.539431-4.603688 18.72702-0.167102 1.83324-0.367465 2.7281-0.514301 2.29675z" fill="#6699cc" stroke-width=".35334575"/>
                                     </g>
                                    </svg>

                            </div>
                            <br />
                            <hr />
                            <!-- Material input text -->
                            
                            <div class="md-form">
                               
                                <input type="text" name="txtusername" id="txtusername" class="form-control">
                                <label for="txtusername" class="font-weight-light"><i class="fa fa-user  grey-text"></i> Username</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                
                                <input type="password" name="txtpassword" id="txtpassword" class="form-control">
                                <label for="txtpassword" class="font-weight-light"> <i class="fa fa-lock  grey-text"></i> Password</label>
                            </div>
                         
                                
                                <input type="checkbox" name="chkremember" class="form-check-input" id="chkremember">
                                <label for="chkremember" class="form-check-label font-weight-light"> Keep me signed in</label>
                       
                            <br />
                            
                                <button name="btnlogin" class="btn btn-primary btn-round waves-effect waves-light btn-block" type="submit">Sign In</button> 
                            
                         
                        </form>
                        <!-- Material form register -->
                  </div>
               
                </div>
              </div>
              <div class="card-footer ">
                <hr>
               
              </div>
            </div>
      

 <!-- Material form register -->
                      
            </div>
        </div>
    </div>
</div>
        </div>
        <?php 
        include("lmsa/plugins.php");
    ?>
</body>