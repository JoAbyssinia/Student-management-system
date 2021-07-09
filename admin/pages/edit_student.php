<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=3;
$asidesubelocation=32;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>


<?php 

    if (isset($_GET['updateS'])) {

      $id = trim($_GET['sid']," ");

      if (isset($_GET['passreset'])) {
        $query = "UPDATE `rvusrs`.`student` SET 
        `fname` = '".$_GET['f_name']."', 
        `mname` = '".$_GET['m_name']."', 
        `lname` = '".$_GET['l_name']."', 
        `gender` = '".$_GET['gender']."', 
        `birth_date` = '".$_GET['b_date']."', 
        `department` = '".$_GET['dep']."', 
        `division` = '".$_GET['div']."', 
        `email` = '".$_GET['email']."', 
        `phone` = '".$_GET['phone_no']."', 
        `academic_year` = '".$_GET['a_year']."', 
        `password` = 'rvustudentservice',
        `section` = '".$_GET['sec']."' 
        WHERE (`st_id` = '".$id."');";
      }else {
        $query = "UPDATE `rvusrs`.`student` SET 
        `fname` = '".$_GET['f_name']."', 
        `mname` = '".$_GET['m_name']."', 
        `lname` = '".$_GET['l_name']."', 
        `gender` = '".$_GET['gender']."', 
        `birth_date` = '".$_GET['b_date']."', 
        `department` = '".$_GET['dep']."', 
        `division` = '".$_GET['div']."', 
        `email` = '".$_GET['email']."', 
        `phone` = '".$_GET['phone_no']."', 
        `academic_year` = '".$_GET['a_year']."',
        `section` = '".$_GET['sec']."' 
        WHERE (`st_id` = '".$id."');";
      }

      $result = mysqli_query($con,$query);

      if ($result) {
       
        $extra="view-student.php?toast=1";
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

 <!-- iCheck for checkboxes -->
 <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">Update Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php 
      $query = "SELECT * FROM rvusrs.student where st_id ='".$_GET['sid']."';";
      $result = mysqli_query($con,$query);
      $row = mysqli_fetch_array($result);
    ?>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-danger card-outline">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-12">
                          <center>
                            <img style="height: 400px;" src="<?php echo "../../".$row[13] ?>" class="image img-rounded elevation-2" alt="">
                          </center>
                        </div>
                    </div>  
                </div>
        </div> 
      </div> 
    </section>
<!-- single student form -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline">
            <div class="card-header">
              <h4 class="card-title">Student form</h4>
            </div>
            <!-- /.card-header -->
            <form role="form" name="adddoc" method="GET" onSubmit="return valid();">
                <div class="card-body">
                <div class="row">
                    <!-- left  -->
                  <div class="col-md-6">

                    <div class="form-group">
                        <label for="doctorname">Student ID</label>
                        <input type="hidden" name="sid"  value=" <?php echo $row[0] ?> "  >
                        <input type="text" name="st_id"  class="form-control"  disabled value="<?php echo $row[0] ?>" >
                  </div>

						<div class="form-group">
							<label for="fname">frist name</label>
								<input type="text" name="f_name"  class="form-control" placeholder="first name" value="<?php echo $row[1] ?>" required="true" >
                        </div>
                        <div class="form-group">
							<label for="fname">middle name</label>
								<input type="text" name="m_name" class="form-control" placeholder="middle name" value="<?php echo $row[2] ?>" required="true">
						</div>

						<div class="form-group">
							<label for="fname">last name</label>
								<input type="text" name="l_name" class="form-control" placeholder="last name" value="<?php echo $row[3] ?>" required="true">
						</div>

						<div class="form-group">
							<label for="fess">gender</label>
							<select name="gender" class="form-control select2" required="true" data-placeholder="select gender" >
								<option></option>
                <?php
                if ($row[4]=="male") {?>
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
							<label >Department</label>
							<select name="dep" class="form-control select2" required="true" data-placeholder="select Department" >
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.department");
							while($dep=mysqli_fetch_array($sql)){
                    if ($dep['dep_code']==$row[6]) {?>
                      <option value="<?php echo $dep['dep_code']; ?>"selected  ><?php echo $dep['depname'] ?></option>
                    <?php }else {?>
                      <option value="<?php echo $dep['dep_code']; ?>"><?php echo $dep['depname'] ?></option>
                     
                  <?php  }
							 } ?>
			
							</select>
						</div>

                    </div>
                    
                    <!-- / left -->
                    <!-- right -->

                    <div class="col-lg-6">				
						<div class="form-group">
							<label >divistion</label>
							<select name="div" class="form-control select2" required="true" data-placeholder="select division">
								<option></option>
						    
                <?php 
                  if ($row[7]=='R') {?>
                    <option value="R" selected>regular </option>
                 <?php }else { ?>
                    <option value="R">regular </option>
                 <?php }

                if ($row[7]=='E') {?>
                  <option value="E" selected>extension </option>
                <?php }else { ?>
                  <option value="E">extension </option>
                <?php }

                if ($row[7]=='W') {?>
                  <option value="W" selected>weekend </option>
                <?php }else { ?>
                  <option value="W">weekend </option>
                <?php }



                  
                ?>

							</select>
						</div>

					
					

						<div class="form-group">
							<label for="fess">Acadamic year</label>
							<select name="a_year" class="form-control select2" required="true" data-placeholder="select Acadamic year">
								<option></option>

                <?php
                    if ($row[11]=='1st') {?>
                      <option value="1st" selected>1st </option>
                   <?php }else { ?>
                      <option value="1st">1st </option>
                   <?php }

                  if ($row[11]=='2nd') {?>
                    	<option value="2nd" selected>2nd </option>
                  <?php }else { ?>
                  	<option value="2nd">2nd </option>
                  <?php }
                  if ($row[11]=='3rd') {?>
                   <option value="3rd" selected>3rd </option>
                  <?php }else { ?>
                    <option value="3rd">3rd </option>
                  <?php }
                  if ($row[11]=='4th') {?>
                    <option value="4th" selected>4th </option>
                  <?php }else { ?>
                    <option value="4th">4th </option>
                  <?php }
                  if ($row[11]=='5th') {?>
                    <option value="5th" selected>5th </option>
                  <?php }else { ?>
                    <option value="5th">5th </option>
                  <?php }
                ?>  


							</select>
						</div>

            <div class="form-group">
							<label for="sec">Section</label>
              <input type="number" name="sec" class="form-control"  value="<?php echo $row[14] ?>"  placeholder="section">
             
						</div>

						<div class="form-group">
              <label for="fname">birth date</label>
             
								<input type="date" name="b_date" class="form-control" value="<?php echo $row[5] ?>"  placeholder="birth date" required="true">
						</div>

						<div class="form-group">
							<label for="fess">email</label>
							<input type="email" name="email" class="form-control" value="<?php echo $row[9] ?>" placeholder="john@example.com" required="true">
						</div>

						<div class="form-group">
							<label for="fess">phone number</label>
              <input type="text" name="phone_no" class="form-control"  value="<?php echo $row[10] ?>"  placeholder="090-000-0000 or +251 000 000 0000" required="true"  data-inputmask="'mask': ['999-999-9999', '+099 999 999 9999']" data-mask>
             
						</div>

            
			

						<div class="form-group" >
							<label for="fess">password</label> <br>
              <div class="icheck-danger d-inline">
                        <input type="checkbox" id="checkboxDanger3" name="passreset">
                        <label for="checkboxDanger3">
                         <span class="text text-gray-dark" style="font-weight: 500;"  >reset  password</span> 
                        </label>
                      </div>
              
						</div>
				</div>

					<button type="submit" name="updateS" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> update</button>
                
                </div>
                </div>
            </form>
            <!-- /.card-body -->
            <div class="card-footer">
              fill student infromation properly 
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

    $(function () {
  
  //Money Euro
  $('[data-mask]').inputmask()

})
</script>
