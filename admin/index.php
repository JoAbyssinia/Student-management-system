<?php
	session_start();
	include("../connection/connection.php");
	error_reporting(0);
	if(isset($_POST['login']))
	{
		$query = "SELECT * FROM rvusrs.adminlogin where username='".$_POST['username']."' and password='".$_POST['password']."';";
		$ret=mysqli_query($con,$query);
		$num=mysqli_fetch_array($ret);
		$roll = $num['roll'];
		$_SESSION['roll']=$roll;

		if ($num>1) {

			$extra="pages/dashboard.php";
			$_SESSION['username']=$_POST['username'];
			$_SESSION['id']=$num['id'];
			$host=$_SERVER['HTTP_HOST'];
			$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}else {
			
			$_SESSION['errmsg']="Invalid username or password";
			$extra="index.php";
			$host  = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>RVU Adama SRS | Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	

	<link href="dist/img/logo_rvu.png" rel="icon">
	<link href="dist/img/logo_rvu.png" rel="apple-touch-icon">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="plugins/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plugins/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="plugins/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="dist/css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(dist/img/logo_rvu.png);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form"   method="POST">
							<p>
								<span style="color:red;"><?php
								 echo htmlentities($_SESSION['errmsg']); 
								?><?php
								  echo htmlentities($_SESSION['errmsg']="");
								?></span>
							</p>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						

						
					</div>
					<div class="container-login100-form-btn">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>

						
					</div>
				
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="plugins/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/vendor/bootstrap/js/popper.js"></script>
	<script src="plugins/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="plugins/vendor/daterangepicker/moment.min.js"></script>
	<script src="plugins/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="plugins/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="dist/js/main.js"></script>

</body>
</html>