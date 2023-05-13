<?php
    include("../../../db/dbconnection.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iTQ6J+suQ1U1Fhtx2nW4G/4QfB+Oq+1j7Rk0ZGn2V2B8o9z7QrJNpGy7Z3N7tWlIYzMMsV5KJdJu6G8yTQJ3Uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Pet Life</title>
</head>

<body>
    <div class="sidebar">
<div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="#" class="active"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            
            <li>
                <a href="appointment.php"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
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
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>
        </div>
        <div class="container">
         
<br/><br/>

        <div class="dashboard-title">
        
  <div class="dash-item">
    <div class="icon"><i class="fas fa-user-friends"></i></div>
    <div class="title">Clients</div>
    <div class="count">
      <?php
        $sql = "SELECT COUNT(*) AS count FROM pet_owner";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          echo $row["count"];
        } else {
          echo "0";
        }
      ?>
    </div>
  </div>
  <div class="dash-item">
    <div class="icon"><i class="fas fa-paw"></i></div>
    <div class="title">Registered Pets</div>
    <div class="count">
      <?php
        $sql = "SELECT COUNT(*) AS count FROM pet";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          echo $row["count"];
        } else {
          echo "0";
        }
      ?>
    </div>
  </div>
  <div class="dash-item">
    <div class="icon"><i class="fas fa-users"></i></div>
    <div class="title">Staff Members</div>
    <div class="count">
      <?php
        $sql = "SELECT COUNT(*) AS count FROM employee";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          echo $row["count"];
        } else {
          echo "0";
        }
      ?>
    </div>
    </div>
    
<br/>
<div class="dashboard-container">
  <div class="dashboard-available-container">
    <div class="dashboard-available">
      <div class="dashboard-available-staff-title" style="font-size:15px;">Today's Available Staff Members</div>
      <ul class="employee-list">
        <?php
          $current_date = date('Y-m-d');

          $sql = "SELECT emp_id, emp_name FROM employee WHERE emp_id NOT IN (SELECT emp_id FROM holiday WHERE from_date <= '$current_date' AND to_date >= '$current_date' AND approval_stage = 'Approved')";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo '<li><span class="name">' . $row["emp_name"] . '</span><span class="status available"></span></li>';
            }
          } else {
            echo '<li>No staff members available today</li>';
          }
        ?>
      </ul>
    </div>
  </div>
</div>


    </div>
    <br/>
    <?php
// Connect to database and retrieve today's appointments
$db = new mysqli('localhost', 'root', '', 'pet_life');
$today = date('Y-m-d');
$sql = "SELECT appointment_id, appointment_date, appointment_time, appointment_slot FROM appointment WHERE appointment_date = '$today'";
$result = $db->query($sql);
?>
	<center><h2 style="margin-top:0px;">Today's Appointments</h2>
  </center>	
  <br>
  <center><table>
		<thead>
			<tr>
				<th>Appointment ID</th>
				<th>Appointment Date</th>
        <th>Appointment Time</th>
        <th>Appointment Slot</th>
				
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $result->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $row['appointment_id']; ?></td>
            <td><?php echo $row['appointment_date']; ?></td>
						<td><?php echo $row['appointment_time']; ?></td>
						<td><?php echo $row['appointment_slot']; ?></td>
					</tr>
			<?php } ?>
		</tbody>
      </table></center>

    <script src="script.js"></script>
<br/><br/>


</body>

</html>