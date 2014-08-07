<?php
if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}
$UserName="";
if(isset($_SESSION["username"])){$UserName=$_SESSION["username"];}
$con = mysqli_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
mysqli_select_db($con, "pakfung_phplogin");

	//get the profile of the current user from database.
	//$query=mysql_query("select image,contact,age,gender  from users natural join profile where UserName='$UserName'") or die(mysql_error());
	//$result=mysql_fetch_row($query);
	//$destination=$result[0];
	//$imgpreviewsize=1/2;
	//$image_size = getimagesize($destination);
	echo "Pictures:<br>";
	//echo "<img src=\"".$destination."\" width=".(200)." height=".(150)." border='0'><br><br>";
	?>


	<form name='form1' method='post' action="post_submit.php" enctype="multipart/form-data">
        Add pictures of your place here.<br>
        <input type="file" id="file" name="files[]" multiple accept="image/*"></input></td>
        <!--  <input name='compare' type='submit' id='compare' value='upload'></input><br>
	</form>-->

	    <div class='input-prepend'>
        <!--<form name='form1' method='post' action='post_submit.php'>-->
            
        <span class='add-on'>
        Title:
        </span><input class='span2' name='post-title' type='text' size='15' id='post-title' value=""></input><br><br>
            
        <span class='add-on'>
        Country:
        </span><input class='span2' name='country' type='text' size='15' id='country' value=""></input><br><br>
        
        <span class='add-on'>
        City:
        </span><input class='span2' name='city' type='text' size='15' id='city' value=""></input><br><br>
        
        <span class='add-on'>
        Available Times:
        </span><input class='span2' name='freetime' type='text' size='15' id='freetimes' value=""></input><br><br>
            
        <span class='add-on'>
        Description:
        </span><textarea name='description' size='15' id='description' rows="8" cols="50" value="" placeholder="Describe what you have to offer here..."></textarea><br><br>
            
        <button id='signin' type='submit' class='btn btn-primary'>Post</button>

        </form>
	</div>
	