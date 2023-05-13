<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    } 
    
    if (isset($_POST['item_id']) && isset($_POST['item_status'])) {
        // Sanitize the inputs to prevent SQL injection attacks
        $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
        $item_status = mysqli_real_escape_string($conn, $_POST['item_status']);

        // Construct the update query with a CASE statement to update the column with the string "enable" or "disable" instead of the integer 1 or 0
        $sql = "UPDATE pet_item SET item_status = CASE WHEN '$item_status' = '1' THEN 'Available' WHEN '$item_status' = '0' THEN 'Deleted' ELSE item_status END WHERE item_id='$item_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Item deleted successfully.";
        } else {
            echo "Error Deleting: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
    }
 ?>
