<?php
	session_start();
	include 'connect.php';
	$cstaffdept = $_SESSION['cstaffdept'];
	$cstaffid = $_SESSION['cstaffid'];
	$tob = $_POST['tob']; // getting the type of booking
	$topic = $_POST['topic']; //geting the event name
	$dob = $_POST['date']; //getting the bate of booking
	$sql = "SELECT * FROM `booking` WHERE `dept` = '$cstaffdept' AND `DOE` = '$dob'"; //getting first day order
	//echo $sql;
	$result = $conn->query($sql) or die("alldaybk.php - 14");
	$p = array();
	if ($result->num_rows > 0)  // check if tuples exsist in result variable
    {       
        while($row = $result->fetch_assoc())  //return NULL for end of rows and returns entire tuple in $row
        {
        	$p[0] = $row['p1'];
        	$p[1] = $row['p2'];
        	$p[2] = $row['p3'];
        	$p[3] = $row['p4'];
        	$p[4] = $row['p5'];
        	$p[5] = $row['p6'];
        	$p[6] = $row['p7'];
        	$p[7] = $row['p8'];
        }
    }
    $ppos = array(); // 
    $ppos[0] = 'p1'; //
    $ppos[1] = 'p2'; //
    $ppos[2] = 'p3'; //
    $ppos[3] = 'p4'; // period identifiers
    $ppos[4] = 'p5'; // 
    $ppos[5] = 'p6'; //
    $ppos[6] = 'p7'; //
    $ppos[7] = 'p8'; //
    switch ($tob) {
    	case '1':   		
    			for ($j=0; $j < 8; $j++) 
    			{ 
    				$k = $j+1;
    				$subcodemarker = 'p'.$k.'-subcode';
    				if (strcmp($p[0], '--') == 0) 
    				{
    					$sql = "UPDATE `booking` SET `$ppos[$j]` = '$cstaffid', `$subcodemarker` = '$topic' WHERE `DOE` = '$dob' AND `dept` = '$cstaffdept'" ;
    					echo $sql;
    					$result = $conn->query($sql) or die('Line 45 - alldaybk.php'); //storing in result variable
    					$sql = "SELECT `dayorder` FROM `booking` WHERE `DOE` = '$dob'" ;
    					$result = $conn->query($sql) or die('Line 47 - alldaybk.php'); //storing in result variable
    					$row = $result->fetch_assoc();
    					$dayorder = $row['dayorder'];
    					$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dob','$dayorder','$ppos[$j]','$cstaffdept','$cstaffid','$cstaffdept','-','-','-','$topic',0)" ;
						//echo $sql;
						$result = $conn->query($sql) or die("bookdate.php - 142");
    				}
    				else
    				{
    					$sql = "UPDATE `booking` SET `$ppos[$j]` = '$cstaffid', `$subcodemarker` = '$topic' WHERE `DOE` = '$dob' AND `dept` = '$cstaffdept'" ;
    					echo $sql;
    					$result = $conn->query($sql) or die('Line 45 - alldaybk.php'); //storing in result variable
    					$sql = "SELECT `dayorder` FROM `booking` WHERE `DOE` = '$dob'" ;
    					$result = $conn->query($sql) or die('Line 47 - alldaybk.php'); //storing in result variable
    					$row = $result->fetch_assoc();
    					$dayorder = $row['dayorder'];
    					$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dob','$dayorder','$ppos[$j]','$cstaffdept','$cstaffid','$cstaffdept','-','-','-','$topic',0)" ;
						//echo $sql;
						$result = $conn->query($sql) or die("bookdate.php - 142");
    				}
    			}   		
    		break;
		case '2':
    			for ($j=0; $j < 4; $j++) 
    			{ 
    				$k = $j+1;
    				$subcodemarker = 'p'.$k.'-subcode';
    				if (strcmp($p[0], '--') == 0) 
    				{
    					$sql = "UPDATE `booking` SET `$ppos[$j]` = '$cstaffid', `$subcodemarker` = '$topic' WHERE `DOE` = '$dob' AND `dept` = '$cstaffdept'" ;
    					$result = $conn->query($sql) or die('Line 45 - alldaybk.php'); //storing in result variable
    					$sql = "SELECT `dayorder` FROM `booking` WHERE `DOE` = '$dob'" ;
    					$result = $conn->query($sql) or die('Line 47 - alldaybk.php'); //storing in result variable
    					$row = $result->fetch_assoc();
    					$dayorder = $row['dayorder'];
    					$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dob','$dayorder','$ppos[$j]','$cstaffdept','$cstaffid','$cstaffdept','-','-','-','$topic',0)" ;
						//echo $sql;
						$result = $conn->query($sql) or die("bookdate.php - 142");
    				}
    				else
    				{
    					$sql = "UPDATE `booking` SET `$ppos[$j]` = '$cstaffid', `$subcodemarker` = '$topic' WHERE `DOE` = '$dob' AND `dept` = '$cstaffdept'" ;
    					echo $sql;
    					$result = $conn->query($sql) or die('Line 45 - alldaybk.php'); //storing in result variable
    					$sql = "SELECT `dayorder` FROM `booking` WHERE `DOE` = '$dob'" ;
    					$result = $conn->query($sql) or die('Line 47 - alldaybk.php'); //storing in result variable
    					$row = $result->fetch_assoc();
    					$dayorder = $row['dayorder'];
    					$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dob','$dayorder','$ppos[$j]','$cstaffdept','$cstaffid','$cstaffdept','-','-','-','$topic',0)" ;
						//echo $sql;
						$result = $conn->query($sql) or die("bookdate.php - 142");
    				}
    			}   				
    		break;
		case '3':			
    			for ($j=4; $j < 8; $j++) 
    			{ 
    				$k = $j+1;
    				$subcodemarker = 'p'.$k.'-subcode';
    				if (strcmp($p[0], '--') == 0) 
    				{
    					$sql = "UPDATE `booking` SET `$ppos[$j]` = '$cstaffid', `$subcodemarker` = '$topic' WHERE `DOE` = '$dob' AND `dept` = '$cstaffdept'" ;
    					$result = $conn->query($sql) or die('Line 45 - alldaybk.php'); //storing in result variable
    					$sql = "SELECT `dayorder` FROM `booking` WHERE `DOE` = '$dob'" ;
    					$result = $conn->query($sql) or die('Line 99 - alldaybk.php'); //storing in result variable
    					$row = $result->fetch_assoc();
    					$dayorder = $row['dayorder'];
    					$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dob','$dayorder','$ppos[$j]','$cstaffdept','$cstaffid','$cstaffdept','-','-','-','$topic',0)" ;
						//echo $sql;
						$result = $conn->query($sql) or die("alldaybk.php - 104");
    				}
    				else
    				{
    					$sql = "UPDATE `booking` SET `$ppos[$j]` = '$cstaffid', `$subcodemarker` = '$topic' WHERE `DOE` = '$dob' AND `dept` = '$cstaffdept'" ;
    					echo $sql;
    					$result = $conn->query($sql) or die('Line 45 - alldaybk.php'); //storing in result variable
    					$sql = "SELECT `dayorder` FROM `booking` WHERE `DOE` = '$dob'" ;
    					$result = $conn->query($sql) or die('Line 47 - alldaybk.php'); //storing in result variable
    					$row = $result->fetch_assoc();
    					$dayorder = $row['dayorder'];
    					$sql = "INSERT INTO `dataondate`(`DOE`, `dayorder`, `Period`, `ofDept`, `bookedby`, `forDept`, `forYear`, `forsec`, `subcode`, `topic`, `cancelled`) VALUES ('$dob','$dayorder','$ppos[$j]','$cstaffdept','$cstaffid','$cstaffdept','-','-','-','$topic',0)" ;
						//echo $sql;
						$result = $conn->query($sql) or die("bookdate.php - 142");
    				}
    			}		
    		break;  	
    	default:
    		# code...
    		break;
    }
    Redirect('allday.php', false);
?>