<?php
include("../../db/dbconnection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    if (empty($_POST["owner_email"])) {
        echo '<script>alert("Email is required")</script>';

    } else if (empty($_POST["owner_pwd"])) {
        echo '<script>alert("Password is required")</script>';
    } else {
        $owner_email = mysqli_real_escape_string($conn, $_POST['owner_email']);
        $owner_pwd = mysqli_real_escape_string($conn, $_POST['owner_pwd']);

        $sql = "SELECT * FROM pet_owner WHERE owner_email = '$owner_email' AND owner_status != 'Deleted'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) > 0) {
            $hashedPassword = md5($owner_pwd);
            if ($hashedPassword == $row["owner_pwd"]) {
                $_SESSION['login_user'] = $owner_email;
                $_SESSION['user_name'] = $row["owner_fname"];
                header("location: ../pet owner/dashboard.php");
            } else {
                echo '<script>alert("Wrong User Details")</script>';
            }
           
        }
        else {
            echo '<script>alert("Wrong User Details")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        
        <div class="right">
            <form method="POST">
                <p class="welcome">Welcome To</p>
                <p class="pet_life">PET LIFE</p>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="email" name="owner_email" placeholder="email">
                </div>
                <div class="form-content">
                    <label class="loging-label2">Password</label>
                    <input type="password" name="owner_pwd" placeholder="password"><br>
                </div>
                <p>
                    <button class="btn-add" type="submit">Login</button>

                    <button class="btn-add" type="submit" onclick="document.location='home.php'">Cancel</button>
                </p>
                <div>
                    <span class="psw">Don't have an account? <a href="./register.php">Sign Up</a></span>
                    <span class="psw"><a href="./resetpss.php">Forgot Password? </a></span>
                </div>
            </form>
        </div>
    </div>

</body>

</html>