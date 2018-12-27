<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	$valueatbooking = $_SESSION['valueatbooking']; //setting the user in slot to session
	$subcodeatbooking = $_SESSION['subcodeatbooking']; //setting the subcode in slot to session
	$sql = "SELECT `staff_name`,`staff_email`,`staff_dept` FROM `stafftbl` WHERE `staff_id` = '$valueatbooking'";  //getting staff details
    $result = $conn->query($sql) or die('Line 17 - albooked.php'); //storing in result variable
    $row = $result->fetch_assoc();
    $uname = $row['staff_name'];
    $uemail = $row['staff_email'];
    $udept = $row['staff_dept'];
    $usubname = '--';
    $event = 1;
	$sql = "SELECT * FROM `subjects` WHERE `subcode` = '$subcodeatbooking'";  //getting staff details
    $result = $conn->query($sql) or die('Line 24 - albooked.php'); //storing in result variable
    if ($result->num_rows > 0)  // check if tuples exsist in result variable
    {
    	$event = 0;
    	$row = $result->fetch_assoc();
    	$usubname = $row['subname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/scelogosmall.png"/>
    <title>SHB | Already Booked</title>
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
                    <strong>Apologies!</strong> Slot already booked.
                </div>
                <hr>
                <?php
                    if($event == 0)
                    {
                ?>
                        <h5 class="card-title text-center mt-3">
                            This slot has been booked by <b><?php echo $uname;?></b> <br> of <b><?php echo $udept;?></b> department for lecture. <br><br> Subject: <?php echo $usubname; ?>
                        </h5>
                <?php
                    }
                    else if($event == 1)
                    {
                ?>
                        <h5 class="card-title text-center mt-3">
                            This slot has been booked by <b><?php echo $uname;?></b> <br> of <b><?php echo $udept;?></b> department for an event <br><br> Event name: <?php echo $subcodeatbooking; ?>
                        </h5>
                <?php
                    }
                    
                    if($_SESSION['spl'] == 0)
                    {
                ?>
                             <form action="dash.php" method="POST">
                <?php
                    }
                    else if($_SESSION['spl'] == 1)
                    {
                ?>
                            <form action="dashsep.php" method="POST">
                <?php
                    }

                ?>
                            <div class="d-flex justify-content-center">
                              <button type="submit" class="btn btn-success btn-block mb-2 mt-3" style="color: white; border-radius: 25px;">Go Back</button>  
                            </div>
                        </form>   
                <?php
                    if($_SESSION['cdeptadmin'] == 1 && strcmp($_SESSION['cstaffdept'], $_SESSION['deptofbooking']) == 0)
                    {
                ?>
                        <form action="unbook.php" method="POST">
                                <div class="d-flex justify-content-center">
                                  <button type="submit" class="btn btn-outline-danger btn-block mb-2" style="border-radius: 25px;">Unbook using HOD Rights</button>  
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
   
  </body>
</html>