		<!-- prototype for user management page -->
		<!DOCTYPE html>
		<html lang="en">
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
		
			.hero-unit {
			  padding: 6px;
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
		
			
		
			<body background="img/2.jpg">
				<!-- top meanu part on the login page -->
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
									<li class="active"><a href="manage.php">Home</a></li>
									<li><a href="aboutTourHome.html">About</a></li>
									<li><a href="#contact" onclick="aboutmsg()">Contact</a></li>
								</ul>
							</div><!--/.nav-collapse -->
						</div>
					</div>
				</div>
		
		
		
		<!-- 		side bar implementation on the left side -->
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span3">
							<div class="well sidebar-nav">
								<ul class="nav nav-list">
									<li class="nav-header">Account Setting</li>
									<?php
									$pageName=@$_GET['id'];
									?>
									
									<li <?php if($pageName==""){echo "class='active'";}?>>
										<a href="manage.php" >Profile</a>
									</li>
		
									<li <?php if($pageName=="change_password"){echo "class='active'";}?>>
										<a href="manage.php?id=change_password&">Change password</a>
										</li>
		
									<li>
										<a href="delete_user.php" onclick="return checkup2()">Delete account</a>
									</li>
									
									<li><a href="logout.php">Log off</a></li><br>
		
									<li class="nav-header">Posts</li>
									<li <?php if($pageName=="create"){echo "class='active'";}?>>
										<a href="manage.php?id=create&">Create a post</a>
									</li>
		
									<li <?php if(($pageName=="view")or($pageName=="search")){echo "class='active'";}?>>
										<a href="manage.php?id=view&">Display all posts</a>
									</li>
		
									<li class="nav-header">Search</li>
									
									<li <?php if($pageName=="searchposts"){echo "class='active'";}?>>
									<a href="manage.php?id=searchposts&">Search posts</a>
									</li>
		
									<li <?php if($pageName=="recentsearch"){echo "class='active'";}?>>
									<a href="manage.php?id=recentsearch&">My recent searches</a>
									</li>
		
									<li <?php if($pageName=="search_user"){echo "class='active'";}?>>
									<a href="manage.php?id=search_user&">Find a user</a>
									</li>
		
									
		
									
								</ul>
								
		
		
							</div><!--/.well -->
		
						</div><!--/span-->
		
						<!-- image part -->
		
						<div class="span9">
		
							<div class="hero-unit">
							<?php
							if ($pageName=="searchposts"){
								include 'searchposts.php';
							}
							if ($pageName=="recentsearch"){
								include 'recentsearch.php';
							}
							if ($pageName=="search_user"){
								include 'search_user.php';
							}
							if ($pageName==""){
								include 'profile.php';
							}
							
							if ($pageName=="change_password"){
								include 'change_password.php';
							}
							if ($pageName=="change_success"){
								echo "<p>change success</p>";
							}
							if ($pageName=="delete_account"){
								?>
								<script>alert('deletion success')</script>;
								<?php
								header("refresh:1;url=login.php&");
							}
							if ($pageName=="create"){
								include 'create.php';
							}
							if ($pageName=="view"){
								include 'view.php';
							}
							?>							
		
							</div>
		
						</div><!--/row-->
		
					</div><!--/span-->
		
				</div><!--/row-->
		
		
		
		
		
		
		
		
		
		<script type="text/javascript">
		
		function aboutmsg()
		
		{
		
		
		
		
		
			alert("Hello world!");
		
		
		
		
		
		bootbox.alert("Please contact us if your website is CRUSHED!");
		
		}
		
		
		function checkup2()
		{
		  if(window.confirm("Are you sure you want to delete your account?"))
		  {
		   return true;
		  }
		  else
		  {
		    return false;
		  }
		}
		
		function confirmbox()
		
		{
		
			var r=confirm("Press a button");
		
			if (r==true)
		
			  {
		
			 	;
		
			  }
		
			else
		
			  {
		
				alert("Please ");
		
			  }
		
			}
		
		
		
		// function changeImage() {
		
		// 	
		
		// 	        newImage = "url(3.jpg)";
		
		// 	        document.getElementById('Good').style.backgroundImage = newImage;
		
		// 	      }
		
		
		
		</script>
		</body>
		</html>