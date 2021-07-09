<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=6;
$asidesubelocation=62;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['cr_code'])) {
    $query="DELETE FROM `rvusrs`.`enroll` WHERE (`st_id` = '".$_GET['st']."') and (`cr_code` = '".$_GET['cr_code']."');";

      $result = mysqli_query($con,$query);
      if ($result) {
         $res = mysqli_query($con,"UPDATE `rvusrs`.`dropcourse` SET `state` = '2' WHERE 
      (`st_id` = '".$_GET['st']."') and (`cor_code` = '".$_GET['cr_code']."');");
      
      $toast =1;
       $msg="student Drop successfully";

      }else {
        
        $toast =2;
        $msg="student Drop failed";

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
            <h1 class="m-0 text-dark">Drop request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Drop request</li>
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
                All Drop requestes are approved by department heads
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
                    
                    <th>Date</th>
                    <th>Add</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                  $query = "SELECT * FROM rvusrs.dropcourse where state='1' or state='2' order by timestamp desc";
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
               
                   
                    <td>
                      <?php
                      $date = explode(" ",$row['timestamp']); 
                        echo $date[0];
                      ?>
                    </td>
                    <td>  
                    <?php 
                      
                      if ($row['state']==1) {?>
                        <a href="drop-request.php?cr_code=<?php echo $row['cor_code'] ?>&&st=<?php echo $row['st_id'] ?>" onClick="return confirm('Are you sure, you want to Drop this student ?')" > 
                      <button class="btn btn-info">Drop </button> 
                      </a> 
                     <?php }elseif ($row['state']==2) {?>
                        <span class="text text-danger" > <i class="fa fa-check-circle"></i> dropped </span>
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






