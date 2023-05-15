<?php
    include("../../../db/dbconnection.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Pet Life</title>
    
    <style>
/* Reset styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Table styles */
.table-wrapper {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

th, td {
  padding: 12px 15px;
  text-align: left;
  vertical-align: top;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #000D2F;
  color: #fff;
  font-weight: bold;
}

tr:nth-child(even) td {
  background-color: #f2f2f2;
}

tr:hover td {
  background-color: #e0e0e0;
}

.print-button {
  text-align: right;
}

.print-button button {
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 10px 20px;
  color: #fff;
  background-color: #000D2F;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.print-button button:hover {
  background-color: #001B5E;
}

.print-button i {
  font-size: 16px;
}

.no-records {
  padding: 12px 15px;
  text-align: center;
  color: #f00;
  font-weight: bold;
}

@media print {
  body * {
    visibility: hidden;
  }
  
  .container, .container * {
    visibility: visible;
    width: 100%;
    
  }
  
  /* .container {
    position: absolute; 
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

  } */
}
/* Style all elements except the table */


/* Style the print button */
#printButton {
  display: block;
  margin-top: 16px;
  padding: 12px 24px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

/* Style the page header */
header {
  background-color: #333;
  color: white;
  padding: 16px;
}

/* Style the page title */
h1 {
  margin: 0;
  font-size: 32px;
}

/* Style the form */
form {
  margin: 16px 0;
}

label {
  display: inline-block;
  margin-bottom: 8px;
  width: 20%;
}

input[type="submit"] {
  display: block;
  margin-top: 8px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

input[type="text"], select {
  display: inline-block;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 70%;
  margin-right: 16px;
}

/* Style the page footer */
footer {
  background-color: #ccc;
  padding: 16px;
  text-align: center;
}

</style>

</head>

<body>
    <div class="sidebar">
    <div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="appointment.php"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php" ><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
            </li>
            <li>
                <a href="report.php" class="active"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>
        </div>
        <div class="container">
        <br/>
<div class="employee-title">Employee List</div><hr>
<br/>
<div class="container print-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="year">Year:</label>
    <select name="year" id="year">
      <?php
      // Generate options for the last 10 years
      $current_year = date("Y");
      for ($i = $current_year; $i >= $current_year - 10; $i--) {
        echo "<option value=\"$i\">$i</option>";
      }
      ?>
    </select><br><br>

    <label for="month">Month:</label>
    <select name="month" id="month">
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select><br><br>

    <label for="status">Appointment Status:</label>
    <select name="status" id="status">
      <option value="Completed">Completed</option>
      <option value="Available">Available</option>
      <option value="Canceled">Canceled</option>
    </select><br><br>

    <input type="submit" name="submit" value="Generate Report">
  </form>

  <?php
  // Check if the form has been submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $year = $_POST["year"];
    $month = $_POST["month"];
    $status = $_POST["status"];

    // // Connect to the database
    // $host = 'localhost';
    // $username = 'your_username';
    // $password = 'your_password';
    // $dbname = 'your_database_name';
    // $conn = mysqli_connect($host, $username, $password, $dbname);

    // // Check connection
    // if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    // }

    // Build the SQL query
    $sql = "SELECT * FROM daycare WHERE YEAR(daycare_date) = $year AND MONTH(daycare_date) = $month AND daycare_status = '$status'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
      die("Query failed: " . mysqli_error($conn));
    }

    // Print the results in a table
    echo "<h2>Results for $status appointments in " . date("F Y", mktime(0, 0, 0, $month, 10, $year)) . "</h2>";
    echo "<table id=\"resultTable\">";
    echo "<tr><th>Daycare ID</th><th>Date</th><th>Pet Name</th><th>Employee ID</th><th>Pet ID</th><th>Owner ID</th><th>Status</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['daycare_id'] . "</td>";
      echo "<td>" . $row['daycare_date'] . "</td>";
      echo "<td>" . $row['pet_name'] . "</td>";
      echo "<td>" . $row['emp_id'] . "</td>";
      echo "<td>" . $row['pet_id'] . "</td>";
      echo "<td>" . $row['owner_id'] . "</td>";
      echo "<td>" . $row['daycare_status'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";

    // Close the database connection
    mysqli_close($conn);
  }
  ?>

  <button onclick="printTable()">Print Results</button>

  <script>
    function printTable() {
      // Get the table element
      var table = document.getElementById("resultTable");

      // Open a new window and write the table content
      var newWindow = window.open();
      newWindow.document.write('<html><head><title>Daycare Report Results</title></head><body>');
      newWindow.document.write(table.outerHTML);
      newWindow.document.write('</body></html>');

      // Print the window content
      newWindow.print();
    }
  </script>
</div>
    </div>
    <script src="script.js"></script>

</body>

</html>