<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_GET,"id");

 
$regQ = "SELECT * FROM rvusrs.enroll where st_id='".$id."';";

$resR = mysqli_query($con,$regQ);
while ($row=mysqli_fetch_array($resR)) {
     mysqli_query($con,"UPDATE `rvusrs`.`enroll` SET `reg_st` = '1' WHERE (`st_id` = '$row[0]');");
}
   $json['success']='get';
   
echo json_encode($json);
mysqli_close($con);

?>
