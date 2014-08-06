<?php

#When you first navigate to the search page with no param do not show any entries and do not comment that no fields were entered
if( !isset($_POST['city']) && !isset($_POST['country'])){
goto first_navigation;
}

$city=$_POST['city'];
$country=$_POST['country'];
$postname=$_POST['post-name'];

#Search for posts matching user criteria and returns them
#Using mysqli to ensure no sql injection
#Users can not search by post-name, perhaps they should be able to save posts for future viewing
#TODO: Border case, what if we have a user living in Markham who wants to let people sleep on their couch but most people visiting Toronto only search Toronto? Make the search area based using something(Google)(maps)(geo) instead of a city, country pair
#TODO:, set list of cities and countries to select from

$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if ($city == "" and $country == "") {
	if ($postname =="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts "))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}if ($postname !="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE name='$postname'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}
}

if ($city != "" and $country == "") {
	if ($postname =="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE City = '$city'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}if ($postname !="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE name='$postname'
	AND City = '$city'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}
}

if ($city == "" and $country != "") {
	if ($postname =="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE Country = '$country'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}if ($postname !="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE name='$postname'
	AND Country = '$country'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}
}

if ($city != "" and $country != "") {
if ($postname =="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE City = '$city'
	AND Country = '$country'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}if ($postname !="") {
	if (!($stmt = $mysqli->prepare("SELECT name, username, description, poster_id, creation_date, modification_date, url
	FROM posts 
	WHERE name='$postname'
	AND City = '$city'
	AND Country = '$country'"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;}
}
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = $stmt->get_result();
#If no results return then give an appropriate message
if(mysqli_num_rows($result)==0){
	printf("<div class=\"no_results\"><b>Your search returned no results.</b></div>");
}
first_navigation:

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-sortable.css">
</head>
<body>
	<div class="search_form">
		<form class="form-inline" role="form" action="manage.php?id=search_posts" method="post" id="searchForm">
			<label class="sr-only" for="post-name">Post Name</label>
			<input type="text" id="post-name" name="post-name">
			<label class="sr-only" for="city">City</label>
			<input type="text" id="city" name="city">
			<label class="sr-only" for="country">Country</label>
			<input type="text" id="country" name="country">
		  <button type="submit" class="btn btn-default">Search</button>
		</form>
		</br>
		Leave all fields blank will display all posts<br />
	</div>
	<div class='123'>
        <table class='table table-bordered table-striped sortable'>
            <thead>
                <tr>
                    <th style="width:10%" data-defaultsort="asc"><i class="fa fa-map-marker fa-fw"></i>Name</th>
                    <th width="35%" data-defaultsign="month">Description</th>
                    <th width="10%" data-firstsort="desc">Poster</th>
                    <th width="15%">Creation date</th>
                    <th width="15%" data-mainsort="true">Modification date</th>
					<th width="15%">Link</th>
                </tr>
				
            </thead>
            <tbody>
			<?php 
				if(!isset($result)){
				goto no_result;
				}
				for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href=\"./posts/".$row['url']."\">View Post</a></td></tr>", $row["name"], $row["description"], $row["username"], $row["creation_date"], $row["modification_date"]);
				}
				
				$stmt->close();
				$result->free();
				$mysqli->close();
				
				no_result:
				?>
            </tbody>
        </table>
    </div>

    <script src="js/jquery-1.7.1.min.js"></script>
    <script src='Scripts/moment.min.js'></script>
    <script src='Scripts/bootstrap-sortable.js'></script>
	<script src="js/jquery.validate.js"></script>
	<script>
	$().ready(function() {
		$("#searchForm").validate();
	}
	</script>
</body>
</html>