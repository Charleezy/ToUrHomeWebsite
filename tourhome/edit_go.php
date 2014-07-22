<?php
session_start();
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin");
$username=$_SESSION["username"];
$contact=$_POST["contact"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$about=$_POST["about_me"];
$accomodates=$_POST["accomodates"];

$query=mysql_query("update profile p 
JOIN users u ON u.id=p.id 
set contact='$contact',age='$age',gender='$gender', about='$about', max_guests='$accomodates'
where u.username='$username'");
header("refresh:0;url=manage.php");
?>