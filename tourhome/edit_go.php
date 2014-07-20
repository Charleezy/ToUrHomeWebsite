<?php
session_start();
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin");
$UserName=$_SESSION["username"];
$contact=$_POST["contact"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$query=mysql_query("select id from users natural join profile where username='$UserName'") or die(mysql_error());
$result=mysql_fetch_array($query);
$id=$result['id'];
$query=mysql_query("update profile set contact='$contact',age='$age',gender='$gender' where id='$id'");
header("refresh:0;url=manage.php");
?>