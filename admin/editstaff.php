<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/edit_staff.css">
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
define('TITLE', 'Update staff');
define('PAGE', 'staff');

include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 // update
 if(isset($_REQUEST['empupdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="aler" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $eId = $_REQUEST['empId'];
    $eName = $_REQUEST['empName'];
    $eCity = $_REQUEST['empCity'];
    $eMobile = $_REQUEST['empMobile'];
    $eEmail = $_REQUEST['empEmail'];
  $sql = "UPDATE staff_tb SET empName = '$eName', empCity = '$eCity', empMobile = '$eMobile', empEmail = '$eEmail' WHERE empid = '$eId'";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert" role="alert"> Updated Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
  }
 ?>
<div class="sec-2">
<br/><br/>
 <div class="staff-title">List of Staff</div>
<div class="edit-form">
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM staff_tb WHERE empid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empId">Emp ID</label>&nbsp;&nbsp;
      <input type="text" class="form-control" id="empId" name="empId" value="<?php if(isset($row['empid'])) {echo $row['empid']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="empName">Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empName" name="empName" value="<?php if(isset($row['empName'])) {echo $row['empName']; }?>">
    </div>
    <div class="form-group">
      <label for="empCity">City</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empCity" name="empCity" value="<?php if(isset($row['empCity'])) {echo $row['empCity']; }?>">
    </div>
    <div class="form-group">
      <label for="empMobile">Mobile</label>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" class="form-control" id="empMobile" name="empMobile" value="<?php if(isset($row['empMobile'])) {echo $row['empMobile']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="email" class="form-control" id="empEmail" name="empEmail" value="<?php if(isset($row['empEmail'])) {echo $row['empEmail']; }?>">
    </div>
    <div class="text-center">
      <button type="submit" id="empupdate" name="empupdate">Update</button>
      <a href="staff.php">Close</a>
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
</div>











        </div>



    </div>

</body>
</head>
</html>