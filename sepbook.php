<?php
    session_start();
    $dte=date("Y-m-d");
    include 'connect.php';
    if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
    {
      $_SESSION['errorcode'] = 3; //setting error code for logged out problem
      Redirect('index.php', false);  //redirecting to index page
    }
    $_SESSION['spl'] = 1;
    $cstaffname = $_SESSION['cstaffname'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/scelogosmall.png"/>
    <title>SHB | Details</title>
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
  	<?php
  		if($_SESSION['spllogin'] == 1)
  		{
  	?>
	  		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #fefefe;">
			<a class="navbar-brand" href="#">Hi there, <?php echo $cstaffname; ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			<?php
				if($_SESSION['spllogin'] == 0)
				{
			?>
			      <li class="nav-item active">
			        <a class="nav-link" href="dash.php">Home <span class="sr-only">(current)</span></a>
			      </li>
			<?php
				}
			?>
			  <li class="nav-item dropdown active">
			    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      Settings
			    </a>
			    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			      <a class="dropdown-item" href="pass.php">Change Password</a>
			    </div>
			  </li>
			</ul>
			<button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href = 'logout.php';">Log Out</button>
			</div>
			</nav>
  	<?php
  		}
  	?>
    <div class="container col-lg-6 col-md-8 col-sm-8">
      <div class="row">
        <div class="centering" style="background-color: #5576C4; ">
          <div class="card rounded shadow " style="background-color: #fefefe; ">
            <div class="card-body"> 
        		<h4 class="card-title text-center mt-3">Booking Prerequisites</h4>
				<hr>
				<form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="dashsep.php" method="POST">
				<div class="form-group">
					<label for="dept">Department</label>
					<select class="custom-select" style="border-radius: 25px;" id="dept" name="dept"> 
						<option value='CSE' >CSE</option>
						<option value='ECE'>ECE</option>
						<option value='EEE'>EEE</option>
						<option value='MECH'>MECH</option>
						<option value='IT'>IT</option>
						<option value='ICE'>ICE</option>
						<option value='MBA'>MBA</option>s
						<option value='CE'>CIVIL</option>							
					</select>
					<label for="purpose">Purpose of booking</label>
				  	<select class="custom-select" style="border-radius: 25px;" id="purpose" name="tob"> 
						<option value='0'>Lecture Booking</option>
						<option value='1'>Event Booking</option>							
					</select>
				</div>
				<div class="d-flex justify-content-center">
				  <button type="submit" class="btn btn-success btn-block mb-2 mt-3" style="color: white; border-radius: 25px;">View Schedule</button>  
				</div>
				</form>
				<?php
					if($_SESSION['spllogin'] == 0)
        			{ 
				?>
						<form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="dash.php">
							<div class="d-flex justify-content-center">
							  <button class="btn btn-outline-danger btn-block mb-2 " onclick="location.href = 'dash.php';" style="border-radius: 25px;">Go Back</button>  
							</div>	
						</form>
				<?php
					}
				?>             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>