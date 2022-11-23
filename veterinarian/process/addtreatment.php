<?php
  include('dbconnection.php');

//pet details
$petid = 1234;

//treatment data
$treatment_date = date('Y-m-d H:i:s');
$differential_diagnosis = "mata una";
$definitive_diagnosis = "kesara hodai";
$followup_date = date('Y-m-d H:i:s');
$special_comments = "hi man hodai";

//symptoms data
$swelling = "";
$collapsed ="";
$diarrhoea = "";
$vomiting = "";
$ear_problems ="";
$eye_problems = "";
$lameness_stiffness ="";
$bloated = "";
$walk ="";
$fluffed = "";
$bleeeding = "";
$skin_redness = "";
$scratching = "";
$furr_loss = "";
$appetite = "";
$beck = "";
$weakness = "";


//medicine data
$trimethoprim_sulfa = "";
$cephalexin = "";
$enrofloxacin = "";
$penicillin = "";

//lab investigations data
$xray = "";
$fbc = "";
$ultrasound = "";

//vaccines data
$cpl = "";
$dhv = "";
$arv = "";

//insert data into treatnment table

$sql1 = "INSERT INTO `pet_treatment`(`treatment_date`,`differential_diagnosis`, `definitive_diagnosis`, `followup_date`,`special_comments`, `pet_id`) 
VALUES ('$treatment_date','$differential_diagnosis','$definitive_diagnosis','$followup_date','$special_comments','$petid')";

//insert data into symptoms table

$sql2 = "INSERT INTO `symptoms`(`treatment_date`,`swelling`, `collapsed`, `diarrhoea`,`vomiting`, `ear_problems`,`eye_problems`,`lameness_stiffness`, `bloated`,`walk`,`fluffed`,`bleeding`,`skin_redness`,`scratching`,`furr_loss`,`appetite`,`beck`,`weakness`,`pet_id`) 
VALUES ('$treatment_date','$swelling','$collapsed','$diarrhoea','$vomiting ','$ear_problems','$eye_problems','$lameness_stiffness','$bloated','$walk','$fluffed','$bleeeding','$skin_redness','$scratching','$furr_loss','$appetite','$beck','$weakness','$petid')";

//insert data into medicine table

$sql3 = "INSERT INTO `medicine_treatment`(`treatment_date`,`trimethoprim_sulfa`, `cephalexin`, `enrofloxacin`,`	penicillin`, `pet_id`) 
VALUES ('$treatment_date','$trimethoprim_sulfa','$cephalexin','$enrofloxacin','$penicillin','$petid')";

//insert data into lab investigations table

$sql4 = "INSERT INTO `lab_investigations`(`treatment_date`,`xray`, `fbc`, `ultrasound`,`pet_id`) 
VALUES ('$treatment_date','$trimethoprim_sulfa','$cephalexin','$enrofloxacin','$penicillin','$petid')";

//insert data into vaccines table
$sql5 = "INSERT INTO `vaccines`(`treatment_date`,`cpl`, `dvh`, `arv`,`pet_id`) VALUES ('$treatment_date','$cpl','$dhv','$arv ','$petid')";


if (mysqli_query($conn, $sql1 && $sql2 && $sql3 && $sql4 && $sql5)) {
  echo "New record created successfully";
} else {
  echo "Error: " .  $sql1 && $sql2 && $sql3 && $sql4 && $sql5 . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>