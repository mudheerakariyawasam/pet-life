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
    <link rel="stylesheet" href="../css/update_employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
                <a href="staff.php" class="active"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
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
<div class="employee-title">Employee Manage</div><hr>
<br/>

<?php
    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "pet_life");

    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve the form data
        $emp_id = $_POST['emp_id'];
        $emp_name = $_POST['emp_name'];
        $emp_address = $_POST['emp_address'];
        $emp_contactno = $_POST['emp_contactno'];
        $emp_designation = $_POST['emp_designation'];
        $emp_email = $_POST['emp_email'];
        $emp_nic = $_POST['emp_nic'];
        $emp_initsalary = $_POST['emp_initsalary'];
        $emp_currsalary = $_POST['emp_currsalary'];
        $emp_holtaken = $_POST['emp_holtaken'];
        $emp_dateassigned = $_POST['emp_dateassigned'];
        $working_status = isset($_POST['working_status']) ? 'enable' : 'disable';
    

        if (!empty($_POST['emp_name'])) {
            $emp_name = $_POST['emp_name'];
        } else {
            $emp_name_error = "Your can't keep name as empty.";
        }

        // Validate the employee contact number format
        if (!preg_match('/^(\+\d{2})?\d{9}$/', $emp_contactno)) {
            $emp_contactno_error = "Please enter a valid contact number.";
        }
    
        // Validate the employee email format
        if (!filter_var($emp_email, FILTER_VALIDATE_EMAIL)) {
            $emp_email_error = "Invalid email format";
        }
    
        // Validate the employee NIC format
        if (!preg_match('/^[0-9]{9}[v]$/', $emp_nic) && !preg_match('/^[0-9]{12}$/', $emp_nic)) {
            $emp_nic_error = "This is invalid NIC number format. Double check befor re-enter.";
        }


        if (preg_match('/^\d+(\.\d{1,2})?$/', $emp_initsalary) && $emp_initsalary >= 25000 && $emp_initsalary <= 350000 && $emp_initsalary >= 0) {
            $emp_initsalary = $_POST['emp_initsalary'];
        } else{   
            $emp_initsalary_error = "Note: Minimum salary should be 25000 and Maximum salary should be 350000.";
        }
        
        if (preg_match('/^\d+(\.\d{1,2})?$/', $emp_currsalary) && $emp_currsalary >= 26000 && $emp_currsalary <= 550000 && $emp_currsalary >= 0) {
            $emp_currsalary = $_POST['emp_currsalary'];
        } else{   
            $emp_currsalary_error = "Note: Minimum salary should be 26000 and Maximum salary should be 550000.";
        }

        if (preg_match('/^\d+$/', $emp_holtaken) && $emp_holtaken >= 0 && $emp_holtaken <= 999) {
            $emp_holtaken = $_POST['emp_holtaken'];
        } else {
            $emp_holtaken_error = "Invalid number of holidays";
        } 
    
        // Update the employee record in the database if there are no validation errors
        if (!isset($emp_contactno_error) && !isset($emp_email_error) && !isset($emp_nic_error) && !isset($emp_initsalary_error) && !isset($emp_currsalary_error) && !isset($emp_holtaken_error) && !isset($emp_name_error)) {
            $sql = "UPDATE employee SET emp_name='$emp_name', emp_address='$emp_address', emp_contactno='$emp_contactno',  emp_designation='$emp_designation', emp_email='$emp_email', emp_nic='$emp_nic', emp_initsalary='$emp_initsalary', emp_currsalary='$emp_currsalary', emp_holtaken='$emp_holtaken', emp_dateassigned='$emp_dateassigned', working_status='$working_status' WHERE emp_id='$emp_id'";
            $result = mysqli_query($conn, $sql);
    
            // Check if the update was successful
            if ($result) {
                // Set a message to display
                $message = "Employee record updated successfully.";
            } else {
                // Set an error message to display
                $message = "Error updating employee record: " . mysqli_error($conn);
            }
        }
    }
    
    // Retrieve the employee record from the database
    if (isset($_GET['emp_id'])) {
        $emp_id = $_GET['emp_id'];
        $sql = "SELECT emp_id, emp_name, emp_address, emp_contactno, emp_designation, emp_email, emp_nic, emp_initsalary, emp_currsalary, emp_holtaken, emp_dateassigned, working_status FROM employee WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        // Redirect to the employee list page if no employee ID is provided
        header("Location: employee_list.php");
        exit();
    }
    ?>
    
    <!-- Display the message, if any -->
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

<!-- Display the form -->
<form method="post" action="">
    <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
    <label>Employee Name:</label>
<input type="text" name="emp_name" value="<?php echo isset($emp_name) ? $emp_name : $row['emp_name']; ?>">
<?php if (isset($emp_name_error)): ?>
    <span style="color: red;"><?php echo $emp_name_error; ?></span>
<?php endif; ?><br/><br/>

<label>Employee Address:</label>
<input type="text" name="emp_address" value="<?php echo isset($emp_address) ? $emp_address : $row['emp_address']; ?>"><br/<br/>

<label>Employee Contact No:</label>
<input type="text" name="emp_contactno" placeholder="+94729290080" value="<?php echo isset($emp_contactno) ? $emp_contactno : $row['emp_contactno']; ?>">
<?php if (isset($emp_contactno_error)): ?>
    <span style="color: red;"><?php echo $emp_contactno_error; ?></span>
<?php endif; ?>

<label>Employee Designation:</label>
<input type="text" name="emp_designation" value="<?php echo isset($emp_designation) ? $emp_designation : $row['emp_designation']; ?>"><br><br>

<label>Employee Email:</label>
<input type="email" name="emp_email" value="<?php echo isset($emp_email) ? $emp_email : $row['emp_email']; ?>">
<?php if (isset($emp_email_error)): ?>
    <span style="color: red;"><?php echo $emp_email_error; ?></span>
<?php endif; ?><br/><br/>

<label>Employee NIC:</label>
<input type="text" name="emp_nic" value="<?php echo isset($emp_nic) ? $emp_nic : $row['emp_nic']; ?>">
<?php if (isset($emp_nic_error)): ?>
    <span style="color: red;"><?php echo $emp_nic_error; ?></span>
<?php endif; ?><br/><br/>

<label>Employee Initial Salary:</label>
<input type="text" name="emp_initsalary" value="<?php echo isset($emp_initsalary) ? $emp_initsalary : $row['emp_initsalary']; ?>">
<?php if (isset($emp_initsalary_error)): ?>
    <span style="color: red;"><?php echo $emp_initsalary_error; ?></span>
<?php endif; ?><br/><br/>

<label>Employee Current Salary:</label>
<input type="text" name="emp_currsalary" value="<?php echo isset($emp_currsalary) ? $emp_currsalary : $row['emp_currsalary']; ?>">
<?php if (isset($emp_currsalary_error)): ?>
    <span style="color: red;"><?php echo $emp_currsalary_error; ?></span>
<?php endif; ?><br/><br/>

<label>Employee Holiday Taken:</label>
<input type="number" name="emp_holtaken" value="<?php echo isset($emp_holtaken) ? $emp_holtaken : $row['emp_holtaken']; ?>">
<?php if (isset($emp_holtaken_error)): ?>
    <span style="color: red;"><?php echo $emp_holtaken_error; ?></span>
<?php endif; ?><br/><br/>
<div class="input-wrapper">
<label>Date Assigned:</label>
<input type="date" name="emp_dateassigned" value="<?php echo isset($emp_dateassigned) ? $emp_dateassigned : $row['emp_dateassigned']; ?>" min="<?php echo $max_date; ?>" max="<?php echo $min_date; ?>"></div><br/><br/>

<label>Working Status:</label>
<input type="checkbox" name="working_status" value="enable"<?php if ($row['working_status'] == 'enable') echo ' checked'; ?> style="transform: scale(1.5);"><br><br>
    
    
    <input type="submit" name="submit" value="Update Employee">
</form>


<br/><br/><br/>
<script>


    </script>






    </div>
    <script src="script.js"></script>
</body>

</html>