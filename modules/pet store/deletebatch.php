<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    } 
    
    if (isset($_POST['batch_id']) && isset($_POST['batch_status'])) {
        // Sanitize the inputs to prevent SQL injection attacks
        $batch_id = mysqli_real_escape_string($conn, $_POST['batch_id']);
        $batch_status = mysqli_real_escape_string($conn, $_POST['batch_status']);

        // Construct the update query with a CASE statement to update the column with the string "enable" or "disable" instead of the integer 1 or 0
        $sql = "UPDATE batch SET batch_status = CASE WHEN '$batch_status' = '1' THEN 'Available' WHEN '$batch_status' = '0' THEN 'Deleted' ELSE batch_status END WHERE batch_id='$batch_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Batch deleted successfully.";
        } else {
            echo "Error Deleting: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
    }
 ?>
