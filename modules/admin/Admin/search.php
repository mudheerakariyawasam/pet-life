<?php
$search = "";
if(isset($_POST['search'])) {
    $search = $_POST['search'];
}
$sql = "SELECT * FROM employee WHERE emp_id LIKE '%$search%' OR emp_name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<form method="POST">
    <input type="text" name="search" placeholder="Search by name or ID" value="<?php echo $search; ?>" onkeyup="liveSearch(this.value)">
    <button type="submit">Search</button>
</form>

<table class="table" id="table" cellspacing=1 cellpadding=3>
    <thead>
        <tr>
            <th scope="col">Emp ID</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Mobile</th>
            <th scope="col">Designation</th>
            <th scope="col">Email</th>
            <th scope="col">NIC</th>
            <th scope="col">Date Assigned</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '<tr>';
                echo '<td><b>'.$row["emp_id"].'</b></td>';
                echo '<td>'. $row["emp_name"].'</td>';
                echo '<td>'. $row["emp_address"].'</td>';
                echo '<td>'. $row["emp_contactno"].'</td>';
                echo '<td>'.$row["emp_designation"].'</td>';
                echo '<td>'.$row["emp_email"].'</td>';
                echo '<td>'.$row["emp_nic"].'</td>';
                echo '<td>'.$row["emp_dateassigned"].'</td>';
                echo '<td class="sub">
                        <div class="f">
                            <div class="f1" style="margin-top:10px;"> 
                                <form action="editstaff.php" method="POST" class="d-inline"> 
                                    <input type="hidden" name="id" value='. $row["emp_nic"] .'>
                                    <button style="border:none;" type="submit" name="view" value="View">
                                        <img src="../images/update.png" width=20px height=20px>
                                    </button>
                                </form>
                            </div>
                            <div class="f2" style="margin-top:10px;"> 
                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='. $row["emp_nic"] .'>
                                    <button style="border:none;" type="submit" name="delete" value="Delete">
                                        <img src="../images/del.png" width=20px height=20px>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="9">0 Result</td></tr>';
        }
        ?>
    </tbody>
</table>

<script>
function liveSearch(str) {
    if (str.length == 0) {
        document.getElementById("table").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "livesearch.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

<?php
if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM employee WHERE emp_nic = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
        echo "Unable to Delete Data";
    }
}
?>