<?php
    include('../dbconnection.php');
    session_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/readtreatment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Amatic+SC&display=swap" rel="stylesheet">
    <title></title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="../images/logo_transparent black.png"></center>
        </div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="showclients.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar ends -->


    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2">SENURI</font>
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
                            <i class="fa-solid fa-message"></i>
                        </a>
                    </li>
                    <li>
                        <!-- <a href="">
                            <span id="designation">Admin</span>
                        </a> -->
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="heading">Treatment Details</div>
            <div class="data-table">

            <?php
                $sql = "SELECT * FROM treatment";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                echo '<table id="showclients">
                        <tr>
                            <th>Treatment ID </th>
                            <th>Treatment Type</th>
                            <th>Treatment Date</th>
                            <th>Definitive Diagnosis </th>
                            <th>Followup Date</th>
                            <th colspan="2"> Action</th>
                        </tr>';

                while($row=mysqli_fetch_assoc($result)){
                    $sql_get_type="SELECT * FROM treatment_type WHERE treatment_id='$row[treatment_id]'";
                    $result_type=mysqli_query($conn,$sql_get_type);
                    $row_type=mysqli_fetch_assoc($result_type);

                    echo '<tr>
                    <td>' . $row["treatment_id"] . '</td>
                    <td>' . $row_type["treatment_type"] . '</td>
                    <td>' . $row["treatment_date"] . '</td>
                    <td>' . $row["definitive_diagnosis"] . '</td>
                    <td>' . $row["followup_date"] . '</td>
                    <td> <a href="#"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td> <a href="#"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>';
                }
                echo '</table>';
                }else{
                    echo "0 results";
                }

            ?>   
                

            </div>
        </div>
        <script src="script.js"></script>
</body>

</html>