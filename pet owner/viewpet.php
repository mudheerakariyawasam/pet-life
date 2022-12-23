<?php
include("dbconnection.php");
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewpet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img class="image" src="images/petlife.png"></center>
        </div>
        <ul>

            <li>
                <a href="dashboard1.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-file"></i><span>VIP Programmes</span></a></a>
            </li>
            <li>
                <a href="#"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i><span>Inquiries</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="./logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
    
        <div class="navbar" >
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name"><?php echo $_SESSION['user_name'];?></div>
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

        <div class="container">

            <!-- search items-->
            <div class="topbar">
                <div class="bar-content search-bar">
                    <form>
                        <label><b>Pet ID </b></label><br>
                        <input class="item-id" type="text" name="pet_id" placeholder="Enter Pet ID">
                        <button type="submit"><img src="images/search.png"></button>
                    </form>
                </div>
                <div class="bar-content add-bar">
                    <a href="addpet.php"> <button class="btn-add" type="submit"><img class="add"
                                src="images/add.png">New Pet</button></a>
                </div>

            </div>
            <!--View All Items Code-->
            <?php
            $loggedInUser = $_SESSION['login_user'];




            $sql2 = "SELECT owner_id FROM pet_owner WHERE owner_email = '{$_SESSION['login_user']}'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $sql = "SELECT * FROM pet WHERE owner_id ='{$row2['owner_id']}'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<table>
            <tr>
                <th>Pet ID</th>
                <th>Pet Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Type</th>
                <th>Breed</th>
            </tr>';

                while ($row = mysqli_fetch_assoc($result)) {

                    echo '<tr > 
                    <td>' . $row["pet_id"] . '</td>
                    <td> ' . $row["pet_name"] . '</td>
                    <td>' . $row["pet_gender"] . '</td> 
                    <td>' . $row["pet_dob"] . '</td>
                    <td>' . $row["pet_type"] . '</td>
                    <td>' . $row["pet_breed"] . '</td>
                    <td class="action"><button type="submit"><img src="images/update.png"></button></td>
                    <td class="action"><button type="submit"><img src="images/delete.png"></button></td>
                </tr>';
                }
                echo '</table>';
            } else {
                echo "0 results";
            }
            ?>
        </div>
        <script src="script.js"></script>
    </div>
</body>

</html>