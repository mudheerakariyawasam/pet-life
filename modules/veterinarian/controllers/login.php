<?php
include('../dbconnection.php');
session_start();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $rEmail = mysqli_real_escape_string($conn, trim($_REQUEST['rEmail']));
        $rPassword = mysqli_real_escape_string($conn, trim($_REQUEST['rPassword']));
        $sql = "SELECT * FROM employee WHERE emp_email='" . $rEmail . "' AND emp_pwd ='" . $rPassword . "' limit 1";
        // $result = $conn->query($sql);
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active = $row['active'];

        $count = mysqli_num_rows($result);

        //variables that are need for the future pages
       
        if ($count == 1) {

            if($row["emp_designation"]=="Store manager"){
                $_SESSION['login_user'] = $myemail;
                $_SESSION['user_name'] = $row["emp_name"];
                header("location: ../../pet store/dashboard.php");
            }

            if($row["emp_designation"]=="Doctor"){
                $_SESSION['login_user'] = $myemail;
                $_SESSION['user_name'] = $row["emp_name"];
                header("location: dashboard.php");
            }

            if($row["emp_designation"]=="Admin"){
                $_SESSION['login_user'] = $myemail;
                $_SESSION['user_name'] = $row["emp_name"];
                header("location: ../../admin/Admin/dashboard.php");
            }

            

            $_SESSION['is_login'] = true;
            $_SESSION['email'] = $myemail;
            $_SESSION['login_user'] = $rEmail;
            $_SESSION['emp_id'] = $row["emp_id"];
            
        } else {
            $msg = '<div class="log-alert" role="alert"> Enter Valid Email and Password </div>';
        }
    // }
} else {
    // echo "<script> location.href='login.php'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login </title>
</head>

<body>
    
    <section>
        <div class="imgbox">
            <img src="../images/pngwing.png" alt="login image">
        </div>
        <div class="contentbox">
            <div class="formbox">
                <h1>Welcome To</h1>
                <h2>PET LIFE</h2>
                <form action="" method="POST" autocomplete="off">
                    <div class="inputbox">

                        <label for="email"></label><input type="email" placeholder="Email" name="rEmail" required>
                    </div>
                    <div class="inputbox">

                        <label for="pass"></label><input type="password" placeholder="Password" name="rPassword">
                    </div>
                    <div class="inputbox">
                        <button>Login</button>

                        <?php if (isset($msg)) {
     echo $msg;
 } ?>
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
                        <P>Don’t have an account? <a href="vetsignup.php">Sign Up!</a></P>
                    </div>


                </form>
                <div><a href="../index.php">Back to Home</a></div>
            </div>
        </div>
    </section>
</body>

</html>