<?php
function connect_mysql(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pet_life";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Call the connect_mysql() function to establish the database connection
$conn = connect_mysql();

// Check if the holiday ID is set in the URL
if (!isset($_GET['holiday_id'])) {
    die("Error: Holiday ID not specified.");
}

// Retrieve the holiday details from the database based on the holiday ID in the URL
$sql = "SELECT * FROM holiday WHERE holiday_id = '" . $_GET['holiday_id'] . "'";
$result = mysqli_query($conn, $sql);

// Check if the query failed
if (!$result) {
    die("Error retrieving holiday details: " . mysqli_error($conn));
}

// Check if the holiday with the specified ID exists
if (mysqli_num_rows($result) == 0) {
    die("Error: Holiday with ID " . $_GET['holiday_id'] . " not found.");
}

// Fetch the holiday details from the query result
$holiday = mysqli_fetch_assoc($result);

// If the user clicks the "Approve" button
if (isset($_POST['approve'])) {
    // Update the approval_stage to "Approved"
    $sql = "UPDATE holiday SET approval_stage = 'Approved' WHERE holiday_id = '" . $_GET['holiday_id'] . "'";
    if (mysqli_query($conn, $sql)) {
        // Refresh the page to see the updated holiday details
        header("Refresh:0");
    } else {
        die("Error updating holiday details: " . mysqli_error($conn));
    }
}

// If the user clicks the "Reject" button
if (isset($_POST['reject'])) {
    // Update the approval_stage to "Rejected"
    $sql = "UPDATE holiday SET approval_stage = 'Rejected' WHERE holiday_id = '" . $_GET['holiday_id'] . "'";
    if (mysqli_query($conn, $sql)) {
        // Refresh the page to see the updated holiday details
        header("Refresh:0");
    } else {
        die("Error updating holiday details: " . mysqli_error($conn));
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Holiday Details</title>
</head>
<body>
	<h1>Holiday Details</h1>
	<p><strong>Holiday ID:</strong> <?php echo $holiday['holiday_id']; ?></p>
	<p><strong>From Date:</strong> <?php echo $holiday['from_date']; ?></p>
	<p><strong>To Date:</strong> <?php echo $holiday['to_date']; ?></p>
	<p><strong>Approval Stage:</strong> <?php echo $holiday['approval_stage']; ?></p>
	<p><strong>Employee ID:</strong> <?php echo $holiday['emp_id']; ?></p>
	<p><strong>Holiday Type:</strong> <?php echo $holiday['holiday_type']; ?></p>
	<p><strong>Holiday Reason:</strong> <?php echo $holiday['holiday_reason']; ?></p>

	<form method="post">
		<input type="submit" name="approve" value="Approve">
		<input type="submit" name="reject" value="Reject">
	</form>
</body>
</html>
