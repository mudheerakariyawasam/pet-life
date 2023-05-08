<?php
$conn = mysqli_connect('localhost', 'root', '', 'pet_life');
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql = "SELECT emp_id, emp_name, emp_designation, working_status FROM employee WHERE emp_id LIKE '%$search%' OR emp_name LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	echo "<table>";
	echo "<tr><th>Employee ID</th><th>Name</th><th>Designation</th><th>Status</th></tr>";
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row['emp_id'] . "</td>";
		echo "<td>" . $row['emp_name'] . "</td>";
		echo "<td>" . $row['emp_designation'] . "</td>";
		echo "<td>";
		if ($row['working_status'] == 'enable') {
			echo "<span class='enable'>Enabled</span>";
			echo "<input type='checkbox' checked='checked' data-empid='" . $row['emp_id'] . "'>";
		} else {
			echo "<span class='disable'>Disabled</span>";
			echo "<input type='checkbox' data-empid='" . $row['emp_id'] . "'>";
		}
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "No employees found.";
}
mysqli_close($conn);
?>