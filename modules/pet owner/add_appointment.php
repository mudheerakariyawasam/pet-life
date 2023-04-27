<?php

    include("../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:../../Auth/login.php");
        exit;
    }

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

    // Get the chosen date from the AJAX request
    $date = $_POST['date'];

    // Count the number of appointments already booked on the chosen date
    $stmt = $dbh->prepare("SELECT COUNT(*) FROM appointment WHERE appointment_date = ?");
    $stmt->execute([$date]);
    $count = $stmt->fetchColumn();
    $count+=$count;
    

    // Insert a new appointment record into the database
    $stmt = $dbh->prepare("INSERT INTO appointment VALUES ('$appointment_id')");
    $stmt->execute([$date]);

    // Send a response back to the JavaScript function
    echo "Appointment booked for $date.";

?>
