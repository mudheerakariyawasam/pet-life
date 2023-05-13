<?php
include("../../db/dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:../../Auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/treatment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="images/petlife.png" width=200px></center>
        </div>
        <ul>

            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php" class="active"><i
                        class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>Pet Daycare</span></a></a>
            </li>
            <li>
                <a href="../../public/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
            </li>
            <li>
                <a href="inquiry.php"><i class="fa fa-user"></i><span>Inquiries</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="./logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                </div>
            </div>


           
        </div>
        
        <div class="container">

            <!-- search items-->
            <    <div class="bar-content search-bar">
            <form method="GET">
    <label><b>Pet Name</b></label><br>
    <select name="pet_name">
        <option value="">Select a pet</option>
        <?php
          $loggedInUser = $_SESSION['login_user'];
        // Get all pets of the logged-in user
        $sql_pets = "SELECT * FROM pet WHERE owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '$loggedInUser')";
        $result_pets = mysqli_query($conn, $sql_pets);
        while ($row_pets = mysqli_fetch_assoc($result_pets)) {
            // Set the selected attribute if the current pet is selected in the URL
            $selected = ($row_pets['pet_name'] == $_GET['pet_name']) ? 'selected' : '';
            echo '<option value="' . $row_pets['pet_name'] . '" ' . $selected . '>' . $row_pets['pet_name'] . '</option>';
        }
        ?>
    </select>
    <button class="btn-add1" type="submit"><img src="images/search.png"></button>
</form>
        </div>
                </div>
            <div class ="app">
                <p>TREATMENT RECORDS </P>
                    </div>
        <div class="tble">
        <table>
                    <tr>
                        <th>Treatment type</th>
                        <th>Pet Name</th>
                        <th>Vet Name</th>
                        <th>Treatment Bill</th>
                        <th>Treatment_date</th>
                        <th>Follow Up Date</th>
                    
                    </tr>
            <?php
            $sql = "SELECT *  FROM employee e 
INNER JOIN treatment a ON e.emp_id = a.vet_id 
INNER JOIN treatment_type t ON t.treatment_id =  a.treatment_id
INNER JOIN pet p ON a.pet_id = p.pet_id 
INNER JOIN pet_owner o ON o.owner_id = p.owner_id 
WHERE o.owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}')";

  // Check if pet_name parameter is set in the URL
  if (isset($_GET['pet_name'])) {
    // Sanitize input value to prevent SQL injection
    $pet_name = mysqli_real_escape_string($conn, $_GET['pet_name']);
    // Include pet_name condition in SQL query
    $sql .= " AND p.pet_name LIKE '%$pet_name%'";
}
$sql .= " ORDER BY a.followup_date ASC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
               

                while ($row = mysqli_fetch_assoc($result)) {

                    echo '<tr > 
                            <td><b>' . $row["treatment_type"] . '</b></td>
                            <td> ' . $row["pet_name"] . '</td>
                            <td>' . $row["emp_name"] . '</td> 
                            <td>' . $row["treatment_bill"] . '</td> 
                            <td>' . $row["treatment_date"] . '</td>
                            <td>' . $row["followup_date"] . '</td>
                        
                        </tr>';
                }
                echo '</table>';
            } else {
                echo '<td colspan="7"><center><img style="width:25%;" src="images/no-results.png"></center></td>';
            }
            ?>
        </div>
    </div>




</body>

</html>