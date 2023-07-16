<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    } 
    
    if (isset($_POST['medicine_id']) && isset($_POST['medicine_status'])) {
        // Sanitize the inputs to prevent SQL injection attacks
        $medicine_id = mysqli_real_escape_string($conn, $_POST['medicine_id']);
        $medicine_status = mysqli_real_escape_string($conn, $_POST['medicine_status']);

        // Construct the update query with a CASE statement to update the column with the string "enable" or "disable" instead of the integer 1 or 0
        $sql = "UPDATE medicine SET medicine_status = CASE WHEN '$medicine_status' = '1' THEN 'Available' WHEN '$medicine_status' = '0' THEN 'Deleted' ELSE medicine_status END WHERE medicine_id='$medicine_id'";
        if (mysqli_query($conn, $sql)) {
            if($result) { 
                //delete batches
                $sql_deletebatch = "UPDATE batch SET batch_status='Deleted' WHERE medicine_id='$medicine_id'";
                $result_deletebatch = mysqli_query($conn,$sql_deletebatch);
                if($result_deletebatch) { 
                    echo "Medicine deleted successfully.";
                    header("location: viewallmedicine.php");
                }
            }else {
                echo "There is an error in deleting!";
            }    
        } else {
            echo "Error Deleting: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
    }
 ?>
