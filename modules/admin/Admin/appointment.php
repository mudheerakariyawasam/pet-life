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
    <link rel="stylesheet" href="../css/appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-J5uS+gU3qlKVuQZ1mxE5P4fNB8fM8kNzzJ7vR2S2JczbLcF0OqAovuoW+boFTYdDZd/dChGWcb7HdqbK9JF13Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pet Life</title>
    
    <style>
    /* .search-box {
        float: right;
        margin-bottom: 10px;
    }
    .search-box input[type="text"] {
        padding: 5px;
        border: none;
        border-radius: 5px;
        margin-left: 5px;
    }
    .pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {
  background-color: #ddd;
}

.pagination a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
button{
float:right;
padding: 5px 10px;


}



		.green {
			background-color: green;
		} */



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
                <a href="appointment.php" class="active"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
            </li>
            <li>
                <a href="report.php"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
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
        <br/><br/>       
<div class="appointment-title">Appointment Management</div><hr>
<br/>

<div class="search-box">
    <label for="search-input">Search:</label>
    <input type="text" id="search-input" placeholder="Search by ID or Name...">
</div>

<center>
<?php

//Define the number of records per page
$records_per_page = 10;

// Get the current page from the URL, or set it to 1 if not provided
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the SQL query
$start_from = ($current_page - 1) * $records_per_page;

	// Retrieve all holidays from the database
	$sql = "SELECT appointment_id, appointment_date, appointment_time, appointment_slot, appointment_status FROM appointment LIMIT $start_from, $records_per_page";
	$result = mysqli_query($conn, $sql);

	// Display the holidays in a table
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='appointment-table'>";
		echo "<tr><th class='appointment-table-header'>Appointment ID</th><th class='appointment-table-header'>Appointment Date</th><th class='appointment-table-header'>Appointment Time</th><th class='appointment-table-header'>Appointment Slot</th><th class='appointment-table-header'>Appointment Status</th><th class='appointment-table-header'>Action</th></tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr class='appointment-row'>";
			echo "<td class='appointment-table-cell appointment-id'>" . $row['appointment_id'] . "</td>";
			echo "<td class='appointment-table-cell '>" . $row['appointment_date'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['appointment_time'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['appointment_slot'] . "</td>";
            echo "<td class='appointment-table-cell appointment-status'>" . $row['appointment_status'] . "</td>";
			echo "<td class='appointment-table-cell'><a class='appointment-link' href='appointment_details.php?appointment_id=" . $row['appointment_id'] . "'><center><i class='fas fa-eye'></i></center></a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		$image_url = "../images/no-results.png";
        echo '<center><img src="' . $image_url . '" alt="No results" width="440" height="400"></center>';
	}

    // Count the total number of records in the employee table
    $sql_count = "SELECT COUNT(*) as total_records FROM appointment";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_records = $row_count['total_records'];

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $records_per_page);
    echo '<br/>';
    // Generate the pagination buttons
    echo '<div class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<a class='active' href='?page=$i'>$i</a>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }

echo '</div>';
?>

</center>
<script>
    // Add event listener to search input
var searchInput = document.getElementById('search-input');
searchInput.addEventListener('input', function() {
    var filterValue = this.value.toUpperCase();
    var rows = document.querySelectorAll('.appointment-row');

    for (var i = 0; i < rows.length; i++) {
        var idCell = rows[i].querySelector('.appointment-id');
        var firstNameCell = rows[i].querySelector('.appointment-status');
       // var lastNameCell = rows[i].querySelector('.employee-table-cell:nth-child(3)');
        var ownerStatusCell = rows[i].querySelector('.appointment-table-cell:nth-child(6)');
        var idValue = idCell.textContent || idCell.innerText;
        var firstNameValue = firstNameCell.textContent || firstNameCell.innerText;
      ///  var lastNameValue = lastNameCell.textContent || lastNameCell.innerText;
        var ownerStatusValue = ownerStatusCell.textContent || ownerStatusCell.innerText;

        if (idValue.toUpperCase().indexOf(filterValue) > -1 ||
            firstNameValue.toUpperCase().indexOf(filterValue) > -1 ||
          //  lastNameValue.toUpperCase().indexOf(filterValue) > -1 ||
            ownerStatusValue.toUpperCase().indexOf(filterValue) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
</script>
</script>
    </div>

</body>

</html>
