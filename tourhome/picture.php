<?php
session_start();
if($_FILES['file1']['name']!=''){
	move_uploaded_file($_FILES['file1']['tmp_name'],"upload/".$_FILES['file1']['name']);
}else{
	echo "<script>alert(please upload file¡);</script>";
}
$destination="upload/".$_FILES['file1']['name'];
$UserName="";
if(isset($_SESSION['username'])){$UserName=$_SESSION['username'];}
$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");

#Note: There is a nuance with updating a table when you are selecting it in a nested query in MySQL. To get around this you use "(select * from profile) as p" instead of just "profile"
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (!($update_profile_image_query = $mysqli->prepare("update profile set image=? where id in (select id from users natural join (select * from profile) as p where username = ?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if (!$update_profile_image_query->bind_param("ss", $destination, $UserName)) {
	echo "Binding parameters failed: (" . $update_profile_image_query->errno . ") " . $update_profile_image_query->error;
}
if (!$update_profile_image_query->execute()) {
    echo "Execute failed: (" . $update_profile_image_query->errno . ") " . $update_profile_image_query->error;
}

#Currently not getting username because we're using sessions to see if users are logged in
header("refresh:0;url=manage.php?change_success");
?>