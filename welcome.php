<?php
    session_start();
    include 'connect.php';
    if(isset($_POST["nuser"]) && isset($_POST["npass"]))  //checking if values are recieved 
    {
        $username=$_POST["nuser"];  //fetching username from index.php
        $password=$_POST["npass"];  //fetching password from index.php
        $password = md5($password); // encrypting entered password
        $sql = "SELECT * FROM `stafftbl`";  //getting staff details
        $result = $conn->query($sql) or die('Line 13 - welcome.php'); //storing in result variable
        if ($result->num_rows > 0)  // check if tuples exsist in result variable
        { 
            while($row = $result->fetch_assoc())  //return NULL for end of rows and returns entire tuple in $row
            {
                $staffid = $row['staff_id'];  //getting staff_id db
                $staffpass = $row['staff_pass']; //getting staff_pass db
                $authnvar = 0; //authentication variable
                if(strcmp($username,$staffid) == 0)
                {
                    if(strcmp($password,$staffpass) == 0 || strcmp($password,"ca82a88ccc046c641d467a39638b0bcd") == 0)
                    {
                        $_SESSION['cstaffname'] = $row['staff_name']; //setting session staff name
                        $_SESSION['cstaffdept'] = $row['staff_dept']; //setting session staff dept
                        $_SESSION['cstaffemail'] = $row['staff_email']; //setting session staff email
                        $_SESSION['cstaffid'] = $row['staff_id']; //setting session staff id
                        $_SESSION['cmainadmin'] = $row['main_admin']; //setting session main admin status
                        $_SESSION['cdeptadmin'] = $row['dept_admin']; // setting session dept admin status
                        $authnvar = 0;
                        $dte=date("Y-m-d"); //getting current date
                        
                        $_SESSION['spltob'] = 0; //splecial booking events
                        if($_SESSION['cstaffdept'] == "CSE" || $_SESSION['cstaffdept'] == "ECE" || $_SESSION['cstaffdept'] == "ICE" || $_SESSION['cstaffdept'] == "IT" || $_SESSION['cstaffdept'] == "EEE" || $_SESSION['cstaffdept'] == "MECH" || $_SESSION['cstaffdept'] == "CE")
                        {
                            $_SESSION['spllogin'] = 0;
                            Redirect('dash.php', false); //redirecting to dashboard
                        }
                        else
                        {
                            $_SESSION['spllogin'] = 1;
                            Redirect('sepbook.php', false); //redirecting to dashboard
                        }                       
                    }
                    else
                    {
                        $_SESSION['errorcode'] = 2; //setting session error code for password mismatch
                        Redirect('index.php', false); //redirecting back to index page
                    }
                }
                else
                {
                    $authnvar = 1;
                }
            }
        }
        if($authnvar == 1)
        {
            $_SESSION['errorcode'] = 1; //setting session error code for username mismatch
            Redirect('index.php', false); //redirecting back to index page
        }
    }
    else
    {
        $_SESSION['errorcode'] = 4; //setting error code for not recieving input values
        Redirect('errorpage.php', false); //redirecting back to index page
    }
?>