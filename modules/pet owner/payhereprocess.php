<?php
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
$array["items"] = "Door bell wireles";
$array["first_name"] = "Saman";
$array["last_name"] = "Perera";
$array["email"] = "samanp@gmail.com";
$array["phone"] = "0771234567";
$array["address"] = "No.1, Galle Road";
$array["city"] = "Colombo";
$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["amount"] = $amount;
$array["hash"] = $hash;


$jsonObj = json_encode ($array);


echo $jsonObj;
?>

