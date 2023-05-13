<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');



$_SESSION['change_password_error'] = ""; // Initialize error message variable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = mysqli_real_escape_string($conn, $_POST['oldpass']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newpass']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['cnewpass']);

    // Retrieve the employee's current password from the database
    $owner_email = $_SESSION['login_user'];

    $query = "SELECT owner_pwd FROM pet_owner WHERE owner_email='$owner_email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    print_r($row[0]);

    $currentHashedPassword = $row[0];

    // Verify the current password
    if (md5($oldPassword) === $currentHashedPassword) {
        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Generate the hashed password
            $newHashedPassword = md5($newPassword);

            // Update the owner's password in the database
            $updateQuery = "UPDATE pey_owner SET owner_pwd='$newHashedPassword' WHERE owner_email='$owner_email'";
            mysqli_query($conn, $updateQuery);

            // Redirect to the updateprofile.php file with the error message as a query parameter
            header("Location: profile.php?password_changed=true&error=" . urlencode($errorMsg));
            exit();

        } else {
            $_SESSION['change_password_error'] = "New password and confirm password do not match.";
            header("Location: profile.php");
        }
    } else {
        $_SESSION['change_password_error']= "Incorrect current password.";
        header("Location: profile.php");
    }
}
?>