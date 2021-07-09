<?php 
include("../connection/connection.php");

$id=filter_input(INPUT_GET,"id");
$request = array();
$queReg = "SELECT * FROM rvusrs.enroll where st_id='$id';";
$resultReg =mysqli_query($con,$queReg);
    
if (mysqli_affected_rows($con)) { 
  while ($row=mysqli_fetch_array($resultReg)) { 
      $reg =$row['reg_st'];
      $reg_en = $row['reg'];
   } 
   if ($reg && $reg_en) {
      array_push($request,array("state"=>"Rd"));
   }elseif ($reg && !$reg_en) {
      array_push($request,array("state"=>"rr"));
   }else { 
      array_push($request,array("state"=>"r"));
   }
}else {
   array_push($request,array("state"=>"nay"));
}

header('content-Type:Application/json');
echo(json_encode(array("state"=>$request)));
mysqli_close($con);
?>