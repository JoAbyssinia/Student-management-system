<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_GET,"id");

$requst=array();
$qury = "SELECT cr_code,course_tilte,credit_houre,prerequesit,fname,lname FROM rvusrs.course_enroll  where st_id='$id';";

$result = mysqli_query($con,$qury);
 
while ($row=mysqli_fetch_array($result)) {

 array_push($requst,array("code"=>$row[0],
 "title"=>$row[1],"houre"=>$row[2],
 "pre"=>$row[3],"fulname"=>ucwords($row[4]." ".$row[5]))); 
}
header('content-Type:Application/json');
echo(json_encode(array("enrollcourse"=>$requst)));

mysqli_close($con);

?>
