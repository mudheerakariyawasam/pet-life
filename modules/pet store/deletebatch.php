<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
    if (isset($_GET['batch_id'])) {
        
        $batch_id = $_GET['batch_id'];
        $sql = "UPDATE batch SET batch_status='Deleted' WHERE batch_id='$batch_id'";
        $result = mysqli_query($conn,$sql);
             
        if($result) { 
            echo "<script>Swal.fire(\"Deleted Successfully\");</script>";
            header("location: viewallbatch.php");
        }else {
            echo "There is an error in deleting!";
        } 
    }    
 ?>
