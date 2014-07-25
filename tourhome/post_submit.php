<?php
session_start();
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin");

$UserName = $_SESSION['username'];
//$poster_id = 0;

$country = mysqli_real_escape_string($con,$_POST['country']);
$city = mysqli_real_escape_string($con,$_POST['city']);
//$freetimes = mysqli_real_escape_string($con,$_POST['freetimes']);
$description = mysqli_real_escape_string($con,$_POST['description']);

$sql = "INSERT INTO posts (username, country, city, description, creation_date, modification_date)
VALUES ('$UserName', '$country', '$city', '$description', now(), now())";

if (!mysqli_query($con,$sql)) {
    die('Error: ' . my_sqli_error($con));
}
echo "1 post record added";
mysqli_close($con);

header("refresh:0;url=viewposts.php");
?>