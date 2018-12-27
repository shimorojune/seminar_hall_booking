<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/scelogosmall.png"/>
    <title>SHB | Login</title>
    <link rel="stylesheet" href="css/bootstrap4-daydream.min.css">
    <style type="text/css">
      html, body{height:100%; margin:0;padding:0}
      .container{
        height:100%;
        display:table;
        width: 100%;
        padding: 0;
      }
      .row {height: 100%; display:table-cell; vertical-align: middle;}
      .centering {
        float:none;
        margin:0 auto;
      }
    </style>
  </head>
  <body style="background-color: #5576C4;">
    <div class="container col-lg-4 col-md-6 col-sm-8">
      <div class="row">
        <div class="centering" style="background-color: #5576C4; ">
          <div class="card rounded shadow " style="background-color: #fefefe; ">
            <div class="card-body">
              <h4 class="card-title text-center mt-3">Login to <br> Seminar Hall Booking</h4>
              <hr>
              <?php
                if(isset($_SESSION['errorcode']) && $_SESSION['errorcode'] == 2)
                {
              ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Oops!</strong> Please check your password.
                  </div>
              <?php
                }
                else if(isset($_SESSION['errorcode']) && $_SESSION['errorcode'] == 1)
                {
              ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Uh-oh!</strong> User not registered.
                  </div>
              <?php
                }
                else if(isset($_SESSION['errorcode']) && $_SESSION['errorcode'] == 3)
                {
              ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Nah-ah!</strong> Please login to continue.
                  </div>
              <?php
                }
                else if(isset($_SESSION['errorcode']) && $_SESSION['errorcode'] == 4)
                {
              ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Uhh-no!</strong> Please try again.
                  </div>
              <?php
                }
                unset($_SESSION['errorcode']);
              ?>
              <form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="welcome.php" method="POST">
                <div class="form-group">
                  <label for="staffid">Staff ID</label>
                  <input type="text" class="form-control" id="staffid" style="border-radius: 25px;" placeholder="Enter Staff ID" name="nuser" required="true">
                  <label class="mt-3" for="password">Password</label>
                  <input type="password" class="form-control" id="password" style="border-radius: 25px;" placeholder="Enter Password" name="npass" required="true">
                  <!-- <div class="custom-control custom-checkbox mt-3 text-center">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                    <label class="custom-control-label" for="remember">Remember Me</label>
                  </div> -->
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-outline-primary btn-block mt-3 mb-3" style="border-radius: 25px;">Login</button>  
                </div>
                <!-- <div class="text-center mt-1">
                  <a href="" style="text-decoration: none; color: #5576C4;">Forgot Password?</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
