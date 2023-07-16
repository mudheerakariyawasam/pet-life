<html>
<head>
<style>
.item-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.item-row {
  display: flex;
  justify-content: space-between;
  flex-basis: 100%;
  margin-bottom: 20px;
}

.item {
  flex-basis: calc(25% - 20px);
  margin-bottom: 20px;
  text-align: center;
}

.item img {
  max-width: 100%;
  height: auto;
}

.item h3 {
  margin-top: 0;
  margin-bottom: 10px;
}

@media (max-width: 767px) {
  .item-row {
    flex-wrap: wrap;
  }

  .item {
    flex-basis: calc(50% - 20px);
  }
}
</style>
</head>
<body>

<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_life";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve the list of items from the database
$sql = "SELECT * FROM pet_item";
$result = $conn->query($sql);

// Display the items in a table with four items per row
if ($result->num_rows > 0) {
  echo "<div class=\"item-container\">";
  $i = 0;
  while ($row = $result->fetch_assoc()) {
    if ($i % 4 == 0) {
      if ($i > 0) {
        echo "</div>";
      }
      echo "<div class=\"item-row\">";
    }
    echo "<div class=\"item\">";
    echo "<a href=\"item.php?item_id=" . $row["item_id"] . "\">";
    echo "<img src=\"" . $row["item_img"] . "\" alt=\"" . $row["item_name"] . "\">";
    echo "<h3>" . $row["item_name"] . "</h3>";
    echo "<p>" . $row["item_desc"] . "</p>";
    echo "<p>Price: $" . $row["item_price"] . "</p>";
    echo "</a>";
    echo "</div>";
    $i++;
  }
  echo "</div>";
} else {
  echo "No items found.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>