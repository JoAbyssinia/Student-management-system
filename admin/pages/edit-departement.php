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

if (isset($_GET['update'])) {

          $code = trim($_GET['dep_code']," ");

          $query = "UPDATE `rvusrs`.`department` 
          SET 
          `depname` = '".$_GET['depname']."',
          `facality` = '".$_GET['fac']."',
          `dephead` = '".$_GET['dephead']."' 
          WHERE (`dep_code` = '".$code."'); ";
          $result = mysqli_query($con,$query);

          if ($result) {
          
            $extra="view-departement.php?toast=1";
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


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">Edit Departement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">edit Departement</li>
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
              <h4 class="card-title">Departement form</h4>
            </div>
            <!-- /.card-header -->
            <form role="form" method="GET" onSubmit="return valid();">
                <div class="card-body">
                <div class="row">
                    <!-- left  -->
          <div class="col-md-6">

          <?php 
               $query = "SELECT * FROM rvusrs.department where dep_code = '".$_GET['code']."';";
               $result = mysqli_query($con,$query);
               $row = mysqli_fetch_array($result);
            ?>

              <div class="form-group">
              <label for="doctorname">Departement code</label>
              <input type="hidden" name="dep_code"  value=" <?php echo $row[0] ?> "  >
							<input type="text" name="code"  class="form-control"  placeholder="code"  value="<?php echo $_GET['code'] ?> " disabled="true" >
						</div>

						<div class="form-group">
							<label for="fname">Departement name</label>
								<input type="text" name="depname" class="form-control" placeholder="name" value="<?php echo $row[1] ?> " required="true" >
            </div>


            <div class="form-group">
							<label >Faculty</label>
							<select name="fac" class="form-control select2" required="true" data-placeholder="select faculty" required="true" >
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.faculty");
							while($fac=mysqli_fetch_array($sql)){
                    if ($fac['code']==$row[2]) {?>
                      <option value="<?php echo $fac['code']; ?>"selected  ><?php echo $fac['name'] ?></option>
                    <?php }else {?>
                      <option value="<?php echo $fac['code']; ?>"><?php echo $fac['name'] ?></option>
                      
                  <?php  }
							 } ?>
			
							</select>
						</div>

						<div class="form-group">
							<label >Department head</label>
							<select name="dephead" class="form-control select2"  data-placeholder="select head">
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT ins_id,fname,lname FROM rvusrs.instructor where  type= 'full';");
							while($rowI=mysqli_fetch_array($sql)){
									if ($rowI['ins_id']==$row[3]) {?>
                  
                    <option value="<?php echo $rowI['ins_id']; ?>" selected ><?php echo $rowI['fname']." ".$rowI['lname'] ?></option>

                 <?php }else { ?>
                    
                    <option value="<?php echo $rowI['ins_id']; ?>"><?php echo $rowI['fname']." ".$rowI['lname'] ?></option>

                <?php  }			
							?>
							
							<?php } ?>
			
							</select>
						</div>

          
            
                <button type="submit" name="update" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> update</button>
                </div>

                </div>
                </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              fill infromation properly 
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
</script>