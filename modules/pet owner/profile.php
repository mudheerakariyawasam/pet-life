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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_fname = $_POST['owner_fname'];
    $owner_lname = $_POST['owner_lname'];
    $owner_email = $_POST['owner_email'];
    $owner_contactno = $_POST['owner_contactno'];
    $owner_address = $_POST['owner_address'];
    $owner_nic = $_POST['owner_nic'];
    $owner_pwd = $_POST['owner_pwd'];

$sql = "SELECT * FROM pet_owner WHERE owner_id = '{$row2['owner_id']}'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    // Fetch the first row of the result set
    $row = mysqli_fetch_assoc($result);
    // Use var_dump() to inspect the $row variable
} else {
    // Handle the case when no results are found
    echo "No results found";
}


}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
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
                <a href="profile.php" class="active"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>VIP Programmes</span></a></a>
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

            <div class="top-container">

                <!-- <div>
                        <button class="register-btn2"><a href="./viewpet.php">View Pets</a></button>
                    </div> -->

                <div class="text">
                    Give pets the love they deserve
                </div>

                
            </div>
            <div class="content2" style="
            background-position: center;
            height: 100vh;">

                <p class="topic"> My Profile</p>
                <hr><br>


                <div class="form-content2">

                    <p>
                    <form method="POST">
                        <label><b>Owner ID : </label>
                        <label class="id" name="owner_id"></b><br><br>

                            <div class="column-wise">
                                <label>Full Name :</label><br>
                                <input type="text" name="owner_fname" placeholder="Full Name"
                                    value="<?php echo $owner_fname; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>Email :</label><br>
                                <input type="text" name="owner_email" placeholder="email"
                                    value="<?php echo $owner_email; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>Contact No :</label><br>
                                <input type="text" name="owner_contactno" placeholder="contact no"
                                    value="<?php echo $owner_contactno; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>Address :</label><br>
                                <input type="text" name="owner_address" placeholder="address"
                                    value="<?php echo $owner_address; ?>"><br>
                            </div>
                            <div class="column-wise">
                                <label>NIC :</label><br>
                                <input type="text" name="owner_nic" placeholder="nic"
                                    value="<?php echo $owner_nic; ?>"><br>
                            </div>
                            <div class="pwd-content">
                <button class="btn-add" fdprocessedid="a0hv6"><a href="updatepr.php">Update</a></button>
            </div>
           
                    </form>

                </div>


                <div class="right-content">
            <span class="sub-topic">Change Password</span><br>
            <p>
            </p><div class="pwd-content">
                <label>Current Password :</label><br>
                <input type="password" name="owner_pwd" placeholder="Enter Current Password" fdprocessedid="w9kcn"><br>
            </div>
            <div class="pwd-content">
                <label>New Password :</label><br>
                <input type="password" name="owner_pwd" placeholder="Enter New Password" fdprocessedid="sq99i"><br>
            </div>
            <div class="pwd-content">
                <label>Confirm New Password :</label><br>
                <input type="password" name="owner_pwd" placeholder="Re Enter Password" fdprocessedid="rwoku"><br>
            </div>
            <div class="pwd-content">
                <button class="btn-add" fdprocessedid="a0hv6">Confim </button>
            </div>
            <p></p>
        </div>
            </div>

        </div>
    </div>
</body>

</html>