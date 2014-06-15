<?php
//The code for deleting the user account.
session_start();
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin") or die("Couldn't find the database.");
$UserName=$_SESSION["username"];
mysql_query("DELETE FROM users WHERE username='$UserName'");
mysql_query("DELETE FROM profile WHERE id in (select id from users natural join profile where username='$UserName')");
mysql_close($connect);
header("refresh:1;url=index.php");
?>