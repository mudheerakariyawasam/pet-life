<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM 'pet_owner' WHERE id=$id";
    $clients = mysqli_query($conn, $sql);

    if ($clients) {
        // echo "Deleted successfully!";
        header('location:showclients.php');
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>