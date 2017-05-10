<?php
require_once 'includes/login.php';
require_once 'includes/functions.php';


if (isset($_GET['submit'])) {
	if (empty($_GET['search_term'])) {
		echo "<p>Please enter a search term.</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$search_term = sanitizeMySQL($conn, $_GET['search_term']);
		$query = "SELECT * FROM artist WHERE last_name OR first_name LIKE '%$search_term%'";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
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
	}
}
echo "<br>";
echo "<a href=\"browse.php"."\">"."Back to browse"."</a>";
?>
