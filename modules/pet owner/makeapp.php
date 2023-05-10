<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../modules/pet owner/login.php");
        exit;
    }
    
    $loggedInUser = $_SESSION['login_user'];
    $sql2 = "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $owner_id=$row2["owner_id"];

    // get the highest pet ID currently in use
    $sql_get_id = "SELECT MAX(appointment_id) AS max_id FROM appointment";
    $result_get_id = mysqli_query($conn, $sql_get_id);
    $row = mysqli_fetch_assoc($result_get_id);
    $max_id = $row['max_id'];

    // generate the new pet ID
    if ($max_id === null) {
        $appointment_id = "P001";
    } else {
        $num = intval(substr($max_id, 1)) + 1;
        if ($num < 10) {
            $appointment_id = "A00$num";
        } else if ($num < 100) {
            $appointment_id = "A0$num";
        } else {
            $appointment_id = "A$num";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Get the chosen date
        $date = date('Y-m-d', strtotime($_POST['date']));
        $pet_name = $_POST['pet_name'];
        $emp_name=$_POST['emp_name'];

        //get the appointment slot no
        $sql_getappointmentcount = "SELECT COUNT(*) FROM appointment WHERE appointment_date = '$date'";
        $result_getappointmentcount = mysqli_query($conn, $sql_getappointmentcount);
        $row_getappointmentcount = mysqli_fetch_array($result_getappointmentcount);
        $count = $row_getappointmentcount[0] + 1;
        echo $count;

        // Get the last appointment's slot ID
$sql_get_slot_id = "SELECT appointment_slot FROM appointment ORDER BY appointment_id DESC LIMIT 1";
$result_get_slot_id = mysqli_query($conn, $sql_get_slot_id);
$row_get_slot_id = mysqli_fetch_assoc($result_get_slot_id);
$last_slot_id = $row_get_slot_id['appointment_slot'];

// Increment the slot ID
$new_slot_id = ++$last_slot_id;

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

        //check availability of the vet
        // Get the requested appointment date
$date = $_POST['date'];

// Retrieve the vet IDs from the holiday table for the requested date where the holiday status is approved
$sql = "SELECT emp_id FROM holiday WHERE holiday_date = '$date' AND holiday_status = 'Approved'";
$result = $conn->query($sql);

$unavailable_vets = array();
if ($result->num_rows > 0) {
    // Store the vet IDs in an array
    while ($row = $result->fetch_assoc()) {
        $unavailable_vets[] = $row['vet_id'];
    }
}

// Exclude the unavailable vet IDs from the list of available vets for the appointment form dropdown
$sql = "SELECT emp_id FROM holiday WHERE vet_availability = 'Available'";
if (!empty($unavailable_vets)) {
    $unavailable_vet_ids = implode(',', $unavailable_vets);
    $sql .= " AND emp_id NOT IN ($unavailable_vet_ids)";
}
$result = $conn->query($sql);

// Generate the dropdown options for available vets
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['vet_id'] . '">' . $row['vet_name'] . '</option>';
    }
} else {
    echo '<option value="">No available vets</option>';
}


        //check duplicate entry

        

        if($count>10){
            echo '<script>alert("The date is already filled")</script>'; 
        }else{
            $sql = "INSERT INTO appointment VALUES ('$appointment_id','$date','$new_slot_id','$emp_id','$pet_id','Available')";
            $result = mysqli_query($conn, $sql);
    
            if ($result == TRUE) {
                echo '<script>alert("Your appointment slot is booked")</script>';

            } else {
                echo '<script>alert("There is an error in booking")</script>';
            }
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
                <button class="btn-add" type="submit"><a href="viewapp.php">Confirm</a></button>
            </div>
</form>
    
</div>

</body>

</html>


