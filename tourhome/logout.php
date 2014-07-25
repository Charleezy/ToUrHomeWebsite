<?php

session_start();

session_destroy();

echo "
			<html>
			<head>
			
				<link rel='stylesheet' href='after_login.css' type='text/css'>
				<meta charset='UTF-8'>
				<link type='text/css' rel='stylesheet' href='bootstrap.css'/>
				<script type='text/javascript' src='jquery.js'></script>
				<script type='text/javascript' src='bootstrap.js'></script>
				<style type='text/css'>
				p {
				font-size: 15px;
				font-family: Verdana;
				left: 10px;
				position: fixed;
				}
				</style>
				<title>ToUrHome</title>
				
			</head>
			
			<body>
			<div id='header-container'>
				<!ToUrHome TITLE>
					<div id='ToUrHomeTitle'>
						<a href='http://www.tour-home.org/'>
							<img src='redlogo3.png' width='400' height='90'/>
						</a>
			</div>
        
			</div>
	
			<div id='spacing'> </div>";


echo "<p>You've been logged out. <a href='index.php'>Click</a> here to return to the homepage.</p>";