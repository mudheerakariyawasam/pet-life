<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <title>Logout</title>
</head>

<body>
</body>

</html>
<?php
session_start();

if(isset($_SESSION['user_name'])){
    echo "<script type='text/javascript'>
    toastr.options.positionClass = 'toast-top-center';
    toastr.success(' " . $_SESSION['user_name'] ."  ');
    </script>";
}
session_destroy();

header('Location: /pet-life/Auth/login.php?logout=true');
?>