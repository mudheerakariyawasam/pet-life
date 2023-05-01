<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/pet-life/db/dbconnection.php');
if(isset($_POST['input'])){
$input = $_POST['input'];
$query = "SELECT * FROM pet_owner WHERE owner_contactno LIKE '{$input}%' ";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0){?>

<?php 

}else{
    echo "<h6 class='text-danger text-center mt-3'>No data found</h6>";
    
}
}



?>