<?php

//echo "<h1>Register</h1>";
if(isset($_POST['submit'])){
$submit = $_POST['submit'];}

if (isset($submit)) {
	// strip_tags remove tags that user inputs
	$firstName = strip_tags($_POST['first_name']);
	$lastName = strip_tags($_POST['last_name']);
	$username = strtolower(strip_tags($_POST['username']));
	$password = strip_tags($_POST['password']);
	$repeatpassword = strip_tags($_POST['repeatpassword']);
	$date = date("Y-m-d");

	//open database
	$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
	
	if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	if (!($insert_stmt = $mysqli->prepare("SELECT username FROM users WHERE username=?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	if (!$insert_stmt->bind_param("s", $username)) {
		echo "Binding parameters failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
	}
	if (!$insert_stmt->execute()) {
		echo "Execute failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
	}
	$namecheck = $insert_stmt->get_result();
	$count = mysqli_num_rows($namecheck);
	
	if ($count != 0) {
		die("Username already taken!");
	}
	
    // check for existance
	if ($firstName&&$lastName&&$username&&$password&&$repeatpassword) {
		
		if ($password == $repeatpassword) {
		
			if (strlen($username) > 25 || strlen($firstName) > 25 || strlen($lastName) > 25 ) {
			
				echo "The length of your username/name exceeds the limit of 25!";
				
			} else {
				
				if (strlen($password) > 25 || strlen($password) < 6) {
				
					echo "Password must be between 6 and 25 characters";
					
				} else {
				
					//encrypt password
					$password = md5($password);
					$repeatpassword = md5($repeatpassword);
					
					if (!($insert_stmt = $mysqli->prepare("INSERT INTO users VALUES ('', ?, ? , ?, ?, ?)"))) {
						echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
					}
					if (!$insert_stmt->bind_param("sssss", $firstName, $lastName, $username, $password, $date)) {
						echo "Binding parameters failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
					}
					if (!$insert_stmt->execute()) {
						echo "Execute failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
					}
					
					if (!($select_stmt = $mysqli->prepare("SELECT id FROM users where username = ?"))) {
						echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
					}
					if (!$select_stmt->bind_param("s", $username)) {
						echo "Binding parameters failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
					}
					if (!$select_stmt->execute()) {
						echo "Execute failed: (" . $insert_stmt->errno . ") " . $insert_stmt->error;
					}
					$user_found = $select_stmt->get_result();
					$userID = $user_found->fetch_row()[0];
					
					if (!$userID) {
						$userID  = 'User was not created, query:' . mysql_error() . "\n";
						die($userID);
					}
					$insert_profile_query = sprintf("INSERT INTO profile (id) VALUES ('%s')", $userID);
					$queryreg2 = mysql_query($insert_profile_query);
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
			</a>
		</div>
        
        <h1 id="registrationLogo">Registration</h1>
        
	</div>
	
	<div id="spacing"> </div>

<div id="center">
<p>

<form action='register.php' method='POST'>
<img src="bathroom.jpg" height="100%" width="45%"/>
	<table id="table">
		<tr>
			<td>
			Your First Name:
			</td>
			<td>
			<input type='text' name='first_name' value=''>
			</td>
		</tr>
		
		<tr>
			<td>
			Your Last Name:
			</td>
			<td>
			<input type='text' name='last_name' value=''>
			</td>
		</tr>
		
		<tr>
			<td>
			Your Username:
			</td>
			<td>
			<input type='text' name='username' value=''>
			</td>
		</tr>
		
		<tr>
			<td>
			Your Password:
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
	<footer><a href="index.php">Return to main page</a></footer>
	</body>
</html>