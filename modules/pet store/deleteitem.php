<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
    if (isset($_GET['item_id'])) {
        
        $item_id = $_GET['item_id'];
        $sql = "UPDATE pet_item SET item_status='Deleted' WHERE item_id='$item_id'";
        $result = mysqli_query($conn,$sql);
             
        if($result) { 
            echo "<script>Swal.fire(\"Deleted Successfully\");</script>";
            header("location: viewallitems.php");
        }else {
            echo "There is an error in adding!";
        } 
    }    
 ?>
