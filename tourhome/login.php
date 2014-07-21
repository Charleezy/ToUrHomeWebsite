<?php

//stevenpakfunglau on samuel-huntington.dreamhost.com will be created with password 8!t*8B5r

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {

	$connect = mysql_connect("mysql.tour-home.org", "stevenpakfunglau", "libertinelux")  or die("Couldn't connect to the database");
	mysql_select_db("pakfung_phplogin") or die("Couldn't find the database.");
	
	$query = mysql_query("SELECT * FROM users WHERE username='$username'");
	$numrows = mysql_num_rows($query);
	
	if ($numrows != 0) {
	
		while ($row = mysql_fetch_assoc($query)) {
			
			$dbusername = $row['username'];
			$dbpassword = $row['password'];
			
		}
		
		if ($username == $dbusername && md5($password) == $dbpassword) {
			
			echo "
			<html>
			<head>
			
				<link rel='stylesheet' href='index.css' type='text/css'>
				<meta charset='UTF-8'>
				<link type='text/css' rel='stylesheet' href='bootstrap.css'/>
				<script type='text/javascript' src='jquery.js'></script>
				<script type='text/javascript' src='bootstrap.js'></script>
				<title>ToUrHome</title>
				
			</head>
			
			<body>
			<div id='header-container'>
				<!ToUrHome TITLE>
					<div id='ToUrHomeTitle'>
						<a href='http://www.tour-home.org/'>
							<img src='tourhomelogo.png' width='400' height='80'/>
						</a>
			</div>
        
			</div>
	
			<div id='spacing'> </div>";
			
			#echo "<a href='manage.php'>Continue to profile page</a>";
			
			echo "<div id='myCarousel' class='carousel slide'>
				<ol class='carousel-indicators'>
            <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
            <li data-target='#myCarousel' data-slide-to='1'></li>
            <li data-target='#myCarousel' data-slide-to='2'></li>
				</ol>

			<div class='carousel-inner'>
					<div class='item active'>
						<img src='carouselFour.png'/>
                <div class='container'>
                    <div class='carousel-caption'>
                        <h1 id='firstTransition'>logged in as $username ...</h1>
                        <p><a id='firstButton' class='btn btn-large btn-primary' href='manage.php'>click here to see your profile.</a></p>
                    </div>
                </div>
            </div>";
      

            echo "<div class='item'>
                <img src='carouselThree.png'/>
                <div class='container'>
                    <div class='carousel-caption'>
                        <h1 id='secondTransition'>about ToUrHome.</h1>
                        <p><a id='secondButton' class='btn btn-large btn-danger' href='aboutTourHome.html'>click here to learn more.</a></p>
                    </div>
                </div>
            </div>";


            echo "<div class='item'>
                <img src='carouselOne.png'/>
                <div class='container'>
                    <div class='carousel-caption'>
                        <h1 id='thirdTransition'>behind the scenes.</h1>
                        <p><a id='thirdButton' class='btn btn-large btn-primary' href='aboutus.html'>click here to meet the creators.</a></p>
                    </div>
                </div>
            </div>
        </div>";

        echo "<a class='left carousel-control' href='#myCarousel' data-slide='prev'>
            <span class='glyphicon glyphicon-chevron-left'></span>
        </a>

        <a class='right carousel-control' href='#myCarousel' data-slide='next'>
            <span class='glyphicon glyphicon-chevron-right'></span>
        </a>

    </div>
    
    <div id='secondSpacer'></div>
    <div id='bottom'></div>";

			
			echo "
			</body>
			</html>";
			
			$_SESSION['username']=$username;
			
			
		} else
			echo "Incorrect password!";
		
	} else
		die("That user doesn't exist!");
		
} else 
	die("Please enter a username and password!");

?>