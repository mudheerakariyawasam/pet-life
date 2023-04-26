<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/cashier/permission.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/payments.css">
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
                <a href="payments.php" class="active"><i class="fa fa-user"></i></i><span>Payments</span></a>
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

    <!-- //Navigation bar ends -->


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
                    <li>
                        <!-- <a href="">
                            <span id="designation">Admin</span>
                        </a> -->
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
           <div class="heading">Treatments<hr></div>

<br/>
     <div class="treatment-table">
                <table class="t-table">
                    <tr>
                        <th>Treatment ID </th>
                        <th>Clinic Charges</th>
                        <th>Treatment Bill</th>
                        <th>Discount</th>
                       
                    </tr>
                    <tr>
                        <td>T001<center><hr/></center></td>
                        <td>600.00<center><hr/></center></td>
                        <td>2800.00<center><hr/></center></td>
                        <td>00.00<center><hr/></center></td>
                    </tr>
                  
                
                </table>

            </div>
            <br/>
  <div class="p-item">         
 <div class="item-heading-left">Pet Items</div>
 <div class="item-heading-right"><button>Add Item Details</button></div>
</div>
<br/>

     <div class="item-table">
               <center> <table class="i-table">
                    <tr>
                        <th>Item ID </th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                       
                    </tr>
                    <tr>
                        <td>P001<center></td>
                        <td>2<center></td>
                        <td>0%<center></td>
                        <td>250.00<center></td>
                    </tr>
                  
                
                </table></center>

            </div>
            <br/>

            <div class="p-medicine">         
 <div class="medicine-heading-left">Pet Medicines</div>
 <div class="medicine-heading-right"><button>Add Medicine Details</button></div>
</div>
<br/>

     <div class="medicine-table">
               <center> <table class="m-table">
                    <tr>
                        <th>Medicine ID </th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                       
                    </tr>
                    <tr>
                        <td>M001<center></td>
                        <td>2 Cards<center></td>
                        <td>0%<center></td>
                        <td>397.50<center></td>
                    </tr>
                  
                
                </table></center>

            </div>  
            <br/><br/><br/>
            <div class="bottom">         
                <div class="bottom-heading-left">Employee ID: <?php echo $_SESSION['emp_id']; ?></div>
                <div class="bottom-heading-right">Total Bill<br/>Rs.2000.00<hr/><button>Calculate Bill</button></div>
            </div>
            <br/>

        </div>
        <script src="script.js"></script>
</body>

</html>