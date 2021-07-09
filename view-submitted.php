<?php 

include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();

if (strlen($_SESSION['user'])=="" || strlen($_SESSION['who'])=="" ) {
  $host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";		 
    header("Location: http://$host$uri/$extra");
}

$subdashpagelication=42;
$dashSidebar=4;
$pagelication = 6;
$subpagelication=1;
$toast=0;
include('_includes/navbar.php');
  $counter =0;
?>


<?php 
  

  if (isset($_GET['toast'])==1) {
    $toast=1;
  }


?>


<main id="main">
    
    <div class="row">
   <?php 
      include('_includes/sidebar.php')
   ?>  
      <div class="col-md-10 content" style=" min-height: 600px;">
        
        <div class="content-header" style="margin-top: 100px;">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">View submitted</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">View submitted</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
          
        <section class="content " style="padding: 10px 10px;">
          <div class="card card-danger card-outline" style="min-height: 500px;">
            <div class="card-header">
              <h3 class="card-title text-gray-dark">
                departement: <strong> 
                <?php 
                  echo $dep[0];
                ?>    
              </strong>
              </h3>
              
            </div>
            
            <!-- /.card-header -->
            <div class="card-body"> 
            <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Course</th>
                              <th>Lecture</th>
                              <th>Year</th>
                              <th>Division</th>
                              <th>Semister</th>
                            </tr>
                          </thead>
                          <tbody>
                        <?php 
                        $coun =1;
                            $ass = "SELECT * FROM rvusrs.grade_submit where dep='".$prof['dep']."' ; ";
                            $resultA = mysqli_query($con,$ass);
                            while ($row=mysqli_fetch_array($resultA)) {?>

                            <tr>
                            <td>
                            <?php echo $coun ?>
                            </td>
                            <td><?php  
                            
                                $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$row[9]."';"));
                                echo $crs[0];
                              ?></td>
                               <td><?php  
                                $lec = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.instructor where ins_id = '".$row[10]."';"));
                                echo $lec[1]." ".$lec[2];
                              ?></td>
                              <td><?php 
                                echo $row[2]." Year";
                              ?></td>
                              
                              <td>
                                <?php
                                  if ($row[3]=="R") {
                                    echo "Regular";
                                  }elseif ($row[3]=="W") {
                                    echo "Weekend";
                                  }elseif ($row[3]=="E") {
                                    echo "Extention";
                                  }
                                ?>
                              </td>
                              <td> 
                                  <?php 
                                    echo $row[4];
                                  ?>
                              </td>
                            
                            </tr>
                             
                              
                          <?php $coun++;  }
                        ?>

                          </tbody>
                        </table>
            </div>
            <!-- /.card-body -->
          </div>
        </section>
        </div>
      </div>
    </div>
  
  </main><!-- End #main -->
<?php 

  function submitCheck($crs,$dep,$div,$yr,$sem,$lec)
  {
    global $con;
    $chQ= "SELECT * FROM rvusrs.grade_submit where 
    cor_id='$crs' and 
    lec_id='$lec' and 
    dep='$dep' and 
    `year`='$yr' and 
    `div`='$div' and 
    sem='$sem';";
    mysqli_query($con,$chQ);


    return mysqli_affected_rows($con);
  }
?>


  <footer id="footer">
<?php 
include("_includes/footer.php");
?>
 <script src="assets/d/plugins/select2/js/select2.min.js"></script>
<script src="assets/d/dist/js/adminlte.min.js"></script>
<script src="assets/d/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });

  </script>

  <script>
    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      <?php 
        if ($toast==1) {?>
        Toast.fire({
        icon: 'success',
        title: ' Grade Submit successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: ' Grade Submit failed.' 
      })
     <?php }
      ?>
      

    });
 </script>
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
 
