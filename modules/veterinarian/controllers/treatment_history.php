<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');

$sql = "SELECT * FROM treatment";
$all_treatments = mysqli_query($conn, $sql);
$treatment_list = [];

while ($row = mysqli_fetch_assoc($all_treatments)) {
    // check availablity
    $current_treatment = [];
    $current_treatment['treatment_id'] = $row['treatment_id'];
    $current_treatment['vet_id'] = $row['vet_id'];
    $current_treatment['pet_id'] = $row['pet_id'];
    $current_treatment['assistant_id'] = $row['assistant_id'];
    $current_treatment['definitive_diagnosis'] = $row['definitive_diagnosis'];
    $current_treatment['followup_date'] = ($row['followup_date'] == '0000-00-00') ? '-' : $row['followup_date'];
    $current_treatment['special_comments'] = $row['special_comments'];
    $current_treatment['symptoms'] = $row['symptoms'];
    $current_treatment['treatment_bill'] = $row['treatment_bill'];
    $current_treatment['treatment_date'] = date("Y-m-j", strtotime($row['treatment_date']));
    $t_id = $row['treatment_id'];

    // treatment type
    $check_type = "SELECT treatment_type FROM treatment_type WHERE treatment_id = '$t_id'";
    $type = mysqli_query($conn, $check_type);
    $types = [];
    while ($row = mysqli_fetch_assoc($type)) {
        array_push($types, $row['treatment_type']);
    }
    $current_treatment['treatment_type'] = $types;

    // treatment medicine
    $check_meds = "SELECT batch_id FROM treatment_medicine WHERE treatment_id = '$t_id'";
    $batches = mysqli_query($conn, $check_meds);
    $meds = [];
    while ($row = mysqli_fetch_assoc($batches)) {
        $batch_id = $row['batch_id'];
        $check_med = "SELECT medicine_id FROM batch WHERE batch_id = '$batch_id'";
        $medicines = mysqli_fetch_assoc(mysqli_query($conn, $check_med));
        
        $med_id = $medicines['medicine_id'];
        $get_med = "SELECT medicine_name FROM medicine WHERE medicine_id = '$med_id'";
        $medicine_name = mysqli_fetch_assoc(mysqli_query($conn, $get_med));
        
        array_push($meds, $medicine_name['medicine_name']);
    }
    
    $current_treatment['medicine'] = $meds;
    
    // treatment lab
    $check_labs = "SELECT lab_id FROM treatment_lab WHERE treatment_id = '$t_id'";
    $labs = mysqli_query($conn, $check_labs);
    $lab_inv = [];
    while ($row = mysqli_fetch_assoc($labs)) {
        $lab_id = $row['lab_id'];
        $lab_name_query = "SELECT lab_name FROM lab_investigations WHERE lab_id = '$lab_id'";
        $lab_name = mysqli_fetch_assoc(mysqli_query($conn, $lab_name_query));
        array_push($lab_inv, $lab_name['lab_name']);
    }
    
    $current_treatment['lab_investigations'] = $lab_inv;
    
    // treatment vaccine
    $check_vaccines = "SELECT batch_id FROM treatment_vaccine WHERE treatment_id = '$t_id'";
    $batches = mysqli_query($conn, $check_vaccines);
    $vaccines = [];
    while ($row = mysqli_fetch_assoc($batches)) {
        $batch_id = $row['batch_id'];
        $check_vac = "SELECT medicine_id FROM batch WHERE batch_id = '$batch_id'";
        $vacs = mysqli_fetch_assoc(mysqli_query($conn, $check_vac));

        $vac_id = $vacs['medicine_id'];
        $get_vac = "SELECT medicine_name FROM medicine WHERE medicine_id = '$vac_id'";
        $vaccine_name = mysqli_fetch_assoc(mysqli_query($conn, $get_vac));

        array_push($vaccines, $medicine_name['medicine_name']);
    }

    $current_treatment['vaccine'] = $vaccines;
    // die(json_encode($current_treatment));

    array_push($treatment_list, $current_treatment);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/treatment_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Life</title>
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
                <a href="showclients.php" ><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="treatment_history.php" class="active"><i class="fa-solid fa-calendar-plus"></i><span>Treatment History</span></a></a>
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
                    <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
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
        <div class="heading">Treatment History</div>
             <div class="table-view">
                <table id="history">
                    <tr>
                        <th>Treatment ID </th>
                        <th>Vet ID</th>
                        <th>Pet ID</th>
                        <th> Symptoms</th>
                        <th> Definitive Diagnosis</th>
                        <th>Treatment Date</th>
                        <th> Followup Date</th>
                        <th> Special Comments</th>
                        <th> Treatment Bill</th>
                    </tr>
                    <?php
                    while ($rows = mysqli_fetch_assoc($result))
                    {
                    ?>
                    <tr>
                       <td><?php echo $rows['treatment_id'] ?></td>
                       <td><?php echo $rows['vet_id'] ?></td>
                       <td><?php echo $rows['pet_id'] ?></td>
                       <td><?php echo $rows['symptoms'] ?></td>
                       <td><?php echo $rows['definitive_diagnosis'] ?></td>
                       <td><?php echo $rows['treatment_date'] ?></td>
                       <td><?php echo $rows['followup_date'] ?></td>
                       <td><?php echo $rows['special_comments'] ?></td>
                       <td><?php echo $rows['treatment_bill'] ?></td>
                     
                    </tr>
                    <?php 
                    }
                    ?>
                    <tr>
                        <!-- <td>C002</td>
                        <td>John</td>
                        <td>02/05/2022</td>
                        <td>No.74, New York</td>
                        <td>0705369977</td>
                        <td>john@gmail.com</td>
                        <td>sachintha@gmail.com</td>
                        <td>sachintha@gmail.com</td>
                        <td>sachintha@gmail.com</td> -->
                    </tr>
                    <tr>
                        <!-- <td>C003</td>
                        <td>Swanson</td>
                        <td>02/05/2022</td>
                        <td>No.38/4, New York</td>
                        <td>0705836977</td>
                        <td>swan@gmail.com</td>
                        <td>sachintha@gmail.com</td>
                        <td>sachintha@gmail.com</td>
                        <td>sachintha@gmail.com</td> -->
                    </tr>
                    <tr>
                        <!-- <td>C004</td>
                        <td>Brown</td>
                        <td>02/05/2022</td>
                        <td>No.4,London</td>
                        <td>0789814977</td>
                        <td>brown@yahooo.com</td>
                        <td>sachintha@gmail.com</td>
                        <td>sachintha@gmail.com</td>
                        <td>sachintha@gmail.com</td> -->
                    </tr>
                    </table>
</div>
       
        </div>
    </div>
</body>

<!-- </html> -->