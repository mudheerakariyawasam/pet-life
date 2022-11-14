<?php
   include("dbconnection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT emp_designation FROM employee WHERE emp_email = '$myemail' and emp_pwd = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myemail");
         $_SESSION['login_user'] = $myemail;
         
         header("location: additem.php");
      }else {
         $error = "Your Login Name or Password is invalid";
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
                <input type="text" name="email" placeholder="email"><br>
                <label>Password</label>
                <input type="password" name="password" placeholder="password"><br> 
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