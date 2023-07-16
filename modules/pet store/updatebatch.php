<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
    if (isset($_GET['batch_id'])) {
        $batch_id = $_GET['batch_id'];
        $sql = "SELECT * FROM batch WHERE batch_id='$batch_id'";    
        $result = mysqli_query( $conn,$sql);
        if( $result ){
            while( $row = mysqli_fetch_assoc( $result ) ){
                $medicine_id=$row["medicine_id"];
                $batch_qty=$row["batch_qty"];
                $batch_price=$row["batch_price"];
                $batch_expdate=$row["batch_expdate"];
                $batch_mfddate=$row["batch_mfddate"];
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
 
         //checking only numbers
         if(!(is_numeric($_POST['batch_qty'])) || $_POST['batch_qty']<0){
             echo '<script>alert("Please enter a valid  quantity!")</script>';
         }else if(!(is_numeric($_POST['batch_price'])) || $_POST['batch_price']<0){
             echo '<script>alert("Please enter a valid price!")</script>';
         }else{
             $batch_qty=$_POST['batch_qty'];
             $batch_price=$_POST['batch_price'];
             $batch_expdate=$_POST['batch_expdate'];
             $batch_mfddate=$_POST['batch_mfddate'];
     
             $sql = "UPDATE batch SET batch_qty='$batch_qty',batch_price='$batch_price', batch_expdate='$batch_expdate', batch_mfddate='$batch_mfddate' WHERE batch_id='$batch_id'";
             $result = mysqli_query($conn,$sql);
             
             if($result==TRUE) { 
                echo "<script>Swal.fire(\"Updated Successfully\");</script>";
                header("location: viewallbatch.php");
             }else {
                echo "Error in Updating!";
             } 
         }
         
    }
     
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Pet Life</title>
</head>
<body>
    <div class="main-container">

    <!-- left side nav bar -->

    <div class="left-container">
        <div class="user-img">
            <center><img src="images/logo_transparent black.png"></center>
        </div>
        <ul>
                <li><a  href="dashboard.php"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                <li><a href="viewallitems.php"><i class="fa fa-paw"></i><span>Pet Items</span></a></li>
                <li><a href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
                <li><a class="active" href="viewallbatch.php"><i class="fa fa-stethoscope"></i><span>Batches</span></a></li>
                <li><a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a></li>
                <li><a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>        
    </div>
    
    
    <!-- right side container -->

    <div class="right-container">
    
        <div class="top-bar">
            
            <div class="hello">
                <font class="header-font-1">Welcome </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
        </div>
    
        <div class="content" style="background-size: cover;
            background-position: center;
            height: 100vh;">
        
            <p class="topic">Update Item</p><hr><br>
            <form method="POST" >
                <label><b>Batch ID : </label> 
                <label class="item-id" name="batch_id" ><?php echo $batch_id;?></b><br>
                <label>Medicine ID : </label>
                <label class="item-id" name="medicine_id" ><?php echo $medicine_id;?></b><br>
                <br>
                <label>Qty</label><br>
                <input type="text" name="batch_qty" placeholder="Batch Qty" value="<?php echo isset($batch_qty) ? $batch_qty : $row['batch_qty']; ?>" required><br>
                <label>Price</label><br>
                <input type="text" name="batch_price" placeholder="Batch Price" value="<?php echo isset($batch_price) ? $batch_price : $row['batch_price']; ?>" required><br>
                <label>Batch Exp Date</label><br>
                <input type="date" name="batch_expdate" placeholder="Batch Exp Date" min="<?= date('Y-m-d'); ?>" value="<?php echo isset($batch_expdate) ? $batch_expdate : $row['batch_expdate']; ?>" required><br>
                <label>Batch Mfd Date</label><br>
                <input type="date" name="batch_mfddate" placeholder="Batch Mfd Date" value="<?php echo isset($batch_mfddate) ? $batch_mfddate : $row['batch_mfddate']; ?>" required><br>

                <button class="btn-add" type="submit">Update </button>
                <a class="btn-exit" href="viewallmedicine.php">Exit</a>     
            </form> 
        </div>
    </div>
    
    </div>
</body>
</html>