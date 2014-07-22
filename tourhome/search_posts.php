<?php
session_start();

#When you first navigate to the search page with no param do not show any entries and do not comment that no fields were entered
if( !isset($_POST['city']) && !isset($_POST['country'])){
goto first_navigation;
}

$city=$_POST['city'];
$country=$_POST['country'];

#Search for posts matching user criteria and returns them
#Using mysqli to ensure no sql injection
#Users can not search by post-name, perhaps they should be able to save posts for future viewing
#TODO: Border case, what if we have a user living in Markham who wants to let people sleep on their couch but most people visiting Toronto only search Toronto? Make the search area based using something(Google)(maps)(geo) instead of a city, country pair
#TODO:, set list of cities and countries to select from

$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT po.name, username, description, poster_id, contact, age, gender, creation_date, modification_date
FROM posts AS po
LEFT JOIN users AS u ON poster_id = u.id
join profile AS pr ON pr.id= u.id
WHERE city = ?
AND country = ?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("ss", $city, $country)) {
	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
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
			<label class="sr-only" for="post-name">Post Name*</label>
			<input type="text" id="post-name" name="post-name">
			<label class="sr-only" for="city">City</label>
			<input type="text" id="city" name="city" placeholder="Enter city" required>
			<label class="sr-only" for="country">Country</label>
			<input type="text" id="country" name="country" placeholder="Enter country" required>
		  <button type="submit" class="btn btn-default">Search</button>
		</form>
	</div>
	</br>
	*Leave blank if you don't know the post name<br />
	City and Country are required.
	<div class='container'>
        <table class='table table-bordered table-striped sortable'>
            <thead>
                <tr>
                    <th style="width: 10%" data-defaultsort="asc"><i class="fa fa-map-marker fa-fw"></i>Name</th>
                    <th style="width: 50%" data-defaultsign="month">Description</th>
                    <th style="width: 10%" data-firstsort="desc">Poster</th>
                    <th style="width: 15%">Creation date</th>
                    <th style="width: 15%" data-mainsort="true">Modification date</th>
                </tr>
				<?php 
				if(!isset($result)){
				goto no_result;
				}
				for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				printf ("<tr><td>%s</td><td>%s</td><td>%s<br />%s<br />%d %s</td><td>%s</td><td>%s</td></tr>", $row["name"], $row["description"], $row["username"], $row["contact"], $row["age"], $row["gender"], $row["creation_date"], $row["modification_date"]);
				}
				
				$stmt->close();
				$result->free();
				$mysqli->close();
				
				no_result:
				?>
            </thead>
            <tbody>
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