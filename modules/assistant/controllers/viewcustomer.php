<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/viewcustomer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
<div class="user-img"><center><img src="../images/logo_transparent black.png"></center></div>
        <ul>
        <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
           
            <li>
                <a href="showclients.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
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

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">
                    <font class="header-font-1">Hello </font> &nbsp
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
                    
                </ul>
            </div>
        </div>
        <div class="container">
            <br/><br/><br/>
<div class="cont">
<div class="cont1">
<center><img src="../images/buttler.png"><br/> Mr.Sachintha Perera</br>sachintha@gmail.com</center>
<div class="appoint">
<center>Appointments</center>
<div class="appointment">
   
    <div class="appoint1"><p>5<br/>Past</p></div>
    <div class="appoint2"><p>2<br/>Upcoming</p></div>
</div>
</div>
<div>

<p>Pet Owner's ID</p>
<p>O002</p>
<hr/>
<br/>
<p>Phone Number</p>
<p>0770 377 558</p>
<hr/>
</br>
<p>National ID Number</p>
<p>9916020015V</p>
<hr/>
<br/>
<p>Address</p>
<p>No23, Temple Road, Horana</p>
<hr/>
<br/>
<p>City</p>
<p>Horana</p>
<hr/>
<br/>
<p>Number Of Pets</p>
<p>2</p>
<hr/>
</div>
</div>



<div class="cont2">

<div class="top-btn-set" style="display:flex; width:96%; margin-left:2%">
    <div class="active-pet"><button style="background-color: #C38D9E;color: black;">Chester</button></div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="inactive-pet"style="width:33.33%;"><button>Dora</button></div>
    
</div>
<br/>
<!-- <hr/>

<br/> -->

<div class="pet-name"><p>Pet Name : CHESTER</p></div>

<div class="dog-img"><img src="../images/dog.png" width=40%></div>


<div class="pet-details">
<div class="pet-details-list-1">
<p>Pet ID</p>
<p>P002</p>
<hr/>
<br/>

<p>Requested Date</p>
<p>23/12/2022</p>
<hr/>
<br/>

<p>Age</p>
<p>3 years</p>
<hr/>
<br/>

<p>Weight</p>
<p>7kg</p>
<hr/>
<br/>

<p>Gender</p>
<p>Male</p>
<hr/>
<br/>

</div>
<div class="pet-details-list-2">
<p>Vacccines</p>
<p>distemper</p>
<hr/>
<br/>

<p>Breed</p>
<p>Golden Retriever</p>
<hr/>
<br/>
<br/>
<div class="btn-bottom-set">
    <button>View Previous Treatments</button>
    <br/><br/>
 
</div>

</div>

</div>


</div>
</div>

       

            
    </div>
    <script src="script.js"></script>
</body>

</html>