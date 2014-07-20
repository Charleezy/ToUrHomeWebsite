<?php
session_start();
if($_FILES['file1']['name']!=''){
	move_uploaded_file($_FILES['file1']['tmp_name'],"upload/".$_FILES['file1']['name']);
}else{
	echo "<script>alert(please upload file£¡);</script>";
}
$destination="upload/".$_FILES['file1']['name'];
$UserName=$_POST["username"];
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin");
$query=mysql_query("update profile set image='$destination' where id in (select id from users natural join profile where username = '$UserName')") or die(mysql_error());
header("refresh:0;url=manage.php");
?>