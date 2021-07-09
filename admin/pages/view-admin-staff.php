<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=8;
$asidesubelocation=82;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['id']) && $_GET['del']=="delete" ) {
     
    $query = "DELETE FROM `rvusrs`.`admin_staff` WHERE (`id` = '".$_GET['id']."');";
    
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


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">View Admin staff</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Admin staff</li>
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
                <h3 class="card-title">Admin staffs List</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>full name </th>
                        <th> User name</th>
                        <th> Email</th>
                        <th> Phone no</th>
                        <th>Roll</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.admin_staff ORDER BY id desc;");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                  <tr>
                  <td class="center"><?php echo $cnt;?></td>
                  <td><?php echo $row['fullname'];?>
                    </td>
                    <td><?php echo $row['username'];?>
                  </td> 
                  <td><?php echo $row['email'];?>
                  </td> 
                  <td><?php echo $row['phone'];?>
                  </td>
                  <td><?php echo $row['roll'];?>
                  </td>
                 
                    
                  <td >
                    <div class="small">
          <a href="edit-admin-staff.php?id=<?php echo $row['id'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-edit"></i></a>
                      
        <a href="view-admin-staff.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times "></i></a>
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