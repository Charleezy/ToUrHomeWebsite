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
$post_title = mysqli_real_escape_string($con,$_POST['post-title']);
//pictures
//other variables..

$data['post-title'] = $post_title;
$data['username'] = $UserName;
$data['country'] = $country;
$data['city'] = $city;
$data['description'] = $description;

//$data_seperated = implode(", ", $data);


//add to database
$sql = "INSERT INTO posts (username, name, Country, City, description, creation_date, modification_date)
VALUES ('$UserName', '$post_title', '$country', '$city', '$description', now(), now())";

if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
}

$postid = mysqli_insert_id($con);
$data['postid'] = $postid;
$html_file_name = $data['postid']."-".$data['post-title'].".php"; 

$sql = "UPDATE posts
SET url='$html_file_name'
WHERE id='$postid'";

if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
}

//fill out post template
$placeholders = array("{post-title}", "{username}", "{country}", "{city}", "{description}", "{postid}", "{url}"); 
$tpl = file_get_contents('post-template.php'); 
$new_member_file = str_replace($placeholders, $data, $tpl); 
//write new post to file
$fp = fopen("./posts/".$html_file_name, "x");
fwrite($fp, $new_member_file);
fclose($fp); 


mysqli_close($con);

header("refresh:0;url=manage.php");
?>