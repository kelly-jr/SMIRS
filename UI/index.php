<?php
  include('pages/samples/connect.php');
   include('pages/samples/session.php');
   include('pages/Weather/weather.php');
   
   //Get Username
   $username = $_SESSION['user'];

   //Select location of user
   $select = mysqli_query($db, "SELECT location FROM farmer WHERE username = '$username'");
   $result = $select->fetch_assoc();
   $location = $result['location'];

   //Select id of the town
   $town = mysqli_query($db, "SELECT city_id FROM city_mapping WHERE city_name = '$location'");
   $town_result = $town->fetch_assoc();
   $town_id = $town_result['city_id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart Irrigation System</title>
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php">
            <img src="images/logo.svg" alt="logo" />
          </a>
          
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <img src="images/logo-mini.svg" alt="logo" />
          </a>
        </div>
        
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <!--Read username from Database-->
                <span class="profile-text">Hello <?php echo $username;?></span>
                <img class="img-xs rounded-circle" src="images/faces-clipart/pic-1.png" alt="Profile image">
            </li>
          </ul>
      </nav>
      
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="menu-icon mdi mdi-elevation-rise"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="menu-icon mdi mdi-bookmark-plus-outline"></i>
                <span class="menu-title">Irrigate</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="pages/samples/location.php">
                <i class="menu-icon mdi mdi-bookmark-plus-outline"></i>
                <span class="menu-title">Change Location</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="pages/samples/login.php">
                <i class="menu-icon mdi mdi-restart"></i>
                <span class="menu-title">Sign Out</span>
              </a>
            </li>
          </ul>
        </nav>
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body">
                    <div class="clearfix">                      
                      <!--Fetch Values from database-->
                      <div class="float-left">
                        <p class="mb-0 text-right">Temperature</p>
                        <div class="fluid-container">
                          <h3 class="font-weight-medium text-right mb-0"><?php print_r(current_weather($town_id,'temp')); ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body">
                    <div class="clearfix">
                      <div class="float-left">
                        <p class="mb-0 text-right">Humidity</p>
                        <div class="fluid-container">
                          <h3 class="font-weight-medium text-right mb-0"><?php print_r(current_weather($town_id,'humidity')); ?>%</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body">
                    <div class="clearfix">
                      <div class="float-left">
                      <img src="<?php print_r(current_weather($town_id,'icon')); ?>">
                      </div>

                      <div class="float-right">
                        <p class="mb-0 text-right">Weather Description</p>
                        <div class="fluid-container">
                          <h3 class="font-weight-medium text-right mb-0"><?php print_r(current_weather($town_id,'description')); ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body">
                    <div class="clearfix">
                      <div class="float-right">
                        <div class="fluid-container">
                          <h3 class="font-weight-medium text-right mb-0"><?php print_r(current_weather($town_id,'town'));?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Graph report-->
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row d-none d-sm-flex mb-4">
                      <div class="col-4">
                        <h5 class="text-primary">Soil Temperature</h5>
                        <p>32</p>
                      </div>

                      <div class="col-4">
                        <h5 class="text-primary">Soil Moisture</h5>
                        <p>45</p>
                      </div>

                      <div class="col-4">
                        <h5 class="text-primary">Water Flow Rate</h5>
                        <p>45673</p>
                      </div>
                    </div>

                    <div class="chart-container">
                      <canvas id="dashboard-area-chart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Graph report-->

            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class="card-title text-primary mb-5">Performance History</h2>
                    <div class="wrapper d-flex justify-content-between">
                      <div class="side-left">
                        <p class="mb-2">The best performance</p>
                        <p class="display-3 mb-4 font-weight-light">+45.2%</p>
                      </div>

                      <div class="side-right">
                        <small class="text-muted">2017</small>
                      </div>
                    </div>

                    <div class="wrapper d-flex justify-content-between">
                      <div class="side-left">
                        <p class="mb-2">Worst performance</p>
                        <p class="display-3 mb-5 font-weight-light">-35.3%</p>
                      </div>

                      <div class="side-right">
                        <small class="text-muted">2015</small>
                      </div>
                    </div>

                    <div class="wrapper">
                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Sales</p>
                        <p class="mb-2 text-primary">88%</p>
                      </div>

                      <div class="progress">
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 88%" aria-valuenow="88"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>

                    <div class="wrapper mt-4">
                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Visits</p>
                        <p class="mb-2 text-success">56%</p>
                      </div>

                      <div class="progress">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 56%" aria-valuenow="56"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                  <a href="http://www.bootstrapdash.com/" target="_blank">Kelly Mulumbi</a>. All rights reserved.</span>

                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                  <i class="mdi mdi-heart text-danger"></i>
                </span>
              </div>
            </footer>

            <!-- partial -->
          </div>
            
          <!-- main-panel ends -->
        </div>
            
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
    </div>

    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>