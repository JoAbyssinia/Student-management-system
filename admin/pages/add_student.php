<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=3;
$asidesubelocation=31;
?>


<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>
 
<?php 
  if (isset($_GET['registerS'])) {

    $query = "INSERT INTO `rvusrs`.`student` 
    (`st_id`, `fname`, `mname`, `lname`, `gender`, `birth_date`, `department`, `division`, `email`, `phone`, `academic_year`)
     VALUES ('".trim($_GET['id'])."', '".$_GET['f_name']."', '".$_GET['m_name']."', '".$_GET['l_name']."',
      '".$_GET['gender']."', '".$_GET['b_date']."','".$_GET['dep']."', '".$_GET['div']."',
       '".$_GET['email']."', '".$_GET['phone_no']."', '".$_GET['a_year']."');";
    $result = mysqli_query($con,$query);

    if ($result) {
      $toast = 1;
      $msg = "add student Successfull.";
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
            <h1 class="m-0 text-dark">Add Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="card card-danger card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form  id="uploadData"  enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                <span id="message"></span>
                                <label for="exampleInputFile">File input 
                                    <span class="text-sm text-gray font-weight-light">(excel only)</span> 
                            
                                  <a class="link font-weight-lighter" href="../dist/docs/studentform.xlsx"> sample form <i class="fa fa-file-download"></i></a> </label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="studentListex" class="custom-file-input" required="true" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" name="studentup" id="studentup" class="btn btn-block btn-success" >
                                              <i class="fa fa-upload"></i> Import</button>
                                            
                                        </div>
                                        
                                        </div>
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                        <span class="spinner-grow spinner-grow-sm load text-danger " role="status" aria-hidden="true"></span> 
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>

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
                        <?php 
                          $autoID = rand(1000,9999);
                          $yr=date('y');
                          $autoID = "RVUSDR/".$autoID."/".$yr;
                          
                          $autoID = idchecker($autoID);
                        ?>
              <input type="hidden" name="id"  value=" <?php echo trim($autoID) ?> "  >
							<input type="text" name="st_id"  class="form-control"  disabled value="<?php echo $autoID ?>" >
						</div>

						<div class="form-group">
							<label for="fname">frist name</label>
								<input type="text" name="f_name" class="form-control" placeholder="first name" required="true" >
            </div>
            <div class="form-group">
							<label for="fname">middle name</label>
								<input type="text" name="m_name" class="form-control" placeholder="middle name" required="true">
						</div>

						<div class="form-group">
							<label for="fname">last name</label>
								<input type="text" name="l_name" class="form-control" placeholder="last name" required="true">
						</div>

						<div class="form-group">
							<label for="fess">gender</label>
							<select name="gender" class="form-control select2" required="true" data-placeholder="select gender" >
								<option></option>
								<option value="male">male </option>
								<option value="female">female </option>
							</select>
						</div>

						<div class="form-group">
							<label >Department</label>
							<select name="dep" class="form-control select2" required="true" data-placeholder="select Department" >
							<option></option>
							<?php
							$sql=mysqli_query($con,"SELECT * FROM rvusrs.department");
							while($row=mysqli_fetch_array($sql))
												{
							?>
							<option value="<?php echo $row[0]; ?>"><?php echo $row[1] ?></option>
							<?php } ?>
			
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
								<option value="R">regular </option>
								<option value="E">extension </option>
								<option value="W">weekend </option>
							</select>
						</div>

					
					

						<div class="form-group">
							<label for="fess">Acadamic year</label>
							<select name="a_year" class="form-control select2" required="true" data-placeholder="select Acadamic year">
								<option></option>
								<option value="1st">1st </option>
								<option value="2nd">2nd </option>
								<option value="3rd">3rd </option>
								<option value="4th">4th </option>
								<option value="5th">5th </option>
							</select>
						</div>

						<div class="form-group">
							<label for="fname">birth date</label>
								<input type="date" name="b_date" class="form-control" placeholder="birth date" required="true">
						</div>

						<div class="form-group">
							<label for="fess">email</label>
							<input type="email" name="email" class="form-control" placeholder="john@example.com" required="true">
						</div>

						<div class="form-group">
							<label for="fess">phone number</label>
              <input type="text" name="phone_no" class="form-control"   placeholder="090-000-0000 or +251 000 000 0000" required="true"  data-inputmask="'mask': ['999-999-9999', '+099 999 999 9999']" data-mask>
             
						</div>
			

						<div class="form-group">
							<label for="fess">password</label>
							<input type="text" name="def_pass" class="form-control"  disabled value="stu123rvu" required="true">
						</div>
				</div>

					<button type="submit" name="registerS" id="submit" class="btn btn btn-success"><i class="fa fa-save"></i> Regester</button>
                
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

    function idchecker ($ID) {
      global $con;
      $query = "SELECT * FROM rvusrs.studetchid where st_id ='".$ID."';";
      
      $result = mysqli_query($con,$query);
      $pass = mysqli_fetch_array($result);

      if (mysqli_affected_rows($con)>=1) {
        idchecker($ID);
      }else {
        return $ID;
      }
    }

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

<script>
$(document).ready(function(){
  $(".load").hide();
  $('#uploadData').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"import.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#studentup').attr('disabled', 'disabled');
        $('#studentup').html('Importing...');
        $(".load").show();

      },
      success:function(data)
      {
        $(".load").hide();
        $('#message').html(data);
        $('#uploadData')[0].reset();
        $('#studentup').attr('disabled', false);
        $('#studentup').html('Import');
      }
    })
  });
});
</script>

