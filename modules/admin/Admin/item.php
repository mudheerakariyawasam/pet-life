<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
		}

		h1 {
			font-size: 36px;
			margin-top: 0;
		}

		img {
			max-width: 100%;
			height: auto;
			margin-bottom: 20px;
		}

		.details {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
		}

		.description {
			flex-basis: 60%;
			padding-right: 40px;
			box-sizing: border-box;
		}

		.price {
			flex-basis: 40%;
			margin-top: 20px;
			padding-left: 40px;
			box-sizing: border-box;
		}

		.price h2 {
			font-size: 24px;
			margin-top: 0;
			margin-bottom: 10px;
		}

		.price p {
			font-size: 18px;
			margin: 0;
		}

		.button {
			display: inline-block;
			padding: 10px 20px;
			background-color: #4CAF50;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.3s ease;
		}

		.button:hover {
			background-color: #3e8e41;
		}

		@media only screen and (max-width: 767px) {
			.details {
				flex-wrap: wrap;
			}

			.description {
				flex-basis: 100%;
				padding-right: 0;
				margin-bottom: 20px;
			}

			.price {
				flex-basis: 100%;
				padding-left: 0;
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

	// Start the session
	session_start();

	// Check if the user is logged in
	if (!isset($_SESSION["user_id"])) {
	  // If not, redirect to the login page
	  header("Location: login.php");
	  exit;
	}

	// Retrieve the item with the specified ID from the database
	if (isset($_GET['item_id'])) {
	  $item_id = $_GET['item_id'];
	  $sql = "SELECT * FROM pet_item WHERE item_id = '$item_id'";
	  $result = $conn->query($sql);

	  if ($result->num_rows == 1) {
	    $row = $result->fetch_assoc();
	    echo "<div class=\"container\">";
	    echo "<h1>" . $row["item_name"] . "</h1>";
	    echo "<div class=\"details\">";
	    echo "<div class=\"description\">";
	    echo "<img src=\"" . $row["item_img"] . "\" alt=\"" . $row["item_name"] . "\">";
	    echo "<p>" . $row["item_desc"] . "</p>";
	    echo "</div>";
	    echo "<div class=\"price\">";
	    echo "<h2>Price: $" . $row["item_price"] . "</h2>";
	    echo "<form method=\"post\" action=\"add_to_cart.php\">";
	    echo "<input type=\"hidden\" name=\"item_id\" value=\"" . $row["item_id"] . "\">";
	    echo "<input type=\"number\" name=\"quantity\" value=\"1\" min=\"1\" max=\"10\">";
	    echo "<input type=\"submit\" class=\"button\" value=\"Add to Cart\">";
	    echo "</form>";
	    echo "</div>";
	    echo "</div>";
	    echo "</div>";
	  } else {
	    echo "Item not found.";
	  }
	} else {
	  echo "Invalid request.";
	}

	// Close the database connection
	$conn->close();
	?>
</body>
</html>