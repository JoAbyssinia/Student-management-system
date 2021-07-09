<?php

//import.php
include("../../connection/connection.php");

require '_includes/phpspreedsheet/vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=rvusrs", "root", "");

	if (isset($_FILES['ecxel'])&& isset($_FILES['pdf'])) {
	
		$allowed_extension = array('xls', 'xlsx');
		$file_array = explode(".", $_FILES["ecxel"]["name"]);
		$file_extension = end($file_array);
	 
		if(in_array($file_extension, $allowed_extension))
		{
		  $file_name = time() . '.' . $file_extension;
		  move_uploaded_file($_FILES['ecxel']['tmp_name'], $file_name);
		  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
		  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
	 
		  $spreadsheet = $reader->load($file_name);
	 
		  unlink($file_name);
	 
		  $data = $spreadsheet->getActiveSheet()->toArray();
	 
		  
		  $count = 0;
		  foreach($data as $row)
		  {
	 
			 if ($count > 1) {
				$insert_data = array(
				  ':ocasions'		=>$row[0],
				  ':sem1'		=>	$row[1],
				  ':sem2'		=>	$row[2]	
				);
			 
				$query = "INSERT INTO `rvusrs`.`acadamic-calender` 
				(`ocasion`, `1st-semister`, `2nd-semister`) 
				VALUES (:ocasions, :sem1, :sem2);";
	 
			 $statement = $connect->prepare($query);
			 $statement->execute($insert_data);
			 }
			 $count++;
		  }
		  $message = '<div class="alert alert-success">Data Imported Successfully</div>';
		  $toast = 1;
		  $msg = "add acadamic calender Successfull.";
	 
		}
		else
		{
		  $message = '<div class="alert alert-danger">Only .xls, .xlsx or PDF file allowed</div>';
		}
	 
	 


  // pdf 
  $location="/dist/docs/calender/";
  $pathinfo=pathinfo($_FILES['pdf']['name']);

  if (($pathinfo['extension'] == 'pdf') && $_FILES['pdf']['size'] > 0 ){
	
	 // Read excel file by using ReadFactory object.
	 $pdfac = addslashes($_FILES['pdf']['name']);
	 $pdfacTemp =$_FILES['pdf']['tmp_name'];
	 
	 $temp = explode(".", $pdfac);
	 $newpdfName= ($temp[0].date("Y").'.'.end($temp));

  
	 if (move_uploaded_file($pdfacTemp,$location.$newpdfName)) {
		
		  $query = "INSERT INTO `rvusrs`.`important-docs` 
		  (`docname`, `path`,`type`) VALUES 
		  ('".$temp[0].date('Y')."', '".$location.$newpdfName."','calender');";

			 $resultMeta = mysqli_query($con,$query);
			 if ($resultMeta) {
				$toast =1;
				$msg="Acadamin calender pdf format successfull";
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
  $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

?>