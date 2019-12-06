  <?php session_start();

  if(isset($_SESSION['ad_username'])){
        header("Location: lms_admin.php");
    }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>LMS|Login</title>
      <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/calendar.css" rel="stylesheet">
    <link href="css/paper-dashboard.min.css" rel="stylesheet">

    <!-- MDBootstrap Datatables  -->
<link href="css/addons/datatables.min.css" rel="stylesheet">
 </head>
 <body>
    <div style="height: 100vh">
    <div class="flex-center flex-column">
            <div class="col-md-3">
            <div class="card card-user">
            <form action="lms_exe.php" method="post">
              <div class="image">
                <img src="img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="img/default.png" alt="...">
                  </a>
                    <div class="md-form">
                        <input type="text" name="txtusername" class="form-control" id="txtusername" required="" />
                        <label class="font-weight-light" for="txtusername">Username</label>
                    </div>
                     <div class="md-form">
                        <input type="password" class="form-control" name="txtpassword" id="txtpassword" required="" />
                        <label class="font-weight-light" for="txtpassword">Password</label>
                    </div>
                     <button type="submit" name="btn-adLogin" class="btn btn-primary btn-round float-right">Login</button>
                </div>
               
              </div>
              <div class="card-footer">
                      
              </div>
              </form>
            </div>
            
          </div>
        </div>
    </div>
    <?php 
        include("lmsa/plugins.php");
    ?>
 </body>
 </html>
                        