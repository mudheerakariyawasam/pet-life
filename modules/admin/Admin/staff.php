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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-J5uS+gU3qlKVuQZ1mxE5P4fNB8fM8kNzzJ7vR2S2JczbLcF0OqAovuoW+boFTYdDZd/dChGWcb7HdqbK9JF13Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <title>Pet Life</title>
    
    <style>
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
                <a href="#" class="active"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
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
        <br/>
<div class="employee-title">Employee Management</div><hr>
<br/>

<div class="search-box">
  <label for="search-input">Search:</label>
  <input type="text" id="search-input" placeholder="Search by ID or Name...">
  <i class="fas fa-search"></i>
</div>

<?php
// Define the number of records per page
$records_per_page = 7;

// Get the current page from the URL, or set it to 1 if not provided
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the SQL query
$start_from = ($current_page - 1) * $records_per_page;

// Update the SQL query to include the LIMIT clause
$sql = "SELECT emp_id, emp_name, emp_designation, working_status FROM employee LIMIT $start_from, $records_per_page";

    // Retrieve all employees from the database
    
    $result = mysqli_query($conn, $sql);

    // Display the employees in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='employee-table'>";
        echo "<tr><th class='employee-table-header'>Employee ID</th><th class='employee-table-header'>Employee Name</th><th class='employee-table-header'>Employee Designation</th><th class='employee-table-header'>Working Status</th><th class='employee-table-header'><center>Action</center></th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='employee-row'>";
            echo "<td class='employee-table-cell emp-id'>" . $row['emp_id'] . "</td>";
            echo "<td class='employee-table-cell emp-name'>" . $row['emp_name'] . "</td>";
            echo "<td class='employee-table-cell'>" . $row['emp_designation'] . "</td>";
            echo "<td class='employee-table-cell'>";
            if ($row['working_status'] == 'enable') {
                echo "<label class='switch'><input type='checkbox' checked='checked' data-empid='" . $row['emp_id'] . "'><span class='slider round'></span></label>";
            } else {
                echo "<label class='switch'><input type='checkbox' data-empid='" . $row['emp_id'] . "'><span class='slider round'></span></label>";
            }
            echo "</td>";
            echo "<td class='employee-table-cell'><center><a class='employee-link' href='employee_details.php?emp_id=" . $row['emp_id'] . "'><i class='fas fa-eye'></i></a> | <a class='employee-link' href='update_employee.php?emp_id=" . $row['emp_id'] . "'><i class='fas fa-edit'></i></a></center></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found.";
    }

    // Count the total number of records in the employee table
$sql_count = "SELECT COUNT(*) as total_records FROM employee";
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
<a href="add_employee.php"><button class="btn-add">Add</button></a>
<script>
    // Add event listener to all switch buttons
    var switchButtons = document.querySelectorAll('.switch input[type="checkbox"]');
    for (var i = 0; i < switchButtons.length; i++) {
        switchButtons[i].addEventListener('change', function() {
            var isChecked = this.checked ? '1' : '0';
if (isChecked === '0') {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are going to disable this employee.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            disableEmployee(empId, isChecked);
        } else {
            this.checked = true;
        }
    });
} else {
    disableEmployee(empId, isChecked);
}
            var empId = this.getAttribute('data-empid');

            // Send an AJAX request to update the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_employee_status.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                    } else {
                        console.error(xhr.statusText);
                    }
                }
            };
            xhr.send('emp_id=' + empId + '&working_status=' + isChecked + '&page=' + <?php echo $current_page; ?>);

        });
    }
    function disableEmployee(empId, isChecked) {
    // Send an AJAX request to update the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_employee_status.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            } else {
                console.error(xhr.statusText);
            }
        }
    };
    xhr.send('emp_id=' + empId + '&working_status=' + isChecked + '&page=' + <?php echo $current_page; ?>);
}
    // Add event listener to search input
    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function() {
        var filterValue = this.value.toUpperCase();
        var rows = document.querySelectorAll('.employee-row');

        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].querySelector('.emp-id');
            var nameCell = rows[i].querySelector('.emp-name');
            var idValue = idCell.textContent || idCell.innerText;
            var nameValue = nameCell.textContent || nameCell.innerText;

            if (idValue.toUpperCase().indexOf(filterValue) > -1 || nameValue.toUpperCase().indexOf(filterValue) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
</script>










    </div>
    <script src="script.js"></script>
</body>

</html>