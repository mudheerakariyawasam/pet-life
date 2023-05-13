<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Pet Life </title>
  <link rel="stylesheet" href="/pet-life/Auth/otp.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


<section>
        <div class="imgbox">
        <img src="img/otp.png" id="reset">
        </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">

          <form method="POST">
          <div class="title"><h2 class="welcome">Verify OTP</h2>

            <div class="input-boxes">

              <div class="input-box">
                <input type="text" placeholder="Enter the OTP" name="otp" required>
              </div>
              <div class="btn_add">
              <button class="btn-add" type="submit" name="reset">Verify</button>
              </div>

            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</body>
</html>

<?php
// Include the database connection code
include('../db/dbconnection.php');


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Retrieve the OTP entered by the user
  $otp = $_POST['otp'];
  // Query the OTPs table for the OTP entered by the user
  $sql = "SELECT * FROM email_otps WHERE otp = '$otp'";
  $result = $conn->query($sql);

  // Check if the OTP is valid
  if ($result->num_rows > 0) {
    // OTP is valid, redirect to the resetpassword.php page
    header("Location: login.php");
    exit();
  } else {
    // OTP is invalid, show an alert
    echo "<script>alert('Invalid OTP');</script>";
  }

  
}
?>
