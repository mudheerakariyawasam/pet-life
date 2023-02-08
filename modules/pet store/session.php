<?php
   include("data/dbconnection.php");
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select emp_email from employee where emp_email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['emp_email'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:welcome.php");
      die();
   }
?>