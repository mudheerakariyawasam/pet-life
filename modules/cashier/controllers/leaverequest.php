<?php
    include("../../../db/dbconnection.php");
    
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/cashier/permission.php');

    if(!isset($_SESSION["login_user"])){
        header("location:../../../../../Auth/login.php");
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
                <li><a href="payments.php"><i class="fa fa-user"></i><span>Payments</span></a></li>
                <li><a class="active" href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a></li>
                <li><a href="myprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>        
    </div>
    
    
    <!-- right side container -->

    <div class="right-container">
    
        <div class="top-bar">
            <div class="nav-icon">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="hello">
                <font class="header-font-1">Welcome </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>

            
        </div>
    
        <div class="content" style="
            background-position: center;
            height: 100vh;">

            <p class="topic">Leave Requests</p><hr><br>

            <div class="mini-content">
            <div class="leave-form">
                <form method="POST">
                    <label>Leave Type</label><br>
                    <div class="dropdown-list" style="width:200px;">
                        <select name="holiday_type" class="dropdown-list" >
                        <option value="Holidays">Holidays</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Vacation">Vacation</option>
                            <option value="Emergencies">Emergencies</option>
                            <option value="Parental Leave">Parental Leave</option>
                            <option value="Other">Other</option>
                        </select><br><br>
                    </div>
                    <label>Reason</label><br>
                    <input type="text" name="holiday_reason" required><br><br>
                    
                    <label>Dates</label><br>
                    <label>From</label><br>
                    <input type="date" name="from_date" required><br>
                    <label>To</label><br>
                    <input type="date" name="to_date" required><br><br>
                    <button class="btn-add" type="submit">Add </button>
                    <button class="btn-add" type="submit">Clear </button>
                </form> 
            </div>
            <center>
            <div class="request-type">
                <div>
                <p><b>Request Status</b></p>
                <form method="post">
                    <input type="submit" name="pending" class="button" value="Pending" />         
                    <input type="submit" name="accepted" class="button" value="Accepted" />
                    <input type="submit" name="rejected" class="button" value="Rejected" />
                </form>
                <br>
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
</center>
            </div>
        </div>
</div>
    </div>
</body>
</html>