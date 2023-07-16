<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
$query = mysqli_real_escape_string($conn, $_POST['query']);
$sql = "SELECT * FROM pet_owner WHERE owner_nic LIKE '%$query%'";

// Execute MySQL query
$result = mysqli_query($conn, $sql);

// Generate HTML output
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div onclick='search(event)'>" . $row['owner_nic'] . '</div>';
  }
} else {
  echo 'No results found';
}

// Close MySQL connection
mysqli_close($conn);

?>