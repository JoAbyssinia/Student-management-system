<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=4;
$asidesubelocation=41;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 

    if (isset($_POST['regester'])) {

      $query = "INSERT INTO `rvusrs`.`instructor`
       (`ins_id`, `fname`, `lname`, `type`, `gender`, `dep`, `phone`, `email`) 
       VALUES 
       ('".$_POST['inst_id']."', '".$_POST['f_name']."', '".$_POST['l_name']."',
        '".$_POST['service']."', '".$_POST['gender']."', '".$_POST['dep']."',
         '".$_POST['phone_no']."', '".$_POST['email']."');";
      $result = mysqli_query($con,$query);

      if ($result) {
        $toast = 1;
        $msg = "Instructor Successfull.";
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
            <h1 class="m-0 text-dark">Add Instructor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Instructor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- single instructor form -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline">
            <div class="card-header">
              <h4 class="card-title">Instructor form</h4>
            </div>
            <!-- /.card-header -->
            <form role="form" method="post" onSubmit="return valid();">
                <div class="card-body">
                <div class="row">
                    <!-- left  -->
          <div class="col-md-6">
            <div class="form-group">
							<label for="doctorname">Instructor ID</label>
							<?php 
								$autoID = rand(1000,9999);
								$yr=date('y');
								$autoID = "RVUIST/".$autoID."/".$yr;
							?>
							<input type="text" name="inst_id"  class="form-control"  value="<?php echo $autoID ?>" >
						</div>

						<div class="form-group">
							<label for="fname">frist name</label>
								<input type="text" name="f_name" class="form-control" placeholder="first name" required="true" >
            </div>

						<div class="form-group">
							<label for="fname">last name</label>
								<input type="text" name="l_name" class="form-control" placeholder="last name" required="true">
						</div>

						<div class="form-group">
							<label for="fess">gender</label>
							<select name="gender" class="form-control select2" required="true" data-placeholder="select gender">
								<option></option>
								<option value="male">male </option>
								<option value="female">female </option>
							</select>
						</div>

          </div>
          <div class="col-md-6">  

            <div class="form-group">
							<label for="fess">email</label>
							<input type="email" name="email" class="form-control" placeholder="john@example.com" required="true">
            </div>
            
            <div class="form-group">
							<label >Service</label>
							<select name="service" class="form-control select2" data-placeholder="select Service" required="true">
								<option></option>
								<option value="full">Full time </option>
								<option value="per">Per time </option>
							</select>
						</div>

						<div class="form-group">
							<label >Department</label>
							<select name="dep" class="form-control select2" required="true" data-placeholder="select Department" required="true" >
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.department");
							while($row=mysqli_fetch_array($sql))
												{
							?>
							<option value="<?php echo $row['dep_code']; ?>"><?php echo $row['depname'] ?></option>
							<?php } ?>
			
							</select>
						</div>

            <div class="form-group">
							<label for="fess">phone number</label>
							<input type="text" name="phone_no" class="form-control"  placeholder="090-000-0000 or +251 000 000 0000" required="true" data-inputmask="'mask': ['999-999-9999', '+099 999 999 9999']" data-mask>
            </div>
          </div>  
	            <button type="submit" name="regester" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> Regester</button>

                </div>

                </div>
                </div>
            
            
              
              
              
            
              
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              fill correct infromation properly 
            </div>
          
      </div>
    </section>

  </div>


<?php 
 include('_includes/footer.php');
?>
<script type="text/javascript">

    $('.select2').select2();


    $(function() {
      $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    })

    $(function () {
  
  //Money Euro
  $('[data-mask]').inputmask()

   })
</script>