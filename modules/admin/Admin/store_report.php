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
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Pet Life</title>
    
    <style>
/* Reset styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Table styles */
.table-wrapper {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

th, td {
  padding: 12px 15px;
  text-align: left;
  vertical-align: top;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #000D2F;
  color: #fff;
  font-weight: bold;
}

tr:nth-child(even) td {
  background-color: #f2f2f2;
}

tr:hover td {
  background-color: #e0e0e0;
}

.print-button {
  text-align: right;
}

.print-button button {
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 10px 20px;
  color: #fff;
  background-color: #000D2F;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.print-button button:hover {
  background-color: #001B5E;
}

.print-button i {
  font-size: 16px;
}

.no-records {
  padding: 12px 15px;
  text-align: center;
  color: #f00;
  font-weight: bold;
}

@media print {
  body * {
    visibility: hidden;
  }
  
  .print-container, .print-container * {
    visibility: visible;
  }
  
  .print-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
}

</style>

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
                <a href="staff.php" ><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
            </li>
            <li>
                <a href="report.php" class="active"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
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
        <br/>
<div class="employee-title">Employee List</div><hr>
<br/>
<div class="container print-container">
  <?php
    $sql = "SELECT * FROM pet_item";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      echo '
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item Name</th>
              <th>Item Brand</th>
              <th>Item Quantity</th>
              <th>Unit Price</th>
              <th>Item Category</th>
            </tr>
          </thead>
          <tbody>';
      while($row = $result->fetch_assoc()){
        echo '<tr>
              <td>'.$row["item_id"].'</td>
              <td>'.$row["item_name"].'</td>
              <td>'.$row["item_brand"].'</td>
              <td>'.$row["item_qty"].'</td>
              <td>'.$row["item_price"].'</td>
              <td>'.$row["item_category"].'</td>
            </tr>';
      }
      echo '<tr>
              <td colspan="8" class="print-button">
              <button type="button" class="print-button" onClick="window.print()">
              <i class="fas fa-print"></i>
              Print
            </button>    </td>
            </tr>
          </tbody>
        </table>
      </div>';
    } else {
      echo "<div class='no-records'>No Records Found!</div>";
    }
  
  ?>
</div>
    </div>
    <script src="script.js"></script>

</body>

</html>