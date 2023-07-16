<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');
    if(!isset($_SESSION["login_user"])){
        header("location:../../../Auth/login.php");
        exit;
    }

$treatment_id=$_GET["treatment_id"];

//get details related to appointment
$sql_getdata="SELECT * FROM treatment WHERE treatment_id='$treatment_id'";
$result_getdata=mysqli_query($conn,$sql_getdata);
$row_getdata=mysqli_fetch_assoc($result_getdata);

$pet_id=$row_getdata["pet_id"];
$vet_id=$row_getdata["vet_id"];
$treatment_date=$row_getdata["treatment_date"];

//get appointment ID related to the treatment
$sql_appid="SELECT * FROM appointment WHERE pet_id='$pet_id' AND vet_id='$vet_id' AND treatment_date='$treatment_date'";
$result_appid=mysqli_query($conn,$sql_appid);
$row_appid=mysqli_fetch_assoc($result_appid);
$appointment_id=$row_appid["appointment_id"];

    //create a new appointment
    $sql = "UPDATE appointment SET appointment_status='Completed' WHERE appointment_id='$appointment_id'";
    $result = mysqli_query($conn, $sql);

    if ($result == TRUE) {
        echo '<script>alert("Your appointment slot is booked")</script>';
        header("location:treatment_history.php");

    } else {
        echo '<script>alert("There is an error in booking")</script>';
    }

?> 