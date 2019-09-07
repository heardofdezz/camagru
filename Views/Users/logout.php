<?php
	session_start();
	if (isset($_SESSION['User_id']))
	{
		unset($_SESSION['User_id']);
        unset($_SESSION['Email']);
    	unset($_SESSION['Nom']);
		session_destroy();
		session_start();
	}
	header("Location: " . WEBROOT . "users/login");
	exit;
?>