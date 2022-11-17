<?php
include('process/dbconnection.php');
session_start();
if(!isset($_SESSION['is_login'])){
  if(isset($_REQUEST['email'])){
    $rEmail = mysqli_real_escape_string($conn,trim($_REQUEST['email']));
    $rPassword = mysqli_real_escape_string($conn,trim($_REQUEST['password']));
    $sql = "SELECT emp_email, emp_pwd FROM employee WHERE emp_email='".$myemail."' AND emp_pwd ='".$mypassword."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      
      $_SESSION['is_login'] = true;
      $_SESSION['email'] = $myemail;
      // Redirecting to dashboard on Correct Email and Password
      echo "<script> location.href='#'; </script>";
      exit;
    } else {
      $msg = '<div class="log-alert" role="alert"> Enter Valid Email and Password </div>';
    }
  }
} else {
  echo "<script> location.href='#'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Login </title>
</head>

<body>
    <!-- <style>
        .imgbox {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
    </style> -->
    <section>
        <div class="imgbox">
            <img src="images/pngwing.png" alt="login image">
        </div>
        <div class="contentbox">
            <div class="formbox">
                <h1>Welcome To</h1>
                <h2>PET LIFE</h2>
                <form action="" method="POST">
                    <div class="inputbox">

                        <label for="email"></label><input type="email" placeholder="Email" name="rEmail" required>
                    </div>
                    <div class="inputbox">

                        <label for="pass"></label><input type="password" placeholder="Password" name="rPassword">
                    </div>
                    <div class="inputbox">
<button>Login</button>
                        
 <?php if(isset($msg)) {echo $msg; } ?>
                    </div>
                    <div class="options">
                        <div class="remember">
                            <div class="flex">
                                <input type="checkbox" name="remember" style="margin-right: 5px;">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="inputbox">
                            <P>Forgot Your Password?</P>
                        </div>
                    </div>

                    <div class="inputbox signup" style="display:flex; justify-content:center; margin-top:15px;">
                        <P>Don’t have an account? <a href="#">Sign Up!</a></P>
                    </div>
                

 </form>
   <div><a href="../index.php">Back
            to Home</a></div>
            </div>
        </div>
    </section>
</body>

</html>