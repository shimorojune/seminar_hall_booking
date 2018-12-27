<?php

  session_start();

  include 'connect.php';

  if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
  {
    $_SESSION['errorcode'] = 3; //setting error code for logged out problem
    Redirect('index.php', false);  //redirecting to index page
  }
  $_SESSION['spl'] = 0; //indicating non special booking toggle
  $cstaffname = $_SESSION['cstaffname'];  //getting staff name
  $cstaffdept = $_SESSION['cstaffdept']; //getting staff dept
  $cstaffemail = $_SESSION['cstaffemail']; //getting staff email
  $cstaffid = $_SESSION['cstaffid']; //getting staff id
  $cmainadmin = $_SESSION['cmainadmin']; //getting main admin status
  $cdeptadmin = $_SESSION['cdeptadmin']; // getting dept admin status

  $dte=date("Y-m-d"); //getting current date
  //$dte = date('Y-m-d', strtotime($dte. ' + 0 days'));
  /*$timestamp = strtotime($dte);
  $day = date('l', $timestamp);
  if(strcmp($day, 'Sunday') == 0)
  {
    $dte = date('Y-m-d', strtotime($dte. ' - 1 days'));
  }*/
  //echo $day;
  //$dte = date('Y-m-d', strtotime($dte. ' - 1 days')); //subtracting one day for calculation offset
  //echo $dte;
  $realdate =  $dte; //temporary date storage variable

  for ($i=0; $i < 4;) 
  { 
      $dte = date('Y-m-d', strtotime($dte. ' - 1 days')); //setting starting date for finding 1st Day order
      $sql = "SELECT `DOE` FROM `booking` WHERE `DOE` = '$dte'";  //getting staff details
      $result = $conn->query($sql) or die('Line 36 - welcome.php'); //storing in result variable
      if ($result->num_rows > 0)  // check if tuples exsist in result variable
      { 
          $i++;
      }
  }
  $fdate = $dte; //setting starting date for finding 1st Day order

    //echo $fdate;
  //$edate = date('Y-m-d', strtotime($dte. ' + 5 days'));

  //date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

  //$hourMin = date("h:i:sa");
  
  //$time = explode(':', $hourMin);

  $ppos = array(); // 
  $ppos[0] = 'p1'; //
  $ppos[1] = 'p2'; //
  $ppos[2] = 'p3'; //
  $ppos[3] = 'p4'; // user booking click position identifiers
  $ppos[4] = 'p5'; // 
  $ppos[5] = 'p6'; //
  $ppos[6] = 'p7'; //
  $ppos[7] = 'p8'; //

  $disableflag = 0; //flag to disable future 1 week booking

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/scelogosmall.png"/>
    <title>SHB | Dashboard</title>

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
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #fefefe;">
      <a class="navbar-brand" href="#">Hi there, <?php echo $cstaffname; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="sepbook.php">Special Booking</a>
          </li>
          <?php
              if($cdeptadmin == 1)
              {
          ?>
                <li class="nav-item active">
                  <a class="nav-link" href="allday.php">All-day Booking</a>
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
            <?php              
              if($cmainadmin == 1)
              {
            ?>                
                  <a class="dropdown-item" href="doset.php">Set Day Order</a>
                  <a class="dropdown-item" href="mkholi.php">Mark Holiday</a>
            <?php
              }
            ?>
            </div>
          </li>
        </ul>
        <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href = 'logout.php';">Log Out</button>
      </div>
    </nav>
    <h1 class="text-center mt-4 mb-3" style="color: white">&lt;<span style=" color:#fefefe; text-shadow: 0 0 10px #212121;">CSE</span>&gt; Week View</h1>
    <div class="table-responsive-sm m-xs-0 m-sm-0 m-md-0 m-lg-4 rounded">          
      <table class="table table-hover table-striped" border="1px">
        <thead class="thead-dark justify-contents-center text-center">
          <tr>
            <th>Date</th>
            <th>Day</th>
            <th>DO</th>
            <th>Period 1</th>
            <th>Period 2</th>
            <th>Period 3</th>
            <th>Period 4</th>
            <th>Period 5</th>
            <th>Period 6</th>
            <th>Period 7</th>
            <th>Period 8</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $flag = 0; //flag variable to detect finding the first day order

            //$sql = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND (`DOE` BETWEEN '$fdate' AND '$edate')";
            //echo $sql;
            //echo $fdate;
            $sql = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND `DOE` >= '$fdate' ORDER BY `DOE` ASC"; //getting first day order
            $result = $conn->query($sql) or die("dash.php - 150");
            if ($result->num_rows > 0)  // check if tuples exsist in result variable
            {
                  
                while($row = $result->fetch_assoc())  //return NULL for end of rows and returns entire tuple in $row
                {
                  //echo $row['dayorder'];
                  if($row['dayorder'] == '1')
                  {
                    $firstdo = $row['DOE']; //setting first day order date
                    //echo $firstdo;
                    $flag = 1;
                  }
                  if($flag == 1)
                  {
                    break;
                  }
                }
            } 
            $sql = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND `DOE` >= '$firstdo' ORDER BY `DOE` ASC" ; //getting all records 
                                                          //from Ist day order
            $result = $conn->query($sql) or die("dash.php - 171");
            for($i=0;$i<10;$i++)
            {
              if($i >= 5 && $disableflag == 0) //setting disabled flag to disable second quadrant only if var != 2
                {
                  $disableflag = 1; 
                }
                $row = $result->fetch_assoc();

                $flag = 0; //flag variable for skipping holidays

                $p = array();    //getting all tuple values
                $p[0]=$row['p1'];
                $p[1]=$row['p2'];
                $p[2]=$row['p3'];
                $p[3]=$row['p4'];
                $p[4]=$row['p5'];
                $p[5]=$row['p6'];
                $p[6]=$row['p7'];
                $p[7]=$row['p8'];
                $psub = array();  //getting the subject code associated with tuple records
                $psub[0]=$row['p1-subcode'];
                $psub[1]=$row['p2-subcode'];
                $psub[2]=$row['p3-subcode'];
                $psub[3]=$row['p4-subcode'];
                $psub[4]=$row['p5-subcode'];
                $psub[5]=$row['p6-subcode'];
                $psub[6]=$row['p7-subcode'];
                $psub[7]=$row['p8-subcode'];
                $dayorder = $row['dayorder']; //getting day order values
                $dayorderno = $row['dayorder']; //preserving integer value of day order
                //echo $row['DOE'];
                if($dayorder >= '4' && (strtotime($realdate) == strtotime($row['DOE']))) //opening next week on day order 4
                {
                  $disableflag = 2; //sets the quadrant to be enabled
                  
                }
                switch ($dayorder) {
                  case '1':
                    $dayorder = 'I';
                    break;
                  case '2':
                    $dayorder = 'II';
                    break;
                  case '3':
                    $dayorder = 'III';
                    break;
                  case '4':
                    $dayorder = 'IV';
                    break;
                  case '5':
                    $dayorder = 'V';
                    break;
                  case '0':
                    $flag = 2; //used to skip holidays
                    break;                            
                  default:
                      continue;              
                }
                if($flag == 2)  //skipping all holidays
                {
                    --$i;
                    continue;
                }
                $timestamp = strtotime($row['DOE']);

                $day = date('D', $timestamp);  //finding day assiciated with date
                $datetemp = array();
                $datetemp = explode('-',$row['DOE']);
                $dateinorder = $datetemp[2].'-'.$datetemp[1].'-'.$datetemp[0];
                //echo $dateinorder;
            
          ?>
          <tr class="table-light">
            <?php
              if($disableflag == 0 || $disableflag == 2)
              {
                if($disableflag == 0) //finding the start and end date of first quadrant
                {
                    $sql3 = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND `DOE` >= '$firstdo' ORDER BY `DOE` ASC" ;
                    $result3 = $conn->query($sql3) or die("dash.php - 251");
                    $row3;
                    for ($z=0; $z < 5; $z++) { 
                      $row3 = $result3->fetch_assoc();
                      if($z == 0)
                        $startdate = $row3['DOE'];
                      else if($z == 4)
                        $finaldate = $row3['DOE'];  
                    }
                }
                else if($disableflag == 2) //finding the start and end date of second quadrant 
                {
                    $sql3 = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND `DOE` >= '$firstdo' ORDER BY `DOE` ASC" ;
                    $result3 = $conn->query($sql3) or die("dash.php - 264");
                    $row3;
                    for ($z=0; $z < 10; $z++) { 
                      $row3 = $result3->fetch_assoc();
                      if($z == 5)
                        $startdate = $row3['DOE'];
                      else if($z == 9)
                        $finaldate = $row3['DOE'];  
                    }
                }
            ?>
            <td style="color: #5576C4; white-space: nowrap;"><?php echo $dateinorder; ?></td>
            <td><?php echo $day; ?></td>
            <td style="width: 20px;"><?php echo $dayorder; ?></td>
            <?php
              for ($l=0; $l < 8; $l++) 
              {     
            ?>
                <td style="word-wrap: break-word;"><form method="POST" action="bdetail.php"><input type="hidden" name="dates" value="<?php echo $row['DOE'];?>" /><input type="hidden" name="dayorder" value="<?php echo $dayorderno;?>" /><input  type="hidden" name="finaldate" value="<?php echo $finaldate;?>" /><input  type="hidden" name="dept" value="<?php echo $cstaffdept;?>" /><input  type="hidden" name="startdate" value="<?php echo $startdate;?>" /><input  type="hidden" name="position" value="<?php echo $ppos[$l];?>" /><input  type="hidden" name="value" value="<?php echo $p[$l];?>" /><input  type="hidden" name="subcode" value="<?php echo $psub[$l];?>" /><input type=submit name="val" value='<?php echo $p[$l]; ?>' style="width:105px; outline:none; background-color: transparent; border: 0px; white-space: nowrap; 
            <?php
                  if($p[$l] == "--")
                  {
            ?>
                  color: #388E3C;
                  font-size: 25px;
            <?php
                  }
                  else
                  {
            ?>
                  color: #f44336;
            <?php
                  }
            ?>

                "><input type="submit" value='<?php echo $psub[$l]; ?>' style="text-align: center; width:105px; outline:none; background-color: transparent; border: 0px; 
            <?php
                  if($p[$l] == "--")
                  {
            ?>
                  color: #388E3C;
            <?php
                  }
                  else
                  {
            ?>
                  color: #f44336;
            <?php
                  }
            ?>
                "></form></td> 
            <?php
                  }
              }
              else if($disableflag == 2 )
              {
            ?>
              <td style="color: #616161; width: 110px"><?php echo $row['DOE']; ?></td>
              <td style="color: #616161;"><?php echo $day; ?></td>
              <td style="color: #616161;"><?php echo $dayorder ?></td>
            <?php
                for ($l=0; $l < 8; $l++) 
                { 
            ?>
                    <td style="word-wrap: break-word;"><form method="POST" action="bdetail.php"><input type="hidden" name="dates" value="<?php echo $row['DOE'];?>" /><input  type="hidden" name="dept" value="<?php echo $cstaffdept;?>" /><input type="hidden" name="dayorder" value="<?php echo $dayorder;?>" /><input  type="hidden" name="one" value="<?php echo $ppos[$l];?>" /><input 
            <?php
                      if($disableflag == 1)
                      {
            ?>
                      disabled 
            <?php
                      }
            ?>        type=submit value='<?php echo $p[$l] ?>' style="width:70px; outline:none; background-color: transparent;        border: 0px; 
            <?php
                      if($p[$l] == "--")
                      {
            ?>
                      color: #616161;
            <?php
                      }
                      else
                      {
            ?>
                      color: #616161;
            <?php
                      }
            ?>

                    "><input 
            <?php
                      if($disableflag == 1)
                      {
            ?>
                      disabled 
            <?php
                      }
            ?>        type="submit" value='<?php echo $psub[$l]; ?>' style="width:70px; outline:none; background-color: transparent;        border: 0px; 
            <?php
                      if($p[$l] == "--")
                      {
            ?>
                      color: #616161;
            <?php
                      }
                      else
                      {
            ?>
                      color: #616161;
            <?php
                      }
            ?>

                    "></form></td> 
            <?php
                  }
            }
            ?>
          </tr>
          <?php
              }
          ?>
            
        </tbody>
      </table>
    </div>
       
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
</html>
