<?php
include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query = "SELECT * FROM artist LEFT JOIN city ON artist.city_id=city.city_id INNER JOIN state 
		ON state.state_id=city.state_id NATURAL JOIN country WHERE artist_id=".$id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid artist id.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No artist found with id of $id<br>";
	} else {
		if ($row = $result ->fetch_assoc()) {
			echo '<h1>'.$row["first_name"]." ".$row["last_name"].'</h1>';
			echo '<p>'.$row["birth_date"]."–".$row["death_date"]."<br>"."Born " .$row["city_name"].", "
				.$row["state_name"]." ".$row["country_name"].'</p>';
			echo '<br>';	
			if (empty($row["profile_photo"])) {
				echo "<img src=\"images/ImageNotAvailable.png\" alt=\"artwork not available\" width=\"100\">";
				} else {
					echo "<img src=\"images/".$row["profile_photo"]."\" alt=\"artwork\" width=\"100\">";
					}
			echo '<br>';
			echo '<br>';
			if (empty($row["bio"])) {
				echo "";
				} else {
					echo '<h2>'."Biography".'</h2>';
					echo '<p>'.$row["bio"].'</p>';					}
					echo '<br>';
		} 
	}
} else {
	echo "No id entered.";
}

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query2 = "SELECT * FROM artist_to_method NATURAL JOIN method WHERE artist_id=".$id;
	$result = $conn->query($query2);
	if (!$result) die ("Invalid artist id.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "<br>";
	} else {
		echo'<div class="profile_method_style">';
		echo '<h2>'."Artistic Method".'</h2>';
		while ($row = $result ->fetch_assoc()) {
			echo '<p>'.$row["method_type"].'</p>';
			
		}
		echo '</div>'; 
	}
} else {
	echo "No id entered.";
}


if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query2 = "SELECT * FROM artist_to_style NATURAL JOIN style WHERE artist_id=".$id;
	$result = $conn->query($query2);
	if (!$result) die ("Invalid artist id.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "<br>";
	} else {
		echo'<div class="profile_method_style">';
		echo '<h2>'."Artistic Style".'</h2>';
		while ($row = $result ->fetch_assoc()) {
			echo '<p>'.$row["style_type"].'</p>';
			
		}
		echo '</div>'; 
	}
} else {
	echo "No id entered.";
}

echo "<br>";
echo "<a href=\"browse.php"."\">"."Back to browse"."</a>";

include_once 'includes/footer.php';
?>