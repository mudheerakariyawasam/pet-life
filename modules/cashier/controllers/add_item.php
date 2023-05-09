<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/modules/cashier/permission.php');
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');

$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];

$sql_getdata="SELECT * FROM pet_item WHERE item_name='$item_name'";
$result_getdata=mysqli_query($conn, $sql_getdata);
$row_getdata= mysqli_fetch_assoc($result_getdata);

if($row_getdata["item_qty"]>=$quantity){
    $price=$row_getdata["item_price"];
    $total=$quantity*$price;
    echo "<tr><td>$item_name</td><td>$quantity</td><td>$price</td><td>$total</td></tr>";
}else{
    echo "Low quantity";
}

?>