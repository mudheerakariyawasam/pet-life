<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location:login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pet Life</title>
    
    <style>
    
</style>

</head>

<body>
    <div class="sidebar">
    <div class="user-img"><center><img src="images/logo_transparent black.png" width=200px></center></div>
        <ul>
        <li><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Home</span></a></li>
                <li><a class="active" href="viewallitems.php"><i class="fa fa-paw"></i><span>Pet Items</span></a></li>
                <li><a href="viewallmedicine.php"><i class="fa fa-stethoscope"></i><span>Medicine</span></a></li>
                <li><a href="viewallbatch.php"><i class="fa fa-stethoscope"></i><span>Batches</span></a></li>
                <li><a href="leaverequest.php"><i class="fa-solid fa-file"></i><span>Leave Requests</span></a></li>
                <li><a href="updateprofile.php"><i class="fa-solid fa-circle-user"></i><span>My Profile</span></a></li>
        </ul>
        <div class="logout">
            <hr>
            <a href="../../Auth/logout.php"><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
        </div>
    </div>

    <!-- //Navigation bar -->
    <div class="content">
        <div class="navbar">
            <div class="navbar__left">
                
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
                   
                </ul>
            </div>
        </div>
        <div class="container">
        <br/>
<div class="item-title">Pet Items</div><hr>
<br/>

<div class="search-box">
    <label for="search-input">Search:</label>
    <input type="text" id="search-input" placeholder="Search by ID or Name...">
</div>

<?php
    // Define the number of records per page
    $records_per_page = 7;

    // Get the current page from the URL, or set it to 1 if not provided
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the starting record for the SQL query
    $start_from = ($current_page - 1) * $records_per_page;

    // Update the SQL query to include the LIMIT clause
    $sql = "SELECT * FROM pet_item LIMIT $start_from, $records_per_page";

    // Retrieve all items from the database
    
    $result = mysqli_query($conn, $sql);

    // Display the items in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='item-table'>";
        echo "<tr>
            <th class='item-table-header'>Product ID</th>
            <th class='item-table-header'>Name</th>
            <th class='item-table-header'>Brand</th>
            <th class='item-table-header'>Price</th>
            <th class='item-table-header'>Qty</th>
            <th class='item-table-header'>Status</th>
            <th class='item-table-header'>Action</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='item-row'>";
            echo "<td class='item-table-cell item-id'>" . $row['item_id'] . "</td>";
            echo "<td class='item-table-cell item-name'>" . $row['item_name'] . "</td>";
            echo "<td class='item-table-cell'>" . $row['item_brand'] . "</td>";
            echo "<td class='item-table-cell'>" . $row['item_price'] . "</td>";
            echo "<td class='item-table-cell'>" . $row['item_qty'] . "</td>";
            echo "<td class='item-table-cell'>";
            if ($row['item_status'] == 'Available') {
                echo "<label class='switch'><input type='checkbox' checked='checked' data-itemid='" . $row['item_id'] . "'><span class='slider round'></span></label>";
            } else {
                echo "<label class='switch'><input type='checkbox' data-itemid='" . $row['item_id'] . "'><span class='slider round'></span></label>";
            }
            echo "</td>";
            echo "<td class='item-table-cell'><a class='item-link' href='updateitem.php?item_id=" . $row['item_id'] . "'>Update</a></td>";
            // echo "<td class='item-table-cell'><button class='item-link' onclick='updateItem(" . $row['item_id'] . ")'><i class='fas fa-pen-to-square'></i></button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No items found.";
    }

    // Count the total number of records in the item table
    $sql_count = "SELECT COUNT(*) as total_records FROM pet_item";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_records = $row_count['total_records'];

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $records_per_page);
    echo '<br/>';
    // Generate the pagination buttons
    echo '<div class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo "<a class='active' href='?page=$i'>$i</a>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }

echo '</div>';

?>
<a href="additem.php"><button class="btn-add">Add</button></a>
<script>
    // Add event listener to all switch buttons
    var switchButtons = document.querySelectorAll('.switch input[type="checkbox"]');
    for (var i = 0; i < switchButtons.length; i++) {
        switchButtons[i].addEventListener('change', function() {
            var isChecked = this.checked ? '1' : '0';
            var itemid = this.getAttribute('data-itemid');

            // Send an AJAX request to update the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'deleteitem.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                    } else {
                        console.error(xhr.statusText);
                    }
                }
            };
            xhr.send('item_id=' + itemid + '&item_status=' + isChecked + '&page=' + <?php echo $current_page; ?>);

        });
    }

    // Add event listener to search input
    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function() {
        var filterValue = this.value.toUpperCase();
        var rows = document.querySelectorAll('.item-row');

        for (var i = 0; i < rows.length; i++) {
            var idCell = rows[i].querySelector('.item-id');
            var nameCell = rows[i].querySelector('.item-name');
            var idValue = idCell.textContent || idCell.innerText;
            var nameValue = nameCell.textContent || nameCell.innerText;

            if (idValue.toUpperCase().indexOf(filterValue) > -1 || nameValue.toUpperCase().indexOf(filterValue) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
    
    function updateItem(itemId) {
    var url = 'updateitem.php?item_id=' + itemId;
    window.location.href = url;
}
</script>

    </div>
    <script src="script.js"></script>
</body>

</html>