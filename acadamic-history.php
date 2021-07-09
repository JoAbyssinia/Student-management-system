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


$dashSidebar=2;
$pagelication = 6;
$subpagelication=61;
$toast=0;
include('_includes/navbar.php');
  
$TotalChoure=0;
$TotalGpoint=0;
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
                <h1 class="m-0 text-dark">Academic History</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Academic History</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
          
        <section class="content" style="padding: 10px 10px;" >
        <div class="card card-danger card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Grade Report</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">GPA Summery</a>
                  </li>
                </ul>
              </div>

              
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                  <div>
                     <p class="text-danger font-weight-normal"> <i class="fa fa-hand-point-right"></i> This is not official grade report. </p>
                   </div>
                      <?php 
                          $qeury = "SELECT * FROM rvusrs.ac_view;";
          
                          $result =mysqli_query($con,$qeury);
                          while ($row=mysqli_fetch_array($result)) {
                           
                            $querySpe = "SELECT cors, grade FROM rvusrs.acadamic_history where st_id='".$_SESSION['user']."' and semister = '".$row[1]."' and `year`= '".$row[0]."';";
                            $resultS = mysqli_query($con,$querySpe);
                          
                             if (mysqli_affected_rows($con)>0) { ?>

                        <span class="text-dark font-weight-bolder"> <i class="fa fa-circle"></i> <?php echo $row[0] ?> year, <?php echo $row[1] ?> semister </span>

                        <table class="table">
                        <thead class="bg-gradient-danger text-white" >
                        <tr>
                          <th style="width: 5xp; text-align: center; " >#</th>
                          <th>Code</th>
                          <th>Course title</th>
                          <th >Credit Hour</th>
                          <th>Grade</th>
                          <th>Grade point</th>
                        </tr>
                        </thead>
                        <tbody>

                         <?php  $count=1;
                                $STHoure=0;
                                $STGpoint=0;
                          while ($rows=mysqli_fetch_array($resultS)) {?>
                          <tr>
                            <td style="width: 5xp; text-align: center; "><?php echo $count ?></td>
                            <td><?php echo $rows[0] ?></td>
                            <td><?php 
                               $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte,credit_houre FROM rvusrs.course where cr_code = '".$rows[0]."';"));
                               echo ucfirst($crs[0]);
                            ?></td>
                            <td><?php echo $crs[1]; 
                              $STHoure += (int)$crs[1];
                            ?></td>
                            <td><?php echo strtoupper($rows[1]) ?></td>
                            <td><?php 
                              if ($rows[1]=='A' || $rows[1]=='A-' || $rows[1]=='A+' ) {
                                echo ((int)$crs[1]*4);
                                $STGpoint += (int)$crs[1]*4;
                              }elseif ($rows[1]=='b' || $rows[1]=='b-'||$rows[1]=='b+') {
                                    echo ((int)$crs[1]*3);
                                    $STGpoint += (int)$crs[1]*3;
                              }elseif ($rows[1]=='c' || $rows[1]=='c-' ||$rows[1]=='c+') {
                                   echo ((int)$crs[1]*2);
                                   $STGpoint += (int)$crs[1]*2;
                             }elseif ($rows[1]=='d') {
                                 echo ((int)$crs[1]*1);
                                 $STGpoint += (int)$crs[1]*1;
                              }elseif ($rows[1]=='f') {
                                echo ((int)$crs[1]*0);
                              }else {
                                echo 'NG';
                              }
                            ?></td>
                          </tr>
                          <?php $count++; }
                          } ?>
                        </tbody>
                        <tfoot class="bg-gradient-gray">
                          <tr>
                          <?php 
                           if (isset($STHoure)) {
                          ?>
                            <th colspan="3" style="text-align:end" >Semester Total</th>
                            <th><?php 
                             echo $STHoure;
                               $TotalChoure +=$STHoure;
                            } 
                             
                            ?></th>
                            <th></th>
                            <th><?php if (isset($STGpoint)) {
                               echo $STGpoint; 
                              $TotalGpoint += $STGpoint;
                              }
                            
                            ?></th>
                          </tr>
                          <tr>
                            <?php 
                            if (isset($STGpoint)) { 
                              $gpa = floatval(round($STGpoint/(float)$STHoure, 2));
                              ?>
                         
                          
                            <th colspan="3" >Remark: <?php 
                                if ($gpa ==4) {
                                  echo 'Exellent';
                                }elseif ($gpa >=3.5) {
                                  echo "G.Distinction";
                                }elseif ($gpa >=3.0) {
                                  echo "Distinction";
                                }elseif ($gpa >=2.0) {
                                echo "Avarage";
                                }elseif ($gpa >=1.5) {
                                  echo "Warning";
                                }else {
                                  echo "Failed/Dismissal"; 
                                }
                            ?> </th>
                            <th colspan="2" style="text-align:end"> Semester GPA </th>
                            <th>
                              <?php 
                                echo $gpa; 
                              } 
                              ?>
                            </th>
                          </tr>
                        </tfoot>
                      </table>

                           <?php }

                          
                      ?>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                  <div class="col-md-4">
                      <table class="table">
                          <tbody>
                            <tr>
                              <th>Total Hour:</th>
                              <td><?php echo $TotalChoure ?></td>
                            </tr>
                            <tr>
                              <th>Total Grade point:</th>
                              <td><?php echo $TotalGpoint ?></td>
                            </tr>
                            <tr>
                              <th>Cumulative GPA:</th>
                              <td> <?php 
                              if ($TotalGpoint==0 || $TotalChoure==0) {
                                  echo "0";
                              }else {
                                $gpaTotal = floatval(round($TotalGpoint/(float)$TotalChoure, 2));
                                 echo $gpaTotal;
                              }
                                
                              ?> </td>
                            </tr>
                            <tr>
                              <th>Remark:</th>
                              <td><?php  
                                 if ($TotalGpoint==0 || $TotalChoure==0) {
                                  echo "not set";
                              }else {
                  
                                 if ($gpaTotal ==4) {
                                  echo 'Exellent';
                               }elseif ($gpaTotal >=3.5) {
                                 echo "G.Distinction";
                               }elseif ($gpaTotal >=3.0) {
                                 echo "Distinction";
                               }elseif ($gpaTotal >=2.0) {
                                echo "Avarage";
                               }elseif ($gpaTotal >=1.5) {
                                 echo "Warning";
                               }else {
                                 echo "Failed/Dismissal"; 
                               }
                              }
                              ?></td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                  
                
                </div>
              </div>
              <!-- /.card -->
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
 
