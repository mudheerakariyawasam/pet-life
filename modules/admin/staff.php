<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/staff.css">
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
define('TITLE', 'Staff');
define('PAGE', 'staff');

include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>


<div class="sec-2">
<div>
  <!--Table-->
<br/>
<div class="staff-title">List of Staff</div>
<br/>
  <?php
    $sql = "SELECT * FROM staff_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table" cellspacing=1 cellpadding=3>
  <thead>
   <tr>
    <th scope="col">Emp ID</th>
    <th scope="col">Name</th>
<th scope="col">Designation</th>
<th scope="col">Date Assigned</th>
    <th scope="col">Address</th>
    <th scope="col">Mobile</th>
    <th scope="col">Email</th>
<th scope="col">NIC</th>
    <th scope="col">Action</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["empid"].'</th>';
    echo '<td>'. $row["empName"].'</td>';
echo '<td>'. $row["empDesignation"].'</td>';
echo '<td>'. $row["empDateAssigned"].'</td>';

    echo '<td>'.$row["empAddress"].'</td>';
    echo '<td>'.$row["empMobile"].'</td>';
    echo '<td>'.$row["empEmail"].'</td>';
echo '<td>'. $row["empNIC"].'</td>';
    echo '<td>
    <div class="f">
    <div class="f1" style="margin-top:10px;"> <form action="editstaff.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["empid"] .'><button style="border:none;" type="submit" name="view" value="View"><img src="../images/update.png" width=20px height=20px></button></form></div>
    <div class="f2" style="margin-top:10px;"> <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["empid"] .'><button style="border:none;" type="submit" name="delete" value="Delete"><img src="../images/del.png" width=20px height=20px></button></form></div>
      </div>
      </td>
   </tr>';
  }

 echo '</tbody>
 </table>';
} else {
  echo "0 Result";
}
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM staff_tb WHERE empid = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // below code will refresh the page after deleting the record
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
?>
<a class="add-button" href="insertstaff.php"><button>Add</button></a>
</div>
</div>
<div>
</div>
</div>
</div>
<?php

?>
</div>


















        </div>



    </div>

</body>
</head>
</html>