<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    
    // Delete associated pet records from the pet table
    $deletePetsSql = "DELETE FROM pet WHERE owner_id = ?";
    $stmt = $conn->prepare($deletePetsSql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // If pet records were deleted successfully, proceed with deleting the owner record
        $deleteOwnerSql = "DELETE FROM pet_owner WHERE owner_id = ?";
        $stmt = $conn->prepare($deleteOwnerSql);
        $stmt->bind_param("s", $id);
        
        if ($stmt->execute()) {
            echo "Owner record and associated pet records deleted successfully!";
            // Perform any additional actions or redirections after successful deletion
        } else {
            echo "Error deleting owner record: " . $stmt->error;
        }
    } else {
        echo "Error deleting associated pet records: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
