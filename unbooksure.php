<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	/*$clgtime = array();
	$clgtime[0] = 9;
	$clgtime[1] = 10;
	$clgtime[2] = 11;
	$clgtime[3] = 11;
	$clgtime[4] = ;
	$clgtime[5] = ;
	$clgtime[6] = ;
	$clgtime[7] = ;
	date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
	$hourMin = date("h:i:sa");	
	$time = explode(':', $hourMin);
	echo $time[0];
	echo $time[1];*/
	$date = date('Y-m-d');
	$dateofbooking = $_SESSION['dateofbooking']; //getting the date to unbook as session
	$pastbook = 0;
	if(strtotime($date) > strtotime($dateofbooking))
	{
		$pastbook = 1;
	}
	date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
	$hourMin = date("G:i");
	$endTime = strtotime("+0 minutes", strtotime($hourMin)); //offset value for testing purposes
	$endTime = date('G:i', $endTime);  //time right now
	//echo $endTime;
	//$periodstart = "9:15";
	//if(strcmp(strtotime($endTime), strtotime("9:15")) < 0)
	//echo "HI";
	//echo $hourMin;
	//echo $endTime;
	//echo $hourMin;
	/*echo date('G:i', $endTime);
	echo strcmp(strtotime($hourMin), "9:15");
	if(strcmp(strtotime($hourMin), "9:15") < 0)
	{
		echo "HI";
	}*/
	//$time = explode(':', $hourMin);
	//echo $time[0].':'.$time[1];
	//echo $hourMin;
	//echo date('h:i:s', $endTime);
	//echo strcmp(strtotime($endTime), "9:15");
	if(strtotime($dateofbooking) == strtotime($date))   //making sure the lapsed peiod malpractice isn't allowed to happen
	{
		//echo strcmp(strtotime($endTime), strtotime("10:05"));
		if(strcmp(strtotime($endTime), strtotime("9:15")) > 0 && strcmp($_SESSION['periodofbooking'], 'p1') == 0)
		{
			
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("10:05")) > 0 && strcmp($_SESSION['periodofbooking'], 'p2') == 0)
		{
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("10:55")) > 0 && strcmp($_SESSION['periodofbooking'], 'p3') == 0)
		{
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("11:55")) > 0 && strcmp($_SESSION['periodofbooking'], 'p4') == 0)
		{
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("12:45")) > 0 && strcmp($_SESSION['periodofbooking'], 'p5') == 0)
		{
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("14:15")) > 0 && strcmp($_SESSION['periodofbooking'], 'p6') == 0)
		{
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("15:05")) > 0 && strcmp($_SESSION['periodofbooking'], 'p7') == 0)
		{
			$pastbook = 2;
		}
		else if(strcmp(strtotime($endTime), strtotime("16:00")) > 0 && strcmp($_SESSION['periodofbooking'], 'p8') == 0)
		{
			$pastbook = 2;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/scelogosmall.png"/>
    <title>SHB | Unbook</title>
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
            <?php
            	if($pastbook == 0)
            	{
            ?>    
				<div class="alert alert-danger text-center" role="alert">
		        	<strong>Hold on!</strong> Are you sure you want to unbook?
		      	</div>
		      	<hr>	
		      	<form action="unbook.php" method="POST">
		      		<div class="d-flex justify-content-center">
					  <button type="submit" class="btn btn-outline-danger btn-block mb-2 mt-3" style="border-radius: 25px;">Unbook</button>  
					</div>
		      	</form>	   
						<?php
							if($_SESSION['spl'] == 1)
							{	   			      	
						?>
				<div class="d-flex justify-content-center">
						<button class="btn btn-success btn-block mb-2 mt-1" onclick="location.href='dashsep.php'" style="color: white; border-radius: 25px;">Back</button>  
						<?php
							}
							else 
							{
						?>
						<button class="btn btn-success btn-block mb-2 mt-1" onclick="location.href='dash.php'" style="color: white; border-radius: 25px;">Back</button> 
						<?php
							}
						?>
				</div>
			<?php
            	}
            	else if($pastbook == 1 || $pastbook == 2)
            	{
            ?>
            		<div class="alert alert-danger text-center" role="alert">
                    	<strong>Apologies!</strong>It is not permitted to modify lapsed time slots.
                  	</div>
                  	<hr>
                  	<h4 class="card-title text-center mt-3">Please try booking or unbooking future slots</h4>										
                  	<div class="text-center">
										<?php
											if($_SESSION['spl'] == 1)
												{			   			      	
										?>
                  		<button class="btn btn-outline-primary mt-2" onclick="location.href = 'dashsep.php';">Go Back</button>	
										<?php
												}
												else
												{
										?>
											<button class="btn btn-outline-primary mt-2" onclick="location.href = 'dash.php';">Go Back</button>
										<?php
												}
										?>
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