<?php include("../linkDB.php"); //database connection function 
// session_start(); // Start session
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Stadia </title>

  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/admin.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php include('../include/javascript.php'); ?>
  <?php include('../include/styles.php'); ?>


</head>

<body onload="initClock()">

  <div class="sidebar">

    <?php include('../include/adminsidebar.php'); ?>

  </div>

  <section class="home-section">

    <nav>

      <?php include('../include/adminnavbar.php'); ?>

    </nav>

    <div class="home-content">

      <div class="main-content">


        <div class="form">
          <h1>Add New User</h1>
          <form method="post">
            <p class="add">Email</p>
            <input type="email" name="email">
            <p class="add">Name</p>
            <input type="text" name="username">
            <!-- <div style="color: red;">
              <?php echo $error; ?>
            </div> -->
            <p class="add">Password</p>
            <input type="password" name="password">
            <br>
            <p class="add">Role</p>
            <select name="role_search" class="search" id="disable">
              <option value="" disabled selected>Search by Role</option>
              <option value="admin">Admin</option>
              <option value="Manager">Manager</option>
                <option value="Equipment Manager">Equipment Manager</option>
              <option value="external supplier">External supplier</option>
            </select>
            <br><br>
            <button type="submit" class="btn" name="form">Confirm Add</button>
          </form>
        </div>

      </div>

    </div>

    <footer>
      <div class="foot">
        <span>Created By <a href="#">Stadia.</a> | &#169; 2023 All Rights Reserved</span>
      </div>
    </footer>

  </section>

</body>

</html>

<script>
  /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
</script>

<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//------ PHP code for add user---
if (isset($_POST['form'])) {

//Taking HTML Form Data from User
$email = $_POST['email'];
$username = $_POST['username'];
$password =$_POST['password'];
$role = $_POST['role_search'];
$query = "SELECT * FROM adminuser WHERE username = '$username'";
$result = mysqli_query($linkDB, $query);
$count =mysqli_num_rows($result);

if ($count > 0) {
  echo '<span class="error"> *User Already Exist , Please try another username</span>';

} else {

  // Store the unhashed password value in a temporary variable
  $tempPassword = $password;
 // //Password hashing
  $password = substr(md5(mt_rand()), 0, 8);
  $hashedPassword = md5($password);
 
  // $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
  $query = "INSERT INTO adminuser (email,username, password, type) VALUES ('$email','$username', '$hashedPassword', '$role')";

  if (!mysqli_query($linkDB, $query)) {

    $error = "<p>Could not sign you up - please try again.</p>";
  } else {
    // // Generate random password
    // $password = substr(md5(mt_rand()), 0, 8);
    // $hashedPassword = md5($password);
    // Update user's password in the database
    $query = "UPDATE adminuser SET password = '$password' WHERE Id = " . mysqli_insert_id($linkDB);
    mysqli_query($linkDB, $query);

    //session variables to keep user logged in
    $_SESSION['User_Id'] = mysqli_insert_id($linkDB);
    $_SESSION['username'] = $username;


    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];



    // Retrieve username and password from database
    $sql = "SELECT username, password FROM adminuser WHERE email='$email' AND username='$username'";
    $result = $linkDB->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
        $password = $row["password"];
      }
    } else {
      echo "User not found in database";
      exit;
    }

    // Send email using PHPMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "25";
    $mail->Username = "stadia.system@gmail.com";
    $mail->Password = "ooxiphelmlrqyktf";
    $mail->Subject = "Welcome to Stadia!";

    $mail->setFrom('stadia.system@gmail.com');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Body = "<p>Hello $username,</p>
                   <p>Your Stadia account has been created with the following credentials: <b>password: $tempPassword</b>.
                  Please log in to the Stadia website using these credentials and change your password as soon as possible.</p>
                  <p>Regards,</p>
                  <p>The Stadia Team</p>";

    if ($mail->send()) {
      echo '<script>alert("This user is added successfully and email sent");</script>';
    } else {
      echo '<script>alert("This user is added successfully but there was an error sending the email");</script>' . $mail->ErrorInfo;
    }

    $mail->smtpClose();
  }
}
}
?>