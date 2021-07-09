<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=5;
$asidesubelocation=52;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['code']) && $_GET['del']=="delete" ) {
     
    $query = "DELETE FROM `rvusrs`.`course` WHERE (`cr_code` = '".$_GET['code']."');";
    $result = mysqli_query($con,$query);
    if ($result) {
      $toast = 1;
      $msg = "delete successfull.";
    }else {
      $toast=2;
      $msg = "delete faild";
    }
   
  }
    if (isset($_GET['toast'])==1) {
      $toast = 1;
      $msg = "Update Successfull.";
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
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">View course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View course</li>
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
                      <th>Course code</th>
                      <th>Course title</th>
                      <th>Catagory</th>
                      <th>Credit hour</th>
                      <th>Offering department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.course");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                  <tr>
                  <td class="center"><?php echo $cnt;?></td>
                  <td class="hidden-xs"><?php echo $row[0];?>
                    
                    </td>
                  <td><?php echo $row[1];?>
                  </td>
                  <td><?php echo $row[2];?>
                  </td>
                  <td> <center><?php echo $row[3];?> </center>  </td>
                  <td><?php 
                  
                     $query=mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code='{$row[4]}'");
                  
                    $depname=mysqli_fetch_array($query);
                    echo $depname['depname'];
                   ?> 
                 
                </td>   
                  <td >
                    <div class="small">
                      <a href="edit-course.php?code=<?php echo $row[0];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-edit"></i></a>
                      
                      <a href="view-course.php?code=<?php echo $row[0]?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times "></i></a>
                    </div>
                   
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

    

  </div>


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
