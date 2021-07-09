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

$subdashpagelication=22;
$dashSidebar=2;
$pagelication = 6;
$subpagelication=1;
$toast=0;
include('_includes/navbar.php');
  $counter =0;


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
                <h1 class="m-0 text-dark">View Assigned</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">View Assigned </li>
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
              

              <!--Accordion wrapper-->
                  <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                    <?php
                      $cardCaunter = 1;
                      $queryList = "SELECT acadamic_year FROM rvusrs.classfilter where department='".$prof['dep']."';";
                      $sqlList=mysqli_query($con,$queryList);
                      $cnt=1;
                      while($row=mysqli_fetch_array($sqlList))
                      { ?>
            
                    <div class="card elevation-0">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingOne<?php echo $cardCaunter ?>">
                          <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?php echo $cardCaunter ?>" aria-expanded="false"
                            aria-controls="collapseOne<?php echo $cardCaunter ?>">
                            <h5 class="mb-0 text-black-50">
                             <?php echo $row[0] ?> 
                             Year <i class="fas fa-angle-down rotate-icon"></i>
                              <div class="float-right">
                                <i class="fa fa-edit"></i>
                              </div>
                            </h5>
                          </a>
                        </div>
                        <!-- Card body -->
                        <div id="collapseOne<?php echo $cardCaunter ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $cardCaunter ?>" data-parent="#accordionEx">
                          <div class="card-body">
                            <ul class="list-group list-group-flush">

                            <?php 
                            $queryListCourse = "SELECT * FROM rvusrs.enroll where dep = '".$prof['dep']."' and year = '".$row[0]."' group by cr_code";

                              $resultC = mysqli_query($con,$queryListCourse);
                              $cors = ($resultC) ? mysqli_affected_rows($con) : 0;	

                              if ($cors!=0) {
                                while ($corse=mysqli_fetch_array($resultC)) {?>
                                  
                                  <li class="list-group-item"> <i class="fa fa-hand-point-right"></i>  <?php 
 
                                    $courseTilteQuery = "SELECT course_tilte FROM rvusrs.course where cr_code ='".$corse[1]."' ";

                                    $resultCT = mysqli_query($con,$courseTilteQuery);
                                    $Ctitle = mysqli_fetch_array($resultCT);
                                      echo ucfirst($Ctitle[0]);
                                  
                                  ?></li>
                              <?php  }
                              }else { ?>
                                <li class="list-group-item">Course not assign yet.</li>
                            <?php  }
                            ?>
                            </ul>
                          </div>
                        </div>

                        </div>
                    <?php  
                       $cardCaunter++;
                    }
                    ?>
                    </div>
                    <!-- Accordion wrapper -->
            
            </div>
            <!-- /.card-body -->
          </div>
        </section>
        </div>
      </div>
    </div>
  
  </main><!-- End #main -->


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
        title: '  Course Assign successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: ' Course Assign failed.' 
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
 
