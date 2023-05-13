<?php
include("../../db/dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:../../Auth/login.php");
    exit;
}

$loggedInUser = $_SESSION['login_user'];

$sql = "SELECT owner_id, CONCAT(owner_fname, ' ', owner_lname) as full_name, owner_email, owner_contactno, owner_address, owner_nic, owner_pwd FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";  
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $owner_id = $row["owner_id"];
        $full_name = $row["full_name"];
        $owner_email = $row["owner_email"];
        $owner_contactno = $row["owner_contactno"];
        $owner_address = $row["owner_address"];
        $owner_nic = $row["owner_nic"];
    }
} else {
    echo "Please try again!";
}
//update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_full_name = $_POST["full_name"];
    $new_email = $_POST["owner_email"];
    $new_contactno = $_POST["owner_contactno"];
    $new_address = $_POST["owner_address"];
    $new_nic = $_POST["owner_nic"];

    $update_sql = "UPDATE pet_owner SET owner_fname = SUBSTRING_INDEX('$new_full_name', ' ', 1), owner_lname = SUBSTRING_INDEX('$new_full_name', ' ', -1), owner_email='$new_email', owner_contactno='$new_contactno', owner_address='$new_address', owner_nic='$new_nic' WHERE owner_id='$owner_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result == TRUE) {
        header("location: profile.php");
    } else {
        $error = "There is an error in updating!";
    }

}

// Initialize error message variable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = mysqli_real_escape_string($conn, $_POST['oldpass']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newpass']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['cnewpass']);

    // Retrieve the employee's current password from the database
    $owner_email = $_SESSION['login_user'];
    $query = "SELECT owner_pwd FROM pet_owner WHERE owner_email='$owner_email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    $currentHashedPassword = $row[0];

    // Verify the current password
    if (md5($oldPassword) === $currentHashedPassword) {
        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Generate the hashed password
            $newHashedPassword = md5($newPassword);

            // Update the employee's password in the database
            $updateQuery = "UPDATE pet_owner SET owner_pwd='$newHashedPassword' WHERE owner_email='$owner_email'";
            mysqli_query($conn, $updateQuery);

            // Redirect to a success page or display a success message
            // echo "wade hari bokka!!";
            // Redirect to the updateprofile.php file with the error message as a query parameter
            header("Location: profile.php?password_changed=true&error=" . urlencode($errorMsg));
            exit();

        } else {
            echo "New password and confirm password do not match.";
            header("Location: profile.php");
        }
    } else {
        echo "Incorrect current password.";
        header("Location: profile.php");
    }
}

if(isset($_POST['delete'])) {
  // Code to delete the user's account
  
  // Update the user table with the deleted status
  $query = "UPDATE pet_owner SET owner_status='Deleted' WHERE owner_id='$owner_id'";
  mysqli_query($conn, $query);
  
  // Redirect to the login page
  header("Location: ../../Auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="images/petlife.png" width=200px></center>
        </div>
        <ul>

            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php" class="active"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>Pet Daycare</span></a></a>
            </li>
            <li>
                <a href="../../public/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
            </li>
            <li>
                <a href="inquiry.php"><i class="fa fa-user"></i><span>Inquiries</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="./logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                </div>
            </div>


           
        </div>


        <div class="container">

            <div class="top-container">

                <!-- <div>
                        <button class="register-btn2"><a href="./viewpet.php">View Pets</a></button>
                    </div> -->

                <div class="text">
                    Give pets the love they deserve
                </div>

                
            </div>
            <div class="content2" style="
            background-position: center;
            height: 100vh;">
                <div class="form-content2">

                    <p>
                    <form method="POST">
                       
                        <div class="column-wise">
                                <label>Owner ID :</label><br>
                                <input type="text" name="owner_id" placeholder="owner id"
                                    value="<?php echo $owner_id; ?> " readonly><br>
                            </div>

                            <div class="column-wise">
                                <label>Full Name :</label><br>
                                <input type="text" name="full_name" placeholder="Full Name"
                                    value="<?php echo $full_name; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>Email :</label><br>
                                <input type="text" name="owner_email" placeholder="email"
                                    value="<?php echo $owner_email; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>Contact No :</label><br>
                                <input type="text" name="owner_contactno" placeholder="contact no"
                                    value="<?php echo $owner_contactno; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>Address :</label><br>
                                <input type="text" name="owner_address" placeholder="address"
                                    value="<?php echo $owner_address; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>NIC :</label><br>
                                <input type="text" name="owner_nic" placeholder="nic"
                                    value="<?php echo $owner_nic; ?>"><br>
                            </div>
                            <div class="pwd-content">
                <button class="btn-add" fdprocessedid="a0hv6">Update</button>
            </div>
            <div class="pwd-content">
                <button class="btn-add"  name="delete" fdprocessedid="a0hv6">Delete</button>
            </div>
           
                    </form>

                </div>
                
                <div class="right-content">
                <form action="changepassword.php" method="POST">
                        <span class="sub-topic">Change Password</span><br><br>
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
                </form>    
                <?php
                // Check for success message
                if (isset($_GET['password_changed']) && $_GET['password_changed'] == 'true') {
                    echo '<span style="color: green;">Password changed successfully.</span>';
                }

                // Check for error message
                if (isset($_SESSION['change_password_error']) && strlen($_SESSION['change_password_error']) > 1) {
                    echo '<span style="color: red;">' . $_SESSION['change_password_error'] . '</span>';
                    unset($_SESSION['change_password_error']);
                }
                ?>
            
                </div>
        
            </div>

        </div>
    </div>
</body>

</html>