<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_GET,"id");

$requst=array();
$qury = "SELECT * FROM rvusrs.grade_app where st_id='$id';";

$result = mysqli_query($con,$qury);

while ($row=mysqli_fetch_array($result)) {
 
 array_push($requst,array("code"=>$row[1],
 "title"=>$row[2],"year"=>$row[3],"houre"=>$row[4],"sam"=>$row[5],"grade"=>$row[6])) ; 
}
header('content-Type:Application/json');
echo(json_encode(array("grade"=>$requst)));

mysqli_close($con);

?>