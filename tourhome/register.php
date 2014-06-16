<?php

//echo "<h1>Register</h1>";

$submit = $_POST['submit'];

// strip_tags remove tags that user inputs
$fullname = strip_tags($_POST['fullname']);
$username = strtolower(strip_tags($_POST['username']));
$password = strip_tags($_POST['password']);
$repeatpassword = strip_tags($_POST['repeatpassword']);
$date = date("Y-m-d");

if ($submit) {

	//open database
	$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
	mysql_select_db("pakfung_phplogin");
	
	$namecheck = mysql_query("SELECT username FROM users WHERE username='$username'");
	$count = mysql_num_rows($namecheck);
	
	if ($count != 0) {
		die("Username already taken!");
	}
	
    // check for existance
	if ($fullname&&$username&&$password&&$repeatpassword) {
		
		if ($password == $repeatpassword) {
		
			if (strlen($username) > 25 || strlen($fullname) > 25) {
			
				echo "The length of your username exceeds the limit of 25!";
				
			} else {
				
				if (strlen($password) > 25 || strlen($password) < 6) {
				
					echo "Password must be between 6 and 25 characters";
					
				} else {
				
					//encrypt password
					$password = md5($password);
					$repeatpassword = md5($repeatpassword);
					
					$queryreg = mysql_query("INSERT INTO users VALUES ('', '$fullname', '$username', '$password', '$date')");
					$queryreg1 = mysql_query("INSERT INTO profile VALUES ('', '', '', '', '','')");
					die("Welcome to ToUrHome! <a href='index.php'> Return to login page</a>");
					
				}
				
			}
			
		} else 
			echo "Your passwords do not match!";
		
	} else 
		echo "Please fill in <b>ALL</b> fields!";
	
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="register.css" type="text/css">
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="bootstrap.css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
	<title>ToUrHome</title>
</head>

<body>
	<div id="header-container">
	
	<!ToUrHome TITLE>
    	<div id="ToUrHomeTitle">
	        <a href="http://www.tour-home.org/">
				<img src="tourhomelogo.png" width="400" height="80" />
				<img src="couch.png" width="110" height="100" id="couch"/>
			</a>
		</div>
        
        <h1 id="registrationLogo">>>>Registration</h1>
        
	</div>
	
	<div id="spacing"> </div>

<div id="center">
<p>

<form action='register.php' method='POST'>
<img src="bathroom.jpg" height="100%" width="45%"/>
	<table id="table">
		<tr>
			<td>
			<font="Gill Sans">Full Name:</font>
			</td>
			<td>
			<input type='text' name='fullname' value='<?php echo $fullname?>'>
			</td>
		</tr>
		
		<tr>
			<td>
			Username:
			</td>
			<td>
			<input type='text' name='username' value='<?php echo $username?>'>
			</td>
		</tr>
		
		<tr>
			<td>
			Password:
			</td>
			<td>
			<input type='password' name='password'>
			</td>
		</tr>
		
		<tr>
			<td>
			Re-type password:
			</td>
			<td>
			<input type='password' name='repeatpassword'>
			</td>
		</tr>
		
	</table>
	
	<input type='submit' name='submit' value='Register' id="submit">

	<p>
	
</form>
</div>

<div id="secondSpacer"></div>
	<div id="bottom"></div>

</body>
</html>