<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=5;
$asidesubelocation=52;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 

if (isset($_GET['updatecourse'])) {

          $code = trim($_GET['c_code']," ");
          $precourse ="";
          if (!empty($_GET['pre'])) {
            foreach($_GET['pre'] as $preC){
                $precourse .=$preC.","; 
            }
          }


          $query = "UPDATE `rvusrs`.`course` SET 
          `course_tilte` = '".$_GET['title']."', 
          `catagory` = '".$_GET['cat']."', 
          `credit_houre` = '".$_GET['cr_hour']."', 
          `offering_dep` = '".$_GET['dep']."', 
          `prerequesit` = '".$precourse."' 
          WHERE (`cr_code` = '".$code."'); ";

          $result = mysqli_query($con,$query);

          if ($result) {
          
            $extra="view-course.php?toast=1";
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
            <h1 class="m-0 text-dark">Edit Course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Course</li>
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
            <form role="form" name="adddoc" method="GET" onSubmit="return valid();">
                <div class="card-body">
                <div class="row">
                    <!-- left  -->
          <div class="col-md-6">

          <?php 
               $query = "SELECT * FROM rvusrs.course where cr_code = '".$_GET['code']."';";
               $result = mysqli_query($con,$query);
               $row = mysqli_fetch_array($result);
            ?>

              <div class="form-group">
							<label for="doctorname">Course code</label>
              <input type="hidden" name="c_code"  value=" <?php echo $row[0] ?> "  >
							<input type="text" name="code"  class="form-control"  placeholder="code"  value="<?php echo $_GET['code'] ?> " disabled="true" >
						</div>

						<div class="form-group">
							<label for="fname">Course title</label>
								<input type="text" name="title" class="form-control" placeholder="Course title" value="<?php echo $row[1] ?>"  required="true" >
            </div>

						<div class="form-group">
							<label for="fname">Credit hour</label>
								<input type="number" name="cr_hour" class="form-control" placeholder="hour" value="<?php echo $row[3] ?>"  required="true">
						</div>

						<div class="form-group">
							<label for="fess">Catagory</label>
							<select name="cat" class="form-control select2" required="true" data-placeholder="select catagory">
                <option value="" ></option>

                <?php 


                    if (trim($row[2])=="main") {?>
                    	<option value="main" selected>main </option>
                   <?php }else {?>
                    <option value="main" >main </option>
                 ?<?php   }

                  if (trim($row[2])=="common") {?>
                  <option value="common" selected>common </option>
                  <?php }else {?>
                  <option value="common" >common </option>
                  ?<?php   }
                ?>

							</select>
            </div>
            

      
						<div class="form-group">
							<label >Department</label>
							<select name="dep" class="form-control select2" required="true" data-placeholder="select Department">
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.department");
							while($rowC=mysqli_fetch_array($sql)){

                if ($rowC['0']==$row[4]) {?>
                  
                  <option value="<?php echo $rowC[0]; ?>" selected ><?php echo $rowC[1] ?></option>

               <?php }else { ?>
                  
                  <option value="<?php echo $rowC[0]; ?>"><?php echo $rowC[1]?></option>

              <?php  }
              }
               ?>
              
			
							</select>
						</div>

              <div class="form-group">
                <label>Prerequisite</label>
                <select class="select2bs4" name="pre[]" multiple="multiple" data-placeholder="Select a Courses"
                        style="width: 100%;">
                  <option></option>
                 <?php 

                  $pc = explode(",",$row[5]);
                  
                  $sql=mysqli_query($con,"SELECT * FROM rvusrs.course");
                  while($rowC=mysqli_fetch_array($sql)){

                    if (check($pc,trim($rowC[0]))){?>
                       <option value="<?php echo $rowC[0];?>" selected><?php echo  $rowC[0]." ".$rowC[1] ?></option> 
                   <?php }else {?>
                      <option value="<?php echo $rowC[0];?>" ><?php echo $rowC[0]." ".$rowC[1] ?></option> 
                   <?php }
                  }

                  function check ($pcs,$chk){
                    
                    foreach ($pcs as $c) {
                        if ($c==$chk) {
                          return 1;
                        }
                    }
                    return 0;
                  }
                   ?>
          
                </select>
              </div>
              <!-- /.form-group -->
             
            
	              <button type="submit" name="updatecourse" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> Update</button>
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