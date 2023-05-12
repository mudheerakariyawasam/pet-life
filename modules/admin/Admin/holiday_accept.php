<?php

include("../../../db/dbconnection.php");
    session_start();
$holilday_id=$_GET['holiday_id'];
// Update the approval_stage to "Approved"
$sql = "UPDATE holiday SET approval_stage = 'Approved' WHERE holiday_id = '$holilday_id'";
        
if (mysqli_query($conn, $sql)) {

    //get vet ID and requested dates
    // $sql_getv="SELECT * FROM holiday WHERE holiday_id='$holilday_id'";
    // $result_getv=mysqli_query($conn,$sql_getv);
    // $row_getv=mysqli_fetch_array($result_getv);

    //cancel already booked appointments
    //$sql_cancelapp="UPDATE appointment SET appointment_status='Canceled' WHERE vet_id='".$row_getv['emp_id']."'";
    // Refresh the page to see the updated holiday details
    header("location:leave.php");
} else {
    die("Error updating holiday details: " . mysqli_error($conn));
}  

?>