<?php
session_start();
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin");
$UserName=$_POST["username"];
$contact=$_POST["contact"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$query=mysql_query("update profile set contact='$contact',age='$age',gender='$gender' where UserName='$UserName'");
header("refresh:0;url=manage.php");
?>