<?php
	session_start();
	session_destroy();
	//Redirects to home page
	header("Location: index.php");
?>