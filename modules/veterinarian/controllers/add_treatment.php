<?php
include('../dbconnection.php');




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['medicines']) || empty($_POST['treatment_date']) || empty($_POST['definitive_diagnosis'])) {
        echo ('<script>
            alert("Fill all the required fields!");</script>');
    } else {
        //generate the next treatment ID
        $sql_get_id = "SELECT treatment_id FROM treatment ORDER BY treatment_id DESC LIMIT 1";
        $result_get_id = mysqli_query($conn, $sql_get_id);
        $row = mysqli_fetch_assoc($result_get_id);

        $lastid = $treatment_id = "";
        if (mysqli_num_rows($result_get_id) > 0) {
            $lastid = $row['treatment_id'];
        }

        if ($lastid == "") {
            $treatment_id = "T001";
        } else {
            $treatment_id = substr($lastid, 1);
            $treatment_id = intval($treatment_id);

            if ($treatment_id >= 9) {
                $treatment_id = "T0" . ($treatment_id + 1);
            } else if ($treatment_id >= 99) {
                $treatment_id = "T" . ($treatment_id + 1);
            } else {
                $treatment_id = "T00" . ($treatment_id + 1);
            }
        }

        $_SESSION["treatment_id"] = $treatment_id;



        if (isset($_POST['treatment_date']) || isset($_POST['definitive_diagnosis']) || isset($_POST['special_comments']) || $_POST['followup_date']) {
            if (isset($_POST['treatment_date'])) {
                $treatment_date = $_POST['treatment_date'];
                if (isset($_POST['definitive_diagnosis'])) {
                    $definitive_diagnosis = $_POST['definitive_diagnosis'];
                    $special_comments = $_POST['special_comments'];
                    $followup_date = $_POST['followup_date'];
                    $sql = "INSERT INTO `treatment` (`treatment_id`,`vet_id`,`assistant_id`,`pet_id`,`definitive_diagnosis`,`special_comments`,`followup_date`,`treatment_date`) VALUES ('$treatment_id','E001','E001','P001','$definitive_diagnosis','$special_comments','$followup_date','$treatment_date')";
                    // INSERT INTO `treatment`(`treatment_id`, `vet_id`, `assistant_id`, `pet_id`, `definitive_diagnosis`, `special_comments`, `followup_date`, `treatment_date`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]')
                    $result = mysqli_query($conn, $sql);

                } else {
                    $diagnosis_err = "Please enter definitive diagnosis";
                }
            } else {
                $treatment_date_err = "please enter the date";
            }
        }

        if (isset($_POST['medicines'])) {
            $name = implode(" ", $_POST['medicines']);
            $insert = mysqli_query($conn, "INSERT INTO  `treatment_medicine` (`treatment_id`, `treatment_medicine`) VALUES ('$treatment_id','$name')");

        } else {
?>
<script>
    alert("Medicine is required");

</script>
<?php
        }
        if (isset($_POST['treatment_type'])) {

            $name = implode(" ", $_POST['treatment_type']);
            $insert = mysqli_query($conn, "INSERT INTO  `treatment_type` (`treatment_id`, `treatment_type`) VALUES ('$treatment_id','$name')");

        }


        if (isset($_POST['lab_investigations'])) {

            $name = implode(" ", $_POST['lab_investigations']);
            $insert = mysqli_query($conn, "INSERT INTO  `lab_investigations` (`treatment_id`, `lab_investigations`) VALUES ('$treatment_id','$name')");

        }
        if (isset($_POST['symptoms'])) {

            $name = implode(" ", $_POST['symptoms']);
            $insert = mysqli_query($conn, "INSERT INTO  `symptoms` (`treatment_id`, `symptoms`) VALUES ('$treatment_id','$name')");

        } else {
?>
<script>
    alert("Please mention Symptoms");

</script>
<?php
        }
        if (isset($_POST['vaccines'])) {

            $name = implode(" ", $_POST['vaccines']);
            $insert = mysqli_query($conn, "INSERT INTO  `vaccines` (`treatment_id`, `vaccines`) VALUES ('$treatment_id','$name')");

        }

        if ($result == TRUE) {
            header("location:readtreatment.php");
        } else {
            $error = "There is an error in adding!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_treatment.css">
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
            <a href="#"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
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
                    <font class="header-font-2">Senuri </font>
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
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">

            <br />
            <div class="heading">New Treatment</div>
            <br />

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST">


                <div class="contentt">
                    <div class="content-left">
                        <div class="pet-name">CHESTER</div>
                        <br /><br />
                        <div class="pet-img"><img src="../images/dog.png"></div>

                        <br /><br /><br />
                        <div class="label-date">
                            <label for="date">Date<span style="color:red;">*</span> </label>
                            <div class="date"> <input type="date" placeholder="Date" name="treatment_date"></div>

                        </div>

                        <br />
                        <div class="label-title-a">
                            <label for="option"></label>
                            <div class="c-box">
                                <input type="checkbox" name='treatment_type[]' value="Treatment">Treatment &nbsp;
                                <input type="checkbox" name='treatment_type[]' value="Surgery">Surgery
                            </div>

                        </div>
                        <br />
                        <div class="label-title-a">Clinical Signs/Symptoms</div>



                        <div class="sym-list">
                            <div class="sym-list-left">
                                <input type="checkbox" value="Swelling" name="symptoms[]">Swelling </br>
                                <input type="checkbox" value="Collapsed" name="symptoms[]">Collapsed<br />
                                <input type="checkbox" value="Diarrhoea" name="symptoms[]">Diarrhoea<br />
                                <input type="checkbox" value="Vomiting" name="symptoms[]">Vomiting<br />
                                <input type="checkbox" value="Ear Problem" name="symptoms[]">Ear Problem<br />
                                <input type="checkbox" value="Eye Problem" name="symptoms[]">Eye Problem<br />
                                <input type="checkbox" value="Bloated" name="symptoms[]">Bloated<br />
                                <!-- <input type="checkbox" name="symptoms[]">Lameness and Stiffness<br/> -->
                                <!-- <input type="checkbox" name="symptoms[]">Difficult to Walk<br/>
                                        <input type="checkbox" name="symptoms[]">Fluffed Up<br/> -->
                            </div>

                            <div class="sym-list-right">

                                <input type="checkbox" value="Bleeding" name="symptoms[]">Bleeding </br>
                                <input type="checkbox" value="Skin Redness" name="symptoms[]">Skin Redness<br />
                                <input type="checkbox" value="Scratching" name="symptoms[]">Scratching<br />
                                <input type="checkbox" value="Furr Loss" name="symptoms[]">Furr Loss<br />
                                <input type="checkbox" value="Loss of Appetite" name="symptoms[]">Loss of
                                Appetite<br />
                                <input type="checkbox" value="Infection on Beck" name="symptoms[]">Infection on
                                Beck<br />
                                <input type="checkbox" value="Weakness and Tiredness" name="symptoms[]">Weakness and
                                Tiredness<br />

                            </div>

                        </div>



                    </div>

                    <div class="content-right">


                        <div class="label-title-a">Medicines <span style="color:red;">*</span> </div>
                        <div class="sym-list">
                            <div class="sym-list-left">
                                <input type="checkbox" value="Trimethoprim-sulfa"
                                    name="medicines[]">Trimethoprim-sulfa</br>
                                <input type="checkbox" value="Cephalexin" name="medicines[]">Cephalexin<br />
                                <input type="checkbox" value="Enrofloxacin" name="medicines[]">Enrofloxacin<br />
                                <input type="checkbox" value="Penicillin" name="medicines[]">Penicillin</br>

                            </div>

                        </div>
                        <br /></br><br /></br><br />

                        <div class="sym-list">
                            <div class="sym-list-left">
                                <div class="label-title-a">Laboratory Investigations</div>
                                <input type="checkbox" value="X-RAY" name="lab_investigations[]">X-RAY</br>
                                <input type="checkbox" value="FBC" name="lab_investigations[]">FBC<br />
                                <input type="checkbox" value="Ultra Sound" name="lab_investigations[]">Ultra
                                Sound<br />

                            </div>
                            <div class="sym-list-right">
                                <div class="label-title-a">Vaccines</div>
                                <input type="checkbox" value="CPV" name="vaccines[]">CPV</br>
                                <input type="checkbox" value="DHL" name="vaccines[]">DHL</br>
                                <input type="checkbox" value="ARV" name="vaccines[]">ARV</br>


                            </div>

                        </div>


                        <div>
                            <div class="label-title-b">
                                <label for="date">Definitive Diagnosis <span style="color:red;">*</span></label><br />
                            </div>
                            <div><input type="text" name="definitive_diagnosis"></div>

                        </div>
                        <br />
                        <div>
                            <div class="label-title-b">

                                <label for="date">Special Comments</label><br />

                            </div>
                            <div><input type="text" name="special_comments"></div>

                        </div>
                        <br />
                        <div>
                            <div class="label-title-c">
                                <label for="date">Follow Up Date</label><br />
                            </div>
                            <div> <input type="date" placeholder="Date" name="followup_date" min="2023-12-23"></div>

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