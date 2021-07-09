<?php
function check_login()
{

	if (strlen($_SESSION['user'])=="" || strlen($_SESSION['who'])=="" ) {
      $host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";		
      $_SESSION['user']="";
      $_SESSION['who']="";
     
    }
}
?>