<?php
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['cstaffid'])) //checking if user is logged in
	{
		$_SESSION['errorcode'] = 3; //setting error code for logged out problem
		Redirect('index.php', false);  //redirecting to index page
	}
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	$newpassc = $_POST['newpassc'];
	$name = $_SESSION['cstaffname'];
	/*echo $oldpass;
	echo $newpass;
	echo $newpassc;*/
	$oldpass = md5($oldpass);
	$newpass = md5($newpass);
	$newpassc = md5($newpassc);
	$pass = '';
	$sql = "SELECT `staff_pass` FROM `stafftbl` WHERE `staff_name` = '$name'";  //storing entire result set into $result variable
	$result = $conn->query($sql) or die("29 - passchange.php");
	if ($result->num_rows > 0)  // check for records in db
	{
	    // output data of each row
	    while($row = $result->fetch_assoc()) //return NULL for end of rows and returns entire tuple in $row
	    {
	        $pass = $row['staff_pass'];
	    }
	}
	if((strcmp($oldpass, $pass)==0))
	{
		if((strcmp($newpass, $newpassc)==0))
		{
			$sql = "UPDATE `stafftbl` SET `staff_pass`= '$newpass' WHERE `staff_name` = '$name'";  //storing entire result set into $result variable
			$result = $conn->query($sql) or die('45 - passchange.php');
			$_SESSION['passchange'] = 0;
		}
		else
		{
			$_SESSION['passchange'] = 1;
		}
	}
	else
	{
		$_SESSION['passchange'] = 2;
	}
	Redirect('pass.php', false);
?>