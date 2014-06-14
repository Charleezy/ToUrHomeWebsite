<?php

//stevenpakfunglau on samuel-huntington.dreamhost.com will be created with password 8!t*8B5r

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {

	$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
	mysql_select_db("pakfung_phplogin") or die("Couldn't find the database.");
	
	$query = mysql_query("SELECT * FROM users WHERE username='$username'");
	$numrows = mysql_num_rows($query);
	
	if ($numrows != 0) {
	
		while ($row = mysql_fetch_assoc($query)) {
			
			$dbusername = $row['username'];
			$dbpassword = $row['password'];
			
		}
		
		if ($username == $dbusername && md5($password) == $dbpassword) {
			
			echo "You're In! <a href='member.php'>Click</a> here to enter the member page.";
			$_SESSION['username']=$username;
			
		} else
			echo "Incorrect password!";
		
	} else
		die("That user doesn't exist!");
		
} else 
	die("Please enter a username and password!");

?>