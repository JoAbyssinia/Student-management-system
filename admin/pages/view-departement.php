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
  if (isset($_GET['code']) && $_GET['del']=="delete" ) {
     
    $query = "DELETE FROM `rvusrs`.`department` WHERE (`dep_code` = '".$_GET['code']."');";
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



    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">View Departement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Departement</li>
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
                <h3 class="card-title">Departement List</h3>

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
                        <th>Departement code</th>
                        <th>Departement name</th>
                        <th>facality</th>
                        <th>departement head</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.department order by timestamp desc;");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                  <tr>
                  <td class="center"><?php echo $cnt;?></td>
                  <td class="hidden-xs"><?php echo $row[0];?>
          
                    </td>
                  <td><?php echo $row['depname'];?>
                
                  </td>
                  <td><?php
                  $query = "SELECT name FROM rvusrs.faculty where code = '".$row[2]."';";
                  
                  $result = mysqli_query($con,$query);
                  $namef = mysqli_fetch_array($result);
                  echo $namef['name'];
                  ?>
                  
                  </td>
                 
                  <td><?php 
                     $query = "SELECT fname,lname FROM rvusrs.instructor where ins_id = '".$row[3]."';";
                   
                     $result = mysqli_query($con,$query);
                     $nameI = mysqli_fetch_array($result);
                     echo $nameI['fname']." ".$nameI['lname'];
                  ?> </td>
                 
                    
                  <td >
                    <div class="small">
                  <a href="edit-departement.php?code=<?php echo $row['dep_code'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-edit"></i></a>
                      
                  <a href="view-departement.php?code=<?php echo $row['dep_code']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times "></i></a>
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