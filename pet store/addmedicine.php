<?php
   include("dbconnection.php");
   include("header.php");
   
   session_start();
    $sql_get_id="SELECT medicine_id FROM medicine ORDER BY medicine_id DESC LIMIT 1";
    $result_get_id=mysqli_query($conn,$sql_get_id);
    $row=mysqli_fetch_array($result_get_id);

    $lastid="";
                    
    if(mysqli_num_rows($result_get_id)>0){
        $lastid=$row['medicine_id'];
    }

    if($lastid==""){
        $medicine_id="M001";
    }else {
        $medicine_id=substr($lastid,3);
        $medicine_id=intval($medicine_id);

        if($medicine_id>='9'){
            $medicine_id="M0".($medicine_id+1);
        } else if($medicine_id>='99'){
            $medicine_id="M".($medicine_id+1);
        }else{
            $medicine_id="M00".($medicine_id+1);
        }
    }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
        $medicine_name=$_POST['medicine_name'];
        $medicine_brand=$_POST['medicine_brand'];
        $medicine_category=$_POST['medicine_category'];
        $medicine_usage=$_POST['medicine_usage'];
        
        $sql = "INSERT INTO medicine VALUES ('$medicine_id','$medicine_name','$medicine_brand','$medicine_category','$medicine_usage')";
        $result = mysqli_query($conn,$sql);
        
        if($result==TRUE) { 
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
    <link rel="stylesheet" href="css/navbar.css">
    <title>Add New Medicine</title>
</head>
<body>
    <div class="main-container">
        
    <div class="navbar">
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="viewallitems.php">Pet Items</a></li>
                <li><a class="active" href="viewallmedicine.php">Medicine</a></li>
                <li><a href="#">Leave Requests</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
             
        <div class="container">
        <div class="content">
            <span class="pet-item">MEDICINE</span>
            <br>
            <span class="main-topic">Add New Medicine</span>
            <span class="sub-topic">Add the information about the medicine</span>
            <br>
            
            <form method="POST">
                <label><b>Item ID : </label> 
                <label class="item-id" name="medicine_id" ><?php echo $medicine_id;?></b><br><br>
                <label>Medicine Name</label><br>
                <input type="text" name="medicine_name" placeholder="Medicine Name"><br>
                <label>Medicine Brand</label><br>
                <input type="text" name="medicine_brand" placeholder="Medicine Brand"><br>
                <label>Category</label><br>
                <div class="dropdown-list" style="width:200px;">
                    <select name="medicine_category" >
                        <option value="Pet Food">Pet Food</option>
                        <option value="Sleeping Items">Sleeping Items</option>
                        <option value="Collars">Collars</option>
                        <option value="Toys">Toys</option>
                        <option value="Combs">Toys</option>
                        <option value="Food Bowls">Food Bowls</option>
                        <option value="Other">Other</option>
                    </select><br><br>
                </div>
                <label>Medicine Usage</label><br>
                <input type="text" name="medicine_usage" placeholder="Medicine Usage"><br>

                <button class="btn-add" type="submit">Add </button>
                <a class="btn-exit" href="viewallmedicine.php">Exit</a>
                
            </form> 

        </div>
    </div>


    </div>
</body>
</html>