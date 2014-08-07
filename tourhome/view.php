<?php
if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin");

$UserName = $_SESSION['username'];
  $sql = "SELECT * FROM posts WHERE username='$UserName'";

//fetch posts from current sessions username
$query = mysqli_query($con,$sql);
 ?>

<!DOCTYPE html>   
<html lang="en">   
    <head>   
    <meta charset="utf-8">   
    <title>Your Posts</title>   
    <link href="css/bootstrap.css" rel="stylesheet">   
    </head> 
    
    <body>  
        <div id="postlist">
            <table class=" table table-striped">
                <tr class="header">
                    <td>Id</td>
                    <td>Name</td>
                    <td>City</td>
                    <td>Country</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Link</td>
                </tr>

                <?php
                $pageName=@$_GET['id'];
                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['City']."</td>";
                    echo "<td>".$row['Country']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['description']."</td>";
                    echo "<td><a href=\"./posts/".$row['url']."\">View Post</a></td>";
                    echo "</tr>";
                }

                mysqli_close($con);
                ?>
            </table>
        </div>
        
    </body>
    </html>