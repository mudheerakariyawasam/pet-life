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
$new_slot_id=$_GET["new_slot_id"];
$emp_id=$_GET["emp_id"];
$pet_id=$_GET["pet_id"];



    //create a new appointment
    $sql = "INSERT INTO appointment VALUES ('$appointment_id','$date','$time_slot','$new_slot_id','$emp_id','$pet_id','Pending')";
    $result = mysqli_query($conn, $sql);

    if ($result == TRUE) {
        echo '<script>alert("Your appointment slot is booked")</script>';
        header("location:viewapp.php");

    } else {
        echo '<script>alert("There is an error in booking")</script>';
    }

?> 