<?php
   session_start();
   
   // if(session_destroy()) {
   //    header("Location: welcome.php");
   // }
   unset($_SESSION["login_user"]);
   header("location:login.php");

?>