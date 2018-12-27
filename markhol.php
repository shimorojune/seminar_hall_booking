<?php
	session_start();
	include 'connect.php';
	$bdate = $_POST['bdate'];
	$depts = array();
	$sql = "SELECT * FROM `booking` WHERE `DOE` >= '$bdate' AND `dept` = 'CSE' ORDER BY `DOE` DESC";  //getting staff details
	echo $sql;
   	$result = $conn->query($sql) or die('Line 47 - setdo.php'); //storing in result variable	
   	if ($result->num_rows > 0)  // check if tuples exsist in result variable
    {        
        while($row = $result->fetch_assoc())  //return NULL for end of rows and returns entire tuple in $row
        {
        	$dbdate = $row['DOE'];
        	$nextdate = date('Y-m-d', strtotime($dbdate. ' + 1 days'));
        	$timestamp = strtotime($nextdate);
			$day = date('l', $timestamp);
			if(strcmp($day, 'Sunday')==0)
			{
				$nextdate = date('Y-m-d', strtotime($nextdate. ' + 1 days'));	
			}
        	$sql2 = "UPDATE `booking` SET `DOE`= '$nextdate' WHERE `DOE` = '$dbdate'";  //getting staff details
			//echo $sql;
		   	$result2 = $conn->query($sql2) or die('Line 25 - markhol.php'); //storing in result variable	
       	}
    }
    $_SESSION['dateshifterror'] = 0;
    Redirect('mkholi.php', false);
?>