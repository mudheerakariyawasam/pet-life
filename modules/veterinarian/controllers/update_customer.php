<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

$id = $_GET['updateid'];
$sql = "SELECT * from pet_owner WHERE ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$tpn = $row['tpn'];
$address = $row['address'];
$nic = $row['nic'];
$pwd = $row['password'];


if (isset($_POST['save-info'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $tpn = $_POST['tpn'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $pwd = $_POST['password'];

    $sql = "UPDATE pet_owner SET id='$id',fname='$fname',lname='$lname',email= '$email',tpn=$tpn,address='$address',nic='$nic',password='$pwd' WHERE id='$id'";
    $clients = mysqli_query($conn, $sql);

    if ($clients) {
        echo "Updated successfully!";

    } else {
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
                    <font class="header-font-2"> Senuri</font>
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

        <!-- //Top Navigation bar ends -->
        <!-- //Registration form starts -->
        <div class="sub-container">
            <div class="heading">New Client Registration</div>
            <form action="#" class="form" method="post">
                <div class="input-box">
                    <label>Pet Owner's ID</label>
                    <input type="text" name="id" value=<?php echo $id;?> placeholder="Enter a new ID" required>

                </div>
                <div class="input-box">
                    <label>First Name</label>
                    <input type="text" name="fname" value=<?php echo $fname;?> placeholder="Enter First Name" required>

                </div>
                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" name="lname" value=<?php echo $lname;?> placeholder="Enter Last Name" required>

                </div>
                <div class="input-box">
                    <label>Email</label>
                    <input type="text" name="email" value=<?php echo $email;?> placeholder="Enter Email" required>

                </div>
                <div class="input-box">
                    <label>Contact Number</label>
                    <input type="text" name="tpn" value=<?php echo $tpn;?> placeholder="Enter Contact Number" required>

                </div>
                <div class="input-box">
                    <label>Address</label>
                    <input type="text" name="address" value=<?php echo $address;?> placeholder="Enter Address" required>

                </div>
                <div class="column">
                    <div class="input-box">
                        <label>NIC</label>
                        <input type="text" name="nic" value=<?php echo $nic;?> placeholder="Enter NIC" required>

                    </div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="password" value=<?php echo $pwd ;?> placeholder="Enter Password" required>

                    </div>
                </div>
                <br>
                <div class="save-btn">
                    <button onclick="saveTreatment(event)" class="button-01" name="save-info" id="btn-save"
                        type="submit" role="button">Update</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>