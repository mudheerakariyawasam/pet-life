<?php
include("dbconnection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

    // $owner_id = $_POST['owner_id'];
    $owner_fname = $_POST['owner_fname'];
    $owner_lname = $_POST['owner_lname'];
    $owner_email = $_POST['owner_email'];
    $owner_contactno = $_POST['owner_contactno'];
    $owner_address = $_POST['owner_address'];
    $owner_nic = $_POST['owner_nic'];
    $owner_pwd = $_POST['owner_pwd'];

    $hashedPassword = md5($owner_pwd); 



    $sql = "INSERT INTO pet_owner VALUES ('$owner_id','$owner_fname','$owner_lname','$owner_email','$owner_contactno','$owner_address','$owner_nic', '$hashedPassword')";
    $result = mysqli_query($conn, $sql);

   

    if ($result == TRUE) {
        header("location: login.php");
    } else {
        echo "There is an error in adding!";
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
            <div class="nav-item item1 active-home"><a href="./home.php">Home</a></div>
            <div class="nav-item item2"><a href="./aboutus.php">About us</a></div>
            <div class="nav-item item3"><a href="./vip.php">VIP Programs</a></div>
            <div class="nav-item item2"><a href="./services.php">Services</a></div>
            <div class="nav-item item4"><a href="./contactus.php">Contact Us</a></div>
            <div class="nav-item item2"><a href="./appointmentc.php">Book an Appointmnet</a></div>
        </div>
    </div>

    <div class="container">

        <div class="left">
            <form method="POST" action="">
                <p class="welcome">Sign Up Free</p>

                <!-- <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="owner_id" placeholder="Owner ID" required>
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">First Name</label>
                    <input type="text" name="owner_fname" placeholder="first name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Last Name</label>
                    <input type="text" name="owner_lname" placeholder="last name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="email" name="owner_email" placeholder="email" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Phone</label>
                    <input type="number" name="owner_contactno" placeholder="phone" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Address</label>
                    <input type="text" name="owner_address" placeholder="address" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">NIC</label>
                    <input type="text" name="owner_nic" placeholder="NIC"required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Password</label>
                    <input type="password" name="owner_pwd" placeholder="password"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"
                        required>
                </div>

                <p>
                    <button class="btn-login" type="submit">Sign Up</button>
                    <button class="btn-exit" type="submit"><a href="./home.php">Cancel</a></button>
                </p>
            </form>

            <span class="psw">Already have an account? <a href="./login.php">Login</a></span>
        </div>

        <div class="right">
            <img class="image" src="./images/register.png" alt="image">
        </div>

    </div>

</body>

</html>