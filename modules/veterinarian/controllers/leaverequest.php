<?php
   include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
   include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }

    $emp_id=$_SESSION['emp_id'];
    $current_date = date("Y-m-d");

    //get the total holiday count of the employee
    $sql_getholidaycount="SELECT COUNT(*) AS hol_count FROM holiday WHERE emp_id='$emp_id' AND from_date<'$current_date' OR approval_stage='Approved'";
    $result_getholidaycount=mysqli_query($conn,$sql_getholidaycount);
    $row=mysqli_fetch_array($result_getholidaycount);
    $holiday_count=$row["hol_count"];

    //generate next holiday ID
    $sql_get_id="SELECT MAX(holiday_id) AS max_id FROM holiday";
    $result_get_id=mysqli_query($conn,$sql_get_id);
    $row=mysqli_fetch_array($result_get_id);
    $max_id = $row['max_id'];

    // generate the new pet ID
    if ($max_id === null) {
        $holiday_id = "H001";
    } else {
        $num = intval(substr($max_id, 1)) + 1;
        if ($num < 10) {
            $holiday_id = "H00$num";
        } else if ($num < 100) {
            $holiday_id = "H0$num";
        } else {
            $holiday_id = "H$num";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $from_date=date('Y-m-d', strtotime($_POST['from_date']));
            $to_date=date('Y-m-d', strtotime($_POST['to_date']));
            
            //checkDateValidation
            if($from_date<=$to_date){
                
                $holiday_type=$_POST['holiday_type'];
                $holiday_reason=$_POST['holiday_reason'];
        
                //check data null values
                if($holiday_type!="---Select Holiday Type--"){

                    //check whether the date is free - only for vets
                    $sql_getcount="SELECT COUNT(*) FROM holiday WHERE from_date='$from_date'";
                    $result_getcount=mysqli_query($conn,$sql_getcount);
                    $row=mysqli_fetch_array($result_getcount);

                    if($row[0]>=1){
                        echo '<script>alert("Could not place the leave request. Please contact the admin")</script>';
                    }else{
                        //check whether the user has submitted a leave request previously on the same day
                        $sql_getdaycount="SELECT COUNT(*) FROM holiday WHERE requested_date='$current_date' AND emp_id='$emp_id'";
                        $result_getdaycount=mysqli_query($conn,$sql_getdaycount);
                        $row_getdaycount=mysqli_fetch_array($result_getdaycount);

                        if($row_getdaycount[0]>=3){
                            echo '<script>alert("You have already reached the daily limit of requesting leaves. Please contact the admin")</script>';
                        }else{
                            $sql = "INSERT INTO holiday (holiday_id,from_date,to_date,approval_stage,emp_id,holiday_type,holiday_reason,requested_date) 
                            VALUES ('$holiday_id','$from_date','$to_date','Pending','$emp_id','$holiday_type','$holiday_reason','$current_date')";
                            $result = mysqli_query($conn,$sql);
                            
                            if($result==TRUE) { 
                                echo '<script>alert("Your leave request has been sent to the admin")</script>';
                                //header("location: dashboard.php");
                            }else {
                                echo '<script>alert("Could not place the leave request. Please try again.")</script>';
                            }
                        }   
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
    <link rel="stylesheet" href="../css/leaverequest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title></title>
</head>
<body>

<div class="main-container">

    <!-- left side nav bar -->

    <div class="left-container">
        <div class="user-img">
        <center><img src="../images/logo_transparent black.png"></center>
        </div>
        <ul>
                <li>
                    <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="showclients.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
                </li>
                <li>
                    <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment
                            History</span></a></a>
                </li>
                <li>
                    <a href="leaverequest.php" class="active"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a>
                </li>
                <li>
                    <a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My
                            Profile</span></a>
                </li>
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
                    <label><b>No. of Holidays Taken: </b></label>
                    <label><?php echo $holiday_count ?></label><br><br>
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
                    <button class="btn-add" type="submit">Request </button>
                </form> 
            </div>
            
            <div>
                <div class="request-type">
                    <center><p><b>Remaining No of Leave Requests</b></p><br></center>
                    <?php
                        $sql_tot = "SELECT * FROM holiday_references";
                        $result_tot = mysqli_query($conn, $sql_tot);
                        if(mysqli_num_rows($result_tot) > 0)
                        {
                            while($row_tot = mysqli_fetch_assoc($result_tot)){
                                echo '<label><b>'. $row_tot["holiday_type"] .': </b></label>';
                                
                                //get the total no of holidays taken from a specific holiday type
                                $sql_tot_type = "SELECT COUNT(*) FROM holiday WHERE holiday_type='{$row_tot["holiday_type"]}' AND emp_id='$emp_id'";
                                $result_tot_type = mysqli_query($conn, $sql_tot_type);
                                $row_tot_type=mysqli_fetch_array($result_tot_type);
                                
                                if($row_tot_type[0]> 0){
                                    //get the remaining no of holidays
                                    $remaining= $row_tot["no_of_holidays"]-$row_tot_type[0]; 
                                    echo $remaining .'<br>';
                                }else{
                                    echo $row_tot["no_of_holidays"].'<br>';
                                }

                                
                            }
                        } else {
                            $image_url = "images/no-results.png";
                            echo '<img src="' . $image_url . '" alt="No results" width="200" height="200">';
                        }
                    ?>
                </div>
                <center>
                <div class="request-type">
                    <p><b>Requested Leaves</b></p><br>
                    <?php
                        $sql_getholidays = "SELECT * FROM holiday WHERE emp_id='$emp_id'";
                        $result_getholidays = mysqli_query($conn, $sql_getholidays);
                        if(mysqli_num_rows($result_getholidays) > 0)
                        {
                            echo '<form method="POST" action="deleteholiday.php"><table>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Stage</th>
                                    <th>Cancel</th>
                                </tr>';

                            while($row = mysqli_fetch_assoc($result_getholidays)){

                                //adding the color according to the approval stage
                                $stage_color = '';
                                switch($row["approval_stage"]) {
                                    case 'Pending':
                                        $stage_color = '#f5f56c';
                                        break;
                                    case 'Approved':
                                        $stage_color = '#67eb69';
                                        break;
                                    case 'Rejected':
                                        $stage_color = '#c74a4a';
                                        break;
                                }

                                if($row["from_date"]>=$current_date){
                                    echo '<tr > 
                                        <td>' . $row["holiday_type"] . '</td>
                                        <td> ' . $row["from_date"] . '</td>
                                        <td>' . $row["to_date"] . '</td> 
                                        <td style="background-color: ' . $stage_color . ';">' . $row["approval_stage"] . '</td>
                                        <td class="action-btn"><button type="submit" name="holiday_id" 
                                            value="' . $row["holiday_id"] . '"><img src="../images/delete.png"></button></td>
                                    </tr>';
                                }
                            }
                            echo '</table></form>';
                        } else {
                            $image_url = "../images/no-results.png";
                            echo '<img src="' . $image_url . '" alt="No results" width="200" height="200">';
                        }
                    ?>
                </div>
       
            </div>
            </center>
            </div>
        </div>
</div>
    </div>
</body>
</html>