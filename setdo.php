<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}	
	$dte = $_POST['bdate'];
	$nod = $_POST['nod'];
	$do = $_POST['do'];
	$depts = array();
	$depts[0] = 'CSE';
	$depts[1] = 'CE';
	$depts[2] = 'IT';
	$depts[3] = 'ICE';
	$depts[4] = 'EEE';
	$depts[5] = 'ECE';
	$depts[6] = 'MECH';
	$depts[7] = 'MBA';
	for ($i=0; $i < $nod; $i++) 
	{ 				
		if($do >= 6)
			$do = 1;		
		$timestamp = strtotime($dte);
		$day = date('l', $timestamp);
		if(strcmp($day, 'Sunday')==0)
		{
			$dte = date('Y-m-d', strtotime($dte. ' + 1 days'));	
			--$i;
			continue;
		}
		for ($k=0; $k < 8; $k++) 
    	{ 
    		$sql = "SELECT * FROM `booking` WHERE `DOE` = '$dte' AND `dept` = '$depts[$k]'";  //getting staff details
    	    $result = $conn->query($sql) or die('Line 47 - setdo.php'); //storing in result variable		

    	    if ($result->num_rows > 0)  // check if tuples exsist in result variable
        	{
        		$sql = "UPDATE `booking` SET `dayorder`='$do' WHERE `DOE` = '$dte' AND `dept` = '$depts[$k]'";  //getting staff details
    	    	$result = $conn->query($sql) or die('Line 52 - setdo.php'); //storing in result variable		
        	}
        	else
        	{
        		$sql = "INSERT INTO `booking` (`DOE`,`dayorder`,`dept`) VALUES ('$dte','$do','$depts[$k]')";  //getting staff details
    	    	$result = $conn->query($sql) or die('Line 57 - setdo.php'); //storing in result variable		
        	}   		
    	}
				
		$do++;
		$dte = date('Y-m-d', strtotime($dte. ' + 1 days'));	
	}
	Redirect('doset.php', false);
?>
