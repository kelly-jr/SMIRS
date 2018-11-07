<?php
    include ("connect.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username, firstname, lastname, password
        
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $myfirstname = mysqli_real_escape_string($db,$_POST['firstname']);
        $mylastname = mysqli_real_escape_string($db,$_POST['lastname']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        $location = mysqli_real_escape_string($db,$_POST['location']);
        $password = md5($mypassword); 
        
        //Check if user exists
        $sql = "SELECT username FROM farmer WHERE username='$myusername'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        if(mysqli_num_rows($result) == 1)
        {
          echo "Sorry...This user already exist..";
        }
        else
        {
          $query = mysqli_query($db, "INSERT INTO farmer(`username`, `first_name`, `last_name`, `password`, `location`)
                                        VALUES ('$myusername', '$myfirstname', '$mylastname', '$password', '$location')");
 
          if($query)
          {
            //Go to login page
            header("location: login.php");
          }
        }        
     }

?>

<!DOCTYPE html>
<html lang="en">

  <!--Testing git from visual studio code-->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart Irrigation  System</title>
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- endinject -->
    
    <link rel="shortcut icon" href="../../images/favicon.png" />
  </head>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4">Register</h2>
              <div class="auto-form-wrapper">
                <form action="" method = "POST">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name = "username" class="form-control" placeholder="Username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name = "firstname" class="form-control" placeholder="Firstname">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name = "lastname" class="form-control" placeholder="Lastname">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name = "location" class="form-control" placeholder="Town">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <input type="password" name = "password" class="form-control" placeholder="Password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <input type="password" name = "confirm_password" class="form-control" placeholder="Confirm Password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <input type = "submit" class="btn btn-primary submit-btn btn-block" value = "Register">
                  </div>

                  <div class="text-block text-center my-3">
                    <a href="login.php">
                      <span class="text-small font-weight-semibold">Already have and account? Login</span>
                    </a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    <!-- container-scroller -->
    
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/misc.js"></script>
    <!-- endinject -->
  </body>

</html>