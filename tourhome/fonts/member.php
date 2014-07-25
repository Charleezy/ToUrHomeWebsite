<?php

session_start();

if ($_SESSION['username'])
	echo "Welcome, ".$_SESSION['username']."!<br><a href='logout.php'>Logout</a></br>";
else
	die("Your must be logged in!");

?>