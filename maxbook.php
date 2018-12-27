<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	$subcodeforbooking = $_SESSION['subcodeforbooking'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/scelogosmall.png"/>
    <title>SHB | Maxbooked</title>
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
				<div class="alert alert-danger text-center" role="alert">
		        	<strong>Apologies!</strong> Booking limit reached.
		      	</div>
		      	<hr>
		      	<h4 class="card-title text-center mt-3">You have maxed out the number of bookings for this week for subject <?php echo $subcodeforbooking; ?></h4>
		    <?php
	      		if($_SESSION['spl'] == 1)
				{
			?>
					<div class="text-center">
			      		<button class="btn btn-outline-primary mt-2" onclick="location.href = 'dashsep.php';">Go Back</button>	
			      	</div>  
			<?php
				}
				else
				{
			?>
					<div class="text-center">
			      		<button class="btn btn-outline-primary mt-2" onclick="location.href = 'dash.php';">Go Back</button>	
			      	</div>  
			<?php
				}
			?>
		      	                                     
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </body>
</html>