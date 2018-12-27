<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	$cstaffid = $_SESSION['cstaffid'];
	if($_SESSION['spl'] == 1)
	{
		$cstaffdept = $_SESSION['deptofbooking']; //getting value for specail booking
	}
	else
	{
		$cstaffdept = $_SESSION['cstaffdept']; //getting staff dept
	}
	$cnt = 0; //counting number of bookings	
	$dte=date("Y-m-d"); //getting current date
	//$finaldate =  //getting the final date of quadrant
	//$startdate =  //getting the start date of quadrant
	$startdate = $_SESSION['startdate']; //setting start date as session to be accessed for counting later
	$finaldate = $_SESSION['finaldate']; //setting end date as session to be accessed for counting later
	$dateofbooking = $_SESSION['dateofbooking']; //setting the date to book as session
	$doofbooking = $_SESSION['doofbooking']; //setting the day order to book as session
	$deptofbooking = $_SESSION['deptofbooking']; //setting the dept to book as session
	$periodofbooking = $_SESSION['periodofbooking']; //setting the position to book as session
	$deptforbooking = '-'; //getting dept booking for
	$topicforbooking = $_POST['topic']; //getting topic booking for
	$yearforbooking = '-'; //setting deault values for the variables
	$secforbooking = '-'; //setting deault values for the variables
	$subcodeforbooking = 'Event'; //setting deault values for the variables
	$subcodemarker = $periodofbooking.'-subcode'; //setting the subcode marker
	if($_SESSION['spltob'] == 0)
	{
		$subcodeforbooking = $_POST['subcode']; //getting subcode booking for
		$_SESSION['subcodeforbooking'] = $subcodeforbooking; //setting subcode session for use in maxbook.php

		$sql = "SELECT * FROM `work_order` WHERE `subcode` = '$subcodeforbooking'";  //getting staff details
        $result = $conn->query($sql) or die('Line 48 - bookdate.php'); //storing in result variable

       
        $row = $result->fetch_assoc();

        $sem = $row['sem']; //get sem of subject
        if($sem == 1 || $sem == 2)//getting year booking related to subject code
        {
        	$yearforbooking = 1; 
        }
		else if($sem == 3 || $sem == 4)
		{
			$yearforbooking = 2; 
		}
		else if($sem == 5 || $sem == 6)
		{
			$yearforbooking = 3; 
		}
		else if($sem == 7 || $sem == 8)
		{
			$yearforbooking = 4; 
		}
		$secforbooking = $row['sec']; //getting section booking for
		
		$deptforbooking = $row['branch'];
		//$subcodemarker = $periodofbooking.'-subcode'; //setting the subcode marker
		//echo $valatbk;
		//echo $_SESSION['periodofbooking'];		
	}
	else
	{
		$deptforbooking = $_POST['dept'];
	}
	$sql = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND `DOE` BETWEEN '$startdate' AND '$finaldate'" ;
	//echo $sql;
	$result = $conn->query($sql) or die("bookdate.php - 27");
	if ($result->num_rows > 0)  // check if tuples exsist in result variable
    {
        while($row = $result->fetch_assoc())  //return NULL for end of rows and returns entire tuple in $row
        {
        	$p = array();
        	$p[0]=$row['p1'];
			$p[1]=$row['p2'];
			$p[2]=$row['p3'];
			$p[3]=$row['p4'];
			$p[4]=$row['p5'];
			$p[5]=$row['p6'];
			$p[6]=$row['p7'];
			$p[7]=$row['p8'];
			$psub = array();
			$psub[0]=$row['p1-subcode'];
			$psub[1]=$row['p2-subcode'];
			$psub[2]=$row['p3-subcode'];
			$psub[3]=$row['p4-subcode'];
			$psub[4]=$row['p5-subcode'];
			$psub[5]=$row['p6-subcode'];
			$psub[6]=$row['p7-subcode'];
			$psub[7]=$row['p8-subcode'];
		
			for($j=0;$j<8;$j++)
			{
				if(strcmp($p[$j],$cstaffid)==0 && strcmp($psub[$j],$subcodeforbooking)==0)
				{
				  $cnt++;				 
				}
			}
        }
    }
    //echo $cnt;
    if($cnt >= 3 && $_SESSION['spltob'] == 0)
    {
    	Redirect('maxbook.php', false);
    }
    else
    {
    	if($_SESSION['spltob'] == 0)
    	{
    		$sql = "UPDATE `booking` SET `$periodofbooking` = '$cstaffid', `$subcodemarker` = '$subcodeforbooking' WHERE `DOE` = '$dateofbooking' AND `dept` = '$deptofbooking'" ;
			//echo $sql;
    	}
    	else if($_SESSION['spltob'] == 1)
    	{
    		$sql = "UPDATE `booking` SET `$periodofbooking` = '$cstaffid', `$subcodemarker` = '$topicforbooking' WHERE `DOE` = '$dateofbooking' AND `dept` = '$deptofbooking'" ;
    	}    
		$result = $conn->query($sql) or die("bookdate.php - 74");
		
		 $sql = "SELECT * FROM `dataondate` WHERE (`DOE` = '$dateofbooking' AND `Period` = '$periodofbooking') AND `ofDept` = '$deptofbooking'" ; //not letting duplicates
	    //echo $sql;
		$result = $conn->query($sql) or die("bookdate.php - 137");
		if ($result->num_rows > 0)  // check if tuples exsist in result variable
	    {
        	$sql = "UPDATE `dataondate` SET `cancelled` = 0, `topic` = '$topicforbooking' WHERE (`DOE` = '$dateofbooking' AND `Period` = '$periodofbooking') AND `ofDept` = '$deptofbooking'" ;
        	//echo $sql;
			$result = $conn->query($sql) or die("bookdate.php - 137");
        }
		else
		{
			$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dateofbooking','$doofbooking','$periodofbooking','$deptofbooking','$cstaffid','$deptforbooking','$yearforbooking','$secforbooking','$subcodeforbooking','$topicforbooking',0)" ;
			//echo $sql;
			$result = $conn->query($sql) or die("bookdate.php - 142");
		}
		if($_SESSION['spl'] == 1)
		{
			Redirect('dashsep.php', false);
		}
		else
		{
			Redirect('dash.php', false);
		}	
    }
?>