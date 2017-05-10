<?php
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo "<form method='GET' action='results.php'>";

echo "<select id=city_id name='city_name' onchange='this.form.submit();'>"; //auto submits form

echo "<option value=0>Select a City</option>"; //when no value selected
	$sql = "SELECT * FROM city NATURAL JOIN state ORDER BY city_name ASC";
        $result = $conn->query($sql);
            
	while ($cityrow = mysqli_fetch_array($result)) {
		echo "<option value='".$cityrow['city_name']."'>".$cityrow['city_name']." ".$cityrow['state_name']."</option>";
	}

        echo "</select>";
    echo "</form>";
    
    if(!empty($_GET['city_name'])){
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$city_name = sanitizeMySQL($conn, $_GET['city_name']);
		$query = "SELECT * FROM city NATURAL JOIN artist WHERE city_name LIKE '%$city_name'";
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
