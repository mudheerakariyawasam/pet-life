<?php
   include("data/dbconnection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT `emp_designation`,`emp_name` FROM employee WHERE emp_email = '$myemail' and emp_pwd = '$mypassword'";
      
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if (mysqli_num_rows($result) > 0) {

            if($row["emp_designation"]=="Store manager"){
                $_SESSION['login_user'] = $myemail;
                $_SESSION['user_name'] = $row["emp_name"];
                header("location: dashboard.php");
            }
            if($row["emp_designation"]=="Pet owner"){
                $_SESSION['login_user'] = $myemail;
                $_SESSION['user_name'] = $row["emp_name"];
                header("location: ../pet owner/dashboard1.php");
            }
            if($row["emp_designation"]=="Store manager"){
                $_SESSION['login_user'] = $myemail;
                $_SESSION['user_name'] = $row["emp_name"];
                header("location: dashboard.php");
            }
            
        } else {
            echo '<script>alert("Wrong User Details")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <img class= "bg" src="images/bg2.png" > 
        </div>
        <div class="right">
            <form  method="POST" action="">
                <p class="welcome">Welcome To</p>
                <p class="pet_store">PET STORE</p>
                <label>Email</label>
                <input type="text" name="email" placeholder="email" required><br>
                <label>Password</label>
                <input type="password" name="password" placeholder="password" required><br> 
                <span class="psw">Don't have an account? <a href="#">Sign In</a></span>
                <p>
                    <button class="btn-login" type="submit">Login</button>
                    <button class="btn-exit"type="submit">Exit</button>
                </p>
            </form>
        </div>
    </div>
</body>
</html>