<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');



$sql = "SELECT medicine_id , medicine_name FROM medicine";
$all_medicines = mysqli_query($conn, $sql);
$medicine = [];

while ($row = mysqli_fetch_assoc($all_medicines)) {
    // check availablity
    $current_med = [];
    $med_id = $row['medicine_id'];
    $check_with_batch = "SELECT batch_qty, batch_expdate FROM batch WHERE medicine_id = '$med_id'";
    $med = mysqli_query($conn, $check_with_batch);
    $med_data = mysqli_fetch_assoc($med);
    if ($med_data == null) {
        $row['availability'] = false;
    } else {
        $today = date("Y-m-d");
        $exp_date = $med_data['batch_expdate'];
        $med_qty = $med_data['batch_qty'];
        $expired = $today >= $exp_date;
        if (!$expired && $med_qty > 0) {
            $row['availability'] = true;
        } else {
            $row['availability'] = false;
        }
    }

    array_push($medicine, $row);
}

// echo json_encode($medicine);
// die();

$sql = "SELECT lab_id , lab_name FROM lab_investigations";
$lab_inv = mysqli_query($conn, $sql);


$sql = "SELECT medicine_id ,medicine_name FROM medicine WHERE medicine_category='vaccines'";
$vaccines = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if (isset($_POST['selected_medicine'])) {
    //     $id = $_POST['selected_medicine'];
    //     foreach ($id as $student) {
    //         $extract_ = explode(',', $student);


    //         // $query = "INSERT INTO student (id,name) values ('$extract[0]','$extract[1]')";
    //     }
    // }
    // $treatment = mysqli_real_escape_string($conn, $_REQUEST['treatment']);
    // $surgery = mysqli_real_escape_string($conn, $_REQUEST['surgery']);
    if (isset($_POST['symptoms']) && !empty($_POST['symptoms']) && isset($_POST['def_diagnosis']) && isset($_POST['followup_date'])) {
        // die($_POST['symptoms']);
        $sql = 'SELECT * FROM treatment ORDER BY treatment_id  DESC LIMIT 1';
        $last_record = mysqli_query($conn, $sql);

        $last_record_data = mysqli_fetch_assoc($last_record);

        $last_id = substr($last_record_data['treatment_id'], 1);
        $next_t_id = 'T' . str_pad(intval($last_id) + 1, strlen($last_id), '0', STR_PAD_LEFT);



        $symptoms = mysqli_real_escape_string($conn, $_REQUEST['symptoms']);
        $def_diagnosis = mysqli_real_escape_string($conn, $_REQUEST['def_diagnosis']);
        $followup_date = mysqli_real_escape_string($conn, $_REQUEST['followup_date']);


        $sql = "INSERT INTO treatment (treatment_id,vet_id, pet_id, symptoms, definitive_diagnosis, followup_date) VALUES ('$next_t_id','E002', 'P001', '$symptoms', '$def_diagnosis', '$followup_date')";

        if (mysqli_query($conn, $sql) == 1) {
            $_SESSION['treatment_added'] = true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
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
    <title>Pet Care</title>
</head>

<body>
    <section class="section">
        <button class="show-modal button">Show Modal</button>
        <span class="overlay"></span>
        <div class="modal-box">
            <i class="fa-regular fa-circle-check"></i>
            <h3>Completed</h3>
            <p>You have sucessfully downloaded all the source code files.</p>
            <div class="buttons">
                <button class="close-btn">OK, Close</button>
                <button>Open File</button>
            </div>
        </div>
    </section>
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
        <form action="add_treatment_.php" method="post">
            <div class="container">
                <div class="treatment-content">
                    <div class="treatment-header">

                        <h2>New Treatment For Chester
                            <? echo $id[0] ?>
                        </h2>

                    </div>
                    <div class="treatment-data">
                        <div class="t-symptoms">
                            <div class="first-row">
                                <div class="checkbox-wrapper-43">
                                    <label for="">Treatment</label>
                                    <input type="checkbox" name="treatment" id="cbx-43">
                                    <label for="cbx-43" class="check">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z">
                                            </path>
                                            <polyline points="1 9 7 14 15 4"></polyline>
                                        </svg>
                                    </label>
                                </div>

                                <div class="checkbox-wrapper-4">
                                    <label for="">Surgery</label>
                                    <input type="checkbox" name="surgery" id="cbx-4">
                                    <label for="cbx-4" class="check">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z">
                                            </path>
                                            <polyline points="1 9 7 14 15 4"></polyline>
                                        </svg>
                                    </label>
                                </div>
                            </div>

                            <label for="textarea">Clinical Signs/Symptoms</label>
                            <textarea class="" name="symptoms" placeholder="balla gana kiyanna"></textarea>

                            <label for="textarea">Definitive Diagnosis</label>
                            <textarea class="" name="def_diagnosis"></textarea>

                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Name" name="sp_comments" id='name' />
                                <label style="white-space: nowrap;" for="name" class="form__label">Special
                                    Comments</label>
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
                                                    echo "<input type='checkbox' " . $disable . "  id=" . $row["medicine_name"] . " name='slected_medicine[]' value=" . $row["medicine_name"] . ">";
                                                    echo "<label style='opacity: " . $opacity . "' > " . $row["medicine_name"] . "</label><br>";
                                                }
                                            } else {
                                                echo "<pre style='text-align: center'> No investigations </pre>";
                                            }
                                            ?>

                                        </div>
                                    </section>
                                    <input type="radio" name="accordion" id="cb2" />
                                    <section class="box">
                                        <label class="box-title" for="cb2">Laboratory Investigations</label>
                                        <label class="box-close" for="acc-close" onclick="clickLab()"></label>
                                        <div class="box-content" id="lab" style="-webkit-column-count: 2">
                                            <?php
                                            if (!$lab_inv == 1) {
                                                echo "<pre style='text-align: center'> No investigations </pre>";
                                            } else {
                                                if (mysqli_num_rows($lab_inv) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($lab_inv)) {
                                                        echo "<input type='checkbox' id='vehicle1' name='vehicle1' value=" . $row["lab_investigations"] . ">";
                                                        echo "<label> " . $row["lab_investigations"] . "</label><br>";
                                                    }
                                                } else {
                                                    echo "0 results";
                                                }
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
                                            if (!$vaccines == 1) {
                                                echo "<pre style='text-align: center'> No Vaccines </pre>";
                                            } else {
                                                if (mysqli_num_rows($vaccines) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($vaccines)) {
                                                        echo "<input type='checkbox' id='vehicle1' name='vehicle1' value=" . $row["vaccines"] . ">";
                                                        echo "<label> " . $row["vaccines"] . "</label><br>";
                                                    }
                                                }
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
                                        <input type="date" placeholder="Date" id="followup_date" name="followup_date" min="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <div class="save-btn">
                                    <button class="button-01" type="submit" role="button">Save</button>
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

            const section = document.querySelector('.section'),
                overlay = document.querySelector('.overlay'),
                showBtn = document.querySelector('.show-modal'),
                closeBtn = document.querySelector('.close-btn');

            
            
                section.classList.add('active');

                <? if($_SESSION['treatment_added']) {
                    echo "section.classList.add('active');";
                    $_SESSION['treatment_added'] = false;
                } ?>
            
            
            
            


            closeBtn.addEventListener('click', () => {
                section.classList.remove('active');
                console.log('11');
            });
            overlay.addEventListener('click', () => {
                section.classList.remove('active');
                console.log('12');
            });

        </script>
</body>

</html>