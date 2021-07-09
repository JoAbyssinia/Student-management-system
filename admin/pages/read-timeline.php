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
  if (isset($_GET['pcode']) && $_GET['del']=="delete" ) {
     
    $query = "DELETE FROM `rvusrs`.`timeline` WHERE (`id` ='".$_GET['pcode']."');";
    $result = mysqli_query($con,$query);
    if ($result) {
     

        $extra="view-timeline.php?toast=1";
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

          echo "<script>  location.replace('http://$host$uri/$extra');  </script>";        
          
        exit();
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Read timeline</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Read Timeline</li>
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
         <?php }
        ?>

          

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
              <h3 class="card-title">Read post</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="min-height:450px;">
              <?php 
                $query = "SELECT * FROM rvusrs.timeline where `id`='".$_GET['pcond']."';";
                $result = mysqli_query($con,$query);
                $post = mysqli_fetch_array($result);
            
              ?>
              <div class="mailbox-read-info">
                <h5><?php echo $post[1] ?></h5>
                <h6>From: <?php 
                  $query = "SELECT fullname FROM rvusrs.admin_staff where id = '$post[5]';";
                  $result = mysqli_query($con,$query);
                  $nameI = mysqli_fetch_array($result);
                  echo $nameI['fullname'];
                ?>
                  <span class="mailbox-read-time float-right"><?php echo $post[6] ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">

                <?php 
                if ($_SESSION['roll']=='admin') {?>

                <a href="read-timeline.php?pcode=<?php echo $post['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove">
              <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i></button> 
                  </a>

                </div>

                <?php 
                  }?>
                <!-- /.btn-group -->
                <button type="button" onClick="window.print()" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fas fa-print"></i></button>

                 
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message font-weight-normal">
                <?php echo html_entity_decode($post[2])  ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            
            <!-- /.card-footer -->
            <div class="card-footer">
            <?php 
                if ($_SESSION['roll']=='admin') {?>
            <a href="read-timeline.php?pcode=<?php echo $post['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove">
            <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              </a>
              <?php 
                }
                ?>
              <button type="button" onClick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
              
            </div>
            <!-- /.card-footer -->
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




