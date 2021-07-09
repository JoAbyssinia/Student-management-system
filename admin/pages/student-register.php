<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=5;
$asidesubelocation=0;
?> 

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    if (isset($_GET['st_id'])) {
      
      $queryE  = "SELECT * FROM rvusrs.enroll where st_id='".$_GET['st_id']."';";
      $result = mysqli_query($con,$queryE);
      while ($row=mysqli_fetch_array($result)) {
          mysqli_query($con,"UPDATE `rvusrs`.`enroll` SET `reg` = '1' WHERE (`st_id` = '".$_GET['st_id']."');");
      }
    }
?>


<!-- DataTables -->
<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Student Register</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Register</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
          <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">list of courses</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="min-height: 500px;" >
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Id</th>
                      <th>Full name</th>
                      <th>Department</th>
                      <th>Division</th>
                      <th>Acadamic year</th>
                      <th>Semister</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.enroll where lecture IS NOT NULL group by st_id order by dep,year,semister;");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                  <tr>
                  <td class="center"><?php echo $cnt;?></td>
                  <td><?php echo $row[0];?>
                  </td>
                  <td class="hidden-xs"><?php

                      $stQuery = "SELECT * FROM rvusrs.student where st_id='".$row[0]."';";
                                                
                      $resultSt = mysqli_query($con,$stQuery);
                      $stname = mysqli_fetch_array($resultSt);	
                      echo $stname['fname']." ".$stname['mname']." ".$stname['lname']; 
                      ?>
                    
                    </td>
                  <td><?php 
                    $dep = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code ='".$row[3]."';"));
                  echo $dep[1];
                  ?>
                  </td>
                  <td><?php 
                    if ($row[4]=="R") {
                      echo "Regular";
                    }elseif ($row[4]=="W") {
                      echo "Weekend";
                    }elseif ($row[4]=="E") {
                      echo "Extention";
                    }
                  ?>
                  </td>
                  <td><?php echo $row[2]." Year";?>
                  </td>
                  <td> <center><?php echo $row[5];?> </center>  </td>
                  
                  <td >
                    <?php 
                      if ($row['reg_st']==1 && $row['reg']==1 ) {?>
                        
                       <button class="btn btn-success" >  <i class="fa fa-registered"></i> </button>

                      <?php }elseif ($row['reg_st']==1 && $row['reg']==0 ) {?>
                       
                       <a href="student-register.php?st_id=<?php echo $row[0];?>" class="btn btn-danger" tooltip-placement="top" tooltip="register"><i class="fa fa-registered"></i></a>

                     <?php } else{?>
                      <button class="btn btn-danger" disabled >  <i class="fa fa-registered"></i> </button>
                     <?php }
                    ?>

                      
                    
                   
                  </td>
                  </tr>
                  
                  <?php 
                    $cnt=$cnt+1;
                   }?>


                  </tbody>
              
                </table>
              </div>
            
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
        </div>
      </div> 
    </section>

    <!-- recccent post  -->


  </div>
  <!-- /.content-wrapper -->

  
  <?php 
 include('_includes/footer.php');
?>


<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>




