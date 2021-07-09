<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=4;
$asidesubelocation=41;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    if (isset($_POST['upgrade'])) {
        
        $gradepoint = ($_POST['ass1']+$_POST['ass2']+$_POST['midexam']+$_POST['finalexam']);

          if ($gradepoint>100) {
              $toast=2;
              $msg="total grade is more than 100 ";
          }else {
 
          $updateQuery = "UPDATE `rvusrs`.`acadamic_history` SET 
           `grade` = '".$_POST['grade']."',
          `asses1` = '".$_POST['ass1']."', 
          `asses2` = '".$_POST['ass2']."', 
          `finalexam` = '".$_POST['midexam']."', 
          `gradepoint` = '".$_POST['finalexam']."',
          `gradepoint` = '$gradepoint' 
          WHERE 
          (`st_id` = '".$_GET['st_id']."') and 
          (`cors` = '".$_GET['cors']."') and 
          (`dep` = '".$_GET['dep']."') and 
          (`div` = '".$_GET['div']."') and 
          (`year` = '".$_GET['yr']."') and 
          (`semister` = '".$_GET['sem']."');";


          if (mysqli_query($con,$updateQuery)) {
            echo "<script>window.location='import-grade.php?cid=".$_GET["cid"]."&&toast=1';</script>";
          }else {
            $toast=2;
            $msg="Failed to update, try again later ";
          }
        }
    }
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Grade</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Grade</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Edit student grade -->
    <section class="content">

        <div class="row">
        <div class="col-12">
          <div class="card card-danger card-outline" >
            <div class="card-header">
            <a href="import-grade.php?cid=<?php echo $_GET['cid']?>" class="text-bold text-black-50">
                <i class="fa fa-arrow-alt-circle-left"></i> back
              </a>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <div class="row">
                  <div class="col-md-6 col-sm-12 p-0">
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <th colspan="2" class="text-center" > Student info </th>
                        </tr>
                        <tr>
                          <th>Student ID :</th>
                          <td><?php echo $_GET['st_id'] ?></td>
                        </tr>
                        <tr>
                          <th>Full name :</th>
                          <td><?php 
                             $stuname = mysqli_fetch_array(mysqli_query($con,"SELECT fname,mname,lname FROM rvusrs.student where st_id='".$_GET['st_id']."';"));
                             echo $stuname[0]." ".$stuname[1]." ".$stuname[2];
                          ?></td>
                        </tr>
                        <tr>
                          <th>Course :</th>
                          <td><?php 
                             $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$_GET['cors']."';"));
                             echo ucfirst($crs[0]);
                          ?></td>
                        </tr>
                        <tr>
                          <th>Department :</th>
                          <td><?php
                           $dep = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code = '".$_GET['dep']."'"));
                           echo ucfirst($dep[1]);
                          ?></td>
                        </tr>
                        <tr>
                          <th>Division :</th>
                          <td><?php 
                            if ($_GET['div']=="R") {
                              echo "Regular";
                            }elseif ($_GET['div']=="W") {
                              echo "Weekend";
                            }elseif ($_GET['div']=="E") {
                              echo "Extention";
                            }
                          ?></td>
                        </tr>
                        <tr>
                          <th>Academic Year :</th>
                          <td><?php echo $_GET['yr']." Year" ?></td>
                        </tr>
                        <tr>
                          <th>Semester :</th>
                          <td><?php echo $_GET['sem'] ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <?php 
               
                      $stuinfo = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.acadamic_history where st_id='".$_GET['st_id']."' and cors='".$_GET['cors']."' and dep ='".$_GET['dep']."' and `div`='".$_GET['div']."' and `year`='".$_GET['yr']."' and semister='".$_GET['sem']."' "));
                    ?>
                    <form class="form-horizontal"  method="POST">
                      <div class="p-4">
                        <div class="text-center">
                          <p class="font-weight-bold">Semester Result </p>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Ass.1 <small>(15%)</small> </label>
                          <div class="col-sm-9">
                            <input type="text" name="ass1" required value="<?php echo $stuinfo['asses1'] ?>" class="form-control" id="inputEmail3" placeholder="Assesment 1">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3"  class="col-sm-3 col-form-label">Ass.2 <small>(15%)</small> </label>
                          <div class="col-sm-9">
                            <input type="number" name="ass2" required value="<?php echo $stuinfo['asses2'] ?>" class="form-control" id="inputPassword3" placeholder="Assesment 2">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword3"  class="col-sm-3 col-form-label">Mid Exam <small>(30%)</small></label>
                          <div class="col-sm-9">
                            <input type="number" name="midexam" required value="<?php echo $stuinfo['midexam'] ?>" class="form-control" id="inputPassword3" placeholder="Mid Exam">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-3 col-form-label"> Final Exam <small>(40%)</small> </label>
                          <div class="col-sm-9">
                            <input type="number" name="finalexam" required value="<?php echo $stuinfo['finalexam'] ?>" class="form-control" id="inputPassword3" placeholder="Final exam">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-3 col-form-label"> Grade </label>
                          <div class="col-sm-9">
                            <input type="text" name="grade" required value="<?php echo $stuinfo['grade'] ?>" class="form-control" id="inputPassword3" placeholder="Final exam">
                          </div>
                        </div>
                        
                     
                        <button type="submit" name="upgrade" onClick="return confirm('Are you sure you want to update?')" class="btn btn-success btn-block">Update</button>
                        
                      </div>
                      <!-- /.card-footer -->
                    </form> 
                  </div>
                </div> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        </div>  
    </section>
  </div>
<?php 
 include('_includes/footer.php');
?>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
$(document).ready(function(){

 
});
</script>





