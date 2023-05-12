<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/cashier/permission.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');

$sql_tot = "SELECT SUM(total) AS total_bill FROM draft";
$result_tot = mysqli_query($conn, $sql_tot);
$row_tot = mysqli_fetch_assoc($result_tot);

$total_bill = $row_tot["total_bill"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/payments.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Amatic+SC&display=swap" rel="stylesheet">
    <title>Payment Details</title>
    <script>
        function addItem() {
    var itemName = document.getElementById('item_name').value;
    var quantity = document.getElementById('quantity').value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open('POST', 'add_item.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the response as HTML
            var parser = new DOMParser();
            var responseDoc = parser.parseFromString(xhr.responseText, 'text/html');

            // Get the item price from the response
            var itemPrice = responseDoc.getElementById('item_price').value;

            // Create a new table row
            var table = document.getElementById('item-list');
            var row = table.insertRow(-1);

            // Add cell values to the row
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            cell1.innerHTML = itemName;
            cell2.innerHTML = quantity;
            cell3.innerHTML = itemPrice;
            cell4.innerHTML = quantity*itemPrice;

            // Clear the form fields
            document.getElementById('item_name').value = '';
            document.getElementById('quantity').value = '';
        }
    };

    // Send the request
    xhr.send('item_name=' + encodeURIComponent(itemName) + '&quantity=' + encodeURIComponent(quantity));
}

function calculateBill(){
    
}
    </script>
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
                <a href="payments.php" class="active"><i class="fa fa-user"></i></i><span>Payments</span></a>
            </li>

            <li>
                <a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Request</span></a></a>
            </li>
            <li>
                <a href="myprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a>
            </li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar ends -->


    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                <div class="nav-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="hello">
                    <font class="header-font-1">Welcome </font> &nbsp 
                    <font class="header-font-2"><?php echo $_SESSION['user_name']; ?></font>
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
           <div class="heading">Treatments<hr></div>

<br/>
     <div class="treatment-table">
                <table class="t-table">
                    <tr>
                        <th>Treatment ID </th>
                        <th>Clinic Charges</th>
                        <th>Treatment Bill</th>
                        <th>Discount</th>
                       
                    </tr>
                    <tr>
                        <td>T001<center><hr/></center></td>
                        <td>600.00<center><hr/></center></td>
                        <td>2800.00<center><hr/></center></td>
                        <td>00.00<center><hr/></center></td>
                    </tr>
                  
                
                </table>

            </div>
            <br/>
  <div class="p-item">         
 <div class="item-heading-left">Pet Items</div>
 
</div>
<br/>

    <div class="item-table">
        <div class="add-item-details">
                <label for="item_name">Item Name:</label>
                <select id='item_name' name='item_name' class='dropdown-list' required>
                <option value="">--Select--</option>
                <?php
                    
                    //get the pet name from the sql table
                    $sql_getiname="SELECT item_name FROM pet_item ORDER BY item_name ASC"; 
                    $result_getidata = $conn->query($sql_getiname);
                    if($result_getidata->num_rows> 0){
                        while($optionData=$result_getidata->fetch_assoc()){
                        $option =$optionData['item_name'];
                    ?>
                    <?php
                        //selected option
                        if(!empty($item_name) && $item_name== $option){
                        // selected option
                    ?>
                    <option value="<?php echo $option; ?>" selected><?php echo $option; ?> </option>
                    <?php 
                        continue;
                    }?>
                    <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                    <?php
                        }}
                    ?>
                </select>
                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" required>
                <button type="button" onclick="addItem()">Add</button>   
        </div>
        <center> 
        <table class="i-table">
                <thead>
                    <tr>
                        <th>Item Name </th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>   
                    </tr>
                </thead>

                <tbody id="item-list">
                </tbody>
        </table>
        </center>

    </div>
            <br/>

            <!-- <div class="p-medicine">         
            <div class="medicine-heading-left">Pet Medicines</div>
            <div class="medicine-heading-right"><button>Add Medicine Details</button></div>
            </div>
            <br/>

     <div class="medicine-table">
               <center> <table class="m-table">
                    <tr>
                        <th>Medicine ID </th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                       
                    </tr>
                    <tr>
                        <td>M001<center></td>
                        <td>2 Cards<center></td>
                        <td>0%<center></td>
                        <td>397.50<center></td>
                    </tr>
                  
                
                </table></center>

            </div>  
            <br/><br/><br/> -->
            <div class="bottom">         
                <div class="bottom-heading-left">Employee ID: <?php echo $_SESSION['emp_id']; ?></div>
                <div class="bottom-heading-right">Total Bill<br/><?php echo $total_bill?><hr/>
                <button onclick="calculateBill()">Calculate Bill</button></div>
            </div>
            <br/>

        </div>
        <script src="script.js"></script>
</body>

</html>