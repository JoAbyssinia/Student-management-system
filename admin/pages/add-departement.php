<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=6;
$asidesubelocation=61;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>



<?php 

    if (isset($_GET['add'])) {

      $query = "INSERT INTO `rvusrs`.`department` 
      (`dep_code`, `depname`, `facality`, `dephead`) 
      VALUES 
      ('".$_GET['code']."', '".$_GET['depname']."', '".$_GET['fac']."', '".$_GET['dep']."');";
      $result = mysqli_query($con,$query);

      if ($result) {
        $toast = 1;
        $msg = "add departement Successfull.";
      }else {
        $toast=2;
        $msg = "faild";
      }
      
    }

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">Add Departement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Departement</li>
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
              <div class="form-group">
							<label for="doctorname">Departement code</label>
							<input type="text" name="code"  required="true" class="form-control"  placeholder="code" >
						</div>

						<div class="form-group">
							<label for="fname">Departement name</label>
								<input type="text" name="depname" class="form-control" placeholder="name" required="true" >
            </div>


            <div class="form-group">
							<label >Facality</label>
							<select name="fac" class="form-control select2" required="true" data-placeholder="select faclulty">
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.faculty");
							while($row=mysqli_fetch_array($sql))
												{
							?>
							<option value="<?php echo $row['code']; ?>"><?php echo $row['name'] ?></option>
							<?php } ?>
			
							</select>
						</div>

						<div class="form-group">
							<label >Department head</label>
							<select name="dep" class="form-control select2"  data-placeholder="select head">
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT ins_id,fname,lname FROM rvusrs.instructor where  type= 'full';");
							while($row=mysqli_fetch_array($sql))
												{
							?>
							<option value="<?php echo $row['ins_id']; ?>"><?php echo $row['fname']." ".$row['lname'] ?></option>
							<?php } ?>
			
							</select>
						</div>

          
            
                <button type="submit" name="add" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> Add</button>
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