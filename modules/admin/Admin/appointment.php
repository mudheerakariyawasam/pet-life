<?php
    include("../../../db/dbconnection.php");
    session_start();

    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/appointment.css">
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
                <a href="#" class="active"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php""><i class="fa fa-user"></i></i><span>Clients</span></a>
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
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>


            <div class="navbar__right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                    </li>
                    <li><a href="#"><i class="fa-solid fa-message"></i></a></li>
                   
                </ul>
            </div>
        </div>
        <div class="container">
            <br/><br/><br/>

            
  <div class="col-sm-4 mb-5">
  <!-- Main Content area start Middle -->
  <div>
    
    <form method="post">
        <input type="submit" name="pending" class="button" value="Pending" />         
        <input type="submit" name="accepted" class="button" value="Accepted" />
        <input type="submit" name="rejected" class="button" value="Rejected" />
    </form>
<br>
    <?php
    
      if(array_key_exists('pending', $_POST)) {
        displayPending($conn);
      }
      else if(array_key_exists('accepted', $_POST)) {
        displayAccepted($conn);
      }else if(array_key_exists('rejected', $_POST)) {
        displayRejected($conn);
      }else{
        $sql = "SELECT * FROM appointment";
                
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          echo '<table>
          <tr>
            <th>Appointment ID</th>
            <th>Vet ID</th>
            <th>Pet ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Type</th>
            <th>Status</th>
          </tr>';

        while($row = mysqli_fetch_assoc($result)){
                    
          echo '<tr > 
            <td><b>' . $row["appointment_id"] . '</b></td>
            <td>' . $row["vet_id"] .'</td>
            <td> ' . $row["pet_id"] . '</td>
            <td>' . $row["appointment_date"] . '</td> 
            <td>' . $row["appointment_time"] . '</td>
            <td>' . $row["appointment_type"] . '</td>
            <td class="action-btn"><a href="appointment.php?id='.$row["appointment_id"].'"><img class="view-img" src="../images/view-eye.png"></a></td>
          </tr>';
        }
          echo '</table>';
        }else{
          echo "No appointments to show!";
        }
      }

      function displayPending($conn){
        $sql = "SELECT * FROM appointment WHERE appointment_status='Pending'";
                
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          echo '<table>
          <tr>
            <th>Appointment ID</th>
            <th>Vet ID</th>
            <th>Pet ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Type</th>
            <th>Status</th>
          </tr>';

        while($row = mysqli_fetch_assoc($result)){
                    
          echo '<tr > 
            <td><b>' . $row["appointment_id"] . '</b></td>
            <td>' . $row["vet_id"] .'</td>
            <td> ' . $row["pet_id"] . '</td>
            <td>' . $row["appointment_date"] . '</td> 
            <td>' . $row["appointment_time"] . '</td>
            <td>' . $row["appointment_type"] . '</td>
            <td class="action-btn"><a href="appointment.php?id='.$row["appointment_id"].'"><img class="view-img" src="../images/view-eye.png"></a></td>
          </tr>';
        }
          echo '</table>';
        }else{
          echo "No appointments to show!";
        }
      }

      function displayAccepted($conn){
        $sql = "SELECT * FROM appointment WHERE appointment_status='Accepted'";
                
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          echo '<table>
          <tr>
            <th>Appointment ID</th>
            <th>Vet ID</th>
            <th>Pet ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Type</th>
            <th>Status</th>
          </tr>';

        while($row = mysqli_fetch_assoc($result)){
                    
          echo '<tr > 
            <td><b>' . $row["appointment_id"] . '</b></td>
            <td>' . $row["vet_id"] .'</td>
            <td> ' . $row["pet_id"] . '</td>
            <td>' . $row["appointment_date"] . '</td> 
            <td>' . $row["appointment_time"] . '</td>
            <td>' . $row["appointment_type"] . '</td>
            <td class="action-btn"><a href="appointment.php?id='.$row["appointment_id"].'"><img class="view-img" src="../images/view-eye.png"></a></td>
          </tr>';
        }
          echo '</table>';
        }else{
          echo "No appointments to show!";
        }
      }

      function displayRejected($conn){
        $sql = "SELECT * FROM appointment WHERE appointment_status='Rejected'";
                
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          echo '<table>
          <tr>
            <th>Appointment ID</th>
            <th>Vet ID</th>
            <th>Pet ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Type</th>
            <th>Status</th>
          </tr>';

          //href = 'ptlife/folder/file?id='
        while($row = mysqli_fetch_assoc($result)){
                    
          echo '<tr > 
            <td><b>' . $row["appointment_id"] . '</b></td>
            <td>' . $row["vet_id"] .'</td>
            <td> ' . $row["pet_id"] . '</td>
            <td>' . $row["appointment_date"] . '</td> 
            <td>' . $row["appointment_time"] . '</td>
            <td>' . $row["appointment_type"] . '</td>
            <td class="action-btn"><a href="appointment.php?id='.$row["appointment_id"].'"><img class="view-img" src="../images/view-eye.png"></a></td>
          </tr>';
        }
          echo '</table>';
        }else{
          echo "No appointments to show!";
        }
      }

      function displayAppointment($conn){
        $sql = "SELECT * FROM appointment WHERE appointment_id='".$_GET['id']."'";           
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        return $row;
        
      }
    ?>
  </div>
<?php
  if(isset($_GET['id'])) {
    $row=displayAppointment($conn);
  
    $sql_getownerID="SELECT * FROM pet WHERE pet_id='".$row["pet_id"]."'";
    $result_getownerID=mysqli_query($conn,$sql_getownerID);
    $row_getownerID=mysqli_fetch_assoc($result_getownerID);
    
    $sql_getownerDetails="SELECT * FROM pet_owner WHERE owner_id='".$row_getownerID["owner_id"]."'";
    $result_getownerDetails=mysqli_query($conn,$sql_getownerDetails);
    $row_getownerDetails=mysqli_fetch_assoc($result_getownerDetails);

  }
?>
<br>
<div class="content-form">
    <form action="" method="POST">
    <h5 class="text-center">Approve/Reject Appointment</h5><br>

      <div class="form-left">
      <label for="appointmentid">Appointment ID:</label><br>
      <input type="text" class="form-control" id="appointmentid" name="appointmentid" value="<?php if(isset($row['appointment_id'])) {echo $row['appointment_id']; }?>"
        readonly>
      <br><br>
        <label for="appointmentid">Customer Name:</label><br>
      <input type="text" class="form-control" id="owner_fname" name="owner_fname" value="<?php if(isset($row_getownerDetails['owner_fname'])) {echo $row_getownerDetails['owner_fname']; }?>"
        readonly>
      <br><br>
      <label for="petid">Pet ID:</label><br>
        <input type="text" class="form-control" id="petid" name="petid" value="<?php if(isset($row['pet_id'])) { echo $row['pet_id']; } ?>"readonly>
    <br><br>
      <label for="appointmenttype">Appointment Type:</label><br>
      <input type="text" class="form-control" id="appointment_type" name="appointment_type" value="<?php if(isset($row['appointment_type'])) { echo $row['appointment_type']; } ?>"readonly>
    <br>   <br>
      </div>
      
      <div class="form-right">
        <label for="appointmentdate">Mobile:</label><br>
        <input type="text" class="form-control" id="owner_contactno" name="owner_contactno" value="<?php if(isset($row_getownerDetails['owner_contactno'])) {echo $row_getownerDetails['owner_contactno']; }?>">
        <br> <br>  
        <label for="vetid">Vet ID:</label><br>
        <input type="text" class="form-control" id="vetid" name="vetid" value="<?php if(isset($row['vet_id'])) { echo $row['vet_id']; } ?>">
        <br> <br>
        <label for="appointmentdate">Appointment Date:</label><br>
        <input type="date" class="form-control" id="appointmentdate" name="appointmentdate" value="<?php if(isset($row['appointment_date'])) {echo $row['appointment_date']; }?>">
        <br> <br>
        <label for="appointmenttime">Appointment Time:</label><br>
        <input type="text" class="form-control" id="appointmenttime" name="appointmenttime" value="<?php if(isset($row['appointment_time'])) { echo $row['appointment_time']; } ?>">
        <br> <br>
      </div>
      
      <input type="submit" name="accept" class="button" value="Accept" />         
      <input type="submit" name="reject" class="button" value="Reject" />
      
   
  </form>
</div>
  <!-- below msg display if required fill missing or form submitted success or failed -->
  <?php if(isset($msg)) {echo $msg; } ?>
<?php 
   $conn->close();
?>
    <!-- <script src="script.js"></script> -->
</body>

</html>