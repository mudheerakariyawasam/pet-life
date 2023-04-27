<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }
    
    $loggedInUser = $_SESSION['login_user'];
    $sql2 = "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $owner_id=$row2["owner_id"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //generate next day care ID
        $sql_get_id="SELECT appointment_id FROM appointment ORDER BY appointment_id DESC LIMIT 1";
        $result_get_id=mysqli_query($conn,$sql_get_id);
        $row=mysqli_fetch_array($result_get_id);
    
        $lastid="";
                        
        if(mysqli_num_rows($result_get_id)>0){
            $lastid=$row['appointment_id'];
        }
    
        if($lastid==""){
            $appointment_id="A001";
        }else {
            $appointment_id=substr($lastid,3);
            $appointment_id=intval($appointment_id);
    
            if($appointment_id>=9){
                $appointment_id="A0".($appointment_id+1);
            } else if($appointment_id>=99){
                $appointment_id="A".($appointment_id+1);
            }else{
                $appointment_id="A00".($appointment_id+1);
            }
        }

        // Get the chosen date
        $date = date('Y-m-d', strtotime($_POST['date']));
        $pet_name = $_POST['pet_name'];
        $emp_name=$_POST['emp_name'];

        //get the appointment slot no
        $sql_getappointmentcount = "SELECT COUNT(*) FROM appointment WHERE appointment_date = ?";
        $result_getpid=mysqli_query($conn,$sql_getpid);
        $row_pid=mysqli_fetch_array($result_getpid);
        $count = $stmt->fetchColumn();
        $count+=$count;

        //get pet ID
        $sql_getpid="SELECT pet_id FROM pet WHERE owner_id='$owner_id' AND pet_name='$pet_name'";
        $result_getpid=mysqli_query($conn,$sql_getpid);
        $row_pid=mysqli_fetch_array($result_getpid);
        $pet_id = $row_pid['pet_id'];

        //get vet ID
        $sql_getvid="SELECT emp_id FROM employee WHERE emp_name='$emp_name' AND emp_designation='Veterinarian'";
        $result_getvid=mysqli_query($conn,$sql_getvid);
        $row_vid=mysqli_fetch_array($result_getvid);
        $emp_id = $row_vid['emp_id'];
    
        $sql = "INSERT INTO appointment VALUES ('$appointment_id','$date','$count','$emp_id','$pet_id')";
        $result = mysqli_query($conn, $sql);

        if ($result == TRUE) {
            echo '<script>alert("Your appointment slot is booked")</script>';
            header("Location: dashboard.php");
        } else {
            echo '<script>alert("There is an error in booking")</script>';
        }
    }
?> 

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/makeapp.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <title>Pet Care</title>
    </head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="images/petlife.png" width= 200px></center>
        </div>
        <ul>
            
        <li>
                <a href="dashboard.php" ><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php" ><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My Profile</span></a>
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
                <div class="hello">Welcome &nbsp <div class="name"><?php echo $_SESSION['user_name'];?></div>
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
      

    <!-- <div class="left"> -->
    <form method="POST" action="">
    <p class="welcome">Make an Appointment</p>
    <p>Add the information about the appointment</p>

            <!-- get all pet names -->

            <div class="form-content">
                <label class="loging-label1">Pets Name</label>
                <select id='pet_name' name='pet_name' class='dropdown-list' required>
                <option value="">--Select Pet Name--</option>
                <?php
                    
                    //get the pet name from the sql table
                    $sql_mid="SELECT pet_name FROM pet WHERE owner_id='$owner_id' "; 
                    $result_getdata = $conn->query($sql_mid);
                    if($result_getdata->num_rows> 0){
                        while($optionData=$result_getdata->fetch_assoc()){
                        $option =$optionData['pet_name'];
                    ?>
                    <?php
                        //selected option
                        if(!empty($pet_name) && $pet_name== $option){
                        // selected option
                    ?>
                    <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                    <?php 
                        continue;
                    }?>
                    <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                    <?php
                        }}
                    ?>
                </select>
            </div>

            <!-- get all vet names -->

            <div class="form-content">
                <label class="loging-label1">Preferred Doctor</label>
                <select id='emp_name' name='emp_name' class='dropdown-list' required>
                <option value="">--Select Doctor Name--</option>
                <?php
                    
                    //get the vet name from the sql table
                    $sql_vid="SELECT emp_name FROM employee WHERE emp_designation='Veterinarian' "; 
                    $result_vdata = $conn->query($sql_vid);
                    if($result_vdata->num_rows> 0){
                        while($optionData=$result_vdata->fetch_assoc()){
                        $option =$optionData['emp_name'];
                    ?>
                    <?php
                        //selected option
                        if(!empty($emp_name) && $emp_name== $option){
                        // selected option
                    ?>
                    <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                    <?php 
                        continue;
                    }?>
                    <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                    <?php
                        }}
                    ?>
                </select>
            </div>

            <div class="form-content">
                <label class="loging-label1">Preferred day of appointment</label>
                <input type="date" name="date" min="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-content">
                <button class="btn-add" type="submit">Confirm</button>
            </div>
</form>
    
</div>

</body>

</html>


