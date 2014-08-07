<?php
//The code for deleting a post.
if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin") or die("Couldn't find the database.");

//get postid
$postid=$_GET['postid'];

//remove database entry for post
if (!mysqli_query($con, "DELETE FROM posts WHERE id='$postid'")) {
    die('Error: ' . mysqli_error($con));
}

$result = mysqli_query($con, "SELECT url FROM posts WHERE id='$postid'");
//remove page from server
while ($row = mysqli_fetch_array($result)){
    $path = $row['url'];
    
    if (is_file('posts/'.$path)) {
        unlink($path); //delete
    }
    
}
//todo: delete images as well

mysqli_close($con);

//return to profile
header("refresh:1;url=manage.php");
?>