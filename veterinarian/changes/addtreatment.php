<?php
    $connection = null;

    function checkConnection($db) {
        if (mysqli_connect_error($db)) {
            echo '<br /><span style="color: red>"'.mysqli_connect_error($db).'</span>';
            exit();
        }
    }

    /** This function will execute the specified query in the database.
     *  if the query success, return true otherwise false
     */
    function executeQuery($query, $db) {
        checkConnection($db);
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        }

        print_r(mysqli_error($db)); // print the mysql errors after the execution of the above query
        return false;
    }

    $treatments = [
        "Swelling"
        "Collapsed",
        "Diarrhoea",
        "Vomiting",
        "Ear Problem",
        "Eye Problem",
        "Bloated",
        "Difficult to Walk",
        "Bleeding",
        "Skin Redness",
        "Scratching",
        "Furr Loss",
        "Fluffed Up",
    ];

    if (isset($_POST['treatment'])) {
        $time = strtotime($_POST['followup_date']);

        $treatmentList = "";
        for ($i = 0; $i < count($treatments); $i++) {
            if (isset($_POST['Surgery'.$i])) {
                $treatmentList .= $treatments[$i];
            }
        }

        $query = "INSERT INTO treatment(treatment_type, clinical_symptoms, lab_investigations, differential_diagnosis, definitive_diagnosis, followup_date, special_comments) 
        VALUES ($_POST['treatment'], $treatmentList, $_POST['lab_investigation'], $_POST['differential_diagnosis'], $_POST['definitive_diagnosis'], date('Y-m-d', $time), $_POST['special_comments'])";
        if (executeQuery($query, $connection)) {
            echo 'Treatment successfully added!';
        } else {
            echo 'Treatment not added!';
        }
    } else if (isset($_POST['Surgery'])) {
        $time = strtotime($_POST['followup_date']);

        $query = "INSERT INTO treatment(treatment_type, clinical_symptoms, lab_investigations, differential_diagnosis, definitive_diagnosis, followup_date, special_comments) 
        VALUES ($_POST['treatment'], $treatmentList, $_POST['lab_investigation'], $_POST['differential_diagnosis'], $_POST['definitive_diagnosis'], date('Y-m-d', $time), $_POST['special_comments'])";
        if (executeQuery($query, $connection)) {
            echo 'Treatment successfully added!';
        } else {
            echo 'Treatment not added!';
        }
    }
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="addtreatment.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@500&family=Amatic+SC:wght@700&family=Poppins:wght@300&family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="nav-bar">
        <div class="nav-left">
            <font class="header-font-1">Welcome </font>
            <font class="header-font-2">Dr John</font>
        </div>
        <div class="nav-right">
            <ul class="navbar-ul">
                <li><img class="notification" src="images/notification.png"></li>
                <li><img class="msg" src="images/msg.png"></li>
                <li><img class="log-out" src="images/log-out.png"></li>
            </ul>

        </div>
    </div>
    <div class="clear"></div>

    <div class="main">

        <div class="main-left">
             <br /><br /><br /><br /> 

<div class="doc-profile">
<center><img class="doctor-img" src="images/doctor.png"></center>
<center><font class="doc-name">Dr John Doe</font><center></center>

</div>


<br/>

<div>
            <ul>
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="images/dashboard.png"></div>
                        <div class="main-left-right">Dashboard</div>
                    </div>
                </li><br /><br/>
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="images/client.png"></div>
                        <div class="main-left-right" style="color:#C38D9E; font-weight: bolder;">Clients</div>
                    </div>
                </li><br /><br/>
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="images/leave.png"></div>
                        <div class="main-left-right">Leave Request</div>
                    </div>
                </li><br /><br/>

                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="images/profile.png"></div>
                        <div class="main-left-right">My Profile</div>
                    </div>
                </li><br /><br/>
                <li>
                    <div class="left-main-navigation">
                        <div class="main-left-left"><img class="main-left-icon" src="images/log-out.png"></div>
                        <div class="main-left-right">Log Out</div>
                    </div>
                </li><br /><br/>
            </ul>
</div>

        </div>

        <div class="main-right">

            <br /><br /><br /><br /> <br/>
<div class="title"><center><font class="treatment-title">ADD NEW TREATMENT</font></center></div>


<div class="content">
    <div class="content-left">
<font class="pet-name">CHESTER</font>
<div><img src="images/dog.png" style="width:40%;margin-left: 50px;"></div>
<div>

    <form action="addtreatment.php" class="form" method="POST">

<div>
    <label for="date" style="margin-left: 200px;font-family: 'Alegreya Sans';font-style: normal;">Date</label><br/><br/>
<div>    <input type="date" placeholder="Date" name="date"></div>

</div>


<div><label for="option" style="margin-left: 200px;font-family: 'Alegreya Sans';font-style: normal;"></label><br/>
    <div class="c-box">    
        <input type="checkbox" name="treatment">Treatment &nbsp;
        <input type="checkbox" name="Surgery">Surgery
    </div>
    
    </div>
<br/>

<div><font>Clinical Signs/Symptoms</font></div><br/>


<div class="sym-list"><div class="sym-list-left" style="float: left; width: 50%;">
    <?php
        for ($i = 0; $i < $cnt; $i++) {
    ?>
    <input type="checkbox" name="Surgery<?php echo $i; ?>"><?php echo $treatments[$i]; ?><br/>
    <?php } ?>
    <input type="checkbox" name="treatment">  Swelling  </br>
        <!--<input type="checkbox" name="Surgery">Collapsed <br/>
        <input type="checkbox" name="Surgery">Diarrhoea <br/>
        <input type="checkbox" name="Surgery">Vomiting   <br/>
        <input type="checkbox" name="Surgery">Ear Problem<br/>
        <input type="checkbox" name="Surgery">Eye Problem<br/>
        <input type="checkbox" name="Surgery">Bloated<br/>
        <input type="checkbox" name="Surgery">Difficult to Walk<br/>-->
</div>

<div class="sym-list-right" style="float: right; width: 50%;">
    <input type="checkbox" name="treatment">  Bleeding </br>
        <!--<input type="checkbox" name="Surgery">Skin Redness<br/>
        <input type="checkbox" name="Surgery">Scratching<br/>
        <input type="checkbox" name="Surgery">Furr Loss<br/>
        <input type="checkbox" name="Surgery">Fluffed Up<br/>-->
  
</div>

</div>



    </form>


</div>



    </div>
    <div class="content-right">
        <br/><br/>

<form action="">
    <label for="special comments">Medicines</label>
    <br>
    <label class="container">trimethoprim-sulfa
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label class="container">cephalexin
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label class="container">enrofloxacin
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label class="container">penicillin
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <br><br>
    <label for="special comments">Laboratory Investigations</label>
    <label class="container">XRay
      <input type="checkbox" name="lab_investigation">
      <span class="checkmark"></span>
    </label>
    <label class="container">FBC
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label class="container">Ultra Sound
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label for="special comments">Vaccines</label>
    <label class="container">CPV
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label class="container">DHL
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
    <label class="container">ARV
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
                      <div class="input-group">
                          <input class="input--style-1" type="text" placeholder="Differential Diagnosis" name="differential_diagnosis" required="required" >
                      </div>
  
                      <div class="input-group">
                          <input class="input--style-1" type="text" placeholder="Definitive Diagnosis" name="definitive_diagnosis" required="required">
                      </div>
                      <div class="treatment-date">
                      <label for="followup date">FollowUp Date</label>
                      <input name="followup_date" type="date" id="date" name="date">
                      </div>
                      <label for="special comments">Special Comments</label>
                      <br>
                      <textarea rows="4" cols="50" name="special_comments" form="usrform"></textarea>
                      <br><br>
                      <div class="p-t-20">
                          <button class="btn btn--radius btn--green" type="submit">Save New Treatment</button>
                      </div>
                      <div class="p-t-20">
                          <button class="btn btn--radius btn--green" type="submit">Send Treatment Details</button>
                      </div>
</form>
    





    </div>



</div>






        </div>



    </div>

</body>
</head>