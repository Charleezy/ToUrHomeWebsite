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
//pictures
//other variables..

$data['username'] = $UserName;
$data['country'] = $country;
$data['city'] = $city;
$data['description'] = $description;
$data_seperated = implode(", ", $data);


//add to database
$sql = "INSERT INTO posts (username, Country, City, description, creation_date, modification_date)
VALUES ('$UserName', '$country', '$city', '$description', now(), now())";

echo $sql;
if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
}

$data['postid'] = mysqli_insert_id($con);
echo "postid: ".$data['postid'];

//fill out post template
$placeholders = array("{username}", "{country}", "{city}", "{description}", "{postid}"); 
$tpl = file_get_contents('post-template.php'); 
$new_member_file = str_replace($placeholders, $data, $tpl); 
$html_file_name = $data['postid'].".php"; 
//write new post to file
$fp = fopen("./posts/".$html_file_name, "x");
fwrite($fp, $new_member_file);
fclose($fp); 


mysqli_close($con);

header("refresh:0;url=manage.php");
?>