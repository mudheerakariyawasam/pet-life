<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/updatepp.css">
    <title>Document</title>
</head>

<body>

<div class="topic">
        <span class="welcome">Welcome</span>
        <span class="name">Fathima</span>
        <button type="submit" class="notification"><a href="#"><img src="images/bell.png"></a></button>
        <button type="submit" class="messages"><a href="#"><img src="images/message-square.png"></a></button>
        <button type="submit" class="logout"><a href="./logout.php">logout</a></button>
    </div>

    <div class="container">

        <div class="left">
            <form method="POST">
           
                <p class="welcome">Update your PetProfile here</p>
                <!-- <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="pet_id" placeholder="petID">
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">Pet's Name</label>
                    <input type="text" name="pet_name" placeholder="name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet gender</label>
                    <input type="text" name="pet_gender" placeholder="gender" required>
                    
                </div>
                <div class="form-content">
                    <label class="loging-label1">Date of birth</label>
                    <input type="date" name="pet_dob" placeholder="dob" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Type</label>
                    <input type="text" name="pet_type" placeholder="type of pet" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Breed</label>
                    <input type="text" name="pet_breed" placeholder="breed" required>
                </div>
                <!-- <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div> -->
               
                <p>
                    <button class="btn-login" type="submit">Update</button>
                    <!-- <button class="btn-exit" type="submit"><a href="./dashboard.php">Cancel</a></button> -->
                </p>
            </form>
        </div>

        <div class="right">
            <img class="image" src="images/addpet.png" alt="image">
        </div>

    </div>

</body>

</html>