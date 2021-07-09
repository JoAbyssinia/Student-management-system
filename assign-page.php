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

$subdashpagelication=31;
$dashSidebar=3;
$pagelication = 6;
$subpagelication=1;
$toast=0;
include('_includes/navbar.php');
  $counter =0;

   if (isset($_GET['dep'])) {
   $_SESSION['dep']= $_GET['dep'];
   $_SESSION['yr']=$_GET['yr'];
   $_SESSION['div']= $_GET['div'];
   $_SESSION['sem']=$_GET['sem'];
   $_SESSION['sec']= $_GET['sec'];

   $department= $_SESSION['dep'];
   $yr= $_SESSION['yr'];
   $div=  $_SESSION['div'];
   $sem= $_SESSION['sem'];
   $sec= $_SESSION['sec'];
   }
   else {
     
   $department= $_SESSION['dep'];
   $yr= $_SESSION['yr'];
   $div=  $_SESSION['div'];
   $sem= $_SESSION['sem'];
   $sec= $_SESSION['sec'];
   }

  if (isset($_GET['assignCourseSet'])) {

    $course = $_GET['courseSelect'];
    $lec = $_GET['lect'];
    

    $queryAssign = "SELECT enroll.st_id,enroll.cr_code, enroll.lecture FROM rvusrs.enroll inner join rvusrs.student on enroll.st_id = student.st_id where 
    academic_year='".$yr."' and 
    dep='".$department."' and 
    semister = '".$sem."' and 
    enroll.div = '".$div."'  and   
    section = '".$sec."' ;  ";


    $resultAssign = mysqli_query($con,$queryAssign);
    while ($rowA = mysqli_fetch_array($resultAssign)) {
      for ($i=0; $i < sizeof($course) ; $i++) { 
            if ($rowA[1]==$course[$i]) {
                $updateIs ="UPDATE `rvusrs`.`enroll` SET `lecture` = '".$lec[$i]."' WHERE 
                (`st_id` = '$rowA[0]') and (`cr_code` = '".$rowA[1]."');" ;
               
                 mysqli_query($con,$updateIs);
                  
                 
            }
      }
    }

    
    header('location:assigned-instructor.php?toast=1');
    exit();

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
                <h1 class="m-0 text-dark">Assign Instructor</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Assign Instructor </li>
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
              Section: <strong> <?php echo $sec ?> </strong>
              </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="min-height: 500px;">
                  <div class="row">

                 
                
                  <div class="col-md-9">
                    <table class="table table-hover text-nowrap ">
                      <thead>
                        <tr>
                        <th>#</th>
                        <th>course title</th>
                        <th>select instructor</th>
                      </tr>
                      </thead>
                      <tbody>
                  <form action="#" method="get">    
                   
                  <?php 
                    // $courseQuery = "SELECT cr_code , lecture FROM rvusrs.enroll
                    // where dep='".$department."' and `div` = '".$div."' and `year`='".$yr."' group by cr_code;";
                    $courseQuery="SELECT * from rvusrs.enroll inner join student on enroll.st_id=student.st_id 
                    where dep='".$department."' and `div`='".$div."' and `year`='".$yr."' and section='".$sec."' group by cr_code;";
                    $count=1;
                    $query=mysqli_query($con,$courseQuery);
                    while ($row=mysqli_fetch_array($query)) {
                      // echo $row[0];
                  ?>               
                      <tr>
                        <td ><?php echo $count ?></td>
                        <td >
                          <?php 

                        
                            $ct = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.course where cr_code = '".$row['cr_code']."'"));
                            echo $ct[1];

                          ?>
                          <input type="hidden" name="courseSelect[]" value="<?php echo $row['cr_code'] ?>">
                        </td>
                        <td style="width: 60px" > 
                          <div class="form-group">
                            <select name="lect[]" class="form-control form-block select2" required="true" data-placeholder="select Instructor" >
                            <option></option>

                                <?php 
                                  $inst = "SELECT * FROM rvusrs.instructor";
                                  $instCourty = mysqli_query($con,$inst);
                                  while ($in = mysqli_fetch_array($instCourty)) { 
                                    
                                    if ($in[0]==$row['lecture']) { ?>
                                    <option value="<?php echo $in[0] ?>" selected> <?php echo $in[1]." ".$in[2] ?></option>
                                    
                                  <?php  }else { ?>
                                    <option value="<?php echo $in[0] ?>"> <?php echo $in[1]." ".$in[2] ?></option>
                                      
                                  <?php }
                                  }
                                ?>
                            </select>
                          </div>
                        
                        </td>
                       </tr>          
                    <?php  $count++;
                  } ?>
                      </tbody>
                    </table>
                    <div class="p-3">
                       <button type="submit" name='assignCourseSet' class="btn btn-danger">assign</button> 
                    </div>
                </form>
                  </div>
                  </div>
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
 
