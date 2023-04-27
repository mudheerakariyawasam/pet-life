<html>
  <head>
</head>
<body>
  <h1>hi</h1>
<form method="get" action="">
  <input type="text" name="search" placeholder="Search by ID or Name">
  <input type="submit" name="submit" value="Search">
</form>

<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_life";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Select all employees
$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);

// Display data in a table
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Address</th><th>Contact No</th><th>Designation</th><th>Email</th><th>NIC</th><th>Initial Salary</th><th>Current Salary</th><th>Holidays Taken</th><th>Date Assigned</th><th>Delete</th><th>Update</th></tr>";
while($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $row['emp_id'] . "</td>";
  echo "<td>" . $row['emp_name'] . "</td>";
  echo "<td>" . $row['emp_address'] . "</td>";
  echo "<td>" . $row['emp_contactno'] . "</td>";
  echo "<td>" . $row['emp_designation'] . "</td>";
  echo "<td>" . $row['emp_email'] . "</td>";
  echo "<td>" . $row['emp_nic'] . "</td>";
  echo "<td>" . $row['emp_initsalary'] . "</td>";
  echo "<td>" . $row['emp_currsalary'] . "</td>";
  echo "<td>" . $row['emp_holtaken'] . "</td>";
  echo "<td>" . $row['emp_dateassigned'] . "</td>";
  echo "<td><form method='post' action=''>
            <input type='hidden' name='emp_id' value='" . $row['emp_id'] . "'>
            <input type='submit' name='delete' value='Delete'>
          </form></td>";
  echo "<td><form method='post' action='update_employee.php'>
            <input type='hidden' name='emp_id' value='" . $row['emp_id'] . "'>
            <input type='submit' name='update' value='Update'>
          </form></td>";
  echo "</tr>";
}
echo "</table>";

// Delete employee
if(isset($_POST['delete'])) {
  $emp_id = $_POST['emp_id'];
  $sql = "DELETE FROM employee WHERE emp_id=$emp_id";
  mysqli_query($conn, $sql);
}

mysqli_close($conn);
?>
</body>
</html>