<?php
include("../connection/connection.php");
$requst=array();
$location="http://192.168.137.1/rvusrs/admin/";
$query = "SELECT id,docname,`path`,`timestamp` FROM rvusrs.`important-docs` where `type`='important' ORDER BY `important-docs`.`timestamp` DESC;";
$result = mysqli_query($con,$query);
while ($row=mysqli_fetch_array($result)) {

   $date = explode(" ",$row[3]);

 array_push($requst,array("id"=>$row[0],"docname"=>$row[1],
 "path"=>$location.$row[2],"date"=>$date[0])); 
}

header('content-Type:Application/json');
echo(json_encode(array("documents"=>$requst)));

mysqli_close($con);

?>