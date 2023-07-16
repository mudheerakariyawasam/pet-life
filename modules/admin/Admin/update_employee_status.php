<?php
    include("../../../db/dbconnection.php");
    session_start();
?>
<html>
<head>
</head>
<body>
<?php
    // Check if emp_id and working_status are set in the POST array
    if (isset($_POST['emp_id']) && isset($_POST['working_status'])) {
        // Sanitize the inputs to prevent SQL injection attacks
        $empId = mysqli_real_escape_string($conn, $_POST['emp_id']);
        $workingStatus = mysqli_real_escape_string($conn, $_POST['working_status']);

        // Construct the update query with a CASE statement to update the column with the string "enable" or "disable" instead of the integer 1 or 0
        $sql = "UPDATE employee SET working_status = CASE WHEN '$workingStatus' = '1' THEN 'enable' WHEN '$workingStatus' = '0' THEN 'disable' ELSE working_status END WHERE emp_id='$empId'";
        if (mysqli_query($conn, $sql)) {
            echo "Employee status updated successfully.";
        } else {
            echo "Error updating employee status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
    }

?>




</body>
</html>
