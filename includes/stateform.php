<?php
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo "<form method='GET' action='results.php'>";

echo "<select id=state_id name='state_name' onchange='this.form.submit();'>"; //auto submits form

echo "<option value=0>Select a State</option>"; //when no value selected
	$sql = "SELECT state_name FROM state ORDER BY state_name ASC";
        $result = $conn->query($sql);
            
	while ($staterow = mysqli_fetch_array($result)) {
		echo "<option value='".$staterow['state_name']."'>".$staterow['state_name']."</option>";
	}

        echo "</select>";
    echo "</form>";
    
    if(!empty($_GET['state_name'])){
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$state_name = sanitizeMySQL($conn, $_GET['state_name']);
		$query = "SELECT * FROM state NATURAL JOIN artist WHERE state_name LIKE '%$state_name'";
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
