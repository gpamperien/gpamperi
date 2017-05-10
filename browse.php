<?php

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';
?>
<br>
<br>
<form method="get" action="search.php">
		<legend>Search by artist name</legend>
		<input type="text" name="search_term" required>
		<input type="submit" name="submit">
</form>	

<?php
//Dropdown menus
echo'<div class="dropdown">';
	include_once 'includes/countryform.php';
echo '</div>';

echo'<div class="dropdown">';
	include_once 'includes/stateform.php';
echo '</div>';

echo'<div class="dropdown">';
	include_once 'includes/cityform.php';
echo '</div>';

echo'<div class="dropdown">';
	include_once 'includes/methodform.php';
echo '</div>';

echo'<div class="dropdown">';
	include_once 'includes/styleform.php';
echo '</div>';
echo '<br>';

	

$result = $conn->query("SELECT first_name, last_name, profile_photo FROM artists WHERE country_id = ‘country_id’");

$query = "SELECT artist_id, first_name, last_name, profile_photo FROM artist";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;
?>

<?php 
while ($row =$result->fetch_assoc()) {
	echo'<div class="grid">';

	echo '<p>';
	if (empty($row["profile_photo"])) {
		echo "<img src=\"images/ImageNotAvailable.png\" alt=\"artwork not available\" width=\"100\">";
		} else {
			echo "<img src=\"images/".$row["profile_photo"]."\" alt=\"artwork\" width=\"100\">";
			}
	echo "<br>";		
	echo "<a href=\"artistprofile.php?id=".$row["artist_id"]."\">".
	$row["first_name"]."<br>".$row["last_name"]."</a>";
	echo '</p>';
	echo "<br>";
	echo '</div>';
}

include_once 'includes/footer.php';

?>
