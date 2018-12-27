<?php
	session_start();
	$dte=date("Y-m-d");
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
    <title>SHB | Set Day Order</title>
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
    <div class="container col-lg-6 col-md-8 col-sm-8">
      <div class="row">
        <div class="centering" style="background-color: #5576C4; ">
          <div class="card rounded shadow " style="background-color: #fefefe; ">
            <div class="card-body">
        		<h4 class="card-title text-center mt-3">Please enter Booking Details</h4>
				<hr>
				<form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="setdo.php" method="POST">
				<div class="form-group">
					<label class="mt-3" for="nodr">Number of days remaining (As per calender)</label>
					<input type="number" class="form-control" id="nodr" style="border-radius: 25px;" placeholder="Please enter number of days" name="nod" required="true">
					<label for="do">Subject</label>
						<select class="custom-select" style="border-radius: 25px;" id="do" name="do"> 
							<option value='1'>I</option>
							<option value='2'>II</option>
							<option value='3'>III</option>
							<option value='4'>IV</option>
							<option value='5'>V</option>						
						</select>
					<label class="mt-3" for="bdate">Date to begin from</label>
					<input type="date" class="form-control" id="bdate" style="border-radius: 25px;" aria-describedby="emailHelp" placeholder="Begin Date" name="bdate" required="true">
				</div>
				<div class="d-flex justify-content-center">
				  <button type="submit" class="btn btn-success btn-block mb-2 mt-3" style="color: white; border-radius: 25px;">Set day Order Sequence</button>  
				</div>
				</form>
				<form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="dash.php">
					<div class="d-flex justify-content-center">
					  <button class="btn btn-outline-danger btn-block mb-2 " onclick="location.href = 'dash.php';" style="border-radius: 25px;">Go Back</button>  
					</div>	
				</form>        
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