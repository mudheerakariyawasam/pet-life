<?php
$$appointment_id=$_GET['appointment_id'];
$date=$_GET['date'];
$time_slot=$_GET['time_slot'];
$new_slot_id=$_GET['new_slot_id'];
$emp_id=$_GET['emp_id'];
$pet_id=$_GET['pet_id'];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payment.css">
    <title></title>
</head>

<body>
    <div class="body">
        <!-- button  -->
        <div class="save-btn">
            <button onclick="paymentGateWay($appointment_id,$date,$time_slot,$new_slot_id,$emp_id,$pet_id);" class="button-01" name="save-info" id="btn-save" type="submit"
                role="button">Pay Here</button>
        </div>
    </div>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>