<?php
session_start();
if($_FILES['file1']['name']!=''){
	move_uploaded_file($_FILES['file1']['tmp_name'],"upload/".$_FILES['file1']['name']);
}else{
	echo "<script>alert(please upload file��);</script>";
}
$destination="upload/".$_FILES['file1']['name'];
//echo $destination;
$UserName=$_SESSION["username"];
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin");
$query=mysql_query("select id from users natural join profile where username='$UserName'") or die(mysql_error());
$result=mysql_fetch_array($query);
$id=$result['id'];
//echo $id;
$query=mysql_query("update profile set image='$destination' where id='$id'") or die(mysql_error());
header("refresh:0;url=manage.php");
?>