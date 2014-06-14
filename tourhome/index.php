<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="index.css" type="text/css">
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="bootstrap.css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
	<title>ToUrHome</title>
</head>

<!====================================================================>

<body>
	<div id="header-container">
	<!ToUrHome TITLE>
    	<div id="ToUrHomeTitle">
	        <a href="http://www.tour-home.org/">
				<img src="tourhomelogo.png" width="400" height="80" />
			</a>
		</div>
            
		<form id="UserLogin" action='login.php' method='POST'>
				username: <input type='text' name='username'>
				password: <input type='password' name='password'>
				<input type='submit' value='Login'>
		</form>
	
	<!--<p><a id="register" href='register.php'>Register?</a></p>-->
	</div>
	
	<div id="spacing"> </div>
	
<!====================================================================>
	
	<div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <div class="carousel-inner">
            <div class="item active">
                <img src="carouselTwo.png" />
                <div class="container">
                    <div class="carousel-caption">
                        <h1 id="firstTransition">welcome to ToUrHome.</h1>
                        <p><a id="firstButton" class="btn btn-large btn-primary" href='register.php'>click here to signup.</a></p>
                    </div>
                </div>
            </div>

<!====================================================================>

            <div class="item">
                <img src="carouselOne.png" />
                <div class="container">
                    <div class="carousel-caption">
                        <h1 id="secondTransition">about ToUrHome.</h1>
                        <p><a id="secondButton" class="btn btn-large btn-danger" href="aboutus.html">click here to meet the creators.</a></p>
                    </div>
                </div>
            </div>
        </div>

<!====================================================================>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>

    </div>
    
    <div id="secondSpacer"></div>
    <div id="bottom"></div>
    
	
</body>

</html>

