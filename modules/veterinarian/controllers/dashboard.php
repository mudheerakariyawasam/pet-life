<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');
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
    
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="../images/logo_transparent black.png"></center>
        </div>
        <ul>
            <li>
                <a href="#" class="active"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>

            <li>
                <a href="showclients.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
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
            <a href="/pet-life/Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2"><?php echo $_SESSION['user_name']; ?></font>
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

                </ul>
            </div>
        </div>
        <div class="container" style="background-size: cover;
            background-position: center;
            height: 100vh;">

            <div class="dashboard-title">
                <div class="dash-1">
                    <p>Clients&nbsp;&nbsp;&nbsp;<span style="color:green;">73</span></p><img style="padding-left:100px;" src="../images/d1.png">
                </div>
                <div class="dash-2">
                    <p>Pets&nbsp;&nbsp;&nbsp;<span style="color:green;">73</span></p><img style="padding-left:100px;" src="../images/d2.png">
                </div>
                <div class="dash-3">
                    <p>Treatments&nbsp;&nbsp;&nbsp;<span style="color:green;">73</span></p><img style="padding-left:100px;" src="../images/d3.png">
                </div>
                <div class="dash-4">
                    <p>Appointments&nbsp;&nbsp;&nbsp;<span style="color:green;">73</span></p><img style="padding-left:100px;" src="../images/d4.png">
                </div>
            </div>
            <center>
                <div class="heading">Today's Appointments</div>
            </center>
            <br /><br /><br />
            <div class="table">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Pet ID</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;">
                                <div><img src="../images/client.png"></div>
                                <div><br />
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tushan Janith</p>
                                </div>
                            </div>
                        </td>
                        <td>C001</td>
                        <td>P012</td>
                        <td>12/12/2022</td>
                        <td>9.30 a.m.</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;">
                                <div><a href="viewcustomer.php"><img src="../images/client.png"></a></div>
                                <div><br />
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="viewcustomer.php">Sachintha
                                            Perera</a></p>
                                </div>
                            </div>
                        </td>
                        <td>C002</td>
                        <td>P002</td>
                        <td>12/12/2022</td>
                        <td>9.30 a.m.</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display:flex;">
                                <div><img src="../images/client.png"></div>
                                <div><br />
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Navindu Usliyanage</p>
                                </div>
                            </div>
                        </td>
                        <td>C005</td>
                        <td>P043</td>
                        <td>12/12/2022</td>
                        <td>9.30 a.m.</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>