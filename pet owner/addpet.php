<?php
   include("dbconnection.php");

   session_start();
   if(!isset($_SESSION['login_user']))
   {
    header("Location:login.php");
    exit;
   } 

        $loggedInUser = $_SESSION['login_user'];
        $sql2 =  "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $pet_id = '';
        $pet_name = $_POST['pet_name'];
        $pet_gender=$_POST['pet_gender'];
        $pet_dob=$_POST['pet_dob'];
        $pet_type=$_POST['pet_type'];
        $pet_breed=$_POST['pet_breed'];
        $owner_id=$row2['owner_id'];
 
        $sql = "INSERT INTO pet VALUES ('$pet_id','$pet_name','$pet_gender','$pet_dob','$pet_type','$pet_breed','$owner_id')";
        $result = mysqli_query($conn,$sql);
        print_r($result);
        
        if($result==TRUE) { 
            header("Location: viewpet.php");
        }else {
            echo "There is an error in adding!";
        }
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addpet.css">
    <title>Document</title>
</head>

<body>

<div class="topic">
        <span class="welcome">Welcome</span>
        <span class="name">Fathima</span>
        <button type="submit" class="notification"><a href="#"><img src="images/bell.png"></a></button>
        <button type="submit" class="messages"><a href="#"><img src="images/message-square.png"></a></button>
        <button type="submit" class="logout"><a href="./logout.php">logout</a></button>
    </div>

    <div class="container">

        <div class="left">
            <form method="POST">
           
                <p class="welcome">Register your pet here</p>
                <!-- <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="pet_id" placeholder="petID">
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">Pet's Name</label>
                    <input type="text" name="pet_name" placeholder="name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet gender</label>
                    <input type="text" name="pet_gender" placeholder="gender" required>
                    
                </div>
                <div class="form-content">
                    <label class="loging-label1">Date of birth</label>
                    <input type="date" name="pet_dob" placeholder="dob" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Type</label>
                    <input type="text" name="pet_type" placeholder="type of pet" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Breed</label>
                    <input type="text" name="pet_breed" placeholder="breed" required>
                </div>
                <!-- <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div> -->
               
                <p>
                    <button class="btn-login" type="submit">Register</button>
                    <!-- <button class="btn-exit" type="submit"><a href="./dashboard.php">Cancel</a></button> -->
                </p>
            </form>
        </div>

        <div class="right">
            <img class="image" src="images/addpet.png" alt="image">
        </div>

    </div>

</body>

</html>