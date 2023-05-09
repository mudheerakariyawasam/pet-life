<?php
include('../dbConnection.php');
session_start();
if(!isset($_SESSION['is_adminlogin'])){
  if(isset($_REQUEST['aEmail'])){
    $aEmail = mysqli_real_escape_string($conn,trim($_REQUEST['aEmail']));
    $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['aPassword']));
    $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email='".$aEmail."' AND a_password='".$aPassword."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $_SESSION['is_adminlogin'] = true;
      $_SESSION['aEmail'] = $aEmail;
      // Redirecting to RequesterProfile page on Correct Email and Pass
      echo "<script> location.href='dashboard.php'; </script>";
      exit;
    } else {
      $msg = '<div class="sign-alert" role="alert"> Enter Valid Email and Password </div>';
    }
  }
} else {
  echo "<script> location.href='dashboard.php'; </script>";
}
?>


<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="../css/adm_login.css">
</head>
<body>

<div class="home">
<div class="main">
<div class=left></div>

<div class="right">
<div class="caption">
<center><font class="fontt">Welcome To</font></center>
<center><h2>PET LIFE</h2></center>
<center><img src="../images/logo.png" width="150px"></center>
</div>
<form action="" class="form" method="POST">
          <div>
           <label for="email">Email</label><input type="email"
               placeholder="Email" name="aEmail" required>
            <!--Add text-white below if want text color white-->
            <small class="form-text">We'll never share your email with anyone else.</small>
          </div>
<br/>
          <div>
            <label for="pass">Password</label><input type="password"
               placeholder="Password" name="aPassword" required>
          </div>
          <button type="submit" >Login</button>
          <?php if(isset($msg)) {echo $msg; } ?>
        </form>

   <div class="back"><a href="../index.php">Back
            to Home</a></div>
</div>
</div>


</div>


</body>
</html>