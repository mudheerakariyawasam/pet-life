<?php
include("dbconnection.php");
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location:login.php");
    exit;
}

//Get the total no of items in the database

$sql_total = "SELECT COUNT(*) AS total FROM appointment";
$result_total = mysqli_query($conn, $sql_total);
$row = mysqli_fetch_array($result_total);
$total = "";

if (mysqli_num_rows($result_total) > 0) {
    $total = $row['total'];

} else {
    $total = "0";
}

$sql_total1 = "SELECT COUNT(*) AS total FROM pet";
$result_total1 = mysqli_query($conn, $sql_total1);
$row = mysqli_fetch_array($result_total1);
$total1 = "";

if (mysqli_num_rows($result_total1) > 0) {
    $total1 = $row['total'];

} else {
    $total1 = "0";
}

$sql_total2 = "SELECT COUNT(*) AS total FROM treatment";
$result_total2 = mysqli_query($conn, $sql_total2);
$row = mysqli_fetch_array($result_total2);
$total2 = "";

if (mysqli_num_rows($result_total2) > 0) {
    $total2 = $row['total'];

} else {
    $total2 = "0";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Document</title>
</head>

<body>



    <div class="topic">
        <span class="welcome">Welcome </span>
        <span class="name">NAME</span>
        <button type="submit" class="notification"><img src="images/bell.png"></button>
        <button type="submit" class="messages"><img src="images/message-square.png"></button>
        <button type="submit" class="logout"><a href="./logout.php">logout</a></button>
    </div>

 

    <div class="container">

 <div class="nav_bar">
        <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Treatments</a></li>
            <li><a href="#">Vaccinations</a></li>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">VIP Programmes</a></li>
            <li><a href="#">Pet Shop</a></li>
            <li><a href="#">Inquiries</a></li>
        </ul>
    </div>
    
        <div class="summary-1">
       
            <div class="summary-content  total-items">
                <a href="appointment.php">
                    <span class="tot">Your Upcoming Appointments</span><br>
                    <span class="number">
                        <?php echo $total; ?>
                    </span>
                    <div><img class="shopping-cart" src="images/shopping-bag.png"></div>
                </a>
            </div>

            <div class="summary-content low-stock">
                <span class="tot">Your Registered Pets</span>
                <span class="number">
                    <?php echo $total1; ?>
                </span>
                <div><button class="shopping-cart"><a href="./addpet.php">Register Here</a></div>
            </div>

            <div class="summary-content out-of-stock">
                <span class="tot">Treatment Records</span>
                <span class="number">
                    <?php echo $total2 ?>
                </span>
                <div><img class="shopping-cart" src="images/shopping-bag.png"></div>
            </div>
        </div>
    </div>


</body>

</html>


</body>

</html>