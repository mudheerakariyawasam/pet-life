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

    // get the highest pet ID currently in use
    $sql_get_id = "SELECT MAX(appointment_id) AS max_id FROM appointment";
    $result_get_id = mysqli_query($conn, $sql_get_id);
    $row = mysqli_fetch_assoc($result_get_id);
    $max_id = $row['max_id'];

    // generate the new pet ID
    if ($max_id === null) {
        $appointment_id = "A001";
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
        $time_slot=$_POST['time_slot'];

        //get the appointment slot no
        $sql_getappointmentcount = "SELECT COUNT(*) FROM appointment WHERE appointment_date = '$date'";
        $result_getappointmentcount = mysqli_query($conn, $sql_getappointmentcount);
        $row_getappointmentcount = mysqli_fetch_array($result_getappointmentcount);
        $count = $row_getappointmentcount[0] + 1;

        // Get the last appointment's slot ID for the chosen date
        $sql_get_slot_id = "SELECT appointment_slot FROM appointment WHERE appointment_date = '$date' ORDER BY appointment_id DESC LIMIT 1";
        $result_get_slot_id = mysqli_query($conn, $sql_get_slot_id);
        $row_get_slot_id = mysqli_fetch_assoc($result_get_slot_id);
        $last_slot_id = $row_get_slot_id['appointment_slot'];

    // Increment the slot ID or reset it for a new day
    if ($count <= 5 && $last_slot_id !== null) {
        $new_slot_id = ++$last_slot_id;
    } else {
        $new_slot_id = 1;
    }

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
        $sqlc="SELECT * FROM `holiday` WHERE `emp_id`= '$emp_id' AND `approval_stage`= 'Approved'  AND `from_date` <= '$date' AND `to_date`>= '$date'";
        $r=mysqli_query($conn,$sqlc);
        $r1=mysqli_num_rows($r);
        
    if($r1>0) {
        echo"<script>alert('Doctor on leave')</script>";
        echo "<script>window.location.href = 'makeapp.php';</script>";
        exit();
    } else {

        $sql_time="SELECT * FROM appointment WHERE appointment_date = '$date' AND appointment_time = '$time_slot' AND appointment_status != 'Cancelled'
        ";
        $r3=mysqli_query($conn,$sql_time);
        $r_3=mysqli_num_rows($r3); 
        if($r_3>0) {
            echo"<script>alert('Time Slot Already taken')</script>";
            echo "<script>window.location.href = 'makeapp.php';</script>";
        exit();
        } else {

        //check duplicate entry
        $sql_duplicate="SELECT * FROM `appointment` WHERE `appointment_date`='$date' AND `pet_id` = '$pet_id' AND appointment_status != 'Cancelled'";
        $r2=mysqli_query($conn,$sql_duplicate);
        $r_2=mysqli_num_rows($r2); 
        if($r_2>0) {
            echo"<script>alert('Pet already Booked')</script>";
            echo "<script>window.location.href = 'makeapp.php';</script>";
            exit();
        } else {
            
            // //create a new appointment
            // $sql = "INSERT INTO appointment VALUES ('$appointment_id','$date','$time_slot','$new_slot_id','$emp_id','$pet_id','Available')";
            // $result = mysqli_query($conn, $sql);
    
            // if ($result == TRUE) {
            //     echo '<script>alert("Your appointment slot is booked")</script>';
            //     header("location:viewapp.php");

            // } else {
            //     echo '<script>alert("There is an error in booking")</script>';
            // }

            echo "<script>window.location.href = 'payhere_homepage.php?appointment_id=$appointment_id&date=$date&time_slot=$time_slot&new_slot_id=$new_slot_id&emp_id=$emp_id&pet_id=$pet_id';</script>";

        } 
} 
    }   
}
?> 

<html>
    <head></head>
    <body><script src="script.js"></script></body>
    
</html>

