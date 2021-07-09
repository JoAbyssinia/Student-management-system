<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=2;
$asidesubelocation=2;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">view timeline</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Timeline</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-3">
        <?php 
                if ($_SESSION['roll']=='admin') {?>
          <a href="add-timeline.php" class="btn btn-success btn-block mb-3">Add Post</a>
          <?php 
          }?>
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="view-timeline.php" class="nav-link">
                    <i class="fas fa-inbox"></i> all post
                    <span class="badge float-right">
                    <?php 
                     
                      $query = " SELECT count(*) FROM rvusrs.timeline";
                      $result = mysqli_query($con,$query);
                      $nameI = mysqli_fetch_array($result);
                      echo $nameI[0];

                    ?>
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-arrow-alt-circle-up"></i> My posts
                    <span class="badge float-right">
                    <?php 
                     
                     $query = " SELECT count(*) FROM rvusrs.timeline where `from`='".$_SESSION['id']."';";
                     $result = mysqli_query($con,$query);
                     $nameI = mysqli_fetch_array($result);
                     echo $nameI[0];

                   ?>
                    </span>
                  </a>
                </li>
                
               
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title">Timeline post list</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-success">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="min-height:450px">
              <div class="mailbox-controls">
                <!-- Check all button -->
              
                <!-- /.btn-group -->
                <a href="view-timeline.php">
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                </a>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>

                  <?php
                    $sql=mysqli_query($con,"SELECT * FROM rvusrs.timeline order by date desc");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                      
                    ?> 
 
                  <tr> 
                  <td class="mailbox-controls"> <?php echo $cnt ?> </a></td>
                    <td class="mailbox-name"> <a href="read-timeline.php?pcond=<?php echo $row[0] ?>"> <?php
                      $query = "SELECT fullname FROM rvusrs.admin_staff where id = '$row[5]';";
                      $result = mysqli_query($con,$query);
                      $nameI = mysqli_fetch_array($result);
                      echo $nameI['fullname'];
                     ?> </a> 
                     </td>
                    <td class="mailbox-subject"><b> <?php echo html_entity_decode($row[1]) ?></b> 
                    <?php echo  htmlspecialchars_decode(substr(htmlspecialchars_decode($row[2]),0,50)).'"';?>
                    </td>
                   
                    <td class="mailbox-date"> <?php echo $row[6] ?></td>
                  </tr>
                  <?php 
                    $cnt=$cnt+1;
                   }
                   ?>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


    <!-- recccent post  -->


  </div>



<?php 
 include('_includes/footer.php');
?>




