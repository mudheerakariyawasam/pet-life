<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

$pet_id = isset($_GET['updateid']) ? mysqli_real_escape_string($conn, $_GET['updateid']) : '';

//get pet name
$sql_name = "SELECT pet_name FROM pet WHERE pet_id = '$pet_id'";
$result_name=mysqli_query($conn,$sql_name);
$row_name = mysqli_fetch_assoc($result_name);

$_SESSION['treatment_added'] = false;
$sql = "SELECT medicine_id , medicine_name, medicine_category FROM medicine";
$all_medicines = mysqli_query($conn, $sql);
$medicine = [];
$vaccine = [];

while ($row = mysqli_fetch_assoc($all_medicines)) {
    // check availablity
    $current_med = [];
    $med_id = $row['medicine_id'];
    // check against batch table
    $check_with_batch = "SELECT batch_id, batch_qty, batch_expdate FROM batch WHERE medicine_id = '$med_id'";
    $med = mysqli_query($conn, $check_with_batch);
    $med_data = mysqli_fetch_assoc($med);
    
    if ($med_data == null) {
        $row['availability'] = false;
        $row['batch_id'] = null;
    } else {
        $today = date("Y-m-d");
        $exp_date = $med_data['batch_expdate'];
        $med_qty = $med_data['batch_qty'];
        $expired = $today >= $exp_date;
        $row['batch_id'] = $med_data['batch_id'];
        if (!$expired && $med_qty > 0) {
            $row['availability'] = true;
        } else {
            $row['availability'] = false;
        }
    }

    // check whether it is a medicine or a vaccine
    if ($row['medicine_category'] == 'vaccine') {
       // push to vaccine array if category is vaccine
        array_push($vaccine, $row);
    } else {
        array_push($medicine, $row);
    }
    
}
$sql = "SELECT lab_id , lab_name FROM lab_investigations";
$lab_inv = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['treatment_added'] = false;

    if (
        isset($_POST["save-info"]) && isset($_POST['symptoms']) && !empty($_POST['symptoms']) && isset($_POST['def_diagnosis'])
        && isset($_POST['followup_date']) && isset($_POST['sp_comments'])
    ) {
        // die($_POST['symptoms']);
        $sql = 'SELECT * FROM treatment ORDER BY treatment_id  DESC LIMIT 1';
        $last_record = mysqli_query($conn, $sql);

        $last_record_data = mysqli_fetch_assoc($last_record);
        if (!$last_record_data) {
            $last_record_data['treatment_id'] = 'T000';
        }
        $last_id = substr($last_record_data['treatment_id'], 1);
        $next_t_id = 'T' . str_pad(intval($last_id) + 1, strlen($last_id), '0', STR_PAD_LEFT);



        $symptoms = mysqli_real_escape_string($conn, $_REQUEST['symptoms']);
        $def_diagnosis = mysqli_real_escape_string($conn, $_REQUEST['def_diagnosis']);
        $sp_comment = mysqli_real_escape_string($conn, $_REQUEST['sp_comments']);
        $followup_date = mysqli_real_escape_string($conn, $_REQUEST['followup_date']);

        $emp_id = $_SESSION['emp_id'];
        $sql = "INSERT INTO treatment (treatment_id,vet_id, pet_id, symptoms, definitive_diagnosis, special_comments, followup_date, treatment_bill)
         VALUES ('$next_t_id','$emp_id', 'P001', '$symptoms', '$def_diagnosis', '$sp_comment', '$followup_date', '5000.00')";

        if (mysqli_query($conn, $sql) == 1) {
            // die( $_SESSION['treatment_added']);
            $_SESSION['treatment_added'] = true;
            unset($_POST["save-info"]);

            if (isset($_POST['treatment_type'])) {
                foreach ($_POST['treatment_type'] as $ch => $value) {
                    $sql = "INSERT INTO treatment_type (treatment_id,treatment_type) VALUES ('$next_t_id','$value')";
                    mysqli_query($conn, $sql);
                }
            }

            if (isset($_POST['slected_medicine'])) {
                foreach ($_POST['slected_medicine'] as $ch => $value) {
                    $sql = "SELECT batch_id FROM batch WHERE medicine_id = '$value'";
                    $data = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    $batch_id = $data['batch_id'];
                    $sql = "INSERT INTO treatment_medicine (treatment_id,batch_id) VALUES ('$next_t_id','$batch_id')";
                    mysqli_query($conn, $sql);
                }
            }
            if (isset($_POST['selected_lab'])) {
                foreach ($_POST['selected_lab'] as $ch => $value) {
                    $sql = "INSERT INTO treatment_lab (treatment_id,lab_id) VALUES ('$next_t_id','$value')";
                    mysqli_query($conn, $sql);
                }
            }

            if (isset($_POST['selected_vaccine'])) {
                foreach ($_POST['selected_vaccine'] as $ch => $value) {
                    $sql = "INSERT INTO treatment_vaccine (treatment_id,batch_id) VALUES ('$next_t_id','$value')";
                    mysqli_query($conn, $sql);
                }
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
        unset($_POST["save-info"]);
    } else {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_treatment_.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title></title>
</head>

<body>
    <?php if (isset($_SESSION['treatment_added']) && $_SESSION['treatment_added'] == true) { ?>


        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1 class="modal-title"> Treatment ID :
                    <?php echo $next_t_id ?>
                </h1>

                <table class="view-data">
                    <tr class="data-record">
                        <?php if (isset($_POST['treatment_type']) && count($_POST['treatment_type']) > 0) {
                            echo "<td class='table-subject'><i class='fa-solid fa-house-chimney-medical'></i> Treatment type </td>";
                            foreach ($_POST['treatment_type'] as $ch => $value) {
                                echo "<td style='padding-right: 10px;'> <i class='fa-regular fa-square-check'></i> $value </td>";
                            }
                        }
                        ?>
                    </tr>
                    <tr class="data-record">
                        <td class="table-subject"><i class="fa-solid fa-house-medical-circle-exclamation"></i>Clinical
                            Signs/Symptoms </td>
                        <td>
                            <?php echo $symptoms ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-subject"><i class="fa-solid fa-stethoscope"></i>Definitive Diagnosis </td>
                        <td>
                            <?php echo $def_diagnosis ?>
                        </td>
                    </tr>

                    <?php if (strlen($sp_comment) > 0) { ?>
                        <tr>
                            <td class="table-subject"><i class="fa-solid fa-comment-medical"></i>Special comments </td>
                            <td>
                                <?php echo $sp_comment ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <tr class="data-record">
                        <?php if (isset($_POST['slected_medicine']) && count($_POST['slected_medicine']) > 0) {
                            echo "<td class='table-subject'><i class='fa-solid fa-capsules'></i> Medicine </td>";
                            foreach ($_POST['slected_medicine'] as $ch => $value) {
                                echo "<td style='padding-right: 10px;'> <i class='fa-solid fa-tablets'></i> $value </td>";
                            }
                        }
                        ?>
                    </tr>

                    <tr class="data-record">
                        <?php if (isset($_POST['selected_lab']) && count($_POST['selected_lab']) > 0) {
                            echo "<td class='table-subject'><i class='fa-solid fa-vial-virus'></i> Lab investigations </td>";
                            foreach ($_POST['selected_lab'] as $ch => $value) {
                                echo "<td style='padding-right: 10px;'><i class='fa-solid fa-vial'></i> $value </td>";
                            }
                        }
                        ?>
                    </tr>

                    <tr class="data-record">
                        <?php if (isset($_POST['selected_vaccine']) && count($_POST['selected_vaccine']) > 0) {
                            echo "<td class='table-subject'><i class='fa-solid fa-shield-virus'></i> Vaccines </td>";
                            foreach ($_POST['selected_vaccine'] as $ch => $value) {
                                echo "<td style='padding-right: 10px;'><i class='fa-solid fa-syringe'></i> $value </td>";
                            }
                        }
                        ?>
                    </tr>
                    <tr class="data-record">
                        <?php

                        if (isset($_POST['followup_date'])) {
                            $today = date("Y-m-d");
                            $f_date = $_POST['followup_date'];
                            if ($today < $f_date) {
                                echo "<td class='table-subject'><i class='fa-solid fa-calendar-days'></i> Followup date </td>";
                                echo "<td style='padding-right: 10px;'> $f_date </td>";
                            }
                        }
                        ?>
                    </tr>

                </table>

                <div style="color: green;text-align: center;">
                    <?php echo $next_t_id ?>
                    <p style="padding-left: 8px;"> is successfully added.</p>
                </div>
            </div>

        </div>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("btn-save");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            modal.style.display = "block";
            modal.style.opacity = 1;

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
                window.location.href="treatment_history.php";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>


    <?php } ?>


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
                <a href="treatment_history.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatment
                        History</span></a></a>
            </li>
            <li>
                <a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
            </li>

            <li>
                <a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
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
                    <font class="header-font-1">Welcome </font> &nbsp
                    <font class="header-font-2">
                        <?php echo $_SESSION['user_name']; ?>
                    </font>
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
        <form action="add_treatment_.php" method="post">
            <div class="container">
                <div class="treatment-content">
                    <div class="treatment-header">

                        <h2>New Treatment For 
                        <?php echo $row_name["pet_name"]; ?>
                        </h2>

                    </div>
                    <div class="treatment-data">
                        <div class="t-symptoms">

                            <div class="first-row">
                                <div class="checkbox-wrapper-43">
                                    <label for="">Treatment</label>
                                    <input type="checkbox" class="treatment-type-t" name="treatment_type[]"
                                        value="treatment" id="cbx-43">
                                    <label for="cbx-43" onclick="clickTcheck()" class="check t-check">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                            <path
                                                d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z">
                                            </path>
                                            <polyline points="1 9 7 14 15 4"></polyline>
                                        </svg>
                                    </label>
                                </div>

                                <div class="checkbox-wrapper-4">
                                    <label for="">Surgery</label>
                                    <input type="checkbox" class="treatment-type-s" name="treatment_type[]"
                                        value="surgery" id="cbx-4">
                                    <label for="cbx-4" class="check s-check" onclick="clickScheck()">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                            <path
                                                d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z">
                                            </path>
                                            <polyline points="1 9 7 14 15 4"></polyline>
                                        </svg>
                                    </label>
                                </div>
                            </div>


                            <label for="textarea">Clinical Signs/Symptoms</label>
                            <textarea class="add-symptoms" onclick="symptomClick()" name="symptoms"
                                placeholder="Please enter clinical symptoms"></textarea>

                            <label for="textarea">Definitive Diagnosis</label>
                            <textarea class="add-diagnosis" onclick="diagnosisClick()" name="def_diagnosis"
                                placeholder="Please enter the definitive diagnosis"></textarea>

                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Name" name="sp_comments"
                                    id='name' />
                                <label style="white-space: nowrap;" for="name" class="form__label">Additional Medicines
                                    given</label>
                            </div>




                        </div>

                        <div class="t-medicine">

                            <div>
                                <nav class="accordion arrows">

                                    <input type="radio" name="accordion" id="cb1" />
                                    <section class="box">
                                        <label class="box-title" for="cb1">Medicines</label>
                                        <label class="box-close" for="acc-close" onclick="clickMed()"></label>
                                        <div class="box-content" id="med" style="-webkit-column-count: 2">

                                            <?php
                                            if (count($medicine) > 0) {
                                                // output data of each row
                                                foreach ($medicine as $row) {
                                                    $disable = $row['availability'] ? '' : 'disabled="disabled"';
                                                    $opacity = $row['availability'] ? '1' : '0.6';
                                                    echo "<input type='checkbox' " . $disable . "  id=" . $row["medicine_name"] . " name='slected_medicine[]' value=" . $row["medicine_id"] . ">";
                                                    echo "<label style='opacity: " . $opacity . "' > " . $row["medicine_name"] . "</label><br>";
                                                }
                                            } else {
                                                echo "<pre style='text-align: center'> No Medicines </pre>";
                                            }
                                            ?>

                                        </div>
                                    </section>
                                    <input type="radio" name="accordion" id="cb2" />
                                    <section class="box">
                                        <label class="box-title" for="cb2">Laboratory</label>
                                        <label class="box-close" for="acc-close" onclick="clickLab()"></label>
                                        <div class="box-content" id="lab" style="-webkit-column-count: 2">
                                            <?php
                                            if (mysqli_num_rows($lab_inv) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($lab_inv)) {
                                                    echo "<div><input type='checkbox' name='selected_lab[]' value=" . $row["lab_id"] . ">";
                                                    echo "<label> " . $row["lab_name"] . "</label><br></div>";
                                                }
                                            } else {
                                                echo "<pre style='text-align: center'> No investigations </pre>";
                                            }

                                            ?>
                                        </div>
                                    </section>
                                    <input type="radio" name="accordion" id="cb3" />
                                    <section class="box">
                                        <label class="box-title" for="cb3">Vaccines</label>
                                        <label class="box-close" for="acc-close" onclick="clickVac()"></label>
                                        <div class="box-content" id="vac">

                                            <?php
                                            if (count($vaccine) > 0) {
                                                // output data of each row
                                                foreach ($vaccine as $row) {
                                                    $disable = $row['availability'] ? '' : 'disabled="disabled"';
                                                    $opacity = $row['availability'] ? '1' : '0.6';
                                                    echo "<input type='checkbox' " . $disable . "  id=" . $row["medicine_name"] . " name='selected_vaccine[]' value=" . $row["batch_id"] . ">";
                                                    echo "<label style='opacity: " . $opacity . "' > " . $row["medicine_name"] . "</label><br>";
                                                }
                                            } else {
                                                echo "<pre style='text-align: center'> No Vaccines </pre>";
                                            }
                                            ?>
                                        </div>
                                    </section>

                                    <input type="radio" name="accordion" id="acc-close" />
                                </nav>
                            </div>

                            <div>
                                <div class="follow-date">
                                    <div>
                                        <label for="date">Follow Up Date</label><br />
                                    </div>
                                    <div>
                                        <input type="date" placeholder="Date" id="followup_date" name="followup_date"
                                            min="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <div class="save-btn">
                                    <button onclick="saveTreatment(event)" class="button-01" name="save-info"
                                        id="btn-save" type="submit" role="button">Save</button>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>

            </div>
        </form>
        <script>
            document.getElementById("vac").style.cssText = 'display: none';
            document.getElementById("lab").style.cssText = 'display: none';
            document.getElementById("med").style.cssText = 'display: none';


            const checkbox1 = document.getElementById('cb1');
            const checkbox2 = document.getElementById('cb2');
            const checkbox3 = document.getElementById('cb3');

            checkbox1.addEventListener('change', (event) => {
                if (event.currentTarget.checked) {
                    document.getElementById("med").style.cssText = 'display: inline-block; -webkit-column-count: 2';
                    document.getElementById("lab").style.cssText = 'display: none';
                    document.getElementById("vac").style.cssText = 'display: none';
                }
            });
            checkbox2.addEventListener('change', (event) => {
                if (event.currentTarget.checked) {
                    document.getElementById("lab").style.cssText = 'display: inline-block; -webkit-column-count: 2';
                    document.getElementById("med").style.cssText = 'display: none';
                    document.getElementById("vac").style.cssText = 'display: none';
                }
            });
            checkbox3.addEventListener('change', (event) => {
                console.log(event.currentTarget.checked);
                if (event.currentTarget.checked) {
                    document.getElementById("vac").style.cssText = 'display: inline-block; -webkit-column-count: 2';
                    document.getElementById("med").style.cssText = 'display: none';
                    document.getElementById("lab").style.cssText = 'display: none';
                }
            });

            function clickVac() {
                document.getElementById("vac").style.cssText = 'display: none';
            }

            function clickMed() {
                document.getElementById("med").style.cssText = 'display: none';
            }

            function clickLab() {
                document.getElementById("lab").style.cssText = 'display: none';
            }
            console.log(document.getElementById("btn-save"));
            // document.getElementById("btn-save").disabled = true;
            const save = document.querySelector('#btn-save');
            const treatmentBox = document.querySelector('.treatment-type-t');
            const surgeryBox = document.querySelector('.treatment-type-s');
            const sympotmsTA = document.querySelector('.add-symptoms');
            const diagnosisTA = document.querySelector('.add-diagnosis');


            const tCheckBox = document.querySelector('.t-check');
            const sCheckBox = document.querySelector('.s-check');


            function clickTcheck() {
                tCheckBox.style = 'background-color:unset';
                sCheckBox.style = 'background-color:unset';
            }
            function clickScheck() {
                sCheckBox.style = 'background-color:unset';
                tCheckBox.style = 'background-color:unset';
            }
            function symptomClick() {
                sympotmsTA.style = 'border-color:unset';
            }
            function diagnosisClick() {
                diagnosisTA.style = 'border-color:unset';
            }

            function saveTreatment(event) {
                let checkInputs = true;
                if ((!treatmentBox.checked && !surgeryBox.checked)) {

                    tCheckBox.style = 'background-color:red';
                    sCheckBox.style = 'background-color:red';
                    checkInputs = false;
                }


                if (sympotmsTA.value == '') {
                    sympotmsTA.style = "border-color: red";
                    checkInputs = false;
                }
                if (diagnosisTA.value == '') {
                    diagnosisTA.style = "border-color: red";
                    checkInputs = false;
                }

                if (!checkInputs) {
                    event.preventDefault();
                }

            }
        </script>
</body>

<!-- </html> -->