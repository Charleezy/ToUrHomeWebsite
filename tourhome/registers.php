<?php

//echo "<h1>Register</h1>";

$submit = $_POST['submit'];

// strip_tags remove tags that user inputs
//old 
//$fullname = strip_tags($_POST['fullname']);

//new
$first_name = strip_tags($_POST['first_name']);
$last_name = strip_tags($_POST['first_name']);

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
	//if ($fullname&&$username&&$password&&$repeatpassword) {
	
	if ($first_name&&$last_name&&$username&&password&&repeatpassword) {
		
		if ($password == $repeatpassword) {
		
			if (strlen($username) > 25 || strlen($first_name) > 25) {
			
				echo "The length of your username exceeds the limit of 25!";
				
			} else {
				
				if (strlen($password) > 25 || strlen($password) < 6) {
				
					echo "Password must be between 6 and 25 characters";
					
				} else {
				
					//encrypt password
					$password = md5($password);
					$repeatpassword = md5($repeatpassword);
					
					//$queryreg = mysql_query("INSERT INTO users VALUES ('', '$fullname', '$username', '$password', '$date')");
					$queryreg = mysql_query("INSERT INTO users VALUES ('', '$first_name', '$last_name', '$username', '$password', '$date')");
					$userID = mysql_query("SELECT id FROM users where username = '$username'");
					if (!$userID) {
						$userID  = 'User was not created, query:' . mysql_error() . "\n";
						die($userID);
					}
					$insert_profile_query = sprintf("INSERT INTO profile (id) VALUES ('%s')", mysql_fetch_row($userID)[0]);
					$queryreg2 = mysql_query($insert_profile_query);
					
					echo "
			<html>
			<head>
			
				<link rel='stylesheet' href='after_login.css' type='text/css'>
				<meta charset='UTF-8'>
				<link type='text/css' rel='stylesheet' href='bootstrap.css'/>
				<script type='text/javascript' src='jquery.js'></script>
				<script type='text/javascript' src='bootstrap.js'></script>
				<style type='text/css'>
				p {
				font-size: 15px;
				font-family: Verdana;
				left: 10px;
				position: fixed;
				}
				</style>
				<title>ToUrHome</title>
				
			</head>
			
			<body>
			<div id='header-container'>
				<!ToUrHome TITLE>
					<div id='ToUrHomeTitle'>
						<a href='http://www.tour-home.org/'>
							<img src='tourhomelogo.png' width='400' height='90'/>
						</a>
			</div>
        
			</div>
	
			<div id='spacing'> </div>";

					die("<p>You have successfully created an account! <a href='login.html'> Return to login page to get started.</a></p>");		
				}
				
			}
			
		} else 
			echo "Your passwords do not match!";
		
	} else 
		echo "Please fill in <b>ALL</b> fields!";
	
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <title>Register for a free account.</title>
        <link rel="stylesheet" type="text/css" href="loginStyle.css" />
		<script src="modernizr.js"></script>
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);
			body {
				background: #7f9b4e url(sixths.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <body>
        <div class="container">
			
			<section class="main">
				<form class="form-4" action="registers.php" method='POST'>
				    <h1>Register for a free ToUrHome account.</h1>
				    <p>
				        <label for="login">first name</label>
				        <input type="text" name="first_name" placeholder="First Name" required value='<?php echo $first_name?>'>
				    </p>
				    <p>
				        <label for="password">last name</label>
				        <input type="text" name='last_name' placeholder="Last Name" required value='<?php echo $last_name?>'> 
				    </p>
				    <p>
				        <label for="password">username</label>
				        <input type="text" name='username' placeholder="Username" required value='<?php echo $username?>'> 
				    </p>
				    <p>
				        <label for="password">password</label>
				        <input type="password" name='password' placeholder="Password" required> 
				    </p>
				    <p>
				        <label for="password">password</label>
				        <input type="password" name='repeatpassword' placeholder="Re-type password" required> 
				    </p>

				    <p>
				        <input type="submit" name="submit" value="Register" id="submit">
				    </p>       
				</form>​
			</section>
			
        </div>
    </body>
</html>