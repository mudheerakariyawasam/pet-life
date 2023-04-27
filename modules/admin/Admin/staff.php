<html>
  <head>
  <style>
  table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #ddd;
  }

  th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }

  input[type=text] {
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type=submit]:hover {
    background-color: #45a049;
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

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Search filter
if(isset($_POST['search'])) {
  $search = $_POST['search'];
  $sql = "SELECT * FROM employee WHERE emp_id LIKE '%{$search}%' OR emp_name LIKE '%{$search}%'";
} else {
  // Select all employees
  $sql = "SELECT * FROM employee";
}

$result = mysqli_query($conn, $sql);

// Display search form
echo "<form method='post' action=''>";
echo "<input type='text' name='search' placeholder='Search by ID or Name'>";
echo "<input type='submit' value='Search'>";
echo "</form>";

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

if (isset($_POST['delete']) && isset($_POST['emp_id']) && !empty($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];

    // Delete related employee records first
    $query = "DELETE FROM employee WHERE emp_id = $emp_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Employee record deleted successfully.";
    } else {
        echo "Error deleting employee record: " . mysqli_error($conn);
    }
} else {
    echo "No employee ID specified";
}

mysqli_close($conn);
?>
</body>
</html>