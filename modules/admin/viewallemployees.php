<?php
    include("dbconnection.php");
    include("header.php");

    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewemployee.css   ">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
    
        <div class="navbar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a  href="#">Appointments</a></li>
                <li><a href="#">Clients</a></li>
                <li><a class="active" href="#">Staff</a></li>
                <li><a href="#">Leave Manager</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">LogOut</a></li>
            </ul>
        </div>
    
        <div class="container">

        <span class="pet-item">STAFF DETAILS</span>
        <br><br><br>

        <!-- search employees-->
        <div class="topbar">
            <div class="bar-content search-bar">
                <form> 
                    <input class ="emp-id"type="text" name="emp_id" placeholder="Enter Employee ID">
                    <button class="btn-search" type="submit"><img src="images/search.png"></button>
                </form>
            </div>
        <div class="bar-content add-bar">
            <a href="additem.php"> <button class="btn-add" type="submit">Add Employee</button></a>
        </div>

        </div>
        <!--View All Employees Code-->
        
        <?php 
        if(mysqli_num_rows($result) > 0)
        {
            echo '<table>
                    <tr>
                        <th >Staff ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Date Assigned</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>NIC</th>
                        <th colspan="2">Actions</th>
                    </tr>';

                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr > 
                            <td>' . $row["emp_id"] . '</td>
                            <td>' . $row["emp_name"] . '</td>
                            <td>' . $row["emp_designation"] . '</td>
                            <td>' . $row["emp_dateassigned"] . '</td>
                            <td>' . $row["emp_address"] . '</td>
                            <td>' . $row["emp_contactno"] . '</td>
                            <td>' . $row["emp_email"] . '</td>
                            <td>' . $row["emp_nic"] . '</td>
                            
                            <td class="action"><button type="submit"><img src="images/update.png"></button></td>
                            <td class="action"><button type="submit"><img src="images/delete.png"></button></td>
                        </tr>';
                    }
                    echo '</table>';
                }else{
                    echo "0 results";
                } 
                ?>
        </div>
    </div>
</body>
</html>