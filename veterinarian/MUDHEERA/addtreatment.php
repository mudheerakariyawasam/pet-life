<?php
    include('dbconnection.php'); 
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
       
        //generate the next treatment ID

        $sql_get_id="SELECT treatment_id FROM treatment ORDER BY treatment_id DESC LIMIT 1";
        $result_get_id=mysqli_query($conn,$sql_get_id);
        $row=mysqli_fetch_array($result_get_id);

        $lastid="";
                        
        if(mysqli_num_rows($result_get_id)>0){
            $lastid=$row['treatment_id'];
        }

        if($lastid==""){
            $treatment_id="T001";
        }else {
            $treatment_id=substr($lastid,3);
            $treatment_id=intval($treatment_id);

            if($treatment_id>='9'){
                $treatment_id="T0".($treatment_id+1);
            } else if($treatment_id>='99'){
                $treatment_id="T".($treatment_id+1);
            }else{
                $treatment_id="T00".($treatment_id+1);
            }
        }

        // insert data to the treatment table

        $treatment_date=$_POST['treatment_date'];
        $special_comments=$_POST['special_comments'];
        $treatment_bill=$_POST['treatment_bill'];
        $followup_date=$_POST['followup_date'];
        
        $sql = "INSERT INTO treatment VALUES ('$treatment_id','E002','E003','P001','$followup_date','$special_comments','$treatment_bill','$treatment_date')";
        $result = mysqli_query($conn,$sql);
        
        //insert treatment type data into the treatment type table
        
        if(isset($_POST['treatment_type'])){
            foreach($_POST['treatment_type'] as $value){
                $name = implode(" ",$_POST['treatment_type']);
                $insert=mysqli_query($conn,"INSERT INTO treatment_type (treatment_id,treatment_type) VALUES ('T003','$value')");
            }
        }

        if($result==TRUE) { 
            echo "Added";
        }else {
            $error = "There is an error in adding!";
        }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addtreatment.css"
    
</head>
<body>
    <p>
        <span class="pet-item">PET ITEMS</span>
    </p>
    <form action="#" method="POST">
        <label>Treatment Date</label>
        <input type="date" name="treatment_date"><br>
        <label>Treatment Type</label><br>
            <input type="checkbox" name='treatment_type[]' value="surgery"> Surgery <br/>
            <input type="checkbox" name='treatment_type[]' value="vaccination"> Vaccination <br/>
            <input type="checkbox" name='treatment_type[]' value="dental"> Dental <br/>
            <input type="checkbox" name='treatment_type[]' value="treatment"> Treatment <br/>
        <label>Special Comments</label>
        <input type="text" name="special_comments"><br>
        <label>Treatment Bill</label>
        <input type="text" name="treatment_bill"><br>
        <label>FollowUp Date</label>
        <input type="date" name="followup_date"><br>
        
        <button type="submit">Submit</button>

    </form>
    
</body>
</html>