

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Pet Life </title>
  <link rel="stylesheet" href="/pet-life/Auth/forgetpassword.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


<section>
        <div class="imgbox">
        <img src="img/forgot.png" id="reset">
        </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
        
</div>

          <form method="POST">
              <div class="title"><h2 class="welcome">Forgot Password</h2>

            <div class="input-boxes">

              <div class="input-box">
              <label class="loging-label1">Email</label>
               
                <input type="text" placeholder="Enter your email" name="email" required>
              </div>
              <div class="btn_add">
              <button class="btn-add" type="submit" name="Reset">Reset Password</button>
              </div>

            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>
</body>

</html>

<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Include the database connection code
include('../db/dbconnection.php');

// Initialize the $error1 and $error2 variables to empty strings
$error1 = '';
$error2 = '';

// Check if the Reset button was clicked
if (isset($_POST['Reset'])) {
  // Get the email address entered in the form
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  // Check if the email address exists in the users or adminlogin tables
    $query = "SELECT * FROM pet_owner WHERE owner_email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
    $query = "SELECT * FROM employee WHERE emp_email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
      // Email address not found in either table
      $error2 = 'Invalid email address.';
    }
  }

  // If the email address is valid, generate an OTP and store it in the database
  if (empty($error2)) {
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
      header('Location: otp-verification.php?email=' . $email);
    } else {
      // Display an error message if email was not sent successfully
      echo '<script>alert("Invalid OTP please try again.");</script>' . $mail->ErrorInfo;
    }


    $mail->smtpClose();
  }
}
?>