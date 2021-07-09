<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=4;
$asidesubelocation=42;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['id']) && $_GET['del']=="delete" ) {
     
    $query = "DELETE FROM `rvusrs`.`instructor` WHERE (`ins_id` = '".$_GET['id']."');";
    $result = mysqli_query($con,$query);
    if ($result) {
      $toast = 1;
      $msg = "delete successfull.";
    }else {
      $toast=2;
      $msg = "delete faild";
    }
   
  }
    if ($_GET['toast']==1) {
      $toast = 1;
      $msg = "Update Successfull.";
    }

?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">View Instructor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Instructor</li>
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
                <h3 class="card-title">Instructor List</h3>

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
                        <th>full name</th>
                        <th>Gender</th>
                        <th>Service</th>
                        <th>Department</th>
                         <th>Email</th>
                        <th>phone</th>
                        <th>entery date</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.instructor order by entery_date DESC");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                  <tr>
                  <td class="center"><?php echo $cnt;?> </td>
                  <td class="hidden-xs"><?php echo $row['fname']." ".$row['lname'];?>
                  
                    </td>
                  <td><?php echo $row['gender'];?>
                   
                  </td>
                  <td><?php echo $row['type'];?>
                
                  </td>
                  <td><?php 
                  
                     $lec=mysqli_query($con,"SELECT * FROM rvusrs.department where 
                     dep_code='{$row['dep']}'");
                  
                     $lec=mysqli_fetch_array($lec);
                        echo $lec['depname'];
    
                  ?> 
                  
                </td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['phone'];?></td>
                  <td><?php echo $row['entery_date'];?></td>
                    
                  <td >
                    <div class="small">
          <a href="edit-instructor.php?id=<?php echo $row['ins_id'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-edit"></i></a>
                      
        <a href="view-instructor.php?id=<?php echo $row['ins_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times "></i></a>
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