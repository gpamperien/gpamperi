<?php
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo "<form style='GET' action='results.php'>";

echo "<select id=style_id name='style_type' onchange='this.form.submit();'>"; //auto submits form

echo "<option value=0>Select a Style</option>"; //when no value selected
	$sql = "SELECT style_type FROM style ORDER BY style_type ASC";
        $result = $conn->query($sql);
            
	while ($stylerow = mysqli_fetch_array($result)) {
		echo "<option value='".$stylerow['style_type']."'>".$stylerow['style_type']."</option>";
	}

        echo "</select>";
    echo "</form>";
    
    if(!empty($_GET['style_type'])){
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$style_type = sanitizeMySQL($conn, $_GET['style_type']);
		$query = "SELECT * FROM artist_to_style JOIN style ON style.style_id=artist_to_style.style_id
		JOIN artist ON artist.artist_id=artist_to_style.artist_id WHERE style_type LIKE '%$style_type'";
		
		
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