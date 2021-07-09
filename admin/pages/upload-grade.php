<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=4;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload Grade</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload Grade</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">

        <div class="row">
        <div class="col-12">
          <div class="card card-danger card-outline" >
            <div class="card-header">
              <h3 class="card-title">List of Classes </h3>

            
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Course</th>
                    <th>Department</th>
                    <th>year</th>
                    <th>Division</th>
                    <th>Semister</th>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Instractur</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                    $query = "SELECT * FROM rvusrs.grade_submit order by `date` DESC ;";
                    $result = mysqli_query($con,$query);
                    while ($row=mysqli_fetch_array($result)) { 
                     
                      ?>
                      
                  
                  <tr>
                    <td> <?php echo $count ?> </td>
                    <td >
                      <?php  
                          $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$row[9]."';"));
                          echo $crs[0];
                      ?>
                    </td>
                    <td><?php  
                          $dep = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code = '".$row[1]."'"));
                          echo $dep[1];
                      ?></td>
                    <td>
                      <?php 
                        echo $row[2]." Year";
                      ?>
                    </td>
                    <td> <center>
                    <?php
                        if ($row[3]=="R") {
                          echo "Regular";
                        }elseif ($row[3]=="W") {
                          echo "Weekend";
                        }elseif ($row[3]=="E") {
                          echo "Extention";
                        }
                      ?>
                    </center> </td>
                    <td><center>
                      <?php 
                      echo $row['sem'];
                      ?>
                    </center></td>
                    <td>
                      <?php 
                        echo $row['section'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      $date = explode(" ",$row[8]);
                      echo $date[0];
                      ?>
                    </td>
                     <td>
                     <?php  
                        $lec = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.instructor where ins_id = '".$row[10]."';"));
                        echo $lec[1]." ".$lec[2];
                      ?>
                     </td>
                    <td> 
                      <a href="import-grade.php?cid=<?php echo $row[0]?>"> <button class="btn btn-info">view</button> </a> 
                    </td>
                   
                  </tr>

                   <?php $count++; }
                  ?>

                 
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        </div>  

    </section>


    <!-- recccent post  -->


  </div>
  <!-- /.content-wrapper -->

  
  <?php 
 include('_includes/footer.php');
?>






