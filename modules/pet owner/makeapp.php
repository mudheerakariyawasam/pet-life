<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }

    if (isset($_POST['submit'])) {
		// Get the form data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$phone = htmlspecialchars($_POST['phone']);
		$appointment_id = htmlspecialchars($_POST['appointment']);
    }
// Get the current date and time
$current_datetime = date('Y-m-d H:i:s');

// Query the database for available appointment slots
$sql = "SELECT * FROM appointment WHERE appointment_date > '$current_datetime' AND appointment_status = 'available' ORDER BY appointment_date ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	// Loop through the results and create an option element for each available appointment slot
	while ($row = mysqli_fetch_assoc($result)) {
		// Format the date and time
		$appointment_date = strtotime($row['appointment_date']);
		$date = date('l, F j, Y', $appointment_date);
		$time = date('g:i a', $appointment_date);

		// Display the available appointment slot
		echo '<option value="' . $row['appointment_id'] . '">' . $date . ' at ' . $time . '</option>';
	}
} else {
	// Display a message if there are no available appointment slots
	echo '<option value="">No available appointment slots.</option>';
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
                <a href="../admin/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
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
<div class="form-content">
    <label class="loging-label1">Pet ID</label>
    <input type="text" name="pet_id" placeholder="petID">
</div>
<div class="form-content">
    <label class="loging-label1">Pet Name</label>
    <input type="text" name="pet_name" placeholder="name" required>
</div>
<!-- <div class="form-content">
    <label class="loging-label1">Last Name</label>
    <input type="text" name="pet_gender" placeholder="gender" required>
    
</div>
<div class="form-content">
    <label class="loging-label1">Email</label>
    <input type="date" name="pet_dob" placeholder="dob" required>
</div>
<div class="form-content">
    <label class="loging-label1">Phone</label>
    <input type="text" name="pet_type" placeholder="type of pet" required>
</div>
<div class="form-content">
    <label class="loging-label1">Address</label>
    <input type="text" name="pet_breed" placeholder="breed" required>
</div> -->
<!-- <div class="form-content">
    <label class="loging-label1">Pet ID</label>
    <input type="text" name="owner_id" placeholder="owner ID">
</div> -->
<div class="form-content">
    <label class="loging-label1">Preferred Doctor</label>
    <input type="text" name="owner_id" placeholder="owner ID">
</div>
<div class="form-content">
    <label class="loging-label1">Preferred day of appointment</label>
    <select id="date" name="date" required>
			<option value="">Select a date...</option>
		</select>
</div>
<div class="form-content">
    <label class="loging-label1">Preferred time of appointment</label>
    <select id="time" name="time" required>
			<option value="">Select a time...</option>
		</select>
</div>

<p>
    <button class="btn-login" type="submit">Confirm</button>
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


