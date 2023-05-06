<?php
include("../../db/dbconnection.php");

$sql_get_id="SELECT owner_id FROM pet_owner ORDER BY owner_id DESC LIMIT 1";
     $result_get_id=mysqli_query($conn,$sql_get_id);
     $row=mysqli_fetch_array($result_get_id);
 
     $lastid="";
                     
     if(mysqli_num_rows($result_get_id)>0){
         $lastid=$row['owner_id'];
     }
 
     if($lastid==""){
         $owner_id="O001";
     }else {
         $owner_id=substr($lastid,3);
         $owner_id=intval($owner_id);
 
         if($owner_id>=9){
             $owner_id="O0".($owner_id+1);
         } else if($owner_id>=99){
             $owner_id="O".($owner_id+1);
         }else{
             $owner_id="O00".($owner_id+1);
         }
     }
     

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_fname = $_POST['owner_fname'];
    $owner_lname = $_POST['owner_lname'];
    $owner_email = $_POST['owner_email'];
    $owner_contactno = $_POST['owner_contactno'];
    $owner_address = $_POST['owner_address'];
    $owner_nic = $_POST['owner_nic'];
    $owner_pwd = $_POST['owner_pwd'];

    $hashedPassword = md5($owner_pwd); 



    $sql = "INSERT INTO pet_owner VALUES ('$owner_id','$owner_fname','$owner_lname','$owner_email','$owner_contactno','$owner_address','$owner_nic', '$hashedPassword')";
    $result = mysqli_query($conn, $sql);

   

    if ($result == TRUE) {
        header("location: login.php");
    } else {
        echo "There is an error in adding!";
    }

}
?>


<<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>

<div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name">User</div>
                </div>
            </div>

            <div class="navbar__right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span id="designation"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <div class="container">

        <div class="left">
            <form method="POST" action="">
                <p class="welcome">Sign Up Free</p>

                <!-- <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="owner_id" placeholder="Owner ID" required>
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">First Name</label>
                    <input type="text" name="owner_fname" placeholder="first name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Last Name</label>
                    <input type="text" name="owner_lname" placeholder="last name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="email" name="owner_email" placeholder="email" required>
                </div>
                <div class="form-content">
  <label class="loging-label1">Phone</label>
  <input type="tel" name="owner_contactno"  maxlength="10"  placeholder="contact no" pattern="^\+?\d{2}\s?\d{8}$" required>
</div>
                <div class="form-content">
                    <label class="loging-label1">Address</label>
                    <input type="text" name="owner_address" placeholder="address" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">NIC</label>
                    <input type="text" name="owner_nic" placeholder="NIC"required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Password</label>
                    <input type="password" name="owner_pwd" placeholder="password"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"
                        required>
                </div>

                <p>
                    <button class="btn-add" type="submit">Sign Up</button>
                   
                </p>
                
                <span class="psw">Already have an account? <a href="./login.php">Login</a></span>

            </form>


            
        </div>

        <div class="right">
            <img class="image" src="./images/register.png" alt="image">
        </div>

    </div>
</div>

</body>

</html>