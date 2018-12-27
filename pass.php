<?php
  session_start();
  include 'connect.php';
  if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
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
              <h4 class="card-title text-center mt-3">Change Password</h4>
              <hr>
              <?php
                if(isset($_SESSION['passchange']) && $_SESSION['passchange'] == 0)
                {
              ?>
                  <div class="alert alert-success text-center" role="alert">
                    <strong>Yaay!</strong> Password changed successfully
                  </div>
              <?php
                }
                else if(isset($_SESSION['passchange']) && $_SESSION['passchange'] == 1)
                {
              ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Uh-oh!</strong> New Passwords do not match
                  </div>
              <?php
                }
                else if(isset($_SESSION['passchange']) && $_SESSION['passchange'] == 2)
                {
              ?>
                  <div class="alert alert-danger text-center" role="alert">
                    <strong>Nah-ah!</strong> Old password incorrect
                  </div>
              <?php
                }      
                //echo $_SESSION['passchange'];         
                unset($_SESSION['passchange']);
              ?>
              <form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="passchange.php" method="POST">
                <div class="form-group">
                  <label for="staffid">Old Password</label>
                  <input type="password" class="form-control" id="staffid" style="border-radius: 25px;" placeholder="Please enter old Password" name="oldpass" required="true">
                  <label class="mt-3" for="password">New Password</label>
                  <input type="password" class="form-control" id="password" style="border-radius: 25px;" placeholder="Please enter new password" name="newpass" required="true">
                  <label class="mt-3" for="password">Confirm New Password</label>
                  <input type="password" class="form-control" id="password" style="border-radius: 25px;" placeholder="Please confirm new password" name="newpassc" required="true">            
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-success btn-block mb-2" style="color: white; border-radius: 25px;">Change Password</button>  
                </div>
                <?php
                	if($_SESSION['spl'] == 0)
                	{
                ?>
                		<div class="d-flex justify-content-center">
		                  <button class="btn btn-outline-danger btn-block mb-2" onclick="location.href='dash.php'" style="border-radius: 25px;">Go Back</button>  
		                </div>
                <?php
                	}
                	else if($_SESSION['spl'] == 1)
                	{
                ?>
                		<div class="d-flex justify-content-center">
		                  <button class="btn btn-outline-danger btn-block mb-2" onclick="location.href='sepbook.php'" style="border-radius: 25px;">Go Back</button>  
		                </div>
                <?php
                	}
                ?>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>