<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<title>Housing Post</title>
		<link rel="stylesheet" type="text/css" href="postviewing.css" />
		
		<!--Pictures-->
		<link rel="stylesheet" type="text/css" href="icons.css" />
		<link rel="stylesheet" type="text/css" href="postviewings.css" />
	
	</head>
	<body>
		<div class="container">
			<header>
				<h1>
				
				<?php
                    //get base directory
                    $dirname = dirname(dirname(__FILE__)) . '/img/posts/{postid}/';
                    //$dirname = '/tour-home.org/img/posts/{postid}/';
                    $images = glob($dirname."*.{jpg,png,gif,bmp}", GLOB_BRACE);
                    foreach($images as $image) {
                        echo '<img src="http://www.tour-home.org/img/posts/{postid}/'. basename($image) .'" width="250" height="250" /><br />';
                    }

                ?>
				{post-title}</h1>	
				
			</header>
			
			<section class="col-2 ss-style-triangles">
				<div class="column text">
					<h2>what country and city does {username} lives in?</h2>
					<p>{country}, {city}</p>
				</div>
				<div class="column">
					<span class="icon icon-headphones"></span>
				</div>
			</section>
			
			<section class="color">
				<h2>description of what {username} has to offer.</h2>
				<p> {description}</p>
			</section>
		
			<section class="col-2 ss-style-halfcircle">
				<div class="column">
					<span class="icon icon-images"></span>
				</div>
				<div class="column text">
					<h2>{username}'s contact information.</h2>
					<p>Needs to be coded.</p>
					<br>
					<a href="../delete_post.php?postid={postid}" onclick="return checkup()">delete post</a><br>
					<a href="../edit_post.php?postid={postid}">edit</a><br>
					<a href="../manage.php">return</a><br />
				</div>
			</section>
			
			<!--<section class="color ss-style-bigtriangle">
				<h2>{username}'s contact information.</h2>
				<p>asdfghjkl</p>
				
			</section>-->

		</div><!-- /container -->
		
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