<?php
session_start();
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin");

$UserName = $_SESSION['username'];
  $sql = "SELECT * FROM posts WHERE username='$UserName'";

//fetch posts from current sessions username
$query = mysqli_query($con,$sql);
 ?>

<table class="striped">
    <tr class="header">
        <td>Id</td>
        <td>Name</td>
        <td>Title</td>
    </tr>

    <?php
    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['City']."</td>";
        echo "</tr>";
    }

    mysqli_close($con);
    ?>
</table>