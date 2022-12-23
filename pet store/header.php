<?php 
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <title></title>
</head>
<body>
    <div class="topic">
        <span class="welcome">Welcome </span>
        <span class="name"><?php echo $_SESSION['user_name'] ?></span>
        <button type="submit" class="notification"><img src="images/bell.png"></button>
        <button type="submit" class="messages"><img src="images/message-square.png"></button>
    </div>
</body>
</html>