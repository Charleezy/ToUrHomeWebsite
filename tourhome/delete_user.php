<?php
//The code for deleting the user account.
session_start();
$UserName=$_SESSION["username"];

$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (!($delete_user = $mysqli->prepare("DELETE FROM users WHERE username=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if (!$delete_user->bind_param("s", $UserName)) {
	echo "Binding parameters failed: (" . $delete_user->errno . ") " . $delete_user->error;
}
if (!$delete_user->execute()) {
    echo "Execute failed: (" . $delete_user->errno . ") " . $delete_user->error;
}

if (!($delete_profile = $mysqli->prepare("DELETE FROM profile WHERE id in (select id from users natural join (SELECT * FROM profile) as p where username=?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if (!$delete_profile->bind_param("s", $UserName)) {
	echo "Binding parameters failed: (" . $delete_profile->errno . ") " . $delete_profile->error;
}
if (!$delete_profile->execute()) {
    echo "Execute failed: (" . $delete_profile->errno . ") " . $delete_profile->error;
}

$delete_user->close();
$delete_profile->close();
$mysqli->close();
header("refresh:1;url=index.php");
?>