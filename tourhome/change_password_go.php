<?php
session_start();
$UserName=$_SESSION["username"];
$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (!($find_stmt = $mysqli->prepare("select password from users where username = ?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if (!$find_stmt->bind_param("s", $UserName)) {
	echo "Binding parameters failed: (" . $find_stmt->errno . ") " . $find_stmt->error;
}
if (!$find_stmt->execute()) {
    echo "Execute failed: (" . $find_stmt->errno . ") " . $find_stmt->error;
}
$row = $find_stmt->get_result()->fetch_assoc();
$Password=$row['password'];
$Old1=$_POST["old"];
$New1=$_POST["new"];
$ConfirmPassword1=$_POST["confirm"];
$error=false;
if (md5($Old1) != $Password) {
	$error = true;
}
if ($New1 != $ConfirmPassword1) {
	$error = true;
}
if ($error == false) {
$_SESSION["password"]=$New1;
$New1 = md5($New1);
if (!($update_stmt = $mysqli->prepare("UPDATE users SET password=? WHERE username=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if (!$update_stmt->bind_param("ss", $New1, $UserName)) {
	echo "Binding parameters failed: (" . $find_stmt->errno . ") " . $update_stmt->error;
}
if (!$update_stmt->execute()) {
    echo "Execute failed: (" . $update_stmt->errno . ") " . $update_stmt->error;
}
$find_stmt->close();
$update_stmt->close();
$mysqli->close();
}
header("refresh:1;url=manage.php?id=change_success");
?>
