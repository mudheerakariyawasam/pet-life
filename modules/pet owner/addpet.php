<?php
include("../../db/dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:../../Auth/login.php");
    exit;
}


$loggedInUser = $_SESSION['login_user'];
$sql2 = "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

// get the highest pet ID currently in use
$sql_get_id = "SELECT MAX(pet_id) AS max_id FROM pet";
$result_get_id = mysqli_query($conn, $sql_get_id);
$row = mysqli_fetch_assoc($result_get_id);
$max_id = $row['max_id'];

// generate the new pet ID
if ($max_id === null) {
    $pet_id = "P001";
} else {
    $num = intval(substr($max_id, 1)) + 1;
    if ($num < 10) {
        $pet_id = "P00$num";
    } else if ($num < 100) {
        $pet_id = "P0$num";
    } else {
        $pet_id = "P$num";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pet_name = $_POST['pet_name'];
    $pet_gender = $_POST['pet_gender'];
    $pet_dob = $_POST['pet_dob'];
    $pet_type = $_POST['pet_type'];
    $pet_breed = $_POST['pet_breed'];
    $owner_id = $row2['owner_id'];

    $sql = "INSERT INTO pet VALUES ('$pet_id','$pet_name','$pet_gender','$pet_dob','$pet_type','$pet_breed','$owner_id','Registered')";
    $result = mysqli_query($conn, $sql);
    print_r($result);

    if ($result == TRUE) {
        echo '<script>alert("Registration Successful!"); window.location = "viewpet.php";</script>';
    } else {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="images/petlife.png" width=200px></center>
        </div>
        <ul>

            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>Pet Daycare</span></a></a>
            </li>
            <li>
                <a href="../../public/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
            </li>
            <li>
                <a href="inquiry.php"><i class="fa fa-user"></i><span>Inquiries</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="./logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                </div>
            </div>


          
        </div>


        <div class="container">


            <!-- <div class="left"> -->
            <form method="POST" action="">

                <p class="welcome">Register your pet here</p>
                <!-- <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="pet_id" placeholder="petID">
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">Pet's Name</label>
                    <input type="text" name="pet_name" placeholder="name" required>
                </div>
                <!-- <div class="form-content">
                    <label class="loging-label1">Pet gender</label>
                    <input type="text" name="pet_gender" placeholder="gender" required>

                </div> -->
                <div class="form-content">
                    <label class="loging-label1">Pet gender</label>
                    <select name="pet_gender" required>
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Date of birth</label>
                    <input type="date" name="pet_dob" placeholder="dob" max="<?= date('Y-m-d') ?>" required>
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
                    <button class="btn-add" type="submit">Register</button>
                    <!-- <button class="btn-exit" type="submit"><a href="./dashboard.php">Cancel</a></button> -->
                </p>
            </form>

        </div>

        <!-- <div class="top-container">

         <div>
                        <button class="register-btn2"><a href="./viewpet.php">View Pets</a></button>
                    </div>
        </div> -->
        <script src="script.js"></script>

</body>

</html>