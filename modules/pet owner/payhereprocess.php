<?php

$$appointment_id=$_GET['appointment_id'];
$date=$_GET['date'];
$time_slot=$_GET['time_slot'];
$new_slot_id=$_GET['new_slot_id'];
$emp_id=$_GET['emp_id'];
$pet_id=$_GET['pet_id'];

$amount = 3000;
$merchant_id = "1223098";
$order_id = uniqid();
$merchant_secret = "MzU2NDY5NTEwMzE2MDY5NjcwMDg2NzM2NzQ1MjA2OTUyMDY0NQ==";
$currency = "LKR";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];
$array["appointment_id"] = $appointment_id;
$array["date"] = $date;
$array["time_slot"] = $time_slot;
$array["new_slot_id"] = $new_slot_id;
$array["emp_id"] = $emp_id;
$array["pet_id"] = $pet_id;
$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["hash"] = $hash;

$jsonObj = json_encode ($array);
echo $jsonObj;

?>
