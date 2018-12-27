<?php
	session_start();
	include 'connect.php';
	$bookeduser = $_SESSION['valueatbooking'];//getting the id of user currently booking
	$sql = "SELECT * FROM `stafftbl` WHERE `staff_id` = '$bookeduser'";  
	$result = $conn->query($sql) or die("ln 11 - unbook.php");
	$row = $result->fetch_assoc();
	$_SESSION['bkname'] = $row['staff_name'];
	$_SESSION['bkemail'] = $row['staff_email'];
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	$dateofbooking = $_SESSION['dateofbooking']; //getting the date to unbook as session
	$deptofbooking  = $_SESSION['deptofbooking']; //getting the dept to unbook as session
	$periodofbooking = $_SESSION['periodofbooking']; //getting the position to unbook as session
	$subcodemarker = $periodofbooking.'-subcode'; //setting the subcode marker
	$sql = "UPDATE `booking` SET `$periodofbooking` = '--', `$subcodemarker` = '' WHERE `DOE` = '$dateofbooking' AND `dept` = '$deptofbooking'";  //getting staff details
    $result = $conn->query($sql) or die('Line 14 - unbook.php'); //storing in result variable
    $sql = "SELECT * FROM `dataondate` WHERE (`DOE` = '$dateofbooking' AND `Period` = '$periodofbooking') AND `ofDept` = '$deptofbooking'" ; //not letting duplicates
    //echo $sql;
	$result = $conn->query($sql) or die("bookdate.php - 137");
	if ($result->num_rows > 0)  // check if tuples exsist in result variable
    {               	
        	$sql = "UPDATE `dataondate` SET `cancelled` = 1 WHERE (`DOE` = '$dateofbooking' AND `Period` = '$periodofbooking') AND `ofDept` = '$deptofbooking'" ;
        	//echo $sql;
			$result = $conn->query($sql) or die("bookdate.php - 137");        
    }
    //Redirect('mailc.php', false);
	if($_SESSION['spl'] == 1)
	{
		Redirect('dashsep.php', false);
	}
	else
	{
		Redirect('dash.php', false);
	}
?>