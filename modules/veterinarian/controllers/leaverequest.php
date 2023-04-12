<?php
include("../dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
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
    <link rel="stylesheet" href="../css/leaverequest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Update My Profile</title>
</head>

<body>

    <div class="main-container">

        <!-- left side nav bar -->

        <div class="left-container">
            <div class="user-img">
                <center><img src="../images/logo_transparent black.png"></center>
            </div>
            <ul>
                <li><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                <li> <a href="showclients.php"><i class="fa fa-user"></i></i><span>Clients</span></a></li>
                <li>
                    <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment
                            History</span></a></a>
                </li>
                <li><a class="active" href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave
                            Requests</span></a></li>
                <li><a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
            </ul>
            <div class="logout">
                <hr>
                <a href="/pet-life/Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
            </div>
        </div>


        <!-- right side container -->

        <div class="right-container">

            <div class="top-bar">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>&nbsp&nbsp&nbsp
                </div>
                <div class="hello">
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2">
                        <?php echo $_SESSION['user_name']; ?>
                    </font>
                </div>
            </div>

            <div class="content" style="
            background-position: center;
            height: 100vh;">

                <p class="topic">Leave Requests</p>
                <hr><br>

                <div class="mini-content">
                    <div class="leave-form">
                        <form method="POST">
                            <label>Leave Type</label><br>
                            <div class="dropdown-list" style="width:200px;">
                                <select name="holiday_type" class="dropdown-list">
                                    <option value="Holidays">Holidays</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Vacation">Vacation</option>
                                    <option value="Emergencies">Emergencies</option>
                                    <option value="Parental leave">Parental leave</option>
                                    <option value="Other">Other</option>
                                </select><br><br>
                            </div>
                            <label>Reason</label><br>
                            <input type="text" name="holiday_reason" placeholder="Reason" required><br><br>

                            <label>Dates</label><br>
                            <label>From</label><br>
                            <input type="date" name="from_date" required><br>
                            <label>To</label><br>
                            <input type="date" name="to_date" required><br><br>
                            <button class="btn-add" type="submit">Add </button>
                            <button class="btn-add" type="submit">Clear </button>
                        </form>
                    </div>

                    <div class="request-type">
                        <div>
                            <p>Request Status</p>
                            <button class="btn-add" type="submit">Pending </button>
                            <button class="btn-add" type="submit">Approved </button>
                            <button class="btn-add" type="submit">Cancel </button>
                        </div>

                        <div>
                            <table>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                                <tr>
                                    <td>Sick Leave</td>
                                    <td>2023-01-05</td>
                                    <td>2023-01-07</td>
                                </tr>
                                <tr>
                                    <td>Sick Leave</td>
                                    <td>2023-02-07</td>
                                    <td>2023-02-07</td>
                                </tr>
                                <tr>
                                    <td>Sick Leave</td>
                                    <td>2023-01-05</td>
                                    <td>2023-01-07</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>