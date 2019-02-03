<?php
	$servername = "localhost"; //hostname	
	$username = "root"; //mysql username	
	$password = "";  //mysql password	
	$dbname = "shbdb";  //mysql database name
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname); 
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	function Redirect($url, $permanent = false)
	{
	    header('Location: ' . $url, true, $permanent ? 301 : 302);
	    exit();
	}
	
?>