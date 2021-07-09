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

    if (isset($_GET['update'])) {

      $id = trim($_GET['inst_ids']," ");

      $query = "UPDATE `rvusrs`.`instructor` SET 
      `fname` = '".$_GET['f_name']."', 
      `lname` = '".$_GET['l_name']."', 
      `type` = '".$_GET['service']."', 
      `gender` = '".$_GET['gender']."', 
      `dep` = '".$_GET['dep']."', 
      `phone` = '".$_GET['phone_no']."', 
      `email` = '".$_GET['email']."' 
      WHERE (`ins_id` = '".$id."');";
      $result = mysqli_query($con,$query);

      if ($result) {
       
        $extra="view-instructor.php?toast=1";
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
            <h1 class="m-0 text-dark">Update Instructor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Instructor</li>
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
            <form role="form" method="GET" onSubmit="return valid();">
                <div class="card-body">
                <div class="row">
                    <!-- left  -->
          <div class="col-md-6">
            

            <?php 
               $query = "SELECT * FROM rvusrs.instructor where ins_id = '".$_GET['id']."';";
               $result = mysqli_query($con,$query);
               $row = mysqli_fetch_array($result);
            ?>
            <div class="form-group">
              <label for="doctorname">Instructor ID</label>
              <input type="hidden" name="inst_ids"  value=" <?php echo $row[0] ?> "  >
							<input type="text" name="inst_id"  class="form-control"  value="<?php echo $_GET['id'] ?> " disabled="true" >
            </div>
            
						<div class="form-group">
							<label for="fname">frist name</label>
								<input type="text" name="f_name" class="form-control" value="<?php echo $row[1] ?>" placeholder="first name" required="true" >
            </div>

						<div class="form-group">
							<label for="fname">last name</label>
								<input type="text" name="l_name" class="form-control" value="<?php echo $row[2] ?>" placeholder="last name" required="true">
						</div>

						<div class="form-group">
							<label for="fess">gender</label>
							<select name="gender" class="form-control select2" data-placeholder="select gender"  required="true">
								<option> </option>
								
                <?php
                if ($row['4']=="male") {?>
                    	<option value="male" selected>male </option>
                 <?php }else {?>
                  <option value="male"> male </option>   
                <?php }
                ?>
                <?php 

                  if ($row['4']=="female") {?>
                     <option value="female" selected>female</option>
                  <?php }else {?>
                    <option value="female">female </option> 
                  <?php }
                ?>

							</select>
						</div>

            <div class="form-group">
              <label for="fess">email</label>
							<input type="email" name="email" class="form-control" value="<?php echo $row[8] ?>" placeholder="john@example.com" required="true">
            </div>
            
            <div class="form-group">
							<label >Service type</label>
							<select name="service" class="form-control" required="true">
                <option value="select">select Service </option>
                <?php 

                  if ($row['3']=="full") {?>
                    	<option value="full" selected>Full time </option>
                 <?php }else {?>
                  <option value="full">Full time </option>   
                <?php }
                ?>

                <?php 

                  if ($row['3']=="per") {?>
                     <option value="per" selected>Per time </option>
                  <?php }else {?>
                    <option value="per">Per time </option> 
                  <?php }
                ?>
								
							</select>
						</div>

						<div class="form-group">
							<label >Department</label>
							<select name="dep" class="form-control select2" required="true" data-placeholder="select Department" required="true" >
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.department");
							while($dep=mysqli_fetch_array($sql)){
                    if ($dep['dep_code']==$row[5]) {?>
                      <option value="<?php echo $dep['dep_code']; ?>"selected  ><?php echo $dep['depname'] ?></option>
                    <?php }else {?>
                      <option value="<?php echo $dep['dep_code']; ?>"><?php echo $dep['depname'] ?></option>
                      
                  <?php  }
							 } ?>
			
							</select>
						</div>

            <div class="form-group">
							<label for="fess">phone number</label>
              <input type="text" name="phone_no" class="form-control"  value="<?php echo $row[7] ?>" placeholder="090-000-0000 or +251 000 000 0000" required="true" data-inputmask="'mask': ['999-999-9999', '+099 999 999 9999']" data-mask>
            </div>
            
	            <button type="submit" name="update" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> update</button>

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