<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/insert_staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
    <div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="appointment.php"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php" class="active"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="report.php"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
<div class="hello">Hello Admin</div>
            </div>


            <div class="navbar__right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa-solid fa-message"></i>
                        </a>
                    </li>
                  
                </ul>
            </div>
        </div>
        <div class="container">

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
 if(($_REQUEST['emp_id'] == "") || ($_REQUEST['emp_name'] == "") || ($_REQUEST['emp_address'] == "") || ($_REQUEST['emp_contactno'] == "") || ($_REQUEST['emp_designation'] == "") || ($_REQUEST['emp_email'] == "") || ($_REQUEST['emp_nic'] == "") || ($_REQUEST['emp_dateassigned'] == "") || ($_REQUEST['emp_pwd'] == "")) {
  // msg displayed if required field missing
  $msg = '<div class="alert" role="alert"> Fill All Fileds </div>';
 } else {
   // Assigning User Values to Variable
    $eId = $_REQUEST['emp_id'];
      $eName = $_REQUEST['emp_name'];
    $eAddress = $_REQUEST['emp_address'];
    $eContact = $_REQUEST['emp_contactno'];
      $eDesignation = $_REQUEST['emp_designation'];
      $eEmail = $_REQUEST['emp_email'];
      $eNIC = $_REQUEST['emp_nic'];
    $eDate = $_REQUEST['emp_dateassigned'];
    $ePwd = $_REQUEST['emp_pwd'];
   $sql = "INSERT INTO employee (emp_id, emp_name, emp_address, emp_contactno, emp_designation, emp_email, emp_nic, emp_dateassigned, emp_pwd ) VALUES ('$eId', '$eName', '$eAddress', '$eContact', '$eDesignation', '$eEmail', '$eNIC', '$eDate', '$ePwd')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert" role="alert"> Added Successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert" role="alert"> Unable to Add</div>';
   }
 }
 }
?>
<div>
<div>
<br/>
<div class="staff-title">Add New Staff Member</div><br><hr><br>


<div class="add-form">
  <form action="" method="POST">
    <div class="sec">
      <div class="sec-1"><label for="emp_id">Emp Id</label></div>
      <div class="sec-2"><input type="text" class="form-control" id="emp_id" name="emp_id"></div>
    </div>
    <div class="sec">
      <div class="sec-1"><label for="emp_name">Name</label></div>
      <div class="sec-2"><input type="text" class="form-control" id="emp_name" name="emp_name"></div>
    </div>
    <div class="sec">
      <div class="sec-1"><label for="emp_address">Address</label></div>
      <div class="sec-2"><input type="text" class="form-control" id="emp_address" name="emp_address"></div>
    </div>
    <div class="sec">
      <div class="sec-1"><label for="emp_contactno">Mobile</label></div>
      <div class="sec-2"><input type="text" class="form-control" id="emp_contactno" name="emp_contactno"  onkeypress="isInputNumber(event)"></div>
    </div>
    
    <div class="sec">
      <div class="sec-1"><label for="emp_designation">Designation</label></div>
      <div class="sec-2"><input type="text" class="form-control" id="emp_designation" name="emp_designation"></div>
    </div>
    <div class="sec">
     <div class="sec-1"> <label for="emp_email">Email</label></div>
      <div class="sec-2"><input type="email" class="form-control" id="emp_email" name="emp_email"></div>
    </div>
    <div class="sec">
      <div class="sec-1"><label for="emp_nic">NIC</label></div>
      <div class="sec-2"><input type="text" class="form-control" id="emp_nic" name="emp_nic"></div>
    </div>
<div class="sec">
      <div class="sec-1"><label for="emp_dateassigned">Date Assigned</label></div>
      <div class="sec-2"><input type="date" class="form-control" id="emp_dateassigned" name="emp_dateassigned"></div>
    </div>
<div class="sec">
     <div class="sec-1"><label for="emp_pwd">Password</label></div>
     <div class="sec-2"><input type="password" class="form-control" id="emp_pwd" name="emp_pwd"></div>
    </div>
    <div class="text-center">
      <button type="submit" class="add-button" id="empsubmit" name="empsubmit">Add</button>&nbsp;
     <a href="staff.php" class="close-button" ><button>Close</button></a>
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
    <script src="script.js"></script>
</body>

</html>