<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');

check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=7;
$asidesubelocation=71;
$edit=0;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

  <?php 
    if (isset($_GET['submit'])) {

      $query = "INSERT INTO `rvusrs`.`faculty` (`code`, `name`) VALUES ('".$_GET['code']."', '".$_GET['fac_name']."');";
      $result = mysqli_query($con,$query);
      if ($result) {
        $toast = 1;
        $msg = "add new faculity.";
      }else {
        $toast=2;
        $msg = "faild";
      }
    }

    // edit value update 

    if (isset($_GET['edit'])==1) {
      $edit=1; 
    }
      if (isset($_GET['update'])) {

        $code = trim($_GET['codeup']," ");
        $query = "UPDATE `rvusrs`.`faculty` SET `name` = '".$_GET['fac_name']."' WHERE (`code` = '".$code."');";

        $result = mysqli_query($con,$query);
        if ($result) {
          $toast = 1;
          $msg = "Update successfull.";


          $extra="view-faculty.php?toast=1";
          $host=$_SERVER['HTTP_HOST'];
          $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
          echo "<script>  location.replace('http://$host$uri/$extra');  </script>";        

        }else {
          $toast=2;
          $msg = "Update faild";
        }
      }
  ?>

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">

            <?php 
                 if ($edit==1 ) {?>
                  <h1 class="m-0 text-dark">Edit Faculty</h1>
               <?php }else { ?>
                 <h1 class="m-0 text-dark">Add Faculty</h1>
               <?php }
            ?>
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Faculty</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- single Departement form -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline">
            <div class="card-header">
              <h4 class="card-title">Faculty form</h4>
            </div>
            <!-- /.card-header -->
            <form role="form" method="GET" onSubmit="return valid();">
                <div class="card-body" style="height: 400px;">
                <div class="row">
                    <!-- left  -->
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="doctorname">Faculty code</label>
                    <?php 
                        if ($edit==1) {
                          $query = "SELECT * FROM rvusrs.faculty where code = '".$_GET['code']."';";
                          $result = mysqli_query($con,$query);
                          $row = mysqli_fetch_array($result);
                          ?>
                          <input type="hidden" name="codeup"  value=" <?php echo $row[0] ?> "  >
                        <input type="text" name="code"  class="form-control"  value=" <?php echo $row[0] ?> " disabled> 
                      <?php }else { ?>
                        <input type="text" name="code"  class="form-control"   placeholder="code" required="true" >
                      <?php }
                    ?>
                   
                  </div>

                  <div class="form-group">
                    <label for="fname">Faculty name</label>

                        <?php
                          if ($edit==1) {?>
                           <input type="text" name="fac_name" class="form-control" value="<?php echo $row[1]?>" placeholder="name" required="true" >
                         <?php }else{ ?>
                         
                          <input type="text" name="fac_name" class="form-control"  placeholder="name" required="true" >
                        <?php }
                        ?>  
                      
                  </div>

                    <?php 
                      if ($edit ==1) {?>
                       <button type="submit" name="update" id="update" class="btn btn btn-success">
                  <i class="fa fa-save"></i> Update faculty</button>
                     <?php }else { ?>
                      <button type="submit" name="submit" id="submit" class="btn btn btn-success">
                  <i class="fa fa-save"></i> Add faculty</button>
                      <?php }
                    ?>

                 
                      </div>

                      </div>
                      </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              please fill correct infromation properly 
            </div>
          </div>
      </div>
    </section>

  </div>

<?php 
 include('_includes/footer.php');
?>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
</script>