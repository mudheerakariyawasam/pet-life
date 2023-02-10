<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/cashier/permission.php');
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
                <a href="payments.php"><i class="fa fa-user"></i></i><span>Payments</span></a>
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
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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

        <div class="container" >

        <p class="topic">Cash Flow Summary</p><hr><br>
            <div class="summary">
                    <div class="summary-content ">
                        
                       <b> <span class="tot">Total Income</span></b>
                        <span class="number">245 000 LKR</span>
                        <div><img class="shopping-cart" src="../images/income.png"></div>
                    </div>

                    <div class="summary-content ">
                        <b><span class="tot">Total Expenses</span></b>
                        <span class="number">120 000 LKR</span>
                        <div><img class="shopping-cart" src="../images/expenses.png"></div>
                    </div>

                    <div class="summary-content">
                       <b> <span class="tot">Net Profit</span></b>
                        <span class="number">125 000 LKR</span>
                        <div><img class="shopping-cart" src="../images/profit.png"></div>
                    </div>
               
            </div>
            <center>
                <div class="heading">Statistical View</div>
            </center>
        <br/>
        <center><img class="zoom" src="../images/chart.png"></center>
            <br /><br /><br />
          
                  
            </div>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>