<?php
   include("dbconnection.php");

   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $pet_id = $_POST['pet_id'];
        $pet_name = $_POST['pet_name'];
        $pet_gender=$_POST['pet_gender'];
        $pet_dob=$_POST['pet_dob'];
        $pet_type=$_POST['pet_type'];
        $pet_breed=$_POST['pet_breed'];
        $owner_id=$_POST['owner_id'];
 
        $sql = "INSERT INTO pet VALUES ('$pet_id','$pet_name','$pet_gender','$pet_dob','$pet_type','$pet_breed','$owner_id')";
        $result = mysqli_query($conn,$sql);
        
        if($result==TRUE) { 
            header("location: viewpet.php");
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
    <link rel="stylesheet" href="css/addpet.css">
    <title>Document</title>
</head>

<body>

<div class="topic">
        <span class="welcome">Welcome</span>
        <span class="name">NAME</span>
        <button type="submit" class="notification"><img src="images/bell.png"></button>
        <button type="submit" class="messages"><img src="images/message-square.png"></button>
        <button type="submit" class="logout">logout</button>
    </div>

    <div class="container">

        <div class="left">
            <form method="POST">
            <?php
                
                $sql_get_id="SELECT pet_id FROM pet ORDER BY pet_id DESC LIMIT 1";
                $result_get_id=mysqli_query($conn,$sql_get_id);
                $row=mysqli_fetch_array($result_get_id);
            
                $lastid="";
                                
                if(mysqli_num_rows($result_get_id)>0){
                    $lastid=$row['pet_id'];
                }
            
                if($lastid==""){
                    $id="I001";
                }else {
                    $pet_id=substr($lastid,3);
                    $pet_id=intval($pet_id);
            
                    if($pet_id>='9'){
                        $pet_id="I0".($pet_id+1);
                    } else if($pet_id>='99'){
                        $pet_id="I".($pet_id+1);
                    }else{
                        $pet_id="I00".($pet_id+1);
                    }
                }
                            ?>
                <p class="welcome">Register your pet here</p>
                <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="pet_id" placeholder="petID" value="<?php echo $pet_id?>" disabled>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet's Name</label>
                    <input type="text" name="pet_name" placeholder="name">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet gender</label>
                    <input type="text" name="pet_gender" placeholder="gender">
                    
                </div>
                <div class="form-content">
                    <label class="loging-label1">Date of birth</label>
                    <input type="date" name="pet_dob" placeholder="dob">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Type</label>
                    <input type="text" name="pet_type" placeholder="type of pet">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Breed</label>
                    <input type="text" name="pet_breed" placeholder="breed">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="owner_id" placeholder="ID">
                </div>
                <p>
                    <button class="btn-login" type="submit">Register</button>
                    <button class="btn-exit" type="submit">Cancel</button>
                </p>
            </form>
        </div>

        <div class="right">
            <img class="image" src="images/addpet.png" alt="image">
        </div>

    </div>

</body>

</html>