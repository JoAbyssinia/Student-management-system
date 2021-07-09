<?php 

include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();

if (strlen($_SESSION['user'])=="" || strlen($_SESSION['who'])=="" ) {
  $host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";		 
    header("Location: http://$host$uri/$extra");
}

$subdashpagelication=21;
$dashSidebar=2;
$pagelication = 6;
$subpagelication=1;
$toast=0;
include('_includes/navbar.php');
  $counter =0;
?>


<?php 
  if (isset($_GET['assigncourse'])) {
      
    $dep=$_GET['dep'];
    $yr=$_GET['ay'];
    $sem=$_GET['sem'];
    $course=$_GET['cor'];

    $siz = sizeof($course);
  

  
    $queryStudent = "SELECT * FROM rvusrs.student where 
    department='$dep' and academic_year='$yr';";
  
    $resultStudent=mysqli_query($con,$queryStudent);
    while ($row=mysqli_fetch_array($resultStudent)) {
     
      foreach ($course as $code) {

        $enrollQuery = "INSERT INTO `rvusrs`.`enroll`
         (`st_id`, `cr_code`, `year`, `dep`, `div`, `semister`) 
         VALUES 
         ('$row[0]', '$code', '$row[11]', '$dep', '$row[7]', '$sem');"; 
        $enrollResult=	mysqli_query($con,$enrollQuery);
        // delete_pre();
        // grade stor in app db
        mysqli_query($con,"INSERT INTO `rvusrs`.`app_grade` (`st_id`, `cor_code`, `sem`, `year`)
         VALUES 
         ('$row[0]', '$code', '$sem', '$row[11]');");
      }
    }
  
    $couEnro= mysqli_fetch_array(mysqli_query($con,"SELECT count(*) FROM rvusrs.enroll where dep='$dep' and year='$yr';"));
    $couStu= mysqli_fetch_array(mysqli_query($con,"SELECT count(*) FROM rvusrs.student where department='$dep' and academic_year='$yr';"));
    $counter = intdiv(intval($couEnro[0]), intval($couStu[0]));
   
  if($counter == $siz)
  {
    $extra="view-assigned.php?toast=1";
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    echo "<script>  location.replace('http://$host$uri/$extra');  </script>";
  }else {
    // echo $counter." ".$siz;
  }
  }
  if (isset($_GET['toast'])==1) {
    $toast=1;
  }

  if (isset($_GET['instraction'])) {
    $delQuery = "SELECT * FROM rvusrs.app_grade";
    // echo $delQuery;
    $delResult=mysqli_query($con,$delQuery);
    if (mysqli_affected_rows($con)!=0) {
       while ($row=mysqli_fetch_array($delResult)) {
      $delete="DELETE FROM `rvusrs`.`app_grade` WHERE (`st_id` = '$row[0]') and (`cor_code` = '$row[1]');";
      mysqli_query($con,$delete);
    }
    }
  }


?>


<main id="main">
    
    <div class="row">
   <?php 
      include('_includes/sidebar.php')
   ?>  
      <div class="col-md-10 content" style=" min-height: 600px;">
        
        <div class="content-header" style="margin-top: 100px;">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Course Assign</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Course Assign </li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
          
        <section class="content " style="padding: 10px 10px;">
          <div class="card card-danger card-outline" style="min-height: 500px;">
            <div class="card-header">
              <h3 class="card-title text-gray-dark">
                departement: <strong> 
                <?php 
                  echo $dep[0];
                ?>    
              </strong>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body"> 
              <form action="#" method="get">
                <input type="hidden" name="dep" value ="<?php echo trim($prof[5]," ") ?>">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label >Acadamic year</label>
                    <select name="ay" class="form-control select2" required="true" data-placeholder="select year" >
                    <option></option>
                    <?php 
                      if ($prof[5]=='cs') {?>
                         <option value="1st">1st</option>
                         <option value="2nd">2nd</option>
                         <option value="3rd">3rd</option>
                         <option value="4th">4th</option>
                      <?php }elseif ($prof[5]=='ce') {?>
                        <option value="1st">1st</option>
                         <option value="2nd">2nd</option>
                         <option value="3rd">3rd</option>
                         <option value="4th">4th</option>
                         <option value="5th">5th</option>
                     <?php }elseif ($prof[5]=='acc') {?>
                        <option value="1st">1st</option>
                         <option value="2nd">2nd</option>
                         <option value="3rd">3rd</option>
                     <?php }
                    ?>
                    

                    </select>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label >Semister</label>
                    <select name="sem" class="form-control select2" required="true" data-placeholder="select Semister" >
                    <option></option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Course</label>
                    <select class="select2bs4" name="cor[]" multiple="multiple" data-placeholder="Select a Courses"
                            style="width: 100%;">
                     
                     <?php 
    
                      $pc = explode(",",$row[5]);
                      
                      $sql=mysqli_query($con," SELECT * FROM rvusrs.course where offering_dep = '".$prof[5]."' or catagory = 'common'; ");
                      while($rowC=mysqli_fetch_array($sql)){?>
                          <option value="<?php echo $rowC[0];?>" ><?php echo $rowC[1] ?></option> 
                       <?php 
                      } ?>
              
                    </select>
                  </div>

                </div> 
                <!-- end of multiple select -->
                <div class="col-md-3 text-center"></div>
                <div class="col-md-6 text-center" style="margin-top: 50px;">

                  <button type="submit" name="assigncourse" class="btn btn-danger btn-block"> Assign </button>

                </div>
                <div class="col-md-3 text-center"></div>


                </div>
              </form>
              <a href="assign-course.php?instraction=1">
                 <button class="btn btn-dark" onclick="return confirm('Are you sure you want to Clear table?')" > Clear App table </button>
                
              </a>

            </div>
            <!-- /.card-body -->
          </div>
        </section>
        </div>
      </div>
    </div>
  
  </main><!-- End #main -->


  <footer id="footer">
<?php 
include("_includes/footer.php");
?>
 <script src="assets/d/plugins/select2/js/select2.min.js"></script>
<script src="assets/d/dist/js/adminlte.min.js"></script>
<script src="assets/d/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });

  </script>

  <script>
    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      <?php 
        if ($toast==1) {?>
        Toast.fire({
        icon: 'success',
        title: ' profile update successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: ' profile update failed.' 
      })
     <?php }
      ?>
      

    });
 </script>
  <script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });

  $('.select2').select2();

  $(function() {
      $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    })
</script>
 
