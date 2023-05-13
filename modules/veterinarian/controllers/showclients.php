<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/veterinarian/permission.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/showclients.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Amatic+SC&display=swap" rel="stylesheet">
    <title></title>
</head>

<body>
    <div class="main" >
    <div class="sidebar">
        <div class="user-img">
            <img src="../images/logo_transparent black.png">
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

    <!-- //Left Navigation bar ends -->


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
        <div class="container">
            <br/><br/><br/>
            <p class="topic">Clients</p><hr><br>
            <div class="table-btn">
                <div class="search-field">
                    <input type="text" class="search-input" id="live-search" class="form-control" autocomplete="off" placeholder="search on NIC">
                    <div id="results" class="results"></div>
                </div>
                <div class="save-btn">
                    <div class="tooltip tooltip-ex" onclick="getAll()" id="btn-all-treatments">
                        <i class="fa-solid fa-reply-all" ></i>
                        <span class="tooltiptext tooltip-all-t">all treatments</span>
                    </div>
                    <br>
                    <button onclick="saveTreatment(event)" class="btn-add" name="" type="submit" role="button">
                    <a style="color:black;"href="user.php" > + Add new Client</a>
                    </button>
                </div>
            </div>
            <div class="data-table">
                <table id="showclients">
                    <tr>
                        <th>Pet Owner's ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>NIC</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (isset($_GET['nic']) && $_GET['nic'] != '') {
                        $nic = $_GET['nic'];
                        $sql = "SELECT * from pet_owner WHERE owner_nic LIKE '%$nic%' AND owner_status='Registered'";
                    } else {
                        $sql = "SELECT * from pet_owner WHERE owner_status='Registered'";
                    }

                    $clients = mysqli_query($conn, $sql);
                    // die(mysqli_fetch_assoc($clients));
                    if ($clients) {
                        // die(mysqli_fetch_assoc($clients));
                        while ($row = mysqli_fetch_assoc($clients)) {
                            $owner_id = $row['owner_id'];
                            $fname = $row['owner_fname'];
                            $lname = $row['owner_lname'];
                            $email = $row['owner_email'];
                            $tpn = $row['owner_contactno'];
                            $address = $row['owner_address'];
                            $nic = $row['owner_nic'];
                            echo '<tr>
                            <td>' . $owner_id . '</td>
                            <td>' . $fname . '</td>
                            <td>' . $lname . '</td>
                            <td>' . $email . '</td>
                            <td>' . $tpn . '</td>
                            <td>' . $address . '</td>
                            <td>' . $nic . '</td>
                            <td>
                            <div class="action all" style="display:flex;">
                            <a href="viewcustomer.php? owner_id=' . $owner_id . '"><i class="fa-sharp fa-solid fa-eye" style="margin:5px;"></i></a>
                            <a href="update_customer.php? owner_id=' . $owner_id . '"><i class="fa-sharp fa-solid fa-pen-to-square" style="margin:5px;"></i></a>
                            </div>
                            </td>
                            </tr>';
                        }
                    } else {
                        // die('mm');
                        $noData = "No data to show";
                        echo '<tr>
                            <td>' .$noData. '</td>
                            
                           
                            </tr>';
                    }

                    ?>

                </table>

            </div>
        </div>
    </div>
    <!-- Content ends -->
    
    
    <div id="searchresult">

    </div>
    <script src="../js/show_clients.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#live-search').on('input', function() {
                var query = $(this).val();
                if (query !== '') {
                    $.ajax({
                        url: 'livesearch.php',
                        type: 'POST',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            if (response.includes("<div") || response.includes("No results found")) {
                                $('#results').css('visibility', 'visible');
                            } else {
                                $('#results').css('visibility', 'hidden');
                            }
                            $('#results').html(response);
                        }
                    });
                } else {
                    $('#results').css('visibility', 'hidden');
                    $('#results').html('');
                }
            });
        });
    </script>
    </div>
</body>

</html>