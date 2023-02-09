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
<div class="hello">Hello <?php echo $_SESSION['user_name'];?></div>
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
            <br/><br/><br/>

            
  <div class="col-sm-4 mb-5">
  <!-- Main Content area start Middle -->
  <div>
    
    <form method="post">
        <input type="submit" name="pending" class="button" value="Pending" />         
        <input type="submit" name="accepted" class="button" value="Accepted" />
        <input type="submit" name="rejected" class="button" value="Rejected" />
    </form>

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
            <td class="action-btn"><button type="submit"><img src="images/update.png"></button></td>
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
            <td class="action-btn"><button type="submit"><img src="images/update.png"></button></td>
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
            <td class="action-btn"><button type="submit"><img src="images/update.png"></button></td>
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

        while($row = mysqli_fetch_assoc($result)){
                    
          echo '<tr > 
            <td><b>' . $row["appointment_id"] . '</b></td>
            <td>' . $row["vet_id"] .'</td>
            <td> ' . $row["pet_id"] . '</td>
            <td>' . $row["appointment_date"] . '</td> 
            <td>' . $row["appointment_time"] . '</td>
            <td>' . $row["appointment_type"] . '</td>
            <td class="action-btn"><button type="submit"><img src="images/update.png"></button></td>
          </tr>';
        }
          echo '</table>';
        }else{
          echo "No appointments to show!";
        }
      }
    ?>
  </div>
<?php 

    // after assigning work we will delete data from submitrequesttable by pressing close button
    if(isset($_REQUEST['close'])){
      $sql = "DELETE FROM appointment WHERE appointment_id = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
        } else {
          echo "Unable to Delete Data";
        }
      }
 ?>

<?php    
    
    if(isset($_REQUEST['view'])){
      $sql = "SELECT * FROM appointment WHERE appointment_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    }

 //  Assign work Order Request Data going to submit and save on db assignwork_tb table
 if(isset($_REQUEST['assign'])){
  // Checking for Empty Fields
  if(($_REQUEST['appointmentid'] == "") || ($_REQUEST['appointmentdate'] == "") || ($_REQUEST['appointmenttime'] == "") || ($_REQUEST['vetid'] == "") || ($_REQUEST['petid'] == "") || ($_REQUEST['appointmenttype'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
        $aid = $_REQUEST['appointmentid'];
        $adate = $_REQUEST['appointmentdate'];
        $atime = $_REQUEST['appointmenttime'];
        $avid = $_REQUEST['vetid'];
        $apid = $_REQUEST['petid'];
        $atype = $_REQUEST['appointmenttype'];
 
    $sql = "INSERT INTO test (appointment_id, appointment_date, appointment_time, vet_id, pet_id, appointment_type) VALUES ('$aid', '$adate','$atime', '$avid', '$apid', '$atype')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Work Assigned Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Assign Work </div>';
    }
  }
  }

 ?>

<div class="col-sm-5 mt-5 jumbotron">
  <!-- Main Content area Start Last -->
  <form action="" method="POST">
    <h5 class="text-center">Approve/Reject Appointment</h5><br>
    <div class="form-group">
      <label for="appointmentid">Appointment ID</label>
      <input type="text" class="form-control" id="appointmentid" name="appointmentid" value="<?php if(isset($row['appointment_id'])) {echo $row['appointment_id']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="appointmentdate">Appointment Date</label>
      <input type="text" class="form-control" id="appointmentdate" name="appointmentdate" value="<?php if(isset($row['appointment_date'])) {echo $row['appointment_date']; }?>">
    </div>
    <div class="form-group">
      <label for="appointmenttime">Appointment Time</label>
      <input type="text" class="form-control" id="appointmenttime" name="appointmenttime" value="<?php if(isset($row['appointment_time'])) { echo $row['appointment_time']; } ?>">
    </div>
    <div class="form-group">
      <label for="vetid">Vet ID</label>
      <input type="text" class="form-control" id="vetid" name="vetid" value="<?php if(isset($row['vet_id'])) { echo $row['vet_id']; } ?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="petid">Pet ID</label>
        <input type="text" class="form-control" id="petid" name="petid" value="<?php if(isset($row['pet_id'])) { echo $row['pet_id']; } ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="appointmenttype">Appointment Type</label>
        <input type="text" class="form-control" id="appointmenttype" name="appointmenttype" value="<?php if(isset($row['appointment_type'])) {echo $row['appointment_type']; }?>">
      </div>
    </div>
    <div class="float-right">
      <button type="submit" class="btn btn-success" name="assign">Accept</button>
      <button type="reset" class="btn btn-secondary">Reject</button>
    </div>
  </form>
  <!-- below msg display if required fill missing or form submitted success or failed -->
  <?php if(isset($msg)) {echo $msg; } ?>
  <?php 
 
  $conn->close();
?>
      

</div>
    <!-- <script src="script.js"></script> -->
</body>

</html>