<?php
include("../connection/connection.php");
$requst=array();
$query = "SELECT * FROM rvusrs.timeline_view ORDER BY `id` DESC;";
$result = mysqli_query($con,$query);
while ($row=mysqli_fetch_array($result)) {

   $date = explode(" ",$row[6]);
 array_push($requst,array("id"=>$row[0],"subject"=>$row[1],
 "msg"=>$row[2],"to"=>$row[3],
 "office"=>$row[4],"fullname"=>$row[5],
 "date"=>$date[0],"contact"=>$row[7],
 "email"=>$row[8])) ; 
}
echo(json_encode(array("timeline"=>$requst)));

mysqli_close($con);

?>