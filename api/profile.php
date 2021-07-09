<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_GET,"id");

$requst=array();
$qury = "SELECT st_id,fname,mname,lname,gender,birth_date,department.depname,division,entery_date,email,phone,academic_year,`profile`,section FROM rvusrs.student inner join rvusrs.department on department=dep_code   where st_id='$id';";

$result = mysqli_query($con,$qury);
$location="http://192.168.137.1/rvusrs/";
while ($row=mysqli_fetch_array($result)) {
 
   $date = explode(" ",$row[8]);
 array_push($requst,array("id"=>$row[0],"fullname"=>ucfirst($row[1])." ".ucfirst($row[2])." ".ucfirst($row[3]),
 "gender"=>$row[4],"bdate"=>$row[5],
 "dep"=>$row[6],"div"=>$row[7],
 "edate"=>$date[0],"email"=>$row[9],
 "phone"=>$row[10],"ayear"=>$row[11],"prpic"=>$location.$row[12],"section"=>$row[13])) ; 
}
header('content-Type:Application/json');
echo(json_encode(array("profile"=>$requst)));

mysqli_close($con);

?>
