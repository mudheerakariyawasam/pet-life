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
                        <!-- <a href="">
                            <span id="designation">Admin</span>
                        </a> -->
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="heading">Clients' Details</div>
            <div class="search-field">
                <input type="text" name="" id="live-search" class="form-control" autocomplete="off"
                    placeholder="Search Here..">
            </div>
            <div class="save-btn">
                <button onclick="saveTreatment(event)" class="button-01" name="save-info" id="btn-save" type="submit"
                    role="button"><a href="user.php"> + Add new Client</a></button>
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
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT * from pet_owner";
                    $clients = mysqli_query($conn, $sql);
                    if ($clients) {
                        while ($row = mysqli_fetch_assoc($clients)) {
                            $id = $row['owner_id'];
                            $fname = $row['owner_fname'];
                            $lname = $row['owner_lname'];
                            $email = $row['owner_email'];
                            $tpn = $row['owner_contactno'];
                            $address = $row['owner_address'];
                            $nic = $row['owner_nic'];
                            $pwd = $row['owner_pwd'];
                            echo '<tr>
                            <td>' . $id . '</td>
                            <td>' . $fname . '</td>
                            <td>' . $lname . '</td>
                            <td>' . $email . '</td>
                            <td>' . $tpn . '</td>
                            <td>' . $address . '</td>
                            <td>' . $nic . '</td>
                            <td>' . $pwd . '</td>
                            <td>
                            <div class="action all" style="display:flex;">
                            <a href="viewcustomer.php"><i class="fa-sharp fa-solid fa-eye" style="margin:5px;"></i></a>
                            <a href="update_customer.php? updateid=' . $id . '"><i class="fa-sharp fa-solid fa-pen-to-square" style="margin:5px;"></i></a>
                            <a href="delete_customer.php? deleteid=' . $id . '"><i class="fa-sharp fa-solid fa-trash" style="color: #542121; margin:5px;"></i></a>
                            </div>
                            </td>
                            </tr>';
                        }

                    }

                    ?>

                </table>

            </div>
        </div>
    </div>
    <div id="searchresult">

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#live-search").keyup(function () {
                var input = $(this).val();
                // alert(input);
                if (input != "") {
                    $.ajax({
                        url: "livesearch.php",
                        method: "POST",
                        data: {input: input},

                        success: function (data) {
                            $("#searchresult").html(data);
                        }
                    });
                }else{
                    $("#searchresult").css("display","none");
                }
            });
        });

    </script>
</body>

</html>