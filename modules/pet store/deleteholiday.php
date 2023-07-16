<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
session_start();

//cancelling a holiday request
if(isset($_POST['holiday_id'])) {
    $holiday_id = $_POST['holiday_id'];
    $sql_deleteholiday = "DELETE FROM holiday WHERE holiday_id='$holiday_id'";
    $result_deleteholiday = mysqli_query($conn, $sql_deleteholiday);
    
    if($result_deleteholiday) {
        echo '<script>alert("Holiday deleted successfully!");</script>';
        echo '<script>window.location.href = "leaverequest.php";</script>';

    } else {
        echo '<script>alert("Error deleting holiday!");</script>';
    }
}
?>