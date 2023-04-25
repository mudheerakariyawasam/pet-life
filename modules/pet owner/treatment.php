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
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>VIP Programmes</span></a></a>
            </li>
            <li>
                <a href="../admin/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
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


            <div class="navbar__right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span id="designation"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
        
   
</body>

</html>

<?php
$sql = "SELECT *  FROM employee e 
INNER JOIN treatment a ON e.emp_id = a.vet_id 
INNER JOIN treatment_type t ON t.treatment_id =  a.treatment_id
INNER JOIN pet p ON a.pet_id = p.pet_id 
INNER JOIN pet_owner o ON o.owner_id = p.owner_id 
WHERE o.owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}')";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo '<table>
                    <tr>
                        <th>Treatment type</th>
                        <th>Pet Name</th>
                        <th>Vet Name</th>
                        <th>Treatment Bill</th>
                        <th>Follow Up Date</th>
                        <th colspan="2">Actions</th>
                    </tr>';

    while ($row = mysqli_fetch_assoc($result)) {

        echo '<tr > 
                            <td><b>' . $row["treatment_type"] . '</b></td>
                            <td> ' . $row["pet_name"] . '</td>
                            <td>' . $row["emp_name"] . '</td> 
                            <td>' . $row["treatment_bill"] . '</td> 
                            <td>' . $row["followup_date"] . '</td>
                            <td class="action-btn"><button type="submit"><img src="images/update.png"></button></td>
                            <td class="action-btn"><button type="submit"><img src="images/delete.png"></button></td>
                        </tr>';
    }
    echo '</table>';
} else {
    echo "0 results";
}
?>