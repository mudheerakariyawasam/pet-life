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
    
    <style></style>

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
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"  class="active"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
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
        <br/><br/><br/>
       
<div class="appointment-title">DayCare Management</div><hr>
<br/><br/>
<center>
<?php


//Define the number of records per page
$records_per_page = 10;

// Get the current page from the URL, or set it to 1 if not provided
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the SQL query
$start_from = ($current_page - 1) * $records_per_page;

	// Retrieve all holidays from the database
	$sql = "SELECT * FROM daycare LIMIT $start_from, $records_per_page";
	$result = mysqli_query($conn, $sql);

	// Display the holidays in a table
	if (mysqli_num_rows($result) > 0) {
		echo "<table class='appointment-table'>";
		echo "<tr><th class='appointment-table-header'>DayCare ID</th><th class='appointment-table-header'>Date</th><th class='appointment-table-header'>Owner ID</th><th class='appointment-table-header'>Pet Name</th><th class='appointment-table-header'>Status</th><th class='appointment-table-header'>Action</th></tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td class='appointment-table-cell'>" . $row['daycare_id'] . "</td>";
			echo "<td class='appointment-table-cell'>" . $row['daycare_date'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['owner_id'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['pet_name'] . "</td>";
            echo "<td class='appointment-table-cell'>" . $row['daycare_status'] . "</td>";
			echo "<td class='appointment-table-cell'><a class='appointment-link' href='daycare_details.php?daycare_id=" . $row['daycare_id'] . "'><center><i class='fas fa-eye'></i></center></a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No dayacare found.";
	}

    // Count the total number of records in the employee table
    $sql_count = "SELECT COUNT(*) as total_records FROM daycare";
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

    </div>
</body>

</html>
