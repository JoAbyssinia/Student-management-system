<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=3;
$asidesubelocation=32;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['sid']) && $_GET['del']=="delete" ) {
     
    $query = "DELETE FROM `rvusrs`.`student` WHERE (`st_id` = '".$_GET['sid']."');";
    
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
            <h1 class="m-0 text-dark">View Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Student</li>
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
                      <th>ID</th>
                      <th>Profile</th>
                      <th>Full name</th>
                      <th>Gender</th>
                      <th>Department</th>
                      <th>Division</th>
                      <th>Acadamic year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.student order by entery_date desc;");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                  <tr>
                  <td class="center"><?php echo $cnt;?></td>
                  <td><?php echo $row[0];?></td>
                  <td> <img class="user-image img-circle elevation-2" style="width: 50px; height: 50px;" src="<?php echo "../../".$row[13] ?> " alt="profile pic">  </td>
                  <td><?php echo trim($row[1])." ".trim($row[2])." ".trim($row[3]);?>
                  </td>
                  <td><?php echo $row[4];?>
                  </td>
                  <td class="center"><?php
                  
                   $query=mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code='{$row[6]}'");
                  
                    $depname=mysqli_fetch_array($query);
                    echo $depname['depname'];
                   ?></td>
                  <td class="center"><?php
                   
                      if ($row[7]=='R') {
                       echo "Regular";
                      } elseif ($row[7]=='E') {
                        echo "Extention";
                      } else {
                        echo "Weekend";
                      }  

                   ?></td>
                  <td class="center"><?php echo $row[11];?></td>
                  
                  <td >
                    <div class="small">
                      <a href="edit_student.php?sid=<?php echo trim($row[0]);?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-edit"></i></a>
                      
                      <a href="view-student.php?sid=<?php echo trim($row[0])?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times "></i></a>
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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>