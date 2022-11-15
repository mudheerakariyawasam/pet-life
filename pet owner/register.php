<?php
include("dbconnection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myemail = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT emp_designation FROM employee WHERE emp_email = '$myemail' and emp_pwd = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        //session_register("myemail");
        $_SESSION['login_user'] = $myemail;

        header("location: dashboard.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Document</title>
</head>

<body>

    <div class="navbar">
        <div class="normal-link">
            <div class="nav-item item1 active-home"><a href="./index.php">Home</a></div>
            <div class="nav-item item2"><a href="./aboutus.php">About us</a></div>
            <div class="nav-item item3"><a href="./VIP.php">VIP Programs</a></div>
            <div class="nav-item item2"><a href="./services.php">Services</a></div>
            <div class="nav-item item4"><a href="./contactus.php">Contact Us</a></div>
            <div class="nav-item item2"><a href="./appointmentC.php">Book an Appointmnet</a></div>
        </div>
    </div>

    <div class="container">

        <div class="left">
            <form method="POST" action="">
                <p class="welcome">Sign Up Free</p>

                <div class="form-content">
                    <label class="loging-label1">First Name</label>
                    <input type="text" name="owner_fname" placeholder="first name">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Last Name</label>
                    <input type="password" name="owner_lname" placeholder="last name">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="text" name="email" placeholder="email">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Phone</label>
                    <input type="text" name="owner_contactno" placeholder="phone">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Address</label>
                    <input type="text" name="owner_address" placeholder="address">
                </div>
                <div class="form-content">
                    <label class="loging-label1">NIC</label>
                    <input type="text" name="owner_nic" placeholder="NIC">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Password</label>
                    <input type="text" name="owner_pwd" placeholder="password">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Confirm Password</label>
                    <input type="text" name="owner_pwd" placeholder="password">
                </div>
                <p>
                    <button class="btn-login" type="submit">Sign Up</button>
                    <button class="btn-exit" type="submit">Cancel</button>
                </p>
            </form>

            <span class="psw">Already have an account? <a href="#">Login</a></span>
        </div>

        <div class="right">
            <img class="image" src="./images/register.png" alt="image">
        </div>

    </div>

</body>

</html>