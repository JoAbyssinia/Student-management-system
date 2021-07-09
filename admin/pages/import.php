<?php

//import.php
include("../../connection/connection.php");

require '_includes/phpspreedsheet/vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=rvusrs", "root", "");

if($_FILES["studentListex"]["name"] != '')
{
	$allowed_extension = array('xls', 'xlsx');
	$file_array = explode(".", $_FILES["studentListex"]["name"]);
	$file_extension = end($file_array);

	if(in_array($file_extension, $allowed_extension))
	{
		$file_name = time() . '.' . $file_extension;
		move_uploaded_file($_FILES['studentListex']['tmp_name'], $file_name);
		$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

		$spreadsheet = $reader->load($file_name);

		unlink($file_name);

		$data = $spreadsheet->getActiveSheet()->toArray();

		
		
		$count = 0;
		foreach($data as $row)
		{
		$autoID = rand(1000,9999);
		$yr=date('y');
		$autoID = "RVUSDR/".$autoID."/".$yr;

		$autoID = idchecker($autoID);

			if ($count > 0) {

				$insert_data = array(
					':id'		=>	$autoID,
					':first_name'		=>	$row[0],
					':middle_name'		=>	$row[1],
					':last_name'		=>	$row[2],
					':gender'		=>	$row[3],
					':bith_date'	=>	$row[4],
					':dep'		=>	$row[5],
					':div'		=>	$row[6],
					':email'		=>	$row[7],
					':phone'		=>	$row[8],
					':a_year'	=>	$row[9]	
				);
			
				
			


			// $autoID = rand(1000,9999);
			// $yr=date('y');
			// $autoID = "RVUSDR/".$autoID."/".$yr;

			// $autoID = idchecker($autoID);

			$query = "INSERT INTO `rvusrs`.`student` 
			            (`st_id`, `fname`, `mname`, `lname`, `gender`, `birth_date`, `department`, `division`, `email`, `phone`, `academic_year`)
			            VALUES (:id,:first_name,:middle_name,:last_name,
							:gender,:bith_date,:dep,:div,:email,:phone,:a_year);";
			
			

			$statement = $connect->prepare($query);
			$statement->execute($insert_data);
			// mysqli_query($con,$query);
			}
			$count++;
		}
		$message = '<div class="alert alert-success">Data Imported Successfully</div>';

	}
	else
	{
		$message = '<div class="alert alert-danger">Only .xls or .xlsx file allowed</div>';
	}
}
else
{
	$message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;


		function idchecker ($ID) {
			global $con;
			$query = "SELECT * FROM rvusrs.studetchid where st_id ='".$ID."';";
			
			$result = mysqli_query($con,$query);
			$pass = mysqli_fetch_array($result);

			if (mysqli_affected_rows($con)>=1) {
			idchecker($ID);
			}else {
			return $ID;
			}
		}

?>