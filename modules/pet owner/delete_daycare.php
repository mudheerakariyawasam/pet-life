<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
session_start();

//cancelling a holiday request
if(isset($_POST['daycare_id'])) {
    $daycare_id = $_POST['daycare_id'];
    $sql_deleteholiday = "UPDATE daycare SET daycare_status='Canceled' WHERE daycare_id='$daycare_id'";
    $result_deleteholiday = mysqli_query($conn, $sql_deleteholiday);
    
    if($result_deleteholiday) {
        echo '<script>alert("Holiday deleted successfully!");</script>';
        echo '<script>window.location.href = "daycare.php";</script>';

    } else {
        echo '<script>alert("Error deleting daycare appointment!");</script>';
    }
}
?>