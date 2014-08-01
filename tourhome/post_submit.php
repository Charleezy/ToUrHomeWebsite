<?php
session_start();
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin");

$UserName = $_SESSION['username'];
$country = mysqli_real_escape_string($con,$_POST['country']);
$city = mysqli_real_escape_string($con,$_POST['city']);
//$freetimes = mysqli_real_escape_string($con,$_POST['freetimes']);
$description = mysqli_real_escape_string($con,$_POST['description']);
$post_title = mysqli_real_escape_string($con,$_POST['post-title']);

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


//upload pictures, pictures go to /img/posts/postid/{imgname}
$valid_formats = array("jpg", "png", "gif", "bmp");
$max_file_size = 1024*768;
$count = 0;
$path = "img/posts/".$postid."/";

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to execute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
                if ( ! is_dir($path)) {//make directory for post imgs
                    mkdir($path);
                }
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
}


//fill out post template and create page
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