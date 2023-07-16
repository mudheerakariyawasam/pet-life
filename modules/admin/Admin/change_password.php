<?php
  include("../../../db/dbconnection.php");
    session_start();
    if(!isset($_SESSION["employee_id"])){
        header("location:../../../../../Auth/login.php");
        exit;
}

// Get current password from database
$employee_id = $_SESSION['employee_id'];
$current_password_query = "SELECT emp_pwd FROM employee WHERE emp_id = $employee_id";
$current_password_result = mysqli_query($conn, $current_password_query);
$current_password_row = mysqli_fetch_assoc($current_password_result);
$current_password = $current_password_row['emp_pwd'];

// Get new password from form
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Check if current password matches
if ($_POST['current_password'] != $current_password) {
  echo "Current password is incorrect.";
  exit();
}

// Check if new password and confirm password match
if ($new_password != $confirm_password) {
  echo "New password and confirm password do not match.";
  exit();
}

// Update password in database
$update_password_query = "UPDATE employee SET emp_pwd = '$new_password' WHERE emp_id = $employee_id";
$update_password_result = mysqli_query($conn, $update_password_query);

if ($update_password_result) {
  echo "Password updated successfully.";
} else {
  echo "Error updating password.";
}
?>