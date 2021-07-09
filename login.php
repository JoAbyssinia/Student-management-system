<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
$pagelication=0;
$subpagelication=0;
error_reporting(0);

?>

<?php 
   if (isset($_POST['login'])) {

      $id = trim($_POST['id']);
      $pass = trim($_POST['pass']);

        
      $value = logincheck($id,$pass);
      
      if (strlen($value)>1) {
         $data = explode(" ",$value);

         $_SESSION['who']=$data[0]; 
         $_SESSION['user']=$data[1];
         
         $extra="dashboard.php";
			$host=$_SERVER['HTTP_HOST'];
			$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
      }else {
         $_SESSION['errmsg']="Invalid username or password";
      }
      
      
   }

?>
<?php 
include('_includes/navbar.php'); 
?>

<link rel="stylesheet" type="text/css" href="assets/l/css/main.css">

<main id="main">

<section>
  <div class="row">
   
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <form class="login100-form validate-form " action="" method="post">
            <div class="row"> 
              <div class="col-md-12 text-center">
                <img src="assets/img/logo-rvu.png" style="height: 100px;" alt="">
              </div> 
                       
           </div>

            <div class="text-danger font-weight-light text-center "> 
                      <?php
								 echo htmlentities($_SESSION['errmsg']); 
								?><?php
								  echo htmlentities($_SESSION['errmsg']="");
								?>    
           
            </div>
            <div class="wrap-input100 validate-input" data-validate = "inter id code">
              <input class="input100" type="text" name="id">
              <span class="focus-input100" data-placeholder="id"></span>
            </div>
  
            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
              </span>
              <input class="input100" type="password" name="pass">
              <span class="focus-input100" data-placeholder="Password"></span>
            </div>
  
            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <button type="submit" name="login" class="btn btn-danger btn-block">
                  Login
                </button>
              </div>
            </div>
            <br>
          
          </form>
        </div>
      </div>
    </div>
  
  </div>
</section>



<!-- End Trainers Section -->

</main><!-- End #main -->

<?php 
function logincheck($id,$pass)
{
   global $con;
   $queryStudent = "SELECT * FROM rvusrs.student where st_id = '$id' and password = '$pass';";
   $queryInstructor = "SELECT * FROM rvusrs.instructor where ins_id = '$id' and password = '$pass';"; 


   $result = mysqli_query($con,$queryStudent);
   $row = mysqli_fetch_array($result);
   if (mysqli_affected_rows($con)) {
     return  "student ".trim($row['st_id']);
   }

   $resultI = mysqli_query($con,$queryInstructor);
   $row =  mysqli_fetch_array($resultI);
   if (mysqli_affected_rows($con)) {
     return  "Inst ".trim($row['ins_id']);
   }

   return 0;

}

?>



<?php 
include("_includes/footer-top.php");
include("_includes/footer.php");

?>
<script src="assets/l/js/main.js"></script>
  