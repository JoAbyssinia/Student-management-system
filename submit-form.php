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

$subdashpagelication=41;
$dashSidebar=4;
$pagelication = 6;
$subpagelication=1;
$toast=0;
include('_includes/navbar.php');
$message="";
  $counter =0;
?>
<?php 

      if (isset($_POST['submitgrade'])) {
        
        if (isset($_FILES['grade']) && isset($_FILES['attendace'])) {
         
          $allowed_extension = array('xls', 'xlsx');
          $file_array = explode(".", $_FILES["grade"]["name"]);
          $file_array = explode(".", $_FILES["attendace"]["name"]);
          $file_extension = end($file_array);
          $file_extensionA = end($file_array);
          
          
          if(in_array($file_extension, $allowed_extension) && in_array($file_extensionA,$allowed_extension) ){
  
            $location="admin/dist/docs/grade-submited/";

            $grade = addslashes($_FILES['grade']['name']);
            $gradeTemp =$_FILES['grade']['tmp_name'];
            

            $temp = explode(".", $grade);
          $gradenewname= ($temp[0]."-"."grade"."-".$_GET['cr']."-".$_GET['dep']."-".$_GET['yr']."-".$_GET['div']."-".$_GET["sec"]."-".date("Y").'.'.end($temp));

            

            $attend = addslashes($_FILES['attendace']['name']);
            $attendTemp =$_FILES['attendace']['tmp_name'];
            

            $tempA = explode(".", $attend);
            $attendnewname= ($tempA[0]."-"."attendace"."-".$_GET['cr']."-".$_GET['dep']."-".$_GET['yr']."-".$_GET['div']."-".$_GET["sec"]."-".date("Y").'.'.end($tempA));

            
            if (move_uploaded_file($gradeTemp,$location.$gradenewname) && move_uploaded_file($attendTemp,$location.$attendnewname)) {

             

              $querySubmit= "INSERT INTO `rvusrs`.`grade_submit`
               (`dep`, `year`, `div`, `sem` , `section`,`doc_grade`, `doc_attendace`, `cor_id`, `lec_id`)
                VALUES 
              ('".$_GET['dep']."', '".$_GET['yr']."', '".$_GET['div']."', '".$_GET['sem']."','".$_GET['sec']."','$location$gradenewname', '$location$attendnewname', '".$_GET['cr']."', '".$_SESSION['user']."');";

              $result = mysqli_query($con,$querySubmit);
              if ($result) {
                header("location:submit-grade.php?toast=1");
              }else {
                $toast=2;
              }
              
              
            }
            

  
          }else {
          $message = '<div class="alert alert-danger">Only .xls, .xlsx file allowed</div>';
            
          }

        }else {
          $message = '<div class="alert alert-danger">Only .xls, .xlsx file allowed</div>';
        }

      }

    
  

  if (isset($_GET['toast'])==1) {
    $toast=1;
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
                <h1 class="m-0 text-dark">Grade submit</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Grade submit</li>
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
              <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                   
                   <a href="admin/dist/docs/sample grade.xlsx"> <i class="fa fa-file-excel"></i> Grade template </a>
                   <a href="admin/dist/docs/student attendace.xlsx"> <i class="fa fa-file-excel"></i> Attendas template </a>

                  </div>
                </div>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body"> 
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <label>Class detail</label>
                   <table class="table table-bordered">
                     <tr>
                       <td>Course</td>
                       <td>
                         <?php 
                          $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$_GET['cr']."';"));
                          echo $crs[0];
                         
                         ?>
                       </td>
                     </tr>
                     <tr>
                      <td>Departement</td>
                      <td>
                      <?php 
                     
                         $diplis = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department WHERE  dep_code = '".$_GET['dep']."'"));
                         echo $diplis[1];
                         
                         ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Acadamic Year</td>
                      <td>
                      <?php 
                          echo $_GET['yr']." year";
                         ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Division</td>
                      <td>
                      
                          
                          <?php

                          if ($_GET['div']=="R") {
                            echo "Regular";
                          }elseif ($_GET['div']=="W") {
                            echo "Weekend";
                          }elseif ($_GET['div']=="E") {
                            echo "Extention";
                          }
                        ?>
                         
                      </td>
                    </tr>
                    <tr>
                      <td>Semister</td>
                      <td>
                      <?php 
                          echo $_GET['sem'];
                         ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Section</td>
                      <td>
                      <?php 
                          echo $_GET['sec'];
                         ?>
                      </td>
                    </tr>
                   </table>
                </div>
                <div class="col-md-6 col-sm-12">
                <span id="message"> <?php echo $message; ?> </span>
                  <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label for="exampleInputFile">Grade file <small class="font-weight-light" >[excel only]</small> </label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="grade" required class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputFile">Attendance file <small  class="font-weight-light">[excel only]</small> </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="attendace" required class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                      <br><br>
                  <div class="form-group">
                    <button type="submit" name="submitgrade" class="btn btn-block bg-gradient-success" > <i class="fa fa-upload"></i> Submit</button>
                  </div>
                </form>
                <!-- ende of div -->
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
        title: '  successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: 'Grade Submit failed.' 
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
 
