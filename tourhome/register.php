<?php

echo "<h1>Register</h1>";

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
			
				echo "Length of username or full name is too long!";
				
			} else {
				
				if (strlen($password) > 25 || strlen($password) < 6) {
				
					echo "Password must be between 6 and 25 characters";
					
				} else {
				
					//encrypt password
					$password = md5($password);
					$repeatpassword = md5($repeatpassword);
					
					$queryreg = mysql_query("INSERT INTO users VALUES ('', '$fullname', '$username', '$password', '$date')");
					$queryreg1 = mysql_query("INSERT INTO profile VALUES ('', '', '', '', '','')");
					die("You have been registered! <a href='index.php'> Return to login page</a>");
					
				}
				
			}
			
		} else 
			echo "Your passwords do not match!";
		
	} else 
		echo "Please fill in <b>all</b> fields!";
	
}

?>

<html>
<p>
<form action='register.php' method='POST'>
	<table>
		<tr>
			<td>
			Your full name:
			</td>
			<td>
			<input type='text' name='fullname' value='<?php echo $fullname?>'>
			</td>
		</tr>
		
		<tr>
			<td>
			Choose a username:
			</td>
			<td>
			<input type='text' name='username' value='<?php echo $username?>'>
			</td>
		</tr>
		
		<tr>
			<td>
			Choose a password:
			</td>
			<td>
			<input type='password' name='password'>
			</td>
		</tr>
		
		<tr>
			<td>
			Repeat your password:
			</td>
			<td>
			<input type='password' name='repeatpassword'>
			</td>
		</tr>
	</table>
	<p>
	<input type='submit' name='submit' value='Register'>
</form>

</html>