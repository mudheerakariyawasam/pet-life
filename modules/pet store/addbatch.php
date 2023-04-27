<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }

    $sql_get_id="SELECT batch_id FROM batch ORDER BY batch_id DESC LIMIT 1";
    $result_get_id=mysqli_query($conn,$sql_get_id);
    $row=mysqli_fetch_array($result_get_id);

    $lastid="";
                    
    if(mysqli_num_rows($result_get_id)>0){
        $lastid=$row['batch_id'];
    }

    if($lastid==""){
        $batch_id="B001";
    }else {
        $batch_id=substr($lastid,3);
        $batch_id=intval($batch_id);

        if($batch_id>='9'){
            $batch_id="B0".($batch_id+1);
        } else if($batch_id>='99'){
            $batch_id="B".($batch_id+1);
        }else{
            $batch_id="B00".($batch_id+1);
        }
    }

    //insert new batch

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    
        //checking only numbers

        if(!(is_numeric($_POST['batch_qty'])) || $_POST['batch_qty']<0){
            echo '<script>alert("Please enter a valid  quantity!")</script>';
        }else if(!(is_numeric($_POST['batch_price'])) || $_POST['batch_price']<0){
            echo '<script>alert("Please enter a valid price!")</script>';
        }else{
            $medicine_id=$_POST['medicine_id'];
            $batch_qty=$_POST['batch_qty'];
            $batch_price=$_POST['batch_price'];
            $batch_expdate=$_POST['batch_expdate'];
            $batch_mfddate=$_POST['batch_mfddate'];

            $sql = "INSERT INTO batch VALUES ('$batch_id','$medicine_id','$batch_qty','$batch_price','$batch_expdate','$batch_mfddate')";
            $result = mysqli_query($conn,$sql);
            
            if($result==TRUE) { 
                header("location: viewallmedicine.php");
            }else {
                $error = "There is an error in adding!";
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
    <title>Document</title>
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
        
            <p class="topic">Add New Batch</p><hr><br>
        
            <form method="POST" >
                <label><b>Batch ID : </label> 
                <label class="item-id" name="batch_id" ><?php echo $batch_id;?></b><br><br>
                <label>Medicine ID</label><br>
                <select id='medicine_id' name='medicine_id' class='dropdown-list'>
                <?php
                    
                    //get the medicine IDs from the sql table
                    $sql_mid="SELECT medicine_id FROM medicine order by medicine_id"; 

                    $result_getdata = $conn->query($sql_mid);
                    if($result_getdata->num_rows> 0){
                        while($optionData=$result_getdata->fetch_assoc()){
                        $option =$optionData['medicine_id'];
                    ?>
                    <?php
                        //selected option
                        if(!empty($medicine_id) && $medicine_id== $option){
                        // selected option
                    ?>
                    <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                    <?php 
                        continue;
                    }?>
                    <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                    <?php
                        }}
                    ?>
                </select><br>
                <label>Qty</label><br>
                <input type="text" name="batch_qty" placeholder="Batch Qty"><br>
                <label>Price</label><br>
                <input type="text" name="batch_price" placeholder="Batch Price"><br>
                <label>Batch Exp Date</label><br>
                <input type="date" name="batch_expdate" placeholder="Batch Exp Date" min="<?= date('Y-m-d'); ?>"><br>
                <label>Batch Mfd Date</label><br>
                <input type="date" name="batch_mfddate" placeholder="Batch Mfd Date"><br>

                <button class="btn-add" type="submit">Add </button>
                <a class="btn-exit" href="viewallmedicine.php">Exit</a>     
            </form> 
        </div>
    </div>
    
    </div>
</body>
</html>