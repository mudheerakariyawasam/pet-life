<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

//generate next owner ID
$sql_get_id="SELECT owner_id FROM pet_owner ORDER BY owner_id DESC LIMIT 1";
$result_get_id=mysqli_query($conn,$sql_get_id);
$row=mysqli_fetch_array($result_get_id);
 
$lastid="";
                     
     if(mysqli_num_rows($result_get_id)>0){
         $lastid=$row['owner_id'];
     }
 
     if($lastid==""){
         $owner_id="O001";
     }else {
         $owner_id=substr($lastid,3);
         $owner_id=intval($owner_id);
 
         if($owner_id>=9){
             $owner_id="O0".($owner_id+1);
         } else if($owner_id>=99){
             $owner_id="O".($owner_id+1);
         }else{
             $owner_id="O00".($owner_id+1);
         }
     }

if(isset($_POST['save-info'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $tpn = $_POST['tpn'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $pwd = $_POST['password'];

    $sql = "INSERT INTO pet_owner(owner_id,owner_fname,owner_lname,owner_email,owner_contactno,owner_address,owner_nic,owner_pwd)
    values ('$owner_id','$fname','$lname',' $email','$tpn','$address','$nic','$pwd')";
    $clients = mysqli_query($conn,$sql);

    if($clients){
        echo '<script>alert("New Owner Added Successfully!")</script>';
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
r                        <a href="#">
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
            <form action="#" class="form" method="post"  >
                <div class="input-box">
                    <label>Pet Owner's ID: </label>
                    <label><?php echo $owner_id;?></label>
                </div>
                <div class="input-box">
                    <label>First Name</label>
                    <input type="text" name="fname" placeholder="Enter First Name" required>

                </div>
                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" name="lname" placeholder="Enter Last Name" required>

                </div>
                <div class="input-box">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Enter Email" required>

                </div>
                <div class="input-box">
                    <label>Contact Number</label>
                    <input type="text" name="tpn" placeholder="Enter Contact Number" required>

                </div>
                <div class="input-box">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Enter Address" required>

                </div>
                <div class="column">
                    <div class="input-box">
                        <label>NIC</label>
                        <input type="text" name="nic" placeholder="Enter NIC" required>

                    </div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password" required>

                    </div>
                </div>
                <br>
                <div class="save-btn">
                    <button onclick="saveTreatment(event)" class="button-01" name="save-info" id="btn-save"
                        type="submit" role="button">Submit</button>
                </div>
            </form>
</div>

    </div>

</body>

</html>