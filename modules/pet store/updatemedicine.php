<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
    if (isset($_GET['medicine_id'])) {
        $medicine_id = $_GET['medicine_id'];
        $sql = "SELECT * FROM medicine WHERE medicine_id='$medicine_id'";    
        $result = mysqli_query( $conn,$sql);
        if( $result ){
            while( $row = mysqli_fetch_assoc( $result ) ){
                $medicine_name=$row["medicine_name"];
                $medicine_brand=$row["medicine_brand"];
                $medicine_category=$row["medicine_category"];
                $medicine_usage=$row["medicine_usage"];
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

             $medicine_name=$_POST['medicine_name'];
             $medicine_brand=$_POST['medicine_brand'];
             $medicine_category=$_POST['medicine_category'];
             $medicine_usage=$_POST['medicine_usage'];
     
             $sql = "UPDATE medicine SET medicine_name='$medicine_name',medicine_brand='$medicine_brand', medicine_category='$medicine_category', medicine_usage='$medicine_usage' WHERE medicine_id='$medicine_id'";
             $result = mysqli_query($conn,$sql);
             
             if($result==TRUE) { 
                echo "<script>Swal.fire(\"Added Successfully\");</script>";
                header("location: viewallmedicine.php");
             }else {
                 $error = "There is an error in adding!";
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
                <li><a class="active" href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
                <li><a href="viewallbatch.php"><i class="fa fa-stethoscope"></i><span>Batches</span></a></li>
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
            <div class="nav-icon">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="hello">
                <font class="header-font-1">Welcome </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
        </div>
    
        <div class="content" style="background-size: cover;
            background-position: center;
            height: 100vh;">
        
            <p class="topic">Update Medicine</p><hr><br>
        
            <form method="POST">
                <label><b>Medicine ID : </label> 
                <label class="item-id" name="item_id" ><?php echo $medicine_id;?></b><br><br>
                <label>Medicine Name</label><br>
                <input type="text" name="medicine_name" placeholder="Medicine Name" required value="<?php echo isset($medicine_name) ? $medicine_name : $row['medicine_name']; ?>"><br>
                <label>Medicine Brand</label><br>
                <input type="text" name="medicine_brand" placeholder="Medicine Brand" value="<?php echo isset($medicine_brand) ? $medicine_brand : $row['medicine_brand']; ?>" required><br>
                <label>Usage</label><br>
                <input type="text" name="medicine_usage" placeholder="Usage" value="<?php echo isset($medicine_usage) ? $medicine_usage : $row['medicine_usage']; ?>" required><br>
                <label>Category</label><br>
                <div class="dropdown-list" style="width:200px;">
                    <select name="medicine_category" class="dropdown-list">
                        <option value="medicine" <?php if(isset($medicine_category) && $medicine_category == 'medicine') echo 'selected'; ?>>medicine</option>
                        <option value="vaccine" <?php if(isset($medicine_category) && $medicine_category == 'vaccine') echo 'selected'; ?>>vaccine</option>
                    </select><br><br>
                </div>
                
                <button class="btn-add" type="submit">Update </button>
                <a class="btn-exit" href="viewallmedicine.php">Exit</a>    
            </form> 
        </div>
    </div>
    
    </div>
</body>
</html>