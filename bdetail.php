<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	$cstaffid = $_SESSION['cstaffid'];
	$cstaffdept = $_SESSION['cstaffdept']; //getting staff dept
	$cstaffname = $_SESSION['cstaffname'];  //getting staff name
	$cmainadmin = $_SESSION['cmainadmin']; //getting main admin status
	$cdeptadmin = $_SESSION['cdeptadmin']; // getting dept admin status
	$dte=$_POST['dates']; //getting current date
	//$finaldate =  //getting the final date of quadrant
	//$startdate =  //getting the start date of quadrant
	$_SESSION['startdate'] = $_POST['startdate']; //setting start date as session to be accessed for counting later
	$_SESSION['finaldate'] = $_POST['finaldate']; //setting end date as session to be accessed for counting later
	$_SESSION['dateofbooking'] = $_POST['dates']; //setting the date to book as session
	$_SESSION['doofbooking'] = $_POST['dayorder']; //setting the day order to book as session
	$_SESSION['deptofbooking'] = $_POST['dept']; //setting the dept to book as session
	$_SESSION['periodofbooking'] = $_POST['position']; //setting the position to book as session
	$valatbk = $_POST['value']; //getting value stored in the clicked position
	$_SESSION['valueatbooking'] = $_POST['value']; //setting the user in slot to session
	$_SESSION['subcodeatbooking'] = $_POST['subcode']; //setting the subcode in slot to session
	//echo $valatbk;
	//echo $_SESSION['periodofbooking'];
	$date = date('Y-m-d');
	//$date = date('Y-m-d', strtotime($date. ' + 1 days'));
	$dateofbooking = $_SESSION['dateofbooking']; //getting the date to unbook as session
	//echo $dateofbooking;
	$pastbook = 0;
	if(strtotime($date) > strtotime($dateofbooking))
	{
		$pastbook = 1;
	}
    if(strcmp($valatbk, $cstaffid) == 0) //if it is same user... go for unbooking
    {
    	Redirect('unbooksure.php', false);
    }
    else if((strcmp($valatbk, $cstaffid) != 0) && (strcmp($valatbk, '--') != 0)) // if it is other user go for already booked
    {
    	Redirect('albooked.php', false);
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
	//echo $pastbook;
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
    <div class="container col-lg-6 col-md-8 col-sm-8">
      <div class="row">
        <div class="centering" style="background-color: #5576C4; ">
          <div class="card rounded shadow " style="background-color: #fefefe; ">
            <div class="card-body">
            <?php
            	if($pastbook < 1)
            	{
            ?>
            		<h4 class="card-title text-center mt-3">Please enter Booking Details</h4>
					<hr>
					<form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="bookdate.php" method="POST">
					<div class="form-group">
					  <label for="subcode">Subject</label>
					  	<select class="custom-select" style="border-radius: 25px;" id="subcode" name="subcode"> 
					  		<?php
									$sql = "SELECT * FROM `work_order` WHERE `staff_id` = '$cstaffid'";  
									$result = $conn->query($sql) or die("bdetail.php - 192");
									if ($result->num_rows > 0)  // check for records in db
									{
									    // output data of each row
									    while($row = $result->fetch_assoc()) //return NULL for end of rows and returns entire tuple in $row
									    {
									        $subcode = $row['subcode'];
									        $sql2 = "SELECT `subname` FROM `subjects` WHERE `subcode` = '$subcode'"; 
											$result2 = $conn->query($sql2) or die("bdetail.php - 202");
											$row2 = $result2->fetch_assoc();
											$subname = $row2['subname'];

							?>
							<option value=<?php echo $subcode;?>><?php echo $subcode;?> - <?php echo $subname;?></option>
							<?php
										}
									}
									else
									{
							?>
										<option value="temporary">Temporary Testing</option>
							<?php
									}
							?>
						</select>
					  <label class="mt-3" for="password">Topic to be discussed</label>
					  <input type="text" class="form-control" id="password" style="border-radius: 25px;" aria-describedby="emailHelp" placeholder="Enter Topic" name="topic" required="true">
					</div>
					<div class="d-flex justify-content-center">
					  <button type="submit" class="btn btn-success btn-block mb-2 mt-3" style="color: white; border-radius: 25px;">Book</button>  
					</div>
					</form>
					<form class="col-12 pl-lg-4 pr-lg-4 pt-lg-2" action="dash.php">
						<div class="d-flex justify-content-center">
						  <button class="btn btn-outline-danger btn-block mb-2 " onclick="location.href = 'dash.php';" style="border-radius: 25px;">Go Back</button>  
						</div>	
					</form>
					 
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>

