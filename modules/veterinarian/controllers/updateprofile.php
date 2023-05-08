<?php
include("../dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:login.php");
    exit;
}

$employee_id = $_SESSION['emp_id'];

$sql = "SELECT * FROM employee WHERE emp_id='$employee_id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $emp_name = $row["emp_name"];
        $emp_address = $row["emp_address"];
        $emp_contactno = $row["emp_contactno"];
        $emp_designation = $row["emp_designation"];
        $emp_email = $row["emp_email"];
        $emp_nic = $row["emp_nic"];
        $emp_initsalary = $row["emp_initsalary"];
        $emp_currsalary = $row["emp_currsalary"];
        $emp_holtaken = $row["emp_holtaken"];
        $emp_dateassigned = $row["emp_dateassigned"];
    }
} else {
    echo "Please Try Again!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_name = $_POST['emp_name'];
    $new_address = $_POST['emp_address'];
    $new_contactno = $_POST['emp_contactno'];
    $new_email = $_POST['emp_email'];

    $update_sql = "UPDATE employee SET emp_name='$new_name',emp_address='$new_address',emp_contactno='$new_contactno',emp_email='$new_email' WHERE emp_id='$employee_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result == TRUE) {
        header("location: dashboard.php");
    } else {
        $error = "There is an error in updating!";
    }

}
// change password section starts

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $oldPassword = mysqli_real_escape_string($conn, $_POST['oldpass']);
//     $newPassword = mysqli_real_escape_string($conn, $_POST['newpass']);
//     $confirmPassword = mysqli_real_escape_string($conn, $_POST['cnewpass']);

//     // Retrieve the employee's current password from the database
//     $empEmail = $_SESSION['emp_email'];
//     $query = "SELECT emp_pwd FROM employee WHERE emp_email='$empEmail'";
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);
//     $currentHashedPassword = $row['emp_pwd'];

//     // Verify the current password
//     if (md5($oldPassword) === $currentHashedPassword) {
//         // Check if the new password and confirm password match
//         if ($newPassword === $confirmPassword) {
//             // Generate the hashed password
//             $newHashedPassword = md5($newPassword);

//             // Update the employee's password in the database
//             $updateQuery = "UPDATE employee SET emp_pwd='$newHashedPassword' WHERE emp_email='$empEmail'";
//             mysqli_query($conn, $updateQuery);

//             // Redirect to a success page or display a success message
//             echo "wade hari bokka!!";
//             header("Location: updateprofile.php?password_changed=true");
//             exit();
//         } else {
//             $errorMsg = "New password and confirm password do not match.";
//         }
//     } else {
//         $errorMsg = "Incorrect current password.";
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/updateprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>My Profile</title>
</head>

<body>
    <!-- <div class="full">
    
</div> -->

    <div class="main-container">

        <!-- left side nav bar -->

        <div class="left-container">
            <div class="user-img">
                <center><img src="../images/logo_transparent black.png"></center>
            </div>
            <ul>
                <li>
                    <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="showclients.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
                </li>
                <li>
                    <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment
                            History</span></a></a>
                </li>
                <li>
                    <a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a>
                </li>
                <li>
                    <a class="active" href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My
                            Profile</span></a>
                </li>
            </ul>
            <div class="logout">
                <hr>
                <a href="/pet-life/Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
            </div>
        </div>


        <!-- right side container -->

        <div class="right-container">

            <div class="top-bar">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>&nbsp&nbsp&nbsp
                </div>
                <div class="hello">
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2">
                        <?php echo $_SESSION['user_name']; ?>
                    </font>
                </div>
            </div>

            <div class="content" style="
            background-position: center;
            height: 100vh;">

                <p class="topic"> My Profile</p>
                <hr><br>

                <div class="main-content">
             
                    <div class="left-content">
                        <div class="form-content">
                        <form action="updateprofile.php" method="POST">
                       
                            <p>
                            
                                <label><b>Employee ID : </label>
                                <label class="item-id" name="staff_id">
                                    <?php echo $employee_id; ?></b><br><br>
                                    <div class="row-wise">
                                        <div class="column-wise">
                                            <label>Employee Name :</label><br>
                                            <input type="text" name="emp_name" placeholder="Employee Name"
                                                value="<?php echo $emp_name; ?>"><br>
                                        </div>
                                        <div class="column-wise">
                                            <label>Address :</label><br>
                                            <input type="text" name="emp_address" placeholder="Address"
                                                value="<?php echo $emp_address; ?>"><br>
                                        </div>
                                    </div>
                                    <div class="row-wise">
                                        <div class="column-wise">
                                            <label>Designation :</label><br>
                                            <input type="text" name="emp_designation" placeholder="Designation"
                                                value="<?php echo $emp_designation; ?>" readonly><br>
                                        </div>
                                        <div class="column-wise">
                                            <label>Date Assigned :</label><br>
                                            <input type="date" name="date_assigned" placeholder="Date Assigned"
                                                value="<?php echo $emp_dateassigned; ?>" readonly><br>
                                        </div>
                                    </div>
                                    <div class="row-wise">
                                        <div class="column-wise">
                                            <label>Mobile :</label><br>
                                            <input type="number" name="emp_contactno" placeholder="Mobile No"
                                                value="<?php echo $emp_contactno; ?>"><br>
                                        </div>
                                        <div class="column-wise">
                                            <label>Email :</label><br>
                                            <input type="email" name="emp_email" placeholder="Email"
                                                value="<?php echo $emp_email; ?>"><br>
                                        </div>
                                    </div>
                                    <div class="row-wise">
                                        <div class="column-wise">
                                            <label>Initial Salary :</label><br>
                                            <input type="number" name="emp_inisal" placeholder="Initial Salary"
                                                value="<?php echo $emp_initsalary; ?>" readonly><br>
                                        </div>
                                        <div class="column-wise">
                                            <label>Current Salary :</label><br>
                                            <input type="number" name="emp_cursal" placeholder="Current Salary"
                                                value="<?php echo $emp_currsalary; ?>" readonly><br>
                                        </div>
                                    </div>
                                    <div class="row-wise">
                                        <div class="column-wise">
                                            <label>No of Holidays Taken :</label><br>
                                            <input type="number" name="emp_holtaken" placeholder="No of Holidays Taken"
                                                value="<?php echo $emp_holtaken; ?>" readonly><br>
                                        </div>
                                        <div class="column-wise">
                                            <label>No of Holidays Left :</label><br>
                                            <input type="number" name="emp_holleft" placeholder="Mo of Holidays Left"
                                                value="<?php echo $emp_name; ?>" readonly><br>
                                        </div>
                                    </div>

                                    <button class="btn-add" type="submit">Update Profile </button>
                                    <button class="btn-add" href="viewallitems.php">Cancel</button>

                                    </p>
                                    </form>
                        </div>
                    </div>

                    <div class="right-content">
                    <form action="changepassword.php" method="POST">
                        <span class="sub-topic">Change Password</span><br>
                        <?php if (isset($errorMsg)) {
            echo '<p class="error-msg">' . $errorMsg . '</p>';
        } ?>
                        <p>
                        <div class="pwd-content">
                            <label>Current Password :</label><br>
                            <input type="password" name="oldpass" placeholder="Enter Current Password"><br>
                        </div>
                        <div class="pwd-content">
                            <label>New Password :</label><br>
                            <input type="password" name="newpass" placeholder="Enter New Password"><br>
                        </div>
                        <div class="pwd-content">
                            <label>Confirm New Password :</label><br>
                            <input type="password" name="cnewpass" placeholder="Re Enter Password"><br>
                        </div>
                        <div class="pwd-content">
                            <button class="btn-add" type="submit">Confirm </button>
                        </div>
                       
                        </p>
                    </form>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</body>

</html>