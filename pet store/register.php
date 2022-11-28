<?php
    include("data/dbconnection.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $emp_id = $_POST['emp_id'];
        $emp_name = $_POST['emp_name'];
        $emp_address = $_POST['emp_address'];
        $emp_contactno = $_POST['emp_contactno'];
        $emp_designation = $_POST['emp_designation'];
        $emp_email = $_POST['emp_email'];
        $emp_nic = $_POST['emp_nic'];
        $emp_pwd = $_POST['emp_pwd'];

    $sql = "INSERT INTO employee (emp_id,emp_name,emp_address,emp_contactno,emp_designation,emp_email,emp_nic,emp_pwd) VALUES ('$emp_id','$emp_name','$emp_address','$emp_contactno','$emp_designation','$emp_email','$emp_nic','$emp_pwd')";
    $result = mysqli_query($conn,$sql);
        
        if($result === TRUE) { 
            header("location: dashboard.php");
        }else {
            echo "Error";
        }

    }  


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Register Now</title>
</head>
<body>
    <div class="container">

        <div class="left">
            
            <form method="POST" action="">
                <p class="main-topic">Sign Up Free</p>

                    <label>Employee ID</label><br>
                    <input type="text" name="emp_id" placeholder="Employee ID"><br>
    
                    <label>Full Name</label><br>
                    <input type="text" name="emp_name" placeholder="Full Name"><br>
  
                    <label>Address</label><br>
                    <input type="text" name="emp_address" placeholder="Address"><br>
              
                    <label>Contact No</label><br>
                    <input type="text" name="emp_contactno" placeholder="Contact No"><br>
              
                    <label>Designation</label><br>
                    <input type="text" name="emp_designation" placeholder="Designation"><br>
            
                    <label>Email</label><br>
                    <input type="email" name="emp_email" placeholder="Email"><br>
              
                    <label>NIC</label><br>
                    <input type="text" name="emp_nic" placeholder="NIC"><br>
                
                    <label>Password</label><br>
                    <input type="text" name="emp_pwd" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" 
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" required>
                    <br>
                    <!-- <label>Confirm Password</label><br>
                    <input type="text" name="confirm_pwd" placeholder="Confirm Password"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" required>
                 -->
               
                    <button class="btn-login" type="submit">Sign Up</button>
                    <a href="#">
                        <button class="btn-exit">Cancel</button>
                    </a>
                
            </form>

            <span class="login-text"><a href="login.php">Already have an account? Login</a></span>
        
        </div>

        <div class="right">
            <img class="image" src="images/bg2.png" alt="image">
        </div>

    </div>
</body>
</html>