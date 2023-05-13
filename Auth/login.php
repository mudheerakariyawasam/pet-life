<?php
include('../db/dbconnection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//  if (empty($_POST["remail"])) {
//         echo '<script>alert("Email is required")</script>';

//     } else if (empty($_POST["rPassword"])) {
//         echo '<script>alert("Password is required")</script>';
//     } else {

    $rEmail = mysqli_real_escape_string($conn, trim($_REQUEST['rEmail']));
    $rPassword = mysqli_real_escape_string($conn, trim($_REQUEST['rPassword'])); //input password given by the user at login
    
    //authorization checked with the pet owner table
    $sql_owner = "SELECT * FROM pet_owner WHERE owner_email = '$rEmail' AND owner_status != 'Deleted'";
    $result_owner = mysqli_query($conn, $sql_owner);
    $row_owner = mysqli_fetch_array($result_owner, MYSQLI_ASSOC);
    $count_owner = mysqli_num_rows($result_owner);

    //var_dump($row_owner);
    if ($count_owner == 1) {
        
        if (mysqli_num_rows($result_owner) > 0) {
            $hashedPassword = md5($rPassword);
            if ($hashedPassword == $row_owner["owner_pwd"]) {                
                $_SESSION['login_user'] = $rEmail;
                $_SESSION['user_name'] = $row_owner["owner_fname"];
                header("location: ../modules/pet owner/dashboard.php");

            }else{
                //echo "Wrong";
            }
        }

    }else {

        //authorization checked with the employee table
        $sql = "SELECT * FROM employee WHERE working_status != 'disable' AND emp_email='" . $rEmail . "'limit 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
    
        if ($count == 1) {
            $_SESSION['user_role'] = $row["emp_designation"];
            if (mysqli_num_rows($result) > 0) {
                $hashedPassword = md5($rPassword);
                if ($hashedPassword == $row["emp_pwd"]) {
                    if ($row["emp_designation"] == "Store Manager") {
                        $_SESSION['login_user'] = $myemail;
                        $_SESSION['user_name'] = $row["emp_name"];
                        header("location: ../modules/pet store/dashboard.php");
                    }
            
                    if ($row["emp_designation"] == "Veterinarian") {
                        $_SESSION['login_user'] = $myemail;
                        $_SESSION['user_name'] = $row["emp_name"];
                        header("location: ../modules/veterinarian/controllers/dashboard.php");
                    }
    
                    if ($row["emp_designation"] == "Admin") {
                        $_SESSION['login_user'] = $myemail;
                        $_SESSION['user_name'] = $row["emp_name"];
                        header("location: ../modules/admin/Admin/dashboard.php");
                    }
            
                    if ($row["emp_designation"] == "Cashier") {
                        $_SESSION['login_user'] = $myemail;
                        $_SESSION['user_name'] = $row["emp_name"];
                        header("location: ../modules/cashier/controllers/dashboard.php");
                    }
           
                    $_SESSION['is_login'] = true;
                    $_SESSION['emp_email'] = $myemail;
                    $_SESSION['login_user'] = $rEmail;
                    $_SESSION['emp_id'] = $row["emp_id"];
    
                } else {
                    //wrong password
                    $msg = '<div class="log-alert" role="alert"> Enter Valid Email and Password </div>';
                }
            } 
        }else{
            $msg = '<div class="log-alert" role="alert"> Wrong User Details </div>';
        }
    }
}   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/pet-life/Auth/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login </title>
</head>

<body>

    <section>
        <div class="imgbox">
            <img src="/pet-life/Auth/img/pngwing.png" alt="login image">
        </div>
        <div class="contentbox">
            <div class="formbox">
                <h1>Welcome To</h1>
                <h2>PET LIFE</h2>
                <form action="" method="POST" autocomplete="off">
                    <?php if (isset($msg)) {
                        echo $msg;
                    } ?>

                    <div class="inputbox">

                        <label for="email"></label><input type="text" placeholder="Enter your email" name="rEmail" required>
                    </div>
                    <div class="inputbox">

                        <label for="pass"></label><input type="password" placeholder="Enter your password" name="rPassword">
                    </div>
                    <div class="inputbox">
                        <button>Login</button>


                    </div>
                    <div class="options">
                        <div class="inputbox">
                            <P><a href=" ../Auth/forgetpassword.php" >Forgot Your Password?</a></P>
                        </div>
                    </div>

                    <div class="inputbox signup" style="display:flex; justify-content:center; margin-top:15px;">
                        <P>Don’t have an account? <a href="../Auth/register.php">Sign Up!</a></P>

                    </div>


                </form>
                <div><a href="/pet-life">Back to Home</a></div>
                <div class="toast">

                    <div class="toast-content">
                        <i class="fa-regular fa-circle-check" style="color: #2dc02d;font-size: 35px;"></i>

                        <div class="message">
                            <span class="text text-1">Success</span>
                            <span class="text text-2">ඔබ සාර්ථකව ලොග් අවුට් වී ඇත</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>


                    <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const button = document.querySelector("#notify-btn"),
            toast = document.querySelector(".toast");
        (closeIcon = document.querySelector(".close")),
        (progress = document.querySelector(".progress"));

        let timer1, timer2;


        function showNotification() {
            toast.classList.add("active");
            progress.classList.add("active");

            timer1 = setTimeout(() => {
                toast.classList.remove("active");
            }, 3000);

            timer2 = setTimeout(() => {
                progress.classList.remove("active");
            }, 3300);
        }


        closeIcon.addEventListener("click", () => {
            toast.classList.remove("active");

            setTimeout(() => {
                progress.classList.remove("active");
            }, 300);

            clearTimeout(timer1);
            clearTimeout(timer2);
        });

        if (performance.navigation.type != performance.navigation.TYPE_RELOAD) {
            window.history.pushState({}, document.title, window.location.pathname);
        }
    </script>
</body>

</html>

<?php
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    echo "<script> showNotification(); </script>";
}
?>