<?php
session_start();
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin") or die("Couldn't find the database.");
$UserName=$_SESSION["username"];
$query=mysql_query("select password from users where username = '$UserName'");
$row = mysql_fetch_assoc($query);
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
mysql_query("UPDATE users SET password='$New1' WHERE username='$UserName'");
mysql_close($connect);
echo "<a href='manage.php?id=change_success&'>password changed!</a>";
}
?>
