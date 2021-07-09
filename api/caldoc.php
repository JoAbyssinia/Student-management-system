<?php 
include("../connection/connection.php");
$location="http://192.168.137.1/rvusrs/";
$request=array();
$query = "SELECT id,docname,`path` FROM rvusrs.`important-docs` where `type`='calender';";

$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);

array_push($request,array("id"=>$row[0],"docname"=>$row[1],"path"=>$location.$row[2]));

echo(json_encode(array("caldoc"=>$request)));
mysqli_close($con);

?>