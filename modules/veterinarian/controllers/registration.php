<?php
include("../dbconnection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = "";
    $address = "";
    $phone = "";
    $designation = "";
    $email = "";
    $nic = "";
    $password = "";

    $name = input_verify($_POST['name']);
    $address = input_verify($_POST['address']);
    $phone = input_verify($_POST['phone']);
    $designation = input_verify($_POST['designation']);
    $email = input_verify($_POST['email']);
    $nic = input_verify($_POST['nic']);
    $password = input_verify($_POST['password']);

    $query = "INSERT INTO employee(emp_name,emp_address,emp_contactno,emp_designation,emp_email,emp_nic,emp_pwd) VALUES (
    '{$name}','{$address}','$phone','{$designation}','{$email}','{$nic}','{$password}')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "User registration success!";
    } else {
        echo mysqli_error($conn);
    }

}
function input_verify($data)
{
    //remove empty spaces from user input
    $data = trim($data);
    //remove back slash from user input
    $data = stripslashes($data);
    //convert special chars to html entities
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Poppins&family=Roboto&display=swap"
        rel="stylesheet">
    <title></title>
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="row-1">
                <div class="card-header" id="card-header">
                    <h4>Register Yourself Here</h4>
                </div>
            </div>
            <div class="row-2">
                <div class="card-body" id="card-body">
                    <form action="" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder=""
                                aria-describedby="helpId">

                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder=""
                                aria-describedby="helpId">

                        </div>

                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder=""
                                aria-describedby="helpId">

                        </div>
                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" name="designation" id="designation" class="form-control" placeholder=""
                                aria-describedby="helpId">

                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder=""
                                aria-describedby="helpId">

                        </div>
                        <div class="form-group">
                            <label for="">NIC</label>
                            <input type="text" name="nic" id="nic" class="form-control" placeholder=""
                                aria-describedby="helpId">

                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder=""
                                aria-describedby="helpId">
                        </div>
                </div>
                <div class="card-footer" id="card-footer">
                    <input type="submit" value="Sign Up">
                </div>
                <!-- <div class="card-footer" id="card-footer">
                    <input type="submit" value="Login"> 
                    </div> -->
                <div class="inputbox signup" style="display:flex; justify-content:center; margin-top:15px;">
                    <p>Already have an account? <a href="login.php">Login!</a></p>
                </div>
                </form>
            </div>

        </div>
        <div class="right">
            <img class="image" src="../images/pngwing.png" alt="image">
        </div>



        <!-- <p>
                    <button class="btn-login" type="submit">Sign Up</button>
                    <button class="btn-exit" type="submit"><a href="./home.php">Cancel</a></button>
                </p>
            </form>

            <span class="psw">Already have an account? <a href="./login.php">Login</a></span> -->
    </div>

</body>

</html>