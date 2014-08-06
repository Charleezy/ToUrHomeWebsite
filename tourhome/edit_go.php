<?php
session_start();
$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
$username=$_SESSION["username"];
$contact=$_POST["contact"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$about=$_POST["about_me"];
$accomodates=$_POST["accomodates"];

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (!($update_user = $mysqli->prepare("update profile p 
JOIN users u ON u.id=p.id 
set contact=?,age=?,gender=?, about=?, max_guests=?
where u.username=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if (!$update_user->bind_param("ssssss", $contact, $age, $gender, $about, $accomodates, $username)) {
	echo "Binding parameters failed: (" . $update_user->errno . ") " . $update_user->error;
}
if (!$update_user->execute()) {
    echo "Execute failed: (" . $update_user->errno . ") " . $update_user->error;
}

header("refresh:0;url=manage.php?id=change_success");
?>