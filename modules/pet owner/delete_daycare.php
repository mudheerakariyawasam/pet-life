<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
session_start();

if(!isset($_SESSION["login_user"])){
    header("location:login.php");
    exit;
} 

//cancelling a holiday request

if(isset($_GET['daycare_id'])) {
    $daycare_id = mysqli_real_escape_string($conn, $_GET['daycare_id']);
    
    $sql = "UPDATE daycare SET daycare_status='Canceled' WHERE daycare_id='$daycare_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        echo '<script>alert("DayCare deleted successfully!");</script>';
        echo '<script>window.location.href = "daycare.php";</script>';

    } else {
        echo '<script>alert("Error deleting daycare appointment!");</script>';
    }
}else{
    echo "Invalid Request!";
}

?>