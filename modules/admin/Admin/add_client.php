<?php
    include("../../../db/dbconnection.php");
    session_start();

    $sql_get_id="SELECT MAX(owner_id) as max_id FROM pet_owner";
    $result_get_id=mysqli_query($conn,$sql_get_id);
    $row=mysqli_fetch_array($result_get_id);
    $max_id = $row['max_id'];

    // generate the new pet ID
    if ($max_id === null) {
        $owner_id = "O001";
    } else {
        $num = intval(substr($max_id, 1)) + 1;
        if ($num < 10) {
            $owner_id = "O00$num";
        } else if ($num < 100) {
            $owner_id = "O0$num";
        } else {
            $owner_id = "O$num";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Life</title>
    
<style>
        form {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  border: 2px solid #ccc;
  border-radius: 10px;
  font-family: Arial, sans-serif;
}

label {
  display: block;
  width: 100%;
  margin-bottom: 5px;
  font-size: 16px;
  font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="date"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type="submit"] {
  background-color: #C38D9E;
  box-shadow: 0 8px 8px 0 rgba(0,0,0,0.0), 0 2px 2px 0 rgba(0,0,0,1);
  padding: 10px 20px;
  border: none;
  border-radius: 20px;
  cursor: pointer;
}

input[type="submit"]:hover {
    background-color:rgba(215,226,255,0.6);
transition: 0.7s;
}


</style>

</head>

<body>
    <div class="sidebar">
    <div class="user-img"><center><img src="../images/logo_transparent black.png" width=200px></center></div>
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="appointment.php"><i class="fa-solid fa-calendar-plus"></i><span>Appointments</span></a>
            </li>
            <li>
                <a href="client.php" class="active"><i class="fa fa-user"></i></i><span>Clients</span></a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-users" aria-hidden="true"></i><span>Staff</span></a>
            </li>
            <li>
                <a href="leave.php"><i class="fa-solid fa-file"></i><span>Leave Management</span></a></a>
            </li>
            <li>
                <a href="daycare.php"><i class="fa-solid fa-calendar-plus"></i><span>Day Care</span></a>
            </li>
            <li>
                <a href="report.php"><i class="fa-solid fa-file-lines"></i><span>Reports</span></a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="hello">
                <font class="header-font-1">Hello </font> &nbsp
                <font class="header-font-2"><?php echo $_SESSION['user_name'];?> </font>
            </div>
            </div>
        </div>
        <div class="container">
        <br/>
<div class="employee-title">Clients List</div><hr>
<br/>

<?php
// Include the database connection file

// Initialize variables for the form fields

$owner_fname = '';
$owner_lname = '';
$owner_email = '';
$owner_contactno = '';
$owner_address = '';
$owner_nic = '';
$owner_pwd = '';
$active_status = '';

// Initialize error variables for the form fields

$owner_fname_error = '';
$owner_lname_error = '';
$owner_email_error = '';
$owner_contactno_error = '';
$owner_address_error = '';
$owner_nic_error = '';
$owner_pwd_error = '';
$active_status_error = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $owner_fname = $_POST['owner_fname'];
    $owner_lname = $_POST['owner_lname'];
    $owner_email = $_POST['owner_email'];
    $owner_contactno = $_POST['owner_contactno'];
    $owner_address = $_POST['owner_address'];
    $owner_nic = $_POST['owner_nic'];
    $owner_pwd = $_POST['owner_pwd'];
    $active_status = $_POST['active_status'];

    // Validate the form field values
    if (empty($owner_name)) {
        $owner_name_error = "Your can't keep first name as empty.";
    }

   /* if (empty($emp_address)) {
        $emp_address_error = "Please enter the employee's address.";
    }*/

    if (!preg_match('/^(\+\d{2})?\d{9}$/', $owner_contactno)) {
        $owner_contactno_error = "Please enter a valid contact number.";
    }


    if (!filter_var($owner_email, FILTER_VALIDATE_EMAIL)) {
        $owner_email_error = "Please enter a valid email address.";
    }

    if (!preg_match('/^[0-9]{9}[v]$/', $owner_nic) && !preg_match('/^[0-9]{12}$/', $owner_nic)) {
        $owner_nic_error = "Please enter a valid NIC number.";
    }

if (empty($owner_pwd)) {
        $owner_pwd_error = "Your can't keep owner passsword as empty.";
    }
   /* if (empty($emp_dateassigned)) {
        $emp_dateassigned_error = "Please enter the date the employee was assigned.";
    }*/

    /*if (empty($working_status)) {
        $working_status_error = "Please enter the working status of the employee.";
    }*/

    // Check if there are any errors
    if (empty($owner_fname_error) && empty($owner_contactno_error) && empty($owner_contactno_error) && empty($owner_nic_error) && empty($owner_pwd_error)) {
        // Insert the employee record into the database
        $sql = "INSERT INTO pet_owner (owner_id, owner_fname, owner_lname, owner_email, owner_contactno, owner_address, owner_nic, owner_pwd, active_status) VALUES ('$owner_id', '$owner_fname', '$owner_lname', '$owner_email', '$owner_contactno', '$owner_address', '$owner_nic', '$owner_pwd', '$active_status')";
        $result = mysqli_query($conn, $sql);

        // Check if the insert was successful
        if ($result) {
            // Set a message to display
            $message = "Employee record added successfully.";
            
            // Clear the form fields
            $owner_fname = '';
            $owner_lname = '';
            $owner_email = '';
            $owner_contactno = '';
            $owner_address = '';
            $owner_nic = '';
            $owner_pwd = '';
            $active_status = '';
        } else {
            // Set an error message to display
            $message = "Error adding employee record: " . mysqli_error($conn);
        }
    }
}
?>

<!-- Display the form -->
<form method="post" action="">
    <label>Owner First Name:</label>
    <input type="text" name="owner_fname" value="<?php echo $owner_fname; ?>">
    <?php if (isset($owner_fname_error)): ?>
        <span style="color: red;"><?php echo $owner_fname_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Owner Last Name:</label>
    <input type="text" name="owner_lname" value="<?php echo $owner_lname; ?>">
    <?php if (isset($owner_lname_error)): ?>
        <span style="color: red;"><?php echo $owner_lname_error; ?></span>
    <?php endif; ?><br/><br/>


    <label>Owner Email:</label>
    <input type="email" name="owner_email" value="<?php echo $owner_email; ?>">
    <?php if (isset($owner_email_error)): ?>
        <span style="color: red;"><?php echo $owner_email_error; ?></span>
    <?php endif; ?><br/><br/>


    <label>Owner Contact No:</label>
    <input type="text" name="owner_contactno" value="<?php echo $owner_contactno; ?>">
    <?php if (isset($owner_contactno_error)): ?>
        <span style="color: red;"><?php echo $owner_contactno_error; ?></span>
    <?php endif; ?><br/><br/>

    <label>Owner Address:</label>
    <input type="text" name="owner_address" value="<?php echo $owner_address; ?>">
    <?php if (isset($owner_address_error)): ?>
        <span style="color: red;"><?php echo $owner_address_error; ?></span>
    <?php endif; ?><br/><br/>

    

    <label>Owner NIC:</label>
    <input type="text" name="owner_nic" value="<?php echo $owner_nic; ?>">
    <?php if (isset($owner_nic_error)): ?>
        <span style="color: red;"><?php echo $owner_nic_error; ?></span>
    <?php endif; ?><br/><br/>



    <label>Owner Password:</label>
    <input type="text" name="owner_pwd" value="<?php echo $owner_pwd; ?>">
    <?php if (isset($owner_pwd_error)): ?>
        <span style="color: red;"><?php echo $owner_pwd_error; ?></span>
    <?php endif; ?><br/><br/>







    <label>Active Status:</label>
    <input type="text" name="active_status" value="<?php echo $active_status; ?>">
    <?php if (isset($active_status_error)): ?>
        <span style="color: red;"><?php echo $active_status_error; ?></span>
    <?php endif; ?><br/><br/>

    <input type="submit" name="submit" value="Add Client">
</form>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
    </div>
    <script src="script.js"></script>
</body>

</html>