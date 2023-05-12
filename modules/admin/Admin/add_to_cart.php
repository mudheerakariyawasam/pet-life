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

// Retrieve the item ID and quantity from the form
$item_id = $_POST["item_id"];
$quantity = $_POST["quantity"];

// Add the item to the cart
if (isset($_SESSION["cart"][$item_id])) {
  $_SESSION["cart"][$item_id] += $quantity;
} else {
  $_SESSION["cart"][$item_id] = $quantity;
}

// Redirect to the shopping cart page
header("Location: shopping_cart.php");

// Close the database connection
$conn->close();
?>