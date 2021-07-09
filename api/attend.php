<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_GET,"id");

$requst=array();
$qury = "SELECT cr_code,course_tilte,credit_houre FROM rvusrs.attend where st_id='$id';";

$result = mysqli_query($con,$qury);

while ($row=mysqli_fetch_array($result)) {
 
 array_push($requst,array("code"=>$row[0],
 "title"=>$row[1],"houre"=>$row[2])) ; 
}
header('content-Type:Application/json');
echo(json_encode(array("attend"=>$requst)));

mysqli_close($con);

?>
