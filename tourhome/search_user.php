<?php
session_start();

#When you first navigate to the search page with no param do not show any entries and do not comment that no fields were entered
#TODO: Users who search for a username and don't provide country/city should still find a user
#Clickable links to people's profiles
if( !isset($_POST['username']) && !isset($_POST['city']) && !isset($_POST['country'])){
goto first_navigation;
}

if(!isset($_POST['username'])){
$_POST['username']="%";
}

$username=$_POST['username'];
$city=$_POST['city'];
$country=$_POST['country'];

$mysqli = new mysqli("mysql.tour-home.org", "stevenpakfunglau", "libertinelux", "pakfung_phplogin");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT DISTINCT username, image, about, max_guests, age, gender
FROM users AS u LEFT JOIN posts AS po ON poster_id = u.id
join profile AS pr ON pr.id= u.id
WHERE username like ?
AND city = ?
AND country = ?"))) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("sss", $username, $city, $country)) {
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
		<form name="searchForm" class="form-inline" role="form" action="manage.php?id=search_user" method="post" id="searchForm" onsubmit="return validateForm()">
			<label class="sr-only" for="user_name">User Name</label>
			<input type="text" id="user_name" name="user_name">
			<label class="sr-only" for="city">City</label>
			<input type="text" id="city" name="city" placeholder="Enter city">
			<label class="sr-only" for="country">Country</label>
			<input type="text" id="country" name="country" placeholder="Enter country">
			<button type="submit" class="btn btn-default">Search</button>
		</form>
	</div>
	</br>
	*Leave blank if you don't know the username<br />
	City and Country are required.
	<div class='container'>
        <table class='table table-bordered table-striped sortable'>
            <thead>
                <tr>
					<th style="width: 20%" data-defaultsort="asc"></th>
                    <th style="width: 30%" data-defaultsort="asc"><i class="fa fa-map-marker fa-fw"></i>User</th>
                    <th style="width: 50%" data-defaultsign="month">About</th>
                </tr>
				<?php 
				if(!isset($result)){
				goto no_result;
				}
				for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				printf ("<tr><td><div class=\"profileImg\"><img src=\"%s\"></img></div></td><td>%s<br />%d %s</td><td>%s <br />Can accommodate at most %d</td></tr>", $row["image"], $row["username"], $row["age"], $row["gender"], $row["about"], $row["max_guests"]);
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
	<script>
	//Check that either a username or city/country are given
	function validateForm() {
    var username = document.forms["searchForm"]["user_name"].value;
	var city = document.forms["searchForm"]["city"].value;
	var country = document.forms["searchForm"]["country"].value;
    if ( (username == null || username == "") && (city == null || city == "" || country == null || country == "") ) {
        alert("Either provide a username or a location");
        return false;
    }
}
	</script>
</body>
<?php
//Put this around the image
//<div style="max-width:500px;">
//Put in image css
/*
img {
    max-width: 100%;
    height: auto;}
*/
//printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row["name"], $row["description"], $row["username"], $row["creation_date"], $row["modification_date"]);
?>