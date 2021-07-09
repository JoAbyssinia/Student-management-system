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

    if (isset($_GET['update'])) {

      $id = trim($_GET['id']," ");

      $query = "UPDATE `rvusrs`.`admin_staff` SET 
      `fullname` = '".$_GET['fullname']."', 
      `username` = '".$_GET['username']."', 
      `phone` = '".$_GET['phone']."', 
      `email` = '".$_GET['email']."', 
      `roll` = '".$_GET['roll']."' 
      WHERE (`id` = '".$id."');";
      $result = mysqli_query($con,$query);
      
      if ($result) {
       
        $extra="view-admin-staff.php?toast=1";
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

          echo "<script>  location.replace('http://$host$uri/$extra');  </script>";        
          
        exit();

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
            <h1 class="m-0 text-dark">Edit Admin staff</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Admin staff</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- single Admin staff form -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline"  >
            <div class="card-header">
              <h4 class="card-title">Admin staff form</h4>
            </div>
            <!-- /.card-header -->
            <form role="form" name="adddoc" method="GET" onSubmit="return valid();">
                <div class="card-body" style="min-height: 400px;">
                <div class="row">
                    <!-- left  -->
          <div class="col-md-6">

          <?php 
               $query = "SELECT * FROM rvusrs.admin_staff where `id` = '".$_GET['id']."';";
               $result = mysqli_query($con,$query);
               $row = mysqli_fetch_array($result);
            ?>
            <input type="hidden" name="id"  value=" <?php echo $_GET['id'] ?> "  >
          
          <div class="form-group">
							<label for="doctorname">Full name</label>
							<input type="text" name="fullname"  class="form-control" value="<?php echo $row[1] ?> "  placeholder="user name" required="true"  >
						</div>
              
              <div class="form-group">
							<label for="doctorname">User name</label>
							<input type="text" name="username"  class="form-control" value="<?php echo $row[2] ?> "  placeholder="user name" required="true"  >
						</div>

						<div class="form-group">
							<label for="fname">Email</label>
								<input type="text" name="email" class="form-control" placeholder="email" value="<?php echo $row[4] ?> " required="true" >
            </div>

            <div class="form-group">
							<label for="fname">Phone:</label>
								<input type="text" name="phone" class="form-control"  placeholder="phone" value="<?php echo $row[3] ?> " required="true" >
            </div>
            

						<div class="form-group">
							<label >Roll</label>
							<select name="roll" class="form-control select2" required="true" data-placeholder="select Roll">
							<option value> </option>
              


              <?php
                if ($row[5]=="admin") {?>
                    <option value="admin" selected>admin</option>
                 <?php }else {?>
                  <option value="admin">admin</option>  
                <?php }
                ?>
                <?php 

                  if ($row[5]=="data") {?>
                    <option value="data" selected>data incoder</option>
                  <?php }else {?>
                    <option value="data">data incoder</option>
                  <?php }
                ?>
                <?php 
                  if ($row[5]=="finance") {?>
                    <option value="finance" selected>finance</option>
                  <?php }else {?>
                    <option value="finance">finance </option> 
                  <?php }
                  ?>
			
							</select>
						</div>

          
            
              <button type="submit" name="update" id="submit" class="btn btn btn-success">
                <i class="fa fa-save"></i> update </button>
                            </div>

                </div>
                </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              fill correct infromation properly 
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

    

    $('.select2').select2();


    $(function() {
      $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    })
</script>