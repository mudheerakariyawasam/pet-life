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

		form {
			display: flex;
			flex-direction: column;
			align-items: flex-start;
		}

		label {
			display: block;
			font-size: 18px;
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="password"] {
			padding: 10px;
			font-size: 18px;
			border-radius: 5px;
			border: 1px solid #ccc;
			margin-bottom: 20px;
			width: 100%;
			box-sizing: border-box;
		}

		input[type="submit"] {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
			 transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		.error {
			color: red;
			margin-bottom: 20px;
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

	// Check if the user is already logged in
	if (isset($_SESSION["user_id"])) {
	  // If so, redirect to the home page
	  header("Location: index.php");
	  exit;
	}

	// Handle form submission
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  // Retrieve the username and password from the form
	  $username = $_POST["username"];
	  $password = $_POST["password"];

	  // Query the database for the user with the specified username and password
	  $sql = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
	  $result = $conn->query($sql);

	  if ($result->num_rows == 1) {
	    // If the user exists, log them in and redirect to the home page
	    $row = $result->fetch_assoc();
	    $_SESSION["user_id"] = $row["id"];
	    header("Location: index.php");
	    exit;
	  } else {
	    // If the user does not exist or the password is incorrect, display an error message
	    $error = "Invalid username or password.";
	  }
	}
	?>

	<div class="container">
		<h1>Login</h1>
		<?php if (isset($error)) { echo "<div class=\"error\">" . $error . "</div>"; } ?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Login">
		</form>
	</div>

	<?php
	// Close the database connection
	$conn->close();
	?>
</body>
</html>