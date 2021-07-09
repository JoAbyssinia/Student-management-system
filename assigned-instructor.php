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

$subdashpagelication=31;
$dashSidebar=3;
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
                <h1 class="m-0 text-dark">Assign Instructor</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Assign Instructor </li>
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
            <div class="card-body" style="min-height: 500px;">
                  <div class="row">
                      <?php
                       $cardCaunter = 1;
                        $query="SELECT dep,`year`,`div`,`semister` FROM rvusrs.enroll where dep='".$prof[5]."' group by dep,`year`,`div`,semister;";
                        $result=mysqli_query($con,$query);
                        while ($row=mysqli_fetch_array($result)) {?>

                    <div class="accordion md-accordion col-md-12" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <div class="card elevation-0">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingOne<?php echo $cardCaunter ?>">
                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?php echo $cardCaunter ?>" aria-expanded="true"
                          aria-controls="collapseOne<?php echo $cardCaunter ?>">
                          <table class="table table-table-borderless text-gray-dark">
                            <tr>
                              <th>
                               <?php 
                                echo $row[1];
                               ?> 
                              year</th>
                              <td><?php
                                if ($row[2]=="R") {
                                  echo "Regular";
                                }elseif ($row[1]=="E") {
                                  echo "Extention";
                                }else {
                                  echo "Weekend";
                                }
                              ?></td>
                              <td>
                                <?php  
                                  echo $row[3]." semister"; 
                                ?>
                              </td>
                              <td>
                                <i class='fa fa-arrow-alt-circle-down text-center'></i>
                              </td>
                            </tr>
                          </table>
                        </a>
                      </div>
                      </div>

                      <!-- Card body -->
                      <div id="collapseOne<?php echo $cardCaunter ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $cardCaunter ?>" data-parent="#accordionEx">
                        <div class="card-body">
                             
                            
                                    <span class="text text-bold font-weight-bold">
                                      <?php 
                                        $queryCu = "SELECT section FROM rvusrs.student where department ='".$row[0]."' and division ='".$row[2]."' and academic_year='".$row[1]."' group by section ;";
                                        $resultC = mysqli_query($con,$queryCu);
                                       
                                        while ($sec= mysqli_fetch_array($resultC)) { ?>
                                        
                                        <a href="assign-page.php?dep=<?php echo trim($row[0])?>&yr=<?php echo trim($row[1])?>&&div=<?php echo trim($row[2])?>&&sem=<?php echo trim($row[3])?>&&sec=<?php echo trim($sec[0])?>"> <p> Section <?php echo $sec[0] ?> </p> </a>
                                        <?php }
                                      ?>
                                    </span>  
                        </div>
                      </div>

                    </div>

                      <?php 
                      $cardCaunter ++;
                      }                      
                      ?>

                      
                    
              
                  </div>
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
        title: ' Instructor Assign successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: ' Instructor Assign failed.' 
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
 
