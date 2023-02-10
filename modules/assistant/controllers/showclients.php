<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/showclients.css">
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
                <a href="showclients" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>

            <li>
                <a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
            </li>
            <li>
                <a href="myprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="/pet-life/Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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
                    <font class="header-font-2">John</font>
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
            <div class="heading">Clients' Details</div>
            <div class="data-table">
                <table id="showclients">
                    <tr>
                        <th> Client ID </th>
                        <th>Name</th>
                        <th> Date Registered</th>
                        <th> Address </th>
                        <th> Mobile</th>
                        <th> Email</th>
                        <th> Action</th>
                    </tr>
                    <tr>
                        <td>C001</td>
                        <td>Sachintha</td>
                        <td>02/05/2022</td>
                        <td>No.24, New York</td>
                        <td>0789414977</td>
                        <td>sachintha@gmail.com</td>
                        <td> <a href="viewcustomer.php"><i class="fa-sharp fa-solid fa-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td>John</td>
                        <td>02/05/2022</td>
                        <td>No.74, New York</td>
                        <td>0705369977</td>
                        <td>john@gmail.com</td>
                        <td> <a href="viewcustomer.php"><i class="fa-sharp fa-solid fa-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>C003</td>
                        <td>Swanson</td>
                        <td>02/05/2022</td>
                        <td>No.38/4, New York</td>
                        <td>0705836977</td>
                        <td>swan@gmail.com</td>
                        <td> <a href="viewcustomer.php"><i class="fa-sharp fa-solid fa-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>C004</td>
                        <td>Brown</td>
                        <td>02/05/2022</td>
                        <td>No.4,London</td>
                        <td>0789814977</td>
                        <td>brown@yahooo.com</td>
                        <td> <a href="viewcustomer.php"><i class="fa-sharp fa-solid fa-eye"></i></a></td>
                    </tr>
                </table>

            </div>
        </div>
        <script src="script.js"></script>
</body>

</html>