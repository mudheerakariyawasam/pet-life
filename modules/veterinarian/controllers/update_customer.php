<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

$owner_id = isset($_GET['owner_id']) ? mysqli_real_escape_string($conn, $_GET['owner_id']) : '';

$sql = "SELECT * FROM pet_owner WHERE owner_id= '$owner_id'";
$selected_client = mysqli_query($conn,$sql);

if($selected_client && $row = mysqli_fetch_assoc($selected_client)){
    $owner_id = $row['owner_id'];
    $fname = $row['owner_fname'];
    $lname = $row['owner_lname'];
    $email = $row['owner_email'];
    $tpn = $row['owner_contactno'];
    $address = $row['owner_address'];
    $nic = $row['owner_nic'];
    $pwd = $row['owner_pwd'];
}
if(isset($_POST['save-info'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $tpn = $_POST['tpn'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $pwd = $_POST['password'];

    

    $sql = "UPDATE pet_owner SET owner_fname='$fname',owner_lname= '$lname',owner_email='$email', owner_contactno='$tpn',owner_address='$address',
    owner_nic='$nic',owner_pwd='$pwd' WHERE owner_id= '$owner_id'";
    $clients = mysqli_query($conn,$sql);
   


    if($clients){
        // echo '<script>alert("Updated Successfully!")</script>';
        header('location:showclients.php');
    }else{
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title></title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <img src="../images/logo_transparent black.png">
        </div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="showclients.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment
                        History</span></a></a>
            </li>
            <li>
                <a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
            </li>
            <li>
                <a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="/pet-life/Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Left Navigation bar ends -->

    <div class="content">

        <!-- //Top Navigation bar starts -->
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2"> <?php echo $_SESSION['user_name'];?></font>
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
                            <i class="fa-solid fa-message"></i>
                        </a>
                    </li>
                    <li>
                        <!-- <a href="">
                            <span id="designation">Admin</span>
                        </a> -->
                    </li>
                </ul>
            </div>
        </div>

<div class="container">
        <!-- //Top Navigation bar ends -->
        <!-- //Registration form starts -->
        <div class="sub-container">
        <div class="heading">New Client Registration</div>
            <form action="update_customer.php?owner_id=<?php echo $owner_id;?>" class="form" method="post"  >
                <div class="input-box">
                    <label>Pet Owner's ID: </label>
                    <label><?php echo $owner_id ;?></label>
                </div>
                <div class="input-box">
                    <label>First Name</label>
                    <input type="text" name="fname" placeholder="Enter First Name" value="<?php echo $fname ;?>" required>

                </div>
                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" name="lname" placeholder="Enter Last Name" value="<?php echo $lname ;?>" required>

                </div>
                <div class="input-box">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Enter Email" value="<?php echo $email ;?>" required>

                </div>
                <div class="input-box">
                    <label>Contact Number</label>
                    <input type="text" name="tpn" placeholder="Enter Contact Number" value="<?php echo $tpn;?>" required>

                </div>
                <div class="input-box">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Enter Address" value="<?php echo $address;?>" required>

                </div>
                <div class="column">
                    <div class="input-box">
                        <label>NIC</label>
                        <input type="text" name="nic" placeholder="Enter NIC" value="<?php echo $nic;?>" required>

                    </div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password" value="<?php echo $pwd;?>" required>

                    </div>
                </div>
                <br>
                <div class="save-btn">
                <button class="btn-add" type="submit" role="button">
                    <a style="color:black;"href="user.php" >Update</a>
                    </button>
                </div>
            </form>
</div>

    </div>

</body>

</html>