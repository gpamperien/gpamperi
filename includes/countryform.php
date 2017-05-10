<?php
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo "<form method='GET' action='results.php'>";

echo "<select id=country_id name='country_name' onchange='this.form.submit();'>"; //auto submits form

echo "<option value=0>Select a Country</option>"; //when no value selected
	$sql = "SELECT country_name FROM country ORDER BY country_name ASC";
        $result = $conn->query($sql);
            
	while ($countryrow = mysqli_fetch_array($result)) {
		echo "<option value='".$countryrow['country_name']."'>".$countryrow['country_name']."</option>";
	}

        echo "</select>";
    echo "</form>";
    
    if(!empty($_GET['country_name'])){
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$country_name = sanitizeMySQL($conn, $_GET['country_name']);
		$query = "SELECT * FROM country NATURAL JOIN artist WHERE country_name LIKE '%$country_name'";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		$rows = $result->num_rows;
		echo "<table>";
		while ($row =$result->fetch_assoc()) {
			echo '<tr>';
			echo "<td>";
			if (empty($row["profile_photo"])) {
				echo "<img src=\"images/ImageNotAvailable.png\" width=\"100\">";
				} else {
					echo "<img src=\"images/".$row["profile_photo"]."\" width=\"100\">";
					}
			echo "</td>";
			echo "<td>";
			echo "<a href=\"artistprofile.php?id=".$row["artist_id"]."\">".
			$row["first_name"]." ".$row["last_name"]."</a>";
			echo '</td></tr>';
		}
	echo "</table>";	
	
		
	}
?>
