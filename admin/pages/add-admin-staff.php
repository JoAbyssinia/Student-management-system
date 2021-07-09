<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=8;
$asidesubelocation=81;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    if (isset($_GET['addstaff'])) {
    
      $query = "INSERT INTO `rvusrs`.`admin_staff` 
      (`fullname`, `username`, `phone`, `email`, `roll`)
       VALUES 
       ('".trim($_GET['fullname'])."', '".trim($_GET['username'])."', '".trim($_GET['phone'])."', 
       '".trim($_GET['email'])."', '".trim($_GET['roll'])."');";

       echo $query;
      $result = mysqli_query($con,$query);

      if ($result) {
        $toast = 1;
        $msg = "add staff Successfull.";
      }else {
        $toast=2;
        $msg = "faild";
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
            <h1 class="m-0 text-dark">Add Admin staff</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Admin staff</li>
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
          <div class="form-group">
							<label for="doctorname">Full name</label>
							<input type="text" name="fullname"  class="form-control"  placeholder="user name" required="true"  >
						</div>
              
              <div class="form-group">
							<label for="doctorname">User name</label>
							<input type="text" name="username"  class="form-control"  placeholder="user name" required="true"  >
						</div>

						<div class="form-group">
							<label for="fname">Email</label>
								<input type="text" name="email" class="form-control" placeholder="email" required="true" >
            </div>

            <div class="form-group">
							<label for="fname">Phone:</label>
								<input type="text" name="phone" class="form-control" placeholder="phone" required="true" >
            </div>
            

						<div class="form-group">
							<label >Roll</label>
							<select name="roll" class="form-control select2" required="true" data-placeholder="select Roll">
							<option value> </option>
              <option value="admin">admin</option>
              <option value="data">data incoder</option>
              <option value="finance">finance</option>
			
							</select>
						</div>

          
            
              <button type="submit" name="addstaff" id="submit" class="btn btn btn-success">
                <i class="fa fa-save"></i> Add staff</button>
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