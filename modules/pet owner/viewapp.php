<?php
include("../../db/dbconnection.php");
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location:../../Auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewapp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Care</title>
</head>

<body>
    <div class="sidebar">
        <div class="user-img">
            <center><img src="images/petlife.png" width=200px></center>
        </div>
        <ul>

            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="treatment.php"><i class="fa-solid fa-calendar-plus"></i><span>Treatments</span></a>
            </li>
            <!-- <li>
                <a href="vaccination.php"><i class="fa-solid fa-file-lines"></i></i><span>Vaccinations</span></a>
            </li> -->
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user " aria-hidden="true"></i><span>My
                        Profile</span></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-file"></i><span>Pet Daycare</span></a></a>
            </li>
            <li>
                <a href="../../public/Store/store.php"><i class="fas fa-cart-plus"></i><span>Pet Shop</span></a>
            </li>
            <li>
                <a href="inquiry.php"><i class="fa fa-user"></i><span>Inquiries</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="./logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">Welcome &nbsp <div class="name">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                </div>
            </div>

           
        </div>



        <div class="container">
            <div class="bar-content search-bar">
                <form method="GET">
                    <label><b>Pet Name</b></label><br>
                    <select name="pet_name">
                        <option value="">Select a pet</option>
                        <?php
                        $loggedInUser = $_SESSION['login_user'];
                        // Get all pets of the logged-in user
                        $sql_pets = "SELECT * FROM pet WHERE owner_id = (SELECT owner_id FROM pet_owner WHERE owner_email = '$loggedInUser')";
                        $result_pets = mysqli_query($conn, $sql_pets);
                        while ($row_pets = mysqli_fetch_assoc($result_pets)) {
                            // Set the selected attribute if the current pet is selected in the URL
                            $selected = ($row_pets['pet_name'] == $_GET['pet_name']) ? 'selected' : '';
                            echo '<option value="' . $row_pets['pet_name'] . '" ' . $selected . '>' . $row_pets['pet_name'] . '</option>';
                        }
                        ?>
                    </select>
                    <button class="btn-add1" type="submit"><img src="images/search.png"></button>
                </form>
            </div>
            <div class="app">
                <p>APPOINTMENTS</p>
            </div>
            <div class="tble">
                <table>
                    <tr>
                        <th>Pet Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Slot No</th>
                        <th>Doctor</th>
                        <th>Action</th>
                        <th>Appointment Status</th>
                        <!-- <th>completion status</th> -->
                    </tr>
                    <?php
                    $loggedInUser = $_SESSION['login_user'];
                    $currentDate = date('Y-m-d');
                    $sql = "SELECT * FROM appointment a
                     INNER JOIN pet p ON a.pet_id = p.pet_id 
                     INNER JOIN pet_owner o ON o.owner_id = p.owner_id
                    INNER JOIN employee e ON e.emp_id = a.vet_id
                    WHERE a.appointment_status != 'Cancelled' AND owner_email = '{$_SESSION['login_user']}'";

                    // Check if pet_name parameter is set in the URL
                    if (isset($_GET['pet_name'])) {
                        // Sanitize input value to prevent SQL injection
                        $pet_name = mysqli_real_escape_string($conn, $_GET['pet_name']);
                        // Include pet_name condition in SQL query
                        $sql .= " AND p.pet_name LIKE '%$pet_name%'";
                    }

                    $sql .= " ORDER BY a.appointment_date DESC";
                    $result_getdetails = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result_getdetails) > 0) {
                        while ($row_getdetails = mysqli_fetch_assoc($result_getdetails)) {
                            $appointment_id = $row_getdetails["appointment_id"];
                            $appointment_status = $row_getdetails["appointment_status"];
                            $pet_availability = $row_getdetails["pet_availability"];

                            
                            echo '<tr> 
                                <td>' . $row_getdetails["pet_name"] . '</td>
                                <td>' . $row_getdetails["appointment_date"] . '</td>
                                <td>' . $row_getdetails["appointment_time"] . '</td>
                                <td>' . $row_getdetails["appointment_slot"] . '</td>
                                <td>' . $row_getdetails["emp_name"] . '</td>
                                <td class="action">';
                            
                            // Check if appointment is completed
                            if ($appointment_status == 'Completed') {
                                echo '<button class="btn-add2" type="button">Cannot Delete</button>';
                            } else {
                                // Display delete button and handle delete request
                                if (isset($_POST[$appointment_id])) {
                                    // Check if appointment date is in the future
                                    if (strtotime($row_getdetails['appointment_date']) >= strtotime($currentDate) && (strtotime($row_getdetails['appointment_date']) - strtotime($currentDate)) <= 86400) {
                                        // Delete appointment
                                        $sql = "UPDATE appointment SET appointment_status = 'Cancelled' WHERE appointment_id = '$appointment_id'";
                                        if ($conn->query($sql) === TRUE) {
                                            // Success message
                                            echo '<script>alert("Appointment deleted successfully.");</script>';
                                           
                                            $appointment_status = 'Cancelled';
                                            echo "<script>window.location ='viewapp.php'</script>";
                                            // echo '<button class="btn-add2" type="button">Cannot Delete</button>';
                                        } else {
                                            // Error message
                                            echo '<script>alert("Error deleting appointment");</script>';
                                        }
                                    } else {
                                        // Error message
                                        echo '<script>alert("Cannot delete past appointments.");</script>';
                                    }
                                }
                                // Display delete button
                                else {
                                    
                                    echo '<form action="" method="post">
                                            <button class="btn-add3" type="submit" name="' . $appointment_id . '">Delete</button>
                                          </form>';
                                }
                            }
                            
                            echo '</td>';
                            
                            // Determine appointment status
                            if ($appointment_status == 'Cancelled' || $pet_availability == 'Deleted') {
                                $appointment_status_text = 'Cancelled';
                            } elseif ($row_getdetails['appointment_date'] >= $currentDate) {
                                $appointment_status_text = 'Pending';
                                $appointment_status_button = 'Delete';
                            } elseif ($appointment_status != 'Cancelled' && $row_getdetails['appointment_date'] < $currentDate) {
                                $appointment_status_text = 'Completed';
                                $appointment_status_button = 'Cannot Delete';
                            }
                            
                            // Update appointment status in database
                            $sql = "UPDATE appointment SET appointment_status = '$appointment_status_text' WHERE appointment_id = '$appointment_id'";
                            if ($conn->query($sql) === TRUE) {
                                // Success message
                            } else {
                                // Error message
                            }
                            
                            // Display the availability status for each appointment
                            echo '<td class="action1"> 
                                    <p>' . $appointment_status_text . '</p>
                                  </td>';
                            
                            echo '</tr>';
                        }
                    
                    }
                    else {
                           
                     
                           echo '<td colspan="7"><center><img style="width:35%;" src="images/no-results.png"></center></td>';
                       
                        }

                    
                    
?>
</table>
            </div>
        </div>
    </div>
    <script src="script.js"></script>

</body>

</html>