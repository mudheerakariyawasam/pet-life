<?php
session_start();

if(!(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "Cashier" && isset($_SESSION['user_name']))) {
    header("location: /pet-life/public/401.php");
}
?>