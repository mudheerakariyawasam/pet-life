<?php
include('../dbConnection.php');
session_start();
if(!isset($_SESSION['is_adminlogin'])){
  if(isset($_REQUEST['aEmail'])){
    $aEmail = mysqli_real_escape_string($conn,trim($_REQUEST['aEmail']));
    $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['aPassword']));
    $sql = "SELECT emp_email, emp_pwd FROM employee WHERE emp_email='".$aEmail."' AND emp_pwd ='".$aPassword."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $_SESSION['is_adminlogin'] = true;
      $_SESSION['aEmail'] = $aEmail;
      
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
<title>Welcome to Pet Life</title>
</head>
<body>

<div class="home">
<div class="main">
<div class=left></div>

<div class="right">
<div class="caption">
<center><font class="fontt" style="color:black;">Welcome To</font></center>
<center><h2 style="color:black;">PET LIFE</h2></center>
<center><img src="../images/logo_transparent black.png" width="150px"></center>
</div>
<form action="" class="form" method="POST">
          <div>
           <label for="email">Email</label><input type="email"
               placeholder="Email" name="aEmail" required>
            
       
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