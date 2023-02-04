<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/makeapp.css">
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
           
                <p class="welcome">Make an Appointment</p>
                <p>Add the information about the appointment</p>
                <!-- <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="pet_id" placeholder="petID">
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">First Name</label>
                    <input type="text" name="pet_name" placeholder="name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Last Name</label>
                    <input type="text" name="pet_gender" placeholder="gender" required>
                    
                </div>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="date" name="pet_dob" placeholder="dob" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Phone</label>
                    <input type="text" name="pet_type" placeholder="type of pet" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Address</label>
                    <input type="text" name="pet_breed" placeholder="breed" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Pet ID</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Preferred Doctor</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Preferred day of appointment</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
                <div class="form-content">
                    <label class="loging-label1">Preferred time of appointment</label>
                    <input type="text" name="owner_id" placeholder="owner ID">
                </div>
               
                <p>
                    <button class="btn-login" type="submit">Confirm</button>
                    <!-- <button class="btn-exit" type="submit"><a href="./dashboard.php">Cancel</a></button> -->
                </p>
            </form>
        </div>

        <div class="right">
            <img class="image" src="images/Makeapp.png" alt="image">
        </div>

    </div>

</body>

</html>