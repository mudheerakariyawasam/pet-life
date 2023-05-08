<?php
    include("../../../db/dbconnection.php");
    session_start();
?>
<html>
<head>
</head>
<body>
<?php
    // Check if owner_id and active_status are set in the POST array
    if (isset($_POST['owner_id']) && isset($_POST['active_status'])) {
        // Sanitize the inputs to prevent SQL injection attacks
        $ownerId = mysqli_real_escape_string($conn, $_POST['owner_id']);
        $activeStatus = mysqli_real_escape_string($conn, $_POST['active_status']);

        // Construct the update query with a CASE statement to update the column with the string "enable" or "disable" instead of the integer 1 or 0
        $sql = "UPDATE pet_owner SET active_status = CASE WHEN '$activeStatus' = '1' THEN 'activated' WHEN '$activeStatus' = '0' THEN 'deactivated' ELSE active_status END WHERE owner_id='$ownerId'";
        if (mysqli_query($conn, $sql)) {
            echo "Client status updated successfully.";
        } else {
            echo "Error updating client status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
    }

?>




</body>
</html>
