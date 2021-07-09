<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=5;
$asidesubelocation=51;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    if (isset($_GET['addcourse'])) {
      $precourse ="";
      if (!empty($_GET['pre'])) {
        foreach($_GET['pre'] as $preC){
            $precourse .=$preC.","; 
        }
      }
       
        
      
      $query = "INSERT INTO `rvusrs`.`course`
       (`cr_code`, `course_tilte`, `catagory`, `credit_houre`, `offering_dep`,`prerequesit`) 
       VALUES 
       ('".strtoupper($_GET['c_code'])."', '".$_GET['title']."', '".$_GET['cat']."', 
       '".$_GET['cr_hour']."', '".$_GET['dep']."','".$precourse."');";
      $result = mysqli_query($con,$query);

      if ($result) {
        $toast = 1;
        $msg = "add course Successfull.";
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
            <h1 class="m-0 text-dark">Add Course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Course</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- single Course form -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline">
            <div class="card-header">
              <h4 class="card-title">Course form</h4>
            </div>
            <!-- /.card-header -->
            <form role="form" name="adddoc" method="GET" autocomplete="on" onSubmit="return valid();">
                <div class="card-body">
                <div class="row">
                    <!-- left  -->
          <div class="col-md-6">
              <div class="form-group">
							<label for="doctorname">Course code</label>
							<input type="text" name="c_code"  class="form-control"  placeholder="code" required="true" >
						</div>

						<div class="form-group">
							<label for="fname">Course title</label>
								<input type="text" name="title" class="form-control" placeholder="Course title" required="true" >
            </div>

						<div class="form-group">
							<label for="fname">Credit hour</label>
								<input type="number" name="cr_hour" class="form-control" placeholder="hour" required="true">
						</div>

						<div class="form-group">
							<label for="fess">Catagory</label>
							<select name="cat" class="form-control select2" required="true" data-placeholder="select catagory">
								<option value="" ></option>
								<option value="main">main </option>
								<option value="common">common </option>
							</select>
						</div>

      
						<div class="form-group">
							<label >Department</label>
							<select name="dep" class="form-control select2" required="true" data-placeholder="select Department">
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
                <label>Prerequisite</label>
                <select class="select2bs4" name="pre[]" multiple="multiple" data-placeholder="Select a Courses"
                        style="width: 100%;">
                  <option></option>
                 <?php 
                  	$sql=mysqli_query($con,"SELECT * FROM rvusrs.course");
                    while($row=mysqli_fetch_array($sql)){
                    ?>
                    <option value="<?php echo $row['cr_code']; ?>"><?php echo $row['cr_code']." ".$row[1] ?></option>
                    <?php } ?>
            
                 
                 ?>
                </select>
              </div>
              <!-- /.form-group -->
             
            
	<button type="submit" name="addcourse" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> Add</button>
                </div>

                </div>
                </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              Fill infromation properly 
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