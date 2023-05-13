<?php
include("../db/dbconnection.php");

$sql_get_id = "SELECT owner_id FROM pet_owner ORDER BY owner_id DESC LIMIT 1";
$result_get_id = mysqli_query($conn, $sql_get_id);
$row = mysqli_fetch_array($result_get_id);

$lastid = "";

if (mysqli_num_rows($result_get_id) > 0) {
    $lastid = $row['owner_id'];
}

if ($lastid == "") {
    $owner_id = "O001";
} else {
    $owner_id = substr($lastid, 3);
    $owner_id = intval($owner_id);

    if ($owner_id >= 9) {
        $owner_id = "O0" . ($owner_id + 1);
    } else if ($owner_id >= 99) {
        $owner_id = "O" . ($owner_id + 1);
    } else {
        $owner_id = "O00" . ($owner_id + 1);
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



    $sql = "INSERT INTO pet_owner VALUES ('$owner_id','$owner_fname','$owner_lname','$owner_email','$owner_contactno','$owner_address','$owner_nic', '$hashedPassword','current')";
    $result = mysqli_query($conn, $sql);

    if ($result == TRUE) {
        echo '<script>alert("Registration Successful!"); window.location = "login.php";</script>';
    } else {
        echo "There is an error in adding!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/pet-life/Auth/register.css">
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
                <form method="POST" action="">
                        <h2 class="welcome">Sign Up Free</h2>

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
                            <input type="tel" name="owner_contactno" maxlength="10" placeholder="contact no"
                                pattern="^\+?\d{2}\s?\d{8}$" required>
                        </div>
                        <div class="form-content">
                            <label class="loging-label1">Address</label>
                            <input type="text" name="owner_address" placeholder="address" required>
                        </div>
                        <div class="form-content">
                            <label class="loging-label1">NIC</label>
                            <input type="text" name="owner_nic" placeholder="NIC" required>
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
                <div><a href="/pet-life">Back to Home</a></div>
                <div class="toast">

                    <div class="toast-content">
                        <i class="fa-regular fa-circle-check" style="color: #2dc02d;font-size: 35px;"></i>

                        <div class="message">
                            <span class="text text-1">Congratulations!</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>


                    <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
