<?php
if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}
$UserName="";
if(isset($_SESSION["username"])){$UserName=$_SESSION["username"];}
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin");

	//get the profile of the current user from database.
	$query=mysqli_query($con, "select image,contact,age,gender,about,max_guests from users natural join profile where UserName='$UserName'") or die(mysql_error());
	$result=mysqli_fetch_row($query);
	$destination=$result[0];
	//$imgpreviewsize=1/2;
	//$image_size = getimagesize($destination);
	echo "Your picture:<br>";
	echo "<img src=\"".$destination."\" width=".(200)." height=".(150)." border='0'><br><br>";
	?>
	<form name='form1' method='post' action="picture.php" enctype="multipart/form-data">
	update your picture<br>
	<input type="file" name="file1" id="file1"></input></td>
	<input name='compare' type='submit' id='compare' value='upload'></input><br>
	</form>
	<div class='input-prepend'>
	<form id="profile_form" name='form1' method='post' action='edit_go.php'>
	<span class='add-on'>
	Contact:<i class='icon-lock'></i>
	</span><input class='span2' name='contact' type='text' size='15' id='contact' value="<?php echo $result[1]; ?>"></input><br><br>
	<span class='add-on'>
	Age:<i class='icon-envelope'></i>
	</span><input class='span2' name='age' type='text' size='15' id='age' value="<?php echo $result[2]; ?>"></input><br><br>
	<span class='add-on'>
	Gender:<i class='icon-envelope'></i>
	</span><input class='span2' name='gender' type='text' size='15' id='gender' value="<?php echo $result[3]; ?>"></input><br><br>
	<span class='add-on'>About Me:</span>
	<textarea name="about_me" rows="5"><?php echo $result[4]; ?></textarea><br>
	<span class='add-on'>Can Accomodate</span>
	<select name="accomodates">
	<option value="0" <?php if ($result[5] == 0) { echo " selected"; } ?>>0</option>
	<option value="1" <?php if ($result[5] == 1) { echo " selected"; } ?>>1</option>
	<option value="2" <?php if ($result[5] == 2) { echo " selected"; } ?>>2</option>
	<option value="3" <?php if ($result[5] == 3) { echo " selected"; } ?>>3+</option>
	</select><br /><br />
	<button id='signin' type='submit' class='btn btn-primary'>Edit</button>
	</form>
	</div>
	