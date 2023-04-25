<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/leaverequest.css">
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
                <a href="showclients.php"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>

            <li>
                <a href="leaverequest.php" class="active"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
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
                    <font class="header-font-2">JOHN</font>
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
        <div class="heading">Leave Request</div>
        <br/>
        <div class="request-area">
            <div class="request-area-left">
<center><div class="form-details"><form>
    <table>
<tr>
    <td><lable>*Leave Type</lable></td>
<td><input type="text"></td><br/>
</tr>
<tr>
<td><lable>*No of Dates</lable></td>
<td><input type="text"></td>
</tr>
<tr>
    <td>
<label>*Dates</label></td>

<td><lable>From</label><br/>
<input type="date">
<br/>
<lable>To</label></br>
<input type="date"></td>
</tr>
<tr>

<td><label>About</label></td>
<td><textarea></textarea></td></tr>
</table>
<br/>

<button> Request Now</button>
<button> Cancel</buttton><br/>
</form></div></center>

<div></div>
            </div>
            <div class="request-area-right">
<div class="status">
    <br/>
    <h3 style="margin-left:20px;">Request Status</h3>
<div><button style="background-color:pink; color:white; padding:3px 6px; border-radius:20px; border:none; margin-left:20px;">Pending</button>&nbsp; Approved &nbsp; Cancel</div>
<br/><textarea style="margin-left:20px; width:93%; border-radius:20px;" placeholder="aaaaaaaaaaa"&nbsp; &nbsp;>No Pending Request"></textarea>
</div>

            </div>
        </div>
           
        </div>
        <script src="script.js"></script>
</body>

</html>