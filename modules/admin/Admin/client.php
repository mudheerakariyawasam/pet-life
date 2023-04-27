<!DOCTYPE html>
<html>
<head>
	<title>View and Delete Pet Owners</title>
	
		<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		.delete-btn {
			background-color: #f44336;
			color: white;
			border: none;
			padding: 8px 16px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 4px;
		}
	
	</style>
</head>
<body>
	<h2>Pet Owners List</h2>

	<table>
		<thead>
			<tr>
				<th>Owner ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Contact No.</th>
				<th>Address</th>
				<th>NIC</th>
				<th>Password</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Connect to the database
			$conn = mysqli_connect("localhost", "root", "", "pet_life");

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Query to select all records from the pet_owner table
			$sql = "SELECT * FROM pet_owner";
			$result = mysqli_query($conn, $sql);

			// Loop through all records and display them in the table
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row['owner_id'] . "</td>";
				echo "<td>" . $row['owner_fname'] . "</td>";
				echo "<td>" . $row['owner_lname'] . "</td>";
				echo "<td>" . $row['owner_email'] . "</td>";
				echo "<td>" . $row['owner_contactno'] . "</td>";
				echo "<td>" . $row['owner_address'] . "</td>";
				echo "<td>" . $row['owner_nic'] . "</td>";
				echo "<td>" . $row['owner_pwd'] . "</td>";
				echo "<td>";
				echo "<form method='post' action=''>";
				echo "<input type='hidden' name='delete_id' value='" . $row['owner_id'] . "'>";
				echo "<button class='delete-btn' type='submit' name='delete'>Delete</button>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
			}

			// Close the database connection
			mysqli_close($conn);
			?>
		</tbody>
	</table>

	<?php
// Delete the selected record when the delete button is clicked
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "pet_life");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Set foreign key check to 0 to disable foreign key constraints
    mysqli_query($conn, "SET foreign_key_checks = 0");

    // Query to delete the selected record from the pet_owner table
    $sql = "DELETE FROM pet_owner WHERE owner_id='$delete_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Record deleted successfully.</p>";
    } else {
        echo "<p>Error deleting record: " . mysqli_error($conn) . "</p>";
    }

    // Set foreign key check back to 1 to re-enable foreign key constraints
    mysqli_query($conn, "SET foreign_key_checks = 1");

    // Close the database connection
    mysqli_close($conn);
}
?>

</body>
</html>
