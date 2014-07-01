<?php
session_start();
if($_FILES['file1']['name']!=''){
	move_uploaded_file($_FILES['file1']['tmp_name'],"upload/".$_FILES['file1']['name']);
}else{
	echo "<script>alert(please upload file¡);</script>";
}
$destination="upload/".$_FILES['file1']['name'];
$UserName="";
if(isset($_SESSION['username'])){$UserName=$_SESSION['username'];}
$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysql_select_db("pakfung_phplogin");

#echo "<script type='text/javascript'>alert(' destination {". $destination . "}');</script>";
#Note: There is a nuance with updating a table when you are selecting it in a nested query in MySQL. To get around this you use "select * from profile as p" instead of just "profile"
$update_profile_image_query = sprintf("update profile set image='%s' where id in (select id from users natural join (select * from profile) as p where username = '%s')", $destination, $UserName);
#Currently not getting username because we're using sessions to see if users are logged in
#echo "<script type='text/javascript'>alert({". $update_profile_image_query . "});</script>";
$query=mysql_query("update profile set image='$destination' where id in (select id from users natural join (select * from profile) as p where username = '$UserName')") or die(mysql_error());
#header("refresh:0;url=manage.php");
?>