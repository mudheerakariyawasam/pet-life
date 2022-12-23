<?php
    include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/updateprofile.css">
    <title>Update My Profile</title>
</head>
<body>
    <div class="full">
    <div class="main-content">
        <div class="left-content">
            <div class="form-content">
                <span class="topic">Employee Details</span>
                <p>
                <form method="POST">
                    <label><b>Staff ID : </label> 
                    <label class="item-id" name="staff_id" >E001</b><br><br>
                    <div class="row-wise">
                        <div class="column-wise">
                            <label>Employee Name :</label><br>
                            <input type="text" name="emp_name" placeholder="Employee Name"><br>
                        </div>
                        <div class="column-wise">        
                            <label>Address :</label><br>
                            <input type="text" name="emp_address" placeholder="Address"><br>
                        </div>
                    </div>
                    <div class="row-wise">
                        <div class="column-wise">
                            <label>Designation :</label><br>
                            <div class="dropdown-list" style="width:200px;">
                                <select name="designation" class="dropdown-list" >
                                    <option value="Pet Food">Admin</option>
                                    <option value="Sleeping Items">Cashier</option>
                                    <option value="Collars">Store Manager</option>
                                    <option value="Toys">Assistant</option>
                                    <option value="Combs">Veterinarian</option>
                                    <option value="Food Bowls">Day Care Manager</option>
                                </select><br><br>
                            </div>
                        </div>
                        <div class="column-wise">
                            <label>Date Assigned :</label><br>
                    <input type="date" name="date_assigned" placeholder="Date Assigned"><br>
                        </div>
                    </div>
                    <div class="row-wise">
                        <div class="column-wise">
                            <label>Mobile :</label><br>
                            <input type="text" name="emp_mobile" placeholder="Mobile No"><br>
                        </div>
                        <div class="column-wise">        
                            <label>Email :</label><br>
                            <input type="email" name="emp_email" placeholder="Email"><br>
                        </div>
                    </div>
                    <div class="row-wise">
                        <div class="column-wise">
                            <label>Initial Salary :</label><br>
                            <input type="text" name="emp_inisal" placeholder="Initial Salary"><br>
                        </div>
                        <div class="column-wise">
                            <label>Current Salary :</label><br>
                            <input type="text" name="emp_cursal" placeholder="Current Salary"><br>
                        </div>
                    </div>
                    <div class="row-wise">
                        <div class="column-wise">
                            <label>No of Holidays Taken :</label><br>
                            <input type="number" name="emp_holtaken" placeholder="No of Holidays Taken"><br>
                        </div>
                        <div class="column-wise">
                            <label>No of Holidays Left :</label><br>
                            <input type="number" name="emp_holleft" placeholder="Mo of Holidays Left"><br>
                        </div>
                    </div>
                    
                    <button class="btn-add" type="submit">Update Profile </button>
                    <a class="btn-exit" href="viewallitems.php">Cancel</a>
                </p>   
                </form> 
            </div>
        </div>
    
        <div class="right-content">
            <span class="topic">Change Password</span>
            <p>
            <div class="pwd-content">
                <label>Current Password :</label><br>
                <input type="password" name="emp_name" placeholder="Enter Current Password"><br>
            </div>
            <div class="pwd-content">
                <label>New Password :</label><br>
                <input type="password" name="emp_name" placeholder="Enter New Password"><br>
            </div>
            <div class="pwd-content">
                <label>Confirm New Password :</label><br>
                <input type="password" name="emp_name" placeholder="Re Enter Password"><br>
            </div>
            <div class="pwd-content">
                <button class="btn-add">Change Password</button>
            </div>
            </p>
        </div>
    </div>
</div>
</body>
</html>