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
<div id="registration">
<br /><br />
  <center><h1 style="color:green;"><div class="sec-name">Create an Account</a></h1></center>
  <div   class="reg-page">
    <div>
<div >
      <form action="" method="POST" class="form">

        <div>
<label for="name">Name</label><input type="text"
        placeholder="Name" name="aName">
        </div>
        <div>
    <label for="email">Email</label><input type="email"
      placeholder="Email" name="aEmail">

          <small>We'll never share your email with anyone else.</small>
        </div>
        <div>
<label for="pass">New
            Password</label><input type="password" placeholder="Password" name="aPassword">
        </div>
        <button type="submit" name="rSignup">Sign Up</button>
        <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms, Data
          Policy and Cookie Policy.</em>
        <?php if(isset($regmsg)) {echo $regmsg; } ?>
</div>
      </form>
</div>
    </div>
  </div>
</div>
</body>
</html>