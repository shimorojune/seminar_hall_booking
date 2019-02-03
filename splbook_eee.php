<?php 
    include 'connect.php';

    $sql = "UPDATE `booking` SET `p3`='marimuthu-eee', `p3-subcode`='EE6613 ' WHERE `dayorder` = 1 AND (`dept` = 'EEE' AND `DOE` > 2019-01-02)" ;
	//echo $sql;
    $result = $conn->query($sql) or die("bookdate.php - 27");

    $sql = "UPDATE `booking` SET `p6`='marimuthu-eee', `p6-subcode`='EE6613 ',`p6`='marimuthu-eee', `p6-subcode`='EE6613 ' WHERE `dayorder` = 3 AND (`dept` = 'EEE' AND `DOE` > 2019-01-02)" ;
	//echo $sql;
    $result = $conn->query($sql) or die("bookdate.php - 27");
    
    $sql = "UPDATE `booking` SET `p5`='vijayalakshmi-eee', `p5-subcode`='EE8412 ',`p7`='vijayalakshmi-eee', `p7-subcode`='EE8412 ' WHERE `dayorder` = 4 AND (`dept` = 'EEE' AND `DOE` > 2019-01-02)" ;
	//echo $sql;
    $result = $conn->query($sql) or die("bookdate.php - 27");
   

    $sql = "UPDATE `booking` SET `p6`='gaayathry-eee', `p6-subcode`='EE8412 ',`p8`='gaayathry-eee', `p8-subcode`='EE8412 ' WHERE `dayorder` = 1 AND (`dept` = 'EEE' AND `DOE` > 2019-01-02)" ;
	//echo $sql;
    $result = $conn->query($sql) or die("bookdate.php - 27");

    
    $sql = "UPDATE `booking` SET `p8`='gaayathry-eee', `p8-subcode`='EE6613 ' WHERE `dayorder` = 3 AND (`dept` = 'EEE' AND `DOE` > 2019-01-02)" ;
	//echo $sql;
    $result = $conn->query($sql) or die("bookdate.php - 27");

    $sql = "UPDATE `booking` SET `p7`='gaayathry-eee', `p7-subcode`='EE6613 ' WHERE `dayorder` = 5 AND (`dept` = 'EEE' AND `DOE` > 2019-01-02)" ;
	//echo $sql;
    $result = $conn->query($sql) or die("bookdate.php - 27");