<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <title>ToUrhome</title>
		<meta name="viewport" content="width=device-width, initial-scale=2.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<script src="js/bootstrap.js"></script>
		<script src="js/bootbox.js"></script>
		
		<!-- modification of the styles -->
		
		<link href="css/bootstrap.css" rel="stylesheet">
        
        <style type="text/css">
			#a{
				width:200px;
				overflow:hidden;
				white-space:nowrap;
				text-overflow:ellipsis;
			}
		
			body {
				padding-top: 80px;
				padding-bottom: 20px;
			}
		
			.sidebar-nav {
				padding: 10px 0;
			}
		
			.mainpost {
              width: 600px;
			  padding: 6px;
              display: inline-block;
			  margin-bottom: 3px;
			  background-color: rgba(170,168,168,0.5);
			  -webkit-border-radius: 6px;
			     -moz-border-radius: 6px;
			          border-radius: 6px;
		
			}
		
			well sidebar-nav{
				background-color: navy;
			}
		
        </style>
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
    
    <body>

        <div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">ToUrHome</a>
					<!-- layout for the username and password text field -->
					<!-- tags on the top -->
					<div class="nav-collapse">
						<ul class="nav">
							<li class="active"><a href="../manage.php">Home</a></li>
							<li><a href="../aboutTourHome.html">About</a></li>
							<li><a href="#contact" onclick="aboutmsg()">Contact</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
        </div>
        <!-- display post images -->
        <div class="span9">
            <div class="mainpost">
                Pictures:<br>

                <?php
                    //get base directory
                    $dirname = dirname(dirname(__FILE__)) . '/img/posts/70/';
                    //$dirname = '/tour-home.org/img/posts/70/';
                    $images = glob($dirname."*.{jpg,png,gif,bmp}", GLOB_BRACE);
                    foreach($images as $image) {
                        echo '<img src="http://www.tour-home.org/img/posts/70/'. basename($image) .'" width="250" height="250" /><br />';
                    }

                ?>

                <h4>Title: Test Post<br></h4>
                
                <p>
                    <ul>
                    <li>Posted by: dan2<br></li>
                    <li>Country: Canada<br></li>
                    <li>City: Toronto<br></li>
                    <li>Description: Test description<br></li>
                    </ul>
                </p>

                <!-- delete -->
                <a href="delete_post.php" onclick="return checkup()">Delete Post</a><br>
                <!-- edit -->
                <a href="edit_post.php">Edit</a><br>
            </div>
        </div>
        
    <script type="text/javascript">
        function checkup2()
            {
              if(window.confirm("Are you sure you want to delete this post?"))
              {
               return true;
              }
              else
              {
                return false;
              }
            }
    </script>
    </body>
</html>

