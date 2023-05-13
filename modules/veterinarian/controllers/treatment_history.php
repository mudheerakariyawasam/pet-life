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
}

function extractContent($array, $state)
{
    $returnArray = array();
    foreach ($array as $key => $value) {

        if ($state != 'text') {
            switch ($state) {
                case '1':
                    $condition = (($key == 'followup_date') && $value != null);
                    break;
                case '2':
                    $condition = (($key == 'treatment_date') && $value != null);
                    break;

                default:
                    $condition = (($key == 'followup_date' || $key == 'treatment_date') && $value != null);
                    break;
            }
        } else {
            $condition = ($key != 'followup_date' && $key != 'treatment_date' && $value != null);
        }
        if ($condition) {
            if (is_array($value)) {
                foreach ($value as $row) {
                    $returnArray[] = $row;
                }
            } else {
                $returnArray[] = $value;
            }
        }
    }
    return $returnArray;
}

function checkValue($content, $text)
{
    foreach ($content as $data) {

        // die(json_encode($text));
        if (preg_match("/{$text}/i", $data)) {
            // die(json_encode($data));
            return true;
        }
    }
    return false;
}

function checkDateRange($content, $startDate, $endDate)
{
    foreach ($content as $data) {

        $searchDateBegin = date('Y-m-d', strtotime($startDate));
        $searchDateEnd = date('Y-m-d', strtotime($endDate));
        $checkingDate = date('Y-m-d', strtotime($data));

        if (($checkingDate >= $searchDateBegin) && ($checkingDate <= $searchDateEnd)) {
            return true;
        }
    }
    return false;
}

function filter_array($treatment_list, $text)
{
    $matches = array();

    foreach ($treatment_list as $treatment) {

        $content = extractContent($treatment, 'text');

        if (checkValue($content, $text)) {
            $matches[] = $treatment;
        }
    }
    return $matches;
}

function date_filter($treatment_list, $startDate, $endDate, $state)
{
    $matches = array();

    foreach ($treatment_list as $treatment) {

        $content = extractContent($treatment, $state);
        if ($startDate && $endDate) {
            if (checkDateRange($content, $startDate, $endDate)) {
                $matches[] = $treatment;
            }
        } else if ($startDate) {
            if (checkValue($content, $startDate)) {
                $matches[] = $treatment;
            }
        }
    }
    return $matches;
}

// text search
if (isset($_GET['searchQuery']) && $_GET['searchQuery'] != '') {

    $text = $_GET['searchQuery'];
    $treatment_list = filter_array($treatment_list, $text);
} else if (isset($_GET['dateFilter']) && $_GET['dateFilter'] != '') { // date search

    $dates = $_GET['dateFilter'];

    if (is_array($dates) && count($dates) == 3) {
        $startDate = $dates[0];
        $endDate = $dates[1];
        $state = $dates[2];
    } else if (is_array($dates) && count($dates) == 2) {
        $startDate = $dates[0];
        $state = $dates[1];
        $endDate = null;
    }

    $treatment_list = date_filter($treatment_list, $startDate, $endDate, $state);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/treatment_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title></title>
</head>

<body onload="onLoad()">

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
                <a href="treatment_history.php" class="active"><i class="fa-solid fa-calendar-plus"></i><span>Treatment History</span></a></a>
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

    
    <div class="content">
        <!-- //Top Navigation bar starts-->
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
                </ul>
            </div>
        </div>
 <!-- //Top Navigation bar ends-->
        <div class="container">
        <!-- <div class="heading">Treatment History</div> -->
        <p class="topic">Treatment History </p><hr><br>
        <div class="toast" style="display: none;">

            <div class="toast-content">
                <i class="fa-regular fa-circle-check" style="color: #2dc02d;font-size: 35px;"></i>

                <div class="message">
                    <span class="text text-1">Success</span>
                    <span class="text text-2">ඔබ සාර්ථකව ලොග් අවුට් වී ඇත</span>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>


            <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
            <div class="progress"></div>
        </div>
        <div class="filter-panel">
            <input type="text" class="input-search" id="input-search" placeholder="Type to Search...">
            <i onclick="textSearch()" id="search-icon" class="fa-solid fa-magnifying-glass search-icon"></i>
        </div>
        <div class="action-panel">
            <div class="tooltip tooltip-ex" id="btn-all-treatments">
                <i class="fa-solid fa-reply-all" onclick="textSearch('all')"></i>
                <span class="tooltiptext tooltip-all-t">all treatments</span>
            </div>
            <div class="tooltip tooltip-ex" id="btn-expand">
                <i class="fa-solid fa-angles-down" onclick="toggleExpand(true)"></i>
                <span class="tooltiptext tooltip-all-t">expand data</span>
            </div>
            <div class="tooltip tooltip-ex" id="btn-collapse">
                <i class="fa-solid fa-angles-up" onclick="toggleExpand(false)"></i>
                <span class="tooltiptext tooltip-all-t">collapse data</span>
            </div>
            <div class="tooltip tooltip-ex">
                <i class="fa-solid fa-calendar-days" onclick="searchCalendar()"></i>
                <span class="tooltiptext tooltip-calendar">date filter</span>
                <div id="calendar-filter">
                    <div id="c-checkbox-panel">
                        <div class="c-checkbox">
                            <input type="checkbox" id="ct-date" class="c-input-box" checked />
                            <label for="">treatment date</label>
                        </div>
                        <div class="c-checkbox">
                            <input type="checkbox" id="cf-date" class="c-input-box" />
                            <label for="">followup date</label>
                        </div>
                    </div>
                    <div id="c-calendar-panel">
                        <div id="c-calendar-toggle">
                            <div></div>
                            <div class="toggle-switch">
                                <label class="toggle-name"> Date range </label>
                                <input id="toggle" class="toggle-input" type='checkbox' onclick="dateRangeChange()" checked />
                                <label for="toggle" class="toggle-label" id="toggle-label" />
                            </div>
                        </div>
                        <div id="c-calendar-datepicker">
                            <div class="c-datepicker-row">
                                <label id="label-start"><i class="fa-solid fa-calendar-plus" style="margin-right: 8px;"></i>select specific date</label>
                                <input style="cursor: pointer; font-size: 12px" type="date" id="start-date" class="c-calendar-left" webkitdirectory>
                            </div>
                            <div class="c-datepicker-row" id="c-datepicker-end">
                                <label id="label-end"><i class="fa-solid fa-calendar-check" style="margin-right: 8px;"></i>select end date</label>
                                <input style="cursor: pointer; font-size: 12px" type="date" id="end-date" class="c-calendar-left">
                            </div>
                        </div>

                    </div>
                    <div class="c-error-panel" id="c-error-panel"></div>
                    <div id="c-btn-panel">
                        <div id="btn-filter" class="btn-filter" onclick="dateSearch()">filter treatments</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-view">


            <table border="1" id="myTable3" cellspacing="0" cellpadding="0">
                <!-- <caption>Treatment history</caption> -->
                <thead>
                    <tr><!--When a header is clicked, run the sortTable function, with a parameter, 0 for sorting by names, 1 for sorting by country:-->
                        <th style="width: 4%;padding-right: 10px;"></th>
                        <th style="width: 8%;">ID</th>
                        <th style="width: 8%;" mytable2="" onclick="sortTable(1, 'myTable3')">Type</th>
                        <th style="width: 24.8%;" mytable2="" onclick="sortTable(2, 'myTable3')">Symptoms</th>
                        <th style="width: 20%;" mytable2="" onclick="sortTable(3, 'myTable3')">Diagnosis</th>
                        <th mytable2="" onclick="sortTable(4, 'myTable3')">Pet</th>
                        <th mytable2="" onclick="sortTable(6, 'myTable3')">Followup date</th>
                        <!-- <th mytable2="" onclick="sortTable(7, 'myTable3')">Comments</th> -->
                        <th mytable2="" onclick="sortTable(8, 'myTable3')">Date</th>
                        <!-- <th mytable2="" onclick="sortTable(9, 'myTable3')">Bill</th> -->
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Total treatments: &nbsp;<?= count($treatment_list) ?></td>
                    </tr>
                </tfoot>
                <tbody>


                    <?php
                    if (count($treatment_list) > 0) {
                        foreach ($treatment_list as $treatment) : ?>
                            <tr>
                                <td style="width: 4%;padding-right: 10px;color: #56afbbb0;font-size: 16px;"><i onclick="expandRow(this)" id="expand-icon" class="fa-regular fa-square-plus expand-icon"></i></td>
                                <td style="width: 8%;"> <?= $treatment['treatment_id']; ?></td>
                                <td style="width: 8%; padding: 30px 0 30px 0;">
                                    <?php foreach ($treatment['treatment_type'] as $key => $value) {

                                        if ($value == 'treatment') {
                                    ?>
                                            <div class="tooltip">
                                                <?php
                                                echo "<i class='t-icon fa-solid fa-t'></i>";
                                                ?>
                                                <span class="tooltiptext">treatment</span>
                                            </div>
                                        <?php
                                        }
                                        if ($value == 'surgery') {
                                        ?>
                                            <div class="tooltip">
                                                <?php
                                                echo "<i class='s-icon fa-solid fa-s'></i>";
                                                ?>
                                                <span class="tooltiptext">surgery</span>
                                            </div>
                                    <?php
                                        }
                                    } ?>
                                </td>
                                <td style="width: 24%;"><?= $treatment['symptoms']; ?></td>
                                <td style="width: 20%;"><?= $treatment['definitive_diagnosis']; ?></td>
                                <td><?= $treatment['pet_id']; ?></td>
                                <td><?= $treatment['followup_date']; ?></td>

                                <td><?= $treatment['treatment_date']; ?></td>


                            </tr>
                            <tr class="action">
                                <td>
                                    <div class="expand-content" id="expand-content">
                                        <div class="expand-col">
                                            <div class="expand-row">

                                                <div class="tooltip tooltip-ex">
                                                    <label class="expand-label"><i class="fa-solid fa-prescription-bottle-medical expand-data"></i></label>
                                                    <span class="tooltiptext tooltiptext-ex">medicine</span>
                                                </div>
                                                <div class="expand-item">

                                                    <?php
                                                    if (count($treatment['medicine']) > 0) {
                                                        foreach ($treatment['medicine'] as $key => $value) {

                                                            echo "<div class='expand-item-content'><i class='fa-solid fa-check ex-icon'></i>$value</div>";
                                                        }
                                                    } else {
                                                        echo "<div class='expand-item-content'><i class='fa-solid fa-xmark ex-icon-no'></i>No medicine given</div>";
                                                    }

                                                    ?>

                                                </div>

                                            </div>
                                            <div class="expand-row">

                                                <div class="tooltip tooltip-ex">
                                                    <label class="expand-label" style="margin-right: 13px;"><i class="fa-solid fa-flask-vial expand-data"></i></label>
                                                    <span class="tooltiptext tooltiptext-ex">labs</span>
                                                </div>
                                                <div class="expand-item">

                                                    <?php
                                                    if (count($treatment['lab_investigations']) > 0) {
                                                        foreach ($treatment['lab_investigations'] as $key => $value) {

                                                            echo "<div class='expand-item-content'><i class='fa-solid fa-check ex-icon'></i>$value</div>";
                                                        }
                                                    } else {
                                                        echo "<div class='expand-item-content'><i class='fa-solid fa-xmark ex-icon-no'></i>No lab investigation reported</div>";
                                                    }

                                                    ?>

                                                </div>

                                            </div>
                                            <div class="expand-row">

                                                <div class="tooltip tooltip-ex">
                                                    <label class="expand-label" style="margin-right: 19px;"><i class="fa-solid fa-syringe expand-data"></i></label>
                                                    <span class="tooltiptext tooltiptext-ex">vaccines</span>
                                                </div>
                                                <div class="expand-item">

                                                    <?php
                                                    if (count($treatment['vaccine']) > 0) {
                                                        foreach ($treatment['vaccine'] as $key => $value) {

                                                            echo "<div class='expand-item-content'><i class='fa-solid fa-check ex-icon'></i>$value</div>";
                                                        }
                                                    } else {
                                                        echo "<div class='expand-item-content'><i class='fa-solid fa-xmark ex-icon-no'></i>No vaccine given</div>";
                                                    }

                                                    ?>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="expand-col" style="line-height: 1.5">
                                            <div class="expand-row">
                                                <label class="expand-label expand-label-right"><i class="fa-solid fa-comment-medical expand-data" style="padding-right:8px;"></i>comments</label>
                                                <div class="expand-item">
                                                    <?php
                                                    $comment = $treatment['special_comments'];
                                                    if ($comment != null) {
                                                        echo "<div class='expand-item-content'  >$comment</div>";
                                                    } else {
                                                        echo "<div class='expand-item-content' ><i class='fa-solid fa-xmark ex-icon-no'></i>No comments</div>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="expand-row">
                                                <label class="expand-label expand-label-right" style="margin-right: 35px;"><i class="fa-solid fa-dollar-sign expand-data" style="padding-right:16px;"></i>charges</label>
                                                <div class="expand-item">
                                                    <?php
                                                    $bill = $treatment['treatment_bill'];
                                                    if ($bill != null) {
                                                        echo "<div class='expand-item-content'  >$bill</div>";
                                                    } else {
                                                        echo "<div class='expand-item-content' ><i class='fa-solid fa-xmark ex-icon-no'></i>No comments</div>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="expand-row">
                                                <label class="expand-label expand-label-right" style="margin-right: 49px;"><i class="fa-solid fa-user-doctor expand-data" style="padding-right:13px;"></i>Vet Id</label>
                                                <div class="expand-item">
                                                    <?php
                                                    $vet = $treatment['vet_id'];
                                                    if ($vet != null) {
                                                        echo "<div class='expand-item-content'  >$vet</div>";
                                                    } else {
                                                        echo "<div class='expand-item-content' ><i class='fa-solid fa-xmark ex-icon-no'></i>No vet specified</div>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                    <?php endforeach;
                    } else {
                        echo "<tr style='margin-top:100px;'><td style='text-align:center;'><h2>No treatments!</h2></td></tr>";
                    }
                    ?>

                </tbody>
            </table>
            
        </div>
        
        </div>
    </div>



    <script src="../js/treatment_history.js">
    </script>
</body>

</html>