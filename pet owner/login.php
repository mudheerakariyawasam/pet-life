<?php
include("dbconnection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

   

    if(empty($_POST["owner_email"]) ){  
         echo '<script>alert("Email is required")</script>';  
      
    } else if(empty($_POST["owner_pwd"])){
          echo '<script>alert("Password is required")</script>';
    } else {
        $owner_email = mysqli_real_escape_string($conn, $_POST['owner_email']);
        $owner_pwd = mysqli_real_escape_string($conn, $_POST['owner_pwd']);

        //   $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
        $sql = "SELECT * FROM pet_owner WHERE owner_email = '$owner_email'";
        $result = mysqli_query($conn, $sql);
        //   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //  print_r($row);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if (password_verify($owner_pwd, $row["owner_pwd"])) {
                    $_SESSION['login_user'] = $owner_email;
                    header("location: ../pet owner/dashboard.php");
                } else {
                    //return false;  
                    echo '<script>alert("Wrong User Details")</script>';
                }
            }
        }

      /*  $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            //session_register("owner_email");
            $_SESSION['login_user'] = $owner_email;

            header("location: dashboard.php");
        } else {
            echo "Your Login email or Password is invalid";
        }
*/
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
                    <button class="btn-login" type="submit">Login</button>

                    <button class="btn-exit" type="submit" onclick="document.location='home.php'">Cancel</button>
                </p>

                <span class="psw">Don't have an account? <a href="./register.php">Sign In</a></span>
                <span class="psw"><a href="./resetpss.php">Forgot Password? </a></span>

            </form>
        </div>
    </div>

</body>

</html>