<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/updatepr.css">
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
            <form method="POST" action="">
                <p class="welcome">Update your profile here</p>

                <!-- <div class="form-content">
                    <label class="loging-label1">Owner ID</label>
                    <input type="text" name="owner_id" placeholder="Owner ID" required>
                </div> -->
                <div class="form-content">
                    <label class="loging-label1">First Name</label>
                    <input type="text" name="owner_fname" placeholder="first name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Last Name</label>
                    <input type="text" name="owner_lname" placeholder="last name" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Email</label>
                    <input type="email" name="owner_email" placeholder="email" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Phone</label>
                    <input type="number" name="owner_contactno" placeholder="phone" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Address</label>
                    <input type="text" name="owner_address" placeholder="address" required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">NIC</label>
                    <input type="text" name="owner_nic" placeholder="NIC"required>
                </div>
                <div class="form-content">
                    <label class="loging-label1">Password</label>
                    <input type="password" name="owner_pwd" placeholder="password"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"
                        required>
                </div>

                <p>
                    <button class="btn-login" type="submit">update</button>
                    <button class="btn-exit" type="submit"><a href="./home.php">Cancel</a></button>
                </p>
            </form>

            <!-- <span class="psw">Already have an account? <a href="./login.php">Login</a></span> -->
        </div>

        <div class="right">
            <img class="image" src="./images/register.png" alt="image">
        </div>

    </div>

</body>

</html>