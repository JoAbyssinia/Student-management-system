<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=6;
$asidesubelocation=61;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['row'])) {
      $addinfo = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.addcourse where `row`='".$_GET['row']."'"));

      $classinfo = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.enroll where cr_code='$addinfo[1]' and `year`='$addinfo[3]' and dep='$addinfo[2]' and `div`='$addinfo[4]' group by cr_code;"));


      $resuult = mysqli_query($con,"INSERT INTO `rvusrs`.`enroll` 
      (`st_id`, `cr_code`, `year`, `dep`, `div`, `semister`, `lecture`, `reg_st`, `reg`) 
      VALUES 
      ('$addinfo[0]', '$addinfo[1]', '$addinfo[3]', '$addinfo[2]', '$addinfo[4]', '$classinfo[5]', '$classinfo[7]', '1', '1');");

      if ($resuult) {

        $statChange = mysqli_query($con,"UPDATE `rvusrs`.`addcourse` SET `state` = '2' WHERE 
        (`row` = '".$_GET['row']."') and 
        (`st_id` = '$addinfo[0]') and 
        (`cr_code` = '$addinfo[1]');");

       $toast =1;
       $msg="student add successfully";
      }else {
        $toast =2;
        $msg="student add failed";
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
            <h1 class="m-0 text-dark">Add request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add request</li>
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
              <h3 class="card-title">List of request </h3>

              <div class="card-tools">
                All add requestes are approved by department heads
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full name</th>
                    <th>Course</th>
                    <th>Department</th>
                    <th>Academic year</th>
                    <th>Division</th>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Add</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                    $query = "SELECT * FROM rvusrs.addcourse where state='1' or state='2' order by timestamp desc;";
                    $result = mysqli_query($con,$query);
                    while ($row=mysqli_fetch_array($result)) { 
                     
                      ?>
                      
                  
                  <tr>
                    <td> <?php echo $count ?> </td>
                    <td >
                      <?php  
                          $stuf = mysqli_fetch_array(mysqli_query($con,"SELECT fname,mname,lname FROM rvusrs.student where st_id='".$row[0]."';"));
                          echo $stuf[0]." ".$stuf[1]." ".$stuf[2];
                      ?>
                    </td>
                    <td >
                      <?php  
                          $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$row[1]."';"));
                          echo $crs[0];
                      ?>
                    </td>
                    <td><?php  
                          $dep = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code = '".$row[2]."'"));
                          echo $dep[1];
                      ?></td>
                    <td>
                      <?php 
                        echo $row[3]." Year";
                      ?>
                    </td>
                    <td> <center>
                    <?php
                        if ($row[4]=="R") {
                          echo "Regular";
                        }elseif ($row[4]=="W") {
                          echo "Weekend";
                        }elseif ($row[4]=="E") {
                          echo "Extention";
                        }
                      ?>
                    </center> </td>
                    <td><center>
                      <?php 
                      echo $row['section'];
                      ?>
                    </center></td>
                    <td>
                      <?php
                      $date = explode(" ",$row['timestamp']); 
                        echo $date[0];
                      ?>
                    </td>
                    <td>  
                    <?php 
                      
                      if ($row['state']==1) {?>
                        <a href="add-request.php?row=<?php echo $row['row'] ?>" onClick="return confirm('Are you sure you want to Add this student ?')" > 
                      <button class="btn btn-info">Add </button> 
                      </a> 
                     <?php }elseif ($row['state']==2) {?>
                        <span class="text text-green" > <i class="fa fa-check-circle"></i> added </span>
                      <?php }
                    ?>

                     
                    </td>
                  </tr>

                   <?php $query++; }
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






