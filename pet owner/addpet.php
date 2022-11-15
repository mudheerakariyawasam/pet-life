<?php
include("dbconnection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myemail = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT emp_designation FROM employee WHERE emp_email = '$myemail' and emp_pwd = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        //session_register("myemail");
        $_SESSION['login_user'] = $myemail;

        header("location: welcome.php");
    } else {
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
    <link rel="stylesheet" href="css/addpet.css">
    <title>Document</title>
</head>

<body>

<div class="topic">
        <span class="welcome">Welcome </span>
        <span class="name">NAME</span>
        <button type="submit" class="notification"><img src="images/bell.png"></button>
        <button type="submit" class="messages"><img src="images/message-square.png"></button>
        <button type="submit" class="logout">logout</button>
    </div>

    <div class="container">

        <div class="left">
            <form method="POST" action="">
                <p class="welcome">Register your pet here</p>

                <div class="form-content">
                    <label class="loging-label1">Pet's Name</label>
                    <input type="text" name="name" placeholder="name">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet gender</label>
                    <input type="password" name="gender" placeholder="gender">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Date of birth</label>
                    <input type="text" name="dob" placeholder="dob">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Type</label>
                    <input type="text" name="type" placeholder="type of pet">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Breed</label>
                    <input type="text" name="breed" placeholder="breed">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="ownerid" placeholder="ownerID">
                </div>
                <p>
                    <button class="btn-login" type="submit">Register</button>
                    <button class="btn-exit" type="submit">Cancel</button>
                </p>
            </form>
        </div>

        <div class="right">
            <img class="image" src="./images/addpet.png" alt="image">
        </div>

    </div>

</body>

</html>