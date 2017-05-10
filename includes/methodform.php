<?php
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo "<form method='GET' action='results.php'>";

echo "<select id=method_id name='method_type' onchange='this.form.submit();'>"; //auto submits form

echo "<option value=0>Select a Method</option>"; //when no value selected
	$sql = "SELECT method_type FROM method ORDER BY method_type ASC";
        $result = $conn->query($sql);
            
	while ($methodrow = mysqli_fetch_array($result)) {
		echo "<option value='".$methodrow['method_type']."'>".$methodrow['method_type']."</option>";
	}

        echo "</select>";
    echo "</form>";
    
    if(!empty($_GET['method_type'])){
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$method_type = sanitizeMySQL($conn, $_GET['method_type']);
		$query = "SELECT * FROM artist_to_method JOIN method ON method.method_id=artist_to_method.method_id
		JOIN artist ON artist.artist_id=artist_to_method.artist_id WHERE method_type LIKE '%$method_type'";
		
		
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
