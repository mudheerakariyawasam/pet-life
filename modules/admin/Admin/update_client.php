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
                <a href="client.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
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
<div class="employee-title">Client Management</div><hr>
<br/>

<?php
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve the form data
        $owner_id = $_POST['owner_id'];
        $owner_fname = $_POST['owner_fname'];
        $owner_lname = $_POST['owner_lname'];
        $owner_email = $_POST['owner_email'];
        $owner_contactno = $_POST['owner_contactno'];
        $owner_address = $_POST['owner_address'];
        $owner_nic = $_POST['owner_nic'];
        $active_status = isset($_POST['active_status']) ? 'activated' : 'deactivated';
    

        if (!empty($_POST['owner_fname'])) {
            $owner_fname = $_POST['owner_fname'];
        } else {
            $owner_fname_error = "Your can't keep first name as empty.";
        }

// Validate the employee email format
if (!filter_var($owner_email, FILTER_VALIDATE_EMAIL)) {
    $owner_email_error = "Invalid email format";
}




        // Validate the employee contact number format
        if (!preg_match('/^(\+\d{2})?\d{9}$/', $owner_contactno)) {
            $owner_contactno_error = "Please enter a valid contact number.";
        }
    
        
    
        // Validate the employee NIC format
        if (!preg_match('/^[0-9]{9}[v]$/', $owner_nic) && !preg_match('/^[0-9]{12}$/', $owner_nic)) {
            $owner_nic_error = "This is invalid NIC number format. Double check befor re-enter.";
        }


        
    
        // Update the employee record in the database if there are no validation errors
        if (!isset($owner_fname_error) && !isset($owner_contactno_error) && !isset($owner_nic_error) && !isset($owner_email_error) && !isset($owner_pwd_error)) {
            $sql = "UPDATE pet_owner SET owner_id='$owner_id', owner_fname='$owner_fname', owner_lname='$owner_lname', owner_email='$owner_email', owner_contactno='$owner_contactno', owner_address='$owner_address',owner_nic='$owner_nic', active_status='$active_status' WHERE owner_id='$owner_id'";
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
    if (isset($_GET['owner_id'])) {
        $owner_id = $_GET['owner_id'];
        $sql = "SELECT owner_id, owner_fname, owner_lname, owner_email, owner_contactno, owner_address, owner_nic, owner_status FROM pet_owner WHERE owner_id = '$owner_id'";
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
    <input type="hidden" name="owner_id" value="<?php echo $row['owner_id']; ?>">
    <label>Owner First Name:</label>
<input type="text" name="owner_fname" value="<?php echo isset($owner_fname) ? $owner_fname : $row['owner_fname']; ?>">
<?php if (isset($owner_fname_error)): ?>
    <span style="color: red;"><?php echo $owner_fname_error; ?></span>
<?php endif; ?><br/><br/>

<label>Owner Last Name:</label>
<input type="text" name="owner_lname" value="<?php echo isset($owner_lname) ? $owner_lname : $row['owner_lname']; ?>"><br/<br/>

<label>Owner Email:</label>
<input type="email" name="owner_email" value="<?php echo isset($owner_email) ? $owner_email : $row['owner_email']; ?>">
<?php if (isset($owner_email_error)): ?>
    <span style="color: red;"><?php echo $owner_email_error; ?></span>
<?php endif; ?><br/><br/>


<label>Owner Contact No:</label>
<input type="text" name="owner_contactno" placeholder="+94729290080" value="<?php echo isset($owner_contactno) ? $owner_contactno : $row['owner_contactno']; ?>">
<?php if (isset($owner_contactno_error)): ?>
    <span style="color: red;"><?php echo $owner_contactno_error; ?></span>
<?php endif; ?>

<label>Owner Address:</label>
<input type="text" name="owner_address" value="<?php echo isset($owner_address) ? $owner_address : $row['owner_address']; ?>"><br><br>



<label>Owner NIC:</label>
<input type="text" name="owner_nic" value="<?php echo isset($owner_nic) ? $owner_nic : $row['owner_nic']; ?>">
<?php if (isset($owner_nic_error)): ?>
    <span style="color: red;"><?php echo $owner_nic_error; ?></span>
<?php endif; ?><br/><br/>


<label>Active Status:</label>
<input type="checkbox" name="owner_status" value="activated"<?php if ($row['owner_status'] == 'Registered') echo ' checked'; ?> style="transform: scale(1.5);"><br><br>
    
    
    <input type="submit" name="submit" value="Update Client">
</form>


<br/><br/><br/>
<script>


    </script>






    </div>
    <script src="script.js"></script>
</body>

</html>