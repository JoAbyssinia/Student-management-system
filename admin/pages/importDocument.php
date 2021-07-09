<?php

//import.php
include("../../connection/connection.php");

require '_includes/phpspreedsheet/vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=rvusrs", "root", "");

	if (isset($_FILES['pdf'])) {
	
	

  // pdf 
  $location="../dist/docs/imp-documets/";
  $locationBrowse="/dist/docs/imp-documets/";

  $pathinfo=pathinfo($_FILES['pdf']['name']);

  if (($pathinfo['extension'] == 'pdf') && $_FILES['pdf']['size'] > 0 ){
	
	 // Read excel file by using ReadFactory object.
	 $pdfac = addslashes($_FILES['pdf']['name']);
	 $pdfacTemp =$_FILES['pdf']['tmp_name'];
	 
	 $temp = explode(".", $pdfac);
	 $newpdfName= ($temp[0].'-'.date("Y").'.'.end($temp));

  
	 if (move_uploaded_file($pdfacTemp,$location.$newpdfName)) {
		
		  $query = "INSERT INTO `rvusrs`.`important-docs` 
		  (`docname`, `path`,`type`) VALUES 
		  ('".$temp[0].'-'.date('Y')."', '".$locationBrowse.$newpdfName."','important');";

			 $resultMeta = mysqli_query($con,$query);
			 if ($resultMeta) {
				
				echo "<script>location.href='documents.php?toast=1';</script>";

			 }else {
				$toast =2;
				$msg="faild pdf upload";
			 } 
	 
	 }else {
		$toast =2;
		$msg="faild pdf upload";
	 }
  }else {
	 $toast =2;
	 $msg="pdf file only!"; 
  }

}else{
  $message = '<div class="alert alert-danger">Please Select PDF File</div>';
  echo $message;
}



?>