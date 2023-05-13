<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inquiry.css">
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
                <a href="treatment.php" ><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
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
                <a href="inquiry.php" class="active"><i class="fa fa-user"></i><span>Inquiries</span></a>
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


           
        </div>


        </div>
</div>
<div class="clear"></div>


<div class="home-section">



</div>

<div classs="clear"></div>

<div class="contactus">

<div class="continfo">
<div class="continfo-left">

<h3>Pet Life</h3>

<ul>
<li><i class="fa-solid fa-location-dot"></i><span>3131 E, Thomas Road, Phoenix, <br/>AZ 85016</span></li><br/>
<li><i class="fa-solid fa-phone-volume"></i><span>071 7892 902/ 071 1782 901</span></li><br/>
<li><i class="fa-sharp fa-solid fa-earth-americas"></i><span>petlifecolombo.lk</span></li>

</ul>
<br/>
<h4>Office Hours</h4>
<ul>
    <li><div class="dateandtime"><div class="date">Monday</div><div class="time">8.00am - 5.00pm</div></div></li>
    <li><div class="dateandtime"><div class="date">Tuesday</div><div class="time">8.00am - 5.00pm</div></div></li>
    <li><div class="dateandtime"><div class="date">Wednesday</div><div class="time">8.00am - 5.00pm</div></div></li>
    <li><div class="dateandtime"><div class="date">Thursday</div><div class="time">8.00am - 5.00pm</div></div></li>
    <li><div class="dateandtime"><div class="date">Friday</div><div class="time">8.00am - 5.00pm</div></div></li>
    <li><div class="dateandtime"><div class="date">Saturday</div><div class="time">8.00am - 5.00pm</div></div></li>
    <li><div class="dateandtime"><div class="date">Sunday</div><div class="time">8.00am - 5.00pm</div></div></li>
    
</ul>

</div>

<div class="continfo-right">
<h3>Keeping your pet well doesn't have to be hard (or expensive)</h3> 
<h1>SIGN UP FOR OUR VIP PROGRAMS!</h1>
<center><button> <a href="daycare.php">Register Now ...</a></button></center>
</div>

</div>



</div>







<!-- <div classs="clear"></div>
<div class="footer">
    <br/><br/>
<div class="about-us">
    <div class="about">
<p class="title">About Us</p>
<hr/>
<p>Lorem ipsum dolor sit consectetur.<br/>
Vitae in bibendum posuere nec sed. urna sed.<br/>
Pellentesque eget faucibus tri aliquam pharetra.<br/>
 Viverra pharetra purus rhoncus tellultrices sapien.<br/>
etiam vitae. Aliquet enim quam et vel.<br/>
Nibh vitae semper ua bibendu.
</p>
<br/>
<p>Read More.........</p>



    </div>
    <div class="ulinks">
    <p class="title">useful Links</p>
<hr/>
<ul>
<li>Home</li>
<hr>
<li>About Us</li>
<hr>
<li>VIP Programs</li>
<hr>
<li>Services</li>
<hr>
<li>Pet Store</li>
<hr>
<li>Contact Us</li><br/>


</ul>

    </div>
    <div class="gitouch">
    <p class="title">Get In Touch</p>
<hr/>
<ul>
<li><i class="fa-solid fa-location-dot"></i><span>Galle Rd, Colombo</span></li><br/>
<li><i class="fa-solid fa-phone-volume"></i><span>94 7178992 902/ +94 71178992 901</span></li><br/>
<li><i class="fa-solid fa-envelope"></i><span>petlife.lk</span></li><br/>



</ul>

    </div>
</div>

</div> -->
      
        <script src="script.js"></script>

</body>

</html>