<?php
include("../connection/connection.php");
$requst=array();
$query = "SELECT * FROM rvusrs.`acadamic-calender`;";
$result = mysqli_query($con,$query);
while ($row=mysqli_fetch_array($result)) {

 array_push($requst,array("id"=>$row[0],"1st"=>$row[1],
 "2nd"=>$row[2])); 
}
echo(json_encode(array("calender"=>$requst)));

mysqli_close($con);

?>