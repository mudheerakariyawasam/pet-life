<?php
    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }

    $appointment_id=$_GET["appointment_id"];
    $date=$_GET["date"];
    $time_slot=$_GET["time_slot"];
    $urgency=$_GET["urgency"];
    $new_slot_id=$_GET["new_slot_id"];
    $emp_id=$_GET["emp_id"];
    $pet_id=$_GET["pet_id"];
   

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payhere.css">
    <title></title>
</head>

<body>
<section>
    
        <div class="imgbox">
            <img src="images/pay.jpg" id="reset">
        </div>
        <div class="body">
            
            <div class="title"><h1 class="welcome">You are one step closer to book your appointment.</h1>
            <h2 class="welcome">For Bookings :</h2>
            <h2 class="welcome">Rs. 500/= only</h2>

    
            <p><i>**Please note that this fee will be non-refundable in case of a cancellation from your end.</i></p>
    
        <!-- button  -->
        <div class="save-btn">
            <button onclick="paymentGateWay('<?php echo $appointment_id; ?>','<?php echo $date; ?>','<?php echo $time_slot; ?>','<?php echo $urgency; print_r($urgency)?>','<?php echo $new_slot_id; ?>','<?php echo $emp_id; ?>','<?php echo $pet_id; ?>');" class="button-01" name="save-info" id="btn-save" type="submit"
                role="button">Pay Here</button>
                     
              </div>
        
    </div>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>