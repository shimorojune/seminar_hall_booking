<?php
	session_start();
	session_destroy();
	function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
    Redirect('index.php', false); 
 ?>