<?php
session_start();
unset($_SESSION["user_name"]);
unset($_SESSION["emp_id"]);
header("location:login.php");
?>