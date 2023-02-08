<html>
<head>
<link rel="stylesheet" href="../css/registration.css">
<head>

<body>
<?php
  include('../dbConnection.php');

  if(isset($_REQUEST['rSignup'])){
    
    if(($_REQUEST['aName'] == "") || ($_REQUEST['aEmail'] == "") || ($_REQUEST['aPassword'] == "")){
      $regmsg = '<div class="reg-alert" role="alert"> All Fields are Required </div>';
    } else {
      $sql = "SELECT a_email FROM admin_login WHERE a_email='".$_REQUEST['aEmail']."'";
      $result = $conn->query($sql);
      if($result->num_rows == 1){
        $regmsg = '<div class="reg-alert" role="alert"> Email ID Already Registered </div>';
      } else {
        
        $aName = $_REQUEST['aName'];
        $aEmail = $_REQUEST['aEmail'];
        $aPassword = $_REQUEST['aPassword'];
        $sql = "INSERT INTO admin_login(a_name, a_email, a_password) VALUES ('$aName','$aEmail', '$aPassword')";
        if($conn->query($sql) == TRUE){
          $regmsg = '<div class="reg-alert" role="alert"> Account Succefully Created </div>';
        } else {
          $regmsg = '<div class="reg-alert" role="alert"> Unable to Create Account </div>';
        }
      }
    }
  }
?>


<div class="registration">
<div class="side-1">
  <p>WELCOME TO<br/>
  PET LIFE...<img src="../images/logo_transparent black.png" width=300px></P>
 
</div></br>


<div class="side-2">
<br /><br />
  <center><h1><div class="sec-name">Sign Up</a></h1></center>
  <div   class="reg-page">+
    <div>
<div >
      <form action="" method="POST" class="form">

        <div>
<label for="name">User Name</label><input type="text"
        placeholder="Name" name="aName">
        </div>
        <div>
    <label for="email">Email</label><input type="email"
      placeholder="Email" name="aEmail">

          <small>We'll never share your email with anyone else.</small>
        </div>
        <div>
<label for="pass">Password</label><input type="password" placeholder="Password" name="aPassword">
        </div>
        <button type="submit" name="rSignup">Sign Up</button>
        <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms and Policy.</em>
        <div style="text-align:right"><a href="../index.php">Back to home</a></div>
        <?php if(isset($regmsg)) {echo $regmsg; } ?>
    
</div>
<div style="text-align:right"><a href="./index.php">Back to home</a></div>
      </form>
</div>
    </div>
  </div>
</div>
</div>
</body>
</html>