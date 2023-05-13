<?php
include("../db/dbconnection.php");

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$sql_get_id = "SELECT owner_id FROM pet_owner ORDER BY owner_id DESC LIMIT 1";
$result_get_id = mysqli_query($conn, $sql_get_id);
$row = mysqli_fetch_array($result_get_id);

$lastid = "";

if (mysqli_num_rows($result_get_id) > 0) {
    $lastid = $row['owner_id'];
}

if ($lastid == "") {
    $owner_id = "O001";
} else {
    $owner_id = substr($lastid, 3);
    $owner_id = intval($owner_id);

    if ($owner_id >= 9) {
        $owner_id = "O0" . ($owner_id + 1);
    } else if ($owner_id >= 99) {
        $owner_id = "O" . ($owner_id + 1);
    } else {
        $owner_id = "O00" . ($owner_id + 1);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_fname = $_POST['owner_fname'];
    $owner_lname = $_POST['owner_lname'];
    $owner_email = $_POST['owner_email'];
    $owner_contactno = $_POST['owner_contactno'];
    $owner_address = $_POST['owner_address'];
    $owner_nic = $_POST['owner_nic'];
    $owner_pwd = $_POST['owner_pwd'];

    $hashedPassword = md5($owner_pwd);

    $sql = "INSERT INTO pet_owner VALUES ('$owner_id','$owner_fname','$owner_lname','$owner_email','$owner_contactno','$owner_address','$owner_nic', '$hashedPassword','Registered')";
    $result = mysqli_query($conn, $sql);

    if ($result == TRUE) {
       
        
        
        // Initialize the $error1 and $error2 variables to empty strings
        $error1 = '';
        $error2 = '';
        
        // Check if the Reset button was clicked
        if (isset($_POST['Reset'])) {
          // Get the email address entered in the form
          $email = mysqli_real_escape_string($conn, $_POST['owner_email']);
        
          // If the email address is valid, generate an OTP and store it in the database
            $otp = rand(100000, 999999); // Generate a 6-digit OTP
            $query = "INSERT INTO email_otps (email, otp) VALUES ('$email', '$otp')";
            mysqli_query($conn, $query);
        
            // Send email using PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = "25";
            $mail->Username = "petlife1023@gmail.com";
            $mail->Password = "mqumfstsythnyndi";
            $mail->Subject = "Your verify code";
        
            $mail->setFrom('petlife1023@gmail.com');
            $mail->addAddress($email);
        
            $mail->isHTML(true);
            $mail->Body = "<p>Hello,</p>
                           <p>Dear user, </p> <p>Your OTP verify code is <b>$otp </b><br></p>
                          <p>Regards,</p>
                          <p>The Petlife Team</p>";
        
            if ($mail->send()) {
              // Redirect to OTP verification page passing the email as a parameter
              header('Location:  otp-verification - Copy.php?email=' . $email);
            } else {
              // Display an error message if email was not sent successfully
              echo '<script>alert("Invalid OTP please try again.");</script>' . $mail->ErrorInfo;
            }
        
        
            $mail->smtpClose();
          }
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/pet-life/Auth/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login </title>
</head>

<body>

    <section>
        <div class="imgbox">
            <img src="/pet-life/Auth/img/pngwing.png" alt="login image">
        </div>
        <div class="contentbox">
            <div class="formbox">
                <form method="POST" action="">
                        <h2 class="welcome">Sign Up Free</h2>

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
                            <input type="tel" name="owner_contactno" maxlength="10" placeholder="contact no"
                                pattern="^\+?\d{2}\s?\d{8}$" required>
                        </div>
                        <div class="form-content">
                            <label class="loging-label1">Address</label>
                            <input type="text" name="owner_address" placeholder="address" required>
                        </div>
                        <div class="form-content">
                            <label class="loging-label1">NIC</label>
                            <input type="text" name="owner_nic" placeholder="NIC" required>
                        </div>
                        <div class="form-content">
                            <label class="loging-label1">Password</label>
                            <input type="password" name="owner_pwd" placeholder="password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}"
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"
                                required>
                        </div>

                        <p>
                            <button class="btn-add" type="submit" name = "Reset" >Sign Up</button>

                        </p>

                        <span class="psw">Already have an account? <a href="./login.php">Login</a></span>

                    </form>
                <div><a href="/pet-life">Back to Home</a></div>
            
                </div> 
            </div>
        </div>
    </section>
</body>

</html>

