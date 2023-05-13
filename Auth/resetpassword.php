

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Pet Life </title>
  <link rel="stylesheet" href="/pet-life/Auth/resetpassword.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


  <section>
        <div class="imgbox">
        <img src="img/reset.png" id="reset">
        </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
       

          <form method="POST">
          <div class="title"><h2 class="welcome">Reset Password</h2>
            <div class="input-boxes">

            <div class="input-box">

            <input type="password" placeholder="Enter Your New Password" name="newpassword" required>
              </div>
              <div class="input-box">
            <input type="password" placeholder="Confirm Your New Password" name="confirmpassword" required>
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
</body>

</html>

<?php
// Include the database connection code
include('../db/dbconnection.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Retrieve the new password and confirm password entered by the user
  $newpassword = $_POST['newpassword'];
  $confirmpassword = $_POST['confirmpassword'];
  $email = $_POST['email'];

  // Check if the passwords match
  if ($newpassword == $confirmpassword) {
    // Passwords match, check if email exists in users table
    $result = mysqli_query($conn, "SELECT * FROM pet_owner WHERE owner_email='$email'");
    if (mysqli_num_rows($result) > 0) {
      // Email exists in users table, update password
      $hashedPassword = md5($newpassword);
      mysqli_query($conn, "UPDATE pet_owner SET owner_pwd='$hashedPassword' WHERE owner_email='$email'");
    } else {
      // Email not found in users table, check if email exists in adminuser table
      $result = mysqli_query($conn, "SELECT * FROM employee WHERE emp_email='$email'");
      if (mysqli_num_rows($result) > 0) {
        // Email exists in adminuser table, update password
        $hashedPassword = md5($newpassword);
        mysqli_query($conn, "UPDATE employee SET emp_pwd='$hashedPassword' WHERE emp_email='$email'");
      } else {
        // Email not found in either table, show an alert
        echo "<script>alert('Email not found');</script>";
      }
    }

    // Redirect to the login page
    header("Location: login.php");
    exit();
  } else {
    // Passwords do not match, show an alert
    echo "<script>alert('Passwords do not match');</script>";
  }
}
?>
