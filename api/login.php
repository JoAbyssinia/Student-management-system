<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_POST,"id");
$pass=filter_input(INPUT_POST,"pass");


$qury = "SELECT * FROM rvusrs.student where st_id='$id' and `password`='$pass';";
 
$result = mysqli_query($con,$qury);
 
if (mysqli_num_rows($result)) {
   $json['success']='get';
}else {
   $json['failed']="not";
}

echo json_encode($json);
mysqli_close($con);
?>
