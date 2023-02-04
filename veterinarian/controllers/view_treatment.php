<?php
    include('../process/dbconnection.php');
    session_start();
    $id=$_SESSION["treatment_id"] ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/view_treatment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
<div class="user-img"><center><img src="../images/logo.png" width=50%></center></div>
        <ul>
        <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
           
            <li>
                <a href="showclients.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
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
            <a href="logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
<div class="hello">Hello Admin</div>
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
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span id="designation">Admin</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container" style="background-size: cover;
background-position: center;
height: 100vh;">
            


            <br/>
<center><div class="staff-title">Add Treatment</div></center>
<br/>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST">
 

<div class="contentt">
   <div class="content-left">
       <div class="pet-name">Pet Name : CHESTER</div>
       <br /><br /><br/>
       <div class="pet-img"><img src="../images/dog.png"></div>
   
<br/><br/>
       <div class="label-date">
                                <label for="date">Date</label>
                                <div class="date"> <input type="date" placeholder="Date" name="treatment_date"></div>

        </div>

<br/>
        <div class="label-title-a">
                                <label for="option"></label>
                                <div class="c-box">
                                    <input type="checkbox" name='treatment_type[]' value="Treatment">Treatment &nbsp;
                                    <input type="checkbox" name='treatment_type[]' value="Surgery">Surgery
                                </div>

       </div>
<br/>
       <div class="label-title-a">Clinical Signs/Symptoms</div>



       <div class="sym-list">
       <?php
                                //select query
                                $sql = "SELECT * FROM `symptoms` WHERE treatment_id=`T005`";
                                // $result = mysqli_query($conn, $sql);
                                $result=mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['symptoms'];
                                    echo $name;
                                    echo "<br />";
                                }
                                ?>

        </div>
       
   
   
    </div>

   <div class="content-right">
   
    
   <div class="label-title-a">Medicines</div>
   <div class="sym-list">
                            <div class="sym-list-left">
                            <?php
                                //select query
                                $sql_med = "SELECT * FROM `treatment_medicine` WHERE `treatment_id`='T001'";
                                $result = mysqli_query($conn, $sql_med);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['treatment_medicine'];
                                    echo $name;
                                    echo "<br />";
                                }
                                ?>

                            </div>

   </div>
   <br/></br><br/></br><br/>

   <div class="sym-list">
                            <div class="sym-list-left">
                                <div class="label-title-a">Laboratory Investigations</div> 
                                <?php
                                //select query
                                $sql = "SELECT * FROM `lab_investigations` WHERE treatment_id=`T001`" ;
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['lab_investigations'];
                                    echo $name;
                                    echo " <br>";
                                }
                                ?>

                            </div>


                            <div class="sym-list-right">
                                <div class="label-title-a">Vaccines</div> 
                                <?php
                                //select query
                                $sql = "SELECT * FROM `vaccines` WHERE treatment_id=`T001`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['vaccines'];
                                    echo $name;
                                    echo "<br />";
                                }
                                ?>


                            </div>

   </div>
<br/><br/>

   <div>
                            <div class="label-title-b">
                                <label for="date">Definitive Diagnosis</label><br />
                            </div>
                            <div><input type="text" name="definitive_diagnosis"></div>
                            <?php
                                //select query
                                $sql = "SELECT definitive_diagnosis FROM `treatment` WHERE treatment_id=`T001`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['definitive_diagnosis'];
                                    echo $name;
                                    echo "<br />";
                                }
                                ?>

    </div>
    <br />
                        <div>
                            <div class="label-title-b">

                                <label for="date">Special Comments</label><br />

                            </div>
                            <div><input type="text" name="special_comments"></div>
                            <?php
                                //select query
                                $sql = "SELECT special_comments FROM `treatment` WHERE treatment_id=`T001`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['special_comments'];
                                    echo $name;
                                    echo "<br />";
                                }
                                ?>

                        </div>
                        <br/>
                        <div>
                            <div class="label-title-c">
                                <label for="date">Follow Up Date</label><br />
                            </div>
                            <?php
                                //select query
                                $sql = "SELECT followup_date FROM `treatment` WHERE treatment_id=`T001`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['followup_date'];
                                    echo $name;
                                    echo "<br />";
                                }
                                ?>
                            <div> <input type="date" placeholder="Date" name="followup_date"></div>

                        </div>
                        <div class="center">
                            <button type="submit" name="submit" class="button" id="save" onclick="show()">Save</button>
                        </div>



   </div>
 
 
 
 
  </div>


</form>
















    </div>
    <script src="script.js"></script>
</body>

</html>