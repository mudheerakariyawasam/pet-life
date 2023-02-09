<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/client.css">
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
                <a href="#" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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
        define('TITLE', 'Client');
        define('PAGE', 'client');

        include('../dbConnection.php');
        session_start();
?>


<div class="sec-2">
<div>
  <!--Table-->
<br/>
<div class="client-title">List of Clients</div>
<br/>
  <?php
    $sql = "SELECT * FROM pet_owner";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table" cellspacing=1 cellpadding=3>
  <thead>
   <tr>
    <th scope="col">Owner ID</th>
    <th scope="col">First Name</th>
    <th scope="col">Second Name</th>
    <th scope="col">Email</th>
<th scope="col">Contact No</th>
<th scope="col">Address</th>
<th scope="col">Nic</th>
    <th scope="col">Action</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th style="color:#000D2;" scope="row">'.$row["owner_id"].'</th>';
    echo '<td>'. $row["owner_fname"].'</td>';
echo '<td>'. $row["owner_lname"].'</td>';
echo '<td>'. $row["owner_email"].'</td>';

    echo '<td>'.$row["owner_contactno"].'</td>';
    echo '<td>'.$row["owner_address"].'</td>';
    echo '<td>'.$row["owner_nic"].'</td>';

    echo '<td class="sub">
    <div class="f">
    <div class="f1" style="margin-top:10px;"> <form action="editstaff.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["owner_id"] .'><button style="border:none;" type="submit" name="view" value="View"><img src="../images/update.png" width=20px height=20px></button></form></div>
    <div class="f2" style="margin-top:10px;"> <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["owner_id"] .'><button style="border:none;" type="submit" name="delete" value="Delete"><img src="../images/del.png" width=20px height=20px></button></form></div>
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
  $sql = "DELETE FROM pet_owner WHERE owner_id = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
?>
<a class="add-button" href="#"><button>Add</button></a>
</div>
</div>
<div>
</div>
</div>
</div>
<?php

?>

            
    </div>
    <script src="script.js"></script>
</body>

</html>