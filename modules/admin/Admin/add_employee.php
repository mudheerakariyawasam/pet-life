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
    <link rel="stylesheet" href="../css/add_staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
    
<style>
    form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f7f7f7;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="date"],
input[type="password"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

span {
  display: block;
  margin-top: 5px;
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
                <a href="#" class="active"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
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
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>


            <div class="navbar__right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa-solid fa-message"></i>
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
        <div class="container">
        <br/>
<div class="employee-title">Employee List</div><hr>
<br/>

<?php
// Include the database connection file

// Initialize variables for the form fields
$emp_id = '';
$emp_name = '';
$emp_address = '';
$emp_contactno = '';
$emp_designation = '';
$emp_email = '';
$emp_nic = '';
$emp_pwd='';
$emp_initsalary = '';
$emp_currsalary = '';

// Initialize error variables for the form fields
$emp_id_error = '';
$emp_name_error = '';
$emp_address_error = '';
$emp_contactno_error = '';
$emp_designation_error = '';
$emp_email_error = '';
$emp_nic_error = '';
$emp_pwd_error='';
$emp_initsalary_error = '';
$emp_currsalary_error = '';


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form field values
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $emp_address = $_POST['emp_address'];
    $emp_contactno = $_POST['emp_contactno'];
    $emp_designation = $_POST['emp_designation'];
    $emp_email = $_POST['emp_email'];
    $emp_nic = $_POST['emp_nic'];
    $emp_pwd = $_POST['emp_pwd']; 
    $hashedPassword = md5($emp_pwd); 
    $emp_initsalary = $_POST['emp_initsalary'];
    $emp_currsalary = $_POST['emp_currsalary'];


    // Validate the form field values
    if (empty($emp_id)) {
        $emp_id_error = "Your can't keep Emp ID as empty.";
    }

    if (empty($emp_name)) {
        $emp_name_error = "Your can't keep name as empty.";
    }

   /* if (empty($emp_address)) {
        $emp_address_error = "Please enter the employee's address.";
    }*/

    if (!preg_match('/^(\+\d{2})?\d{9}$/', $emp_contactno)) {
        $emp_contactno_error = "Please enter a valid contact number.";
    }

    if (empty($emp_designation)) {
        $emp_designation_error = "Please enter the employee's designation.";
    }

    if (!filter_var($emp_email, FILTER_VALIDATE_EMAIL)) {
        $emp_email_error = "Please enter a valid email address.";
    }

    if (!preg_match('/^[0-9]{9}[v]$/', $emp_nic) && !preg_match('/^[0-9]{12}$/', $emp_nic)) {
        $emp_nic_error = "Please enter a valid NIC number.";
    }

    if (empty($emp_pwd)) {
        $emp_pwd_error = "You can't keep password field as empty.";
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

    
   /* if (empty($emp_dateassigned)) {
        $emp_dateassigned_error = "Please enter the date the employee was assigned.";
    }*/

    /*if (empty($working_status)) {
        $working_status_error = "Please enter the working status of the employee.";
    }*/

    // Check if there are any errors
    if (empty($emp_id_error) && empty($emp_name_error) && empty($emp_contactno_error) && empty($emp_nic_error) && empty($emp_email_error) && empty($emp_pwd_error) && empty($emp_currsalary_error) && empty($emp_initsalary_error) ) {
        // Insert the employee record into the database
        $sql = "INSERT INTO employee (emp_id, emp_name, emp_address, emp_contactno, emp_designation, emp_email, emp_nic, emp_pwd, emp_initsalary, emp_currsalary, working_status) 
        VALUES ('$emp_id', '$emp_name', '$emp_address', '$emp_contactno', '$emp_designation', '$emp_email', '$emp_nic', '$hashedPassword', '$emp_initsalary', '$emp_currsalary', 'enable')";
$result = mysqli_query($conn, $sql);

        

        // Check if the insert was successful
        if ($result) {
            // Set a message to display
            $message = "Employee record added successfully.";
            header("Location: staff.php");
            
            // Clear the form fields
            $emp_id = '';
            $emp_name = '';
            $emp_address = '';
            $emp_contactno = '';
            $emp_designation = '';
            $emp_email = '';
            $emp_nic = '';
            $emp_pwd = '';
            $emp_initsalary = '';
            $emp_currsalary = '';
            $emp_holtaken = '';
            $emp_dateassigned = '';
            $working_status = '';
        } else {
            // Set an error message to display
            $message = "Error adding employee record: " . mysqli_error($conn);
        }
    }
}
?>

<!-- Display the form -->
<form method="post" action="">

<label>Employee Id:</label>
    <input type="text" name="emp_id" value="<?php echo $emp_id; ?>">
    <?php if (isset($emp_id_error)): ?>
        <span style="color: red;"><?php echo $emp_id_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Name:</label>
    <input type="text" name="emp_name" value="<?php echo $emp_name; ?>">
    <?php if (isset($emp_name_error)): ?>
        <span style="color: red;"><?php echo $emp_name_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Address:</label>
    <input type="text" name="emp_address" value="<?php echo $emp_address; ?>">
    <?php if (isset($emp_address_error)): ?>
        <span style="color: red;"><?php echo $emp_address_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Contact No(+94):</label>
    <input type="text" name="emp_contactno" value="<?php echo $emp_contactno; ?>">
    <?php if (isset($emp_contactno_error)): ?>
        <span style="color: red;"><?php echo $emp_contactno_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Designation:</label>
    <input type="text" name="emp_designation" value="<?php echo $emp_designation; ?>">
    <?php if (isset($emp_designation_error)): ?>
        <span style="color: red;"><?php echo $emp_designation_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Email:</label>
    <input type="email" name="emp_email" value="<?php echo $emp_email; ?>">
    <?php if (isset($emp_email_error)): ?>
        <span style="color: red;"><?php echo $emp_email_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee NIC:</label>
    <input type="text" name="emp_nic" value="<?php echo $emp_nic; ?>">
    <?php if (isset($emp_nic_error)): ?>
        <span style="color: red;"><?php echo $emp_nic_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Password:</label>
    <input type="password" name="emp_pwd" value="<?php echo $emp_pwd; ?>">
    <?php if (isset($emp_pwd_error)): ?>
        <span style="color: red;"><?php echo $emp_pwd_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Initial Salary:</label>
    <input type="number" name="emp_initsalary" value="<?php echo $emp_initsalary; ?>">
    <?php if (isset($emp_initsalary_error)): ?>
        <span style="color: red;"><?php echo $emp_initsalary_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Employee Current Salary:</label>
    <input type="number" name="emp_currsalary" value="<?php echo $emp_currsalary; ?>">
    <?php if (isset($emp_currsalary_error)): ?>
        <span style="color: red;"><?php echo $emp_currsalary_error; ?></span>
    <?php endif; ?><br/><br/>

    <input type="submit" name="submit" value="Add Employee">
</form>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
    </div>
    <script src="script.js"></script>
</body>

</html>