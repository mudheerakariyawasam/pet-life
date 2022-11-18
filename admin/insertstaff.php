<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/insert_staff.css">
</head>

<body>
    <div class="nav-bar">
        <div class="nav-left">
            <font class="header-font">Welcome Hello Admin</font>
        </div>
        <div class="nav-right">
            <ul class="navbar-ul">
                <li><img class="notification" src="../images/notification.png"></li>
                <li><img class="msg" src="../images/msg.png"></li>
                <li><img class="log-out" src="../images/log-out.png"></li>
            </ul>



        </div>
    </div>
    <div class="clear"></div>

    <div class="main">

        <div class="main-left">
             <br /><br /><br /><br /> 

<div class="doc-profile">
    <br/>
<center><img class="doctor-img" src="../images/admin.png"></center>
<center><font class="doc-name">Dr John Doe</font><center></center>

</div>


<br/>

<div>
            <ul>
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/dashboardp.png"></div>
                        <div class="main-left-right" style="color:#C38D9E; font-weight: bolder;">Dashboard</div>
                    </div>
                </li><br />

                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/appointment.png"></div>
                        <div class="main-left-right">Appointments</div>
                    </div>
                </li><br />




                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/client.png"></div>
                        <div class="main-left-right">Clients</div>
                    </div>
                </li><br />
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/staff.png"></div>
                        <div class="main-left-right"><a href="staff.php">Staff</a></div>
                    </div>
                </li><br />

                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/leave.png"></div>
                        <div class="main-left-right">Leave Manage</div>
                    </div>
                </li><br />
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/report.png"></div>
                        <div class="main-left-right">Reports</div>
                    </div>
                </li><br />

                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/profile.png"></div>
                        <div class="main-left-right">My Profile</div>
                    </div>
                </li><br />
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="../images/log-out.png"></div>
                        <div class="main-left-right">Log Out</div>
                    </div>
                </li><br />

            </ul>
</div>

        </div>

        <div class="main-right">

            <br /><br /><br/>

<div class="content">
<?php
define('TITLE', 'Add New Staff');
define('PAGE', 'staff'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['empsubmit'])){
 // Checking for Empty Fields
 if(($_REQUEST['empName'] == "") || ($_REQUEST['empDesignation'] == "") || ($_REQUEST['empDateAssigned'] == "") || ($_REQUEST['empAddress'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "") || ($_REQUEST['empNIC'] == "")) {
  // msg displayed if required field missing
  $msg = '<div class="alert" role="alert"> Fill All Fileds </div>';
 } else {
   // Assigning User Values to Variable
   $eName = $_REQUEST['empName'];
 $eDesignation = $_REQUEST['empDesignation'];
 $eDateAssigned = $_REQUEST['empDateAssigned'];
   $eAddress = $_REQUEST['empAddress'];
   $eMobile = $_REQUEST['empMobile'];
   $eEmail = $_REQUEST['empEmail'];
 $eNIC = $_REQUEST['empNIC'];
   $sql = "INSERT INTO staff_tb (empName, empDesignation, empDateAssigned, empAddress, empMobile, empEmail, empNIC) VALUES ('$eName', '$eDesignation', '$eDateAssigned', '$eAddress', '$eMobile', '$eEmail', '$eNIC')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert" role="alert"> Added Successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert" role="alert"> Unable to Add </div>';
   }
 }
 }
?>
<div class="sec-2">
<div>
<br/>
<div class="staff-title">List of Staff</div>


<div class="add-form">
  <form action="" method="POST">
    <div class="form-group">
      <label for="empName">Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empName" name="empName">
    </div>
    <div class="form-group">
      <label for="empName">Designation</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empDesignation" name="empDesignation">
    </div>
    <div class="form-group">
      <label for="empName">Date Assigned</label>&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empDateAssigned" name="empDateAssigned">
    </div>
    <div class="form-group">
      <label for="empCity">Address</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empAddress" name="empAddress">
    </div>
    <div class="form-group">
      <label for="empMobile">Mobile</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empMobile" name="empMobile" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="email" class="form-control" id="empEmail" name="empEmail">
    </div>
<div class="form-group">
      <label for="empEmail">NIC</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empNIC" name="empNIC">
    </div>
    <div class="text-center">
      <button type="submit" class="add-button" id="empsubmit" name="empsubmit">Add</button>&nbsp;
     <a href="staff.php" class="btn-close"><button>Close</button></a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
<?php

?>
</div>
</div>









        </div>



    </div>

</body>
</head>
</html>