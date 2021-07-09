<?php
session_start();
//import.php
include("../../connection/connection.php");

require '_includes/phpspreedsheet/vendor/autoload.php';

$connect = new PDO("mysql:host=localhost;dbname=rvusrs", "root", "");



if($_FILES["gradeimport"]["name"] != '')
{
	$allowed_extension = array('xls', 'xlsx');
	$file_array = explode(".", $_FILES["gradeimport"]["name"]);
	$file_extension = end($file_array);

	if(in_array($file_extension, $allowed_extension))
	{
		$file_name = time() . '.' . $file_extension;
		move_uploaded_file($_FILES['gradeimport']['tmp_name'], $file_name);
		$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

		$spreadsheet = $reader->load($file_name);

		unlink($file_name);

		$data = $spreadsheet->getActiveSheet()->toArray();

		$count = 0;
		foreach($data as $row)
		{
			
			
			// echo $_SESSION['secClass'];

			if ($count > 2) {
				$insert_data = array(
					':s_id'		=>	$row[0],
					':cors'		=>	 $_SESSION['corClass'],
					':dep'		=>	$_SESSION['depClass'],
					':div'		=>	$_SESSION['divClass'],
					':yr'			=>	$_SESSION['yrClass'],
					':sem'		=>	$_SESSION['semClass'],
					':lec'		=>	$_SESSION['lecClass'],
					':grade'		=>	$row[6],
					':ass1'		=>	$row[1],
					':ass2'		=>	$row[2],
					':mid'		=>	$row[3],
					':final'		=>	$row[4],
					':gradepoint'	=>	$row[5]	
				);

				$delete_data = array(
					':s_id'		=>	$row[0],
					':cors'		=>	 $_SESSION['corClass']	
				);

// insert query 
			$query = "INSERT INTO `rvusrs`.`acadamic_history` 
			(`st_id`, `cors`, `dep`, `div`, `year`, `semister`, `lecture`, `grade`, `asses1`, `asses2`, `midexam`, `finalexam`, `gradepoint`) 
			VALUES (:s_id, :cors, :dep, :div, :yr, :sem, :lec, :grade, :ass1, :ass2, :mid, :final, :gradepoint);";
			
			$statement = $connect->prepare($query);
			$statement->execute($insert_data);
// update query
			$update="UPDATE `rvusrs`.`app_grade` SET `grade` = 'a' WHERE 
			(`st_id` = :s_id) and (`cor_code` = :cors);";

			$statement = $connect->prepare($update);
			$statement->execute($delete_data);
// delete query
			$delete = "DELETE FROM `rvusrs`.`enroll` WHERE (`st_id` = :s_id) and (`cr_code` = :cors);";
			
			$statement = $connect->prepare($delete);
			$statement->execute($delete_data);
			}
			$count++;
		}
		$message = '<div class="alert alert-success">Grade Imported Successfully</div>';

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
			// $extra="import-grade.php?cid=".$_SESSION['cid']."";
			// $host=$_SERVER['HTTP_HOST'];
			// $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			// header("location:http://$host$uri/$extra");
?>