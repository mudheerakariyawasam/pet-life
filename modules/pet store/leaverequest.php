<?php
    include("data/dbconnection.php");
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }

    $emp_id=$_SESSION['emp_id'];

    //generate next holiday ID
    
    $sql_get_id="SELECT holiday_id FROM holiday ORDER BY holiday_id DESC LIMIT 1";
    $result_get_id=mysqli_query($conn,$sql_get_id);
    $row=mysqli_fetch_array($result_get_id);
 
    $lastid="";
                     
     if(mysqli_num_rows($result_get_id)>0){
         $lastid=$row['holiday_id'];
     }
 
     if($lastid==""){
         $holiday_id="L001";
     }else {
         $holiday_id=substr($lastid,3);
         $holiday_id=intval($holiday_id);
 
         if($holiday_id>=9){
             $holiday_id="L0".($holiday_id+1);
         } else if($holiday_id>=99){
             $holiday_id="L".($holiday_id+1);
         }else{
             $holiday_id="L00".($holiday_id+1);
         }
     }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $from_date=date('Y-m-d', strtotime($_POST['from_date']));
            $to_date=date('Y-m-d', strtotime($_POST['to_date']));
            
            //checkDateValidation
            if($from_date<$to_date){
                
                $holiday_type=$_POST['holiday_type'];
                $holiday_reason=$_POST['holiday_reason'];
                
                //check data null values

                if($holiday_type=="---Select Holiday Type--"){
                    $sql = "INSERT INTO holiday (holiday_id,from_date,to_date,emp_id,holiday_type,holiday_reason) VALUES ('$holiday_id','$from_date','$to_date','$emp_id','$holiday_type','$holiday_reason')";
                    //$sql = "INSERT INTO holiday VALUES (holiday_id,from_date,to_date,emp_id,holiday_type,holiday_reason) VALUES ('$holiday_id','$from_date','$to_date','$emp_id','Vaccination','$holiday_reason')";
                    $result = mysqli_query($conn,$sql);
                    
                    if($result==TRUE) { 
                        echo '<script>alert("Your leave request has been sent to the admin")</script>';
                        header("location: dashboard.php");
                    }else {
                        echo '<script>alert("Could not place the leave request. Please try again.")</script>';
                    }
                }else{
                    echo '<script>alert("Insert Valid Holiday Type")</script>';
                }
            }else{
                echo '<script>alert("Insert Valid Date Range")</script>';
            } 
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/leaverequest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Update My Profile</title>
</head>
<body>

<div class="main-container">

    <!-- left side nav bar -->

    <div class="left-container">
        <div class="user-img">
            <center><img src="images/logo_transparent black.png"></center>
        </div>
        <ul>
                <li><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                <li><a href="viewallitems.php"><i class="fa fa-paw"></i><span>Pet Items</span></a></li>
                <li><a href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
                <li><a class="active" href="#"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a></li>
                <li><a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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
                <font class="header-font-2"><?php echo $_SESSION['user_name']; ?> </font>
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
                            <option value="">--Select Holiday Type--</option>
                            <option value="Holidays">Holidays</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Vacation">Vacation</option>
                            <option value="Emergencies">Emergencies</option>
                            <option value="Parental Leave">Parental Leave</option>
                            <option value="Other">Other</option>
                        </select><br><br>
                    </div>
                    <label>Reason</label><br>
                    <input type="text" name="holiday_reason" placeholder="Reason" required><br><br>
                    
                    <label>Dates</label><br>
                    <label>From</label><br>
                    <input type="date" name="from_date" min="<?= date('Y-m-d'); ?>" required><br>
                    <label>To</label><br>
                    <input type="date" name="to_date" min="<?= date('Y-m-d'); ?>" required><br><br>
                    <button class="btn-add" type="submit">Add </button>
                    <button class="btn-add" type="submit">Clear </button>
                </form> 
            </div>
            <center>
            <div class="request-type">
                <div>
                <p><b>Request Status</b></p>
                <form method="">
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