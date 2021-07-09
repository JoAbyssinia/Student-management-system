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

$subdashpagelication=52;
$dashSidebar=5;
$pagelication = 6;
$subpagelication=1;
$toast=0;
include('_includes/navbar.php');
  $counter =0;


    if (isset($_GET['state'])) {
        $state = mysqli_query($con,"UPDATE `rvusrs`.`dropcourse` SET `state` = '1' 
        WHERE 
        (`st_id` = '".$_GET['st']."') and 
        (`cor_code` = '".$_GET['cor']."');");
        if ($state) {
          $toast=1;
        }else {
          $toast=2;
        }
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
                <h1 class="m-0 text-dark">Course Drop Request</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Course Drop Request </li>
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
                <table class="table"> 
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>full name</th>
                      <th>course</th>
                      <th>state</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $count = 1;
                      $query= "SELECT * FROM rvusrs.dropcourse where dip='".$prof[5]."' order by timestamp desc;";
                      $result=mysqli_query($con,$query);
                      while ($row=mysqli_fetch_array($result)) {?>
                      <tr>
                        <td> 
                          <?php 
                            echo $count;
                          ?>
                        </td>
                        <td>
                          <?php 
                          $namef = mysqli_fetch_array(mysqli_query($con,"SELECT fname,mname,lname FROM rvusrs.student  where st_id='$row[0]';"));
                          echo $namef[0]." ".$namef[1]." ".$namef[2];
                          ?>
                        </td>

                        <td>
                        <?php 
                          $course = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code='$row[1]';"));
                          echo $course[0];
                          ?> 
                        </td>
                        <td>
                        <?php 
                          if ($row[3]==0) {
                            echo "Requested";
                          }elseif ($row[3]==1) {
                            echo "Approved";
                          }elseif ($row[3]==2) {
                            echo "Submited ";
                          }
                        ?>
                        </td>
                        <td>
                          <a href="drop-request.php?state=1&&st=<?php echo $row[0]?>&&cor=<?php echo $row[1] ?>">
                            <button class="btn btn-outline-danger" 
                            <?php 
                              if ($row[3]==2) {
                                echo "disabled";
                              }
                            ?>
                             > <i class="fa fa-check-circle"></i> Approve</button>
                          </a>
                        </td>
                      </tr> 
                      <?php $count++;} 
                    ?>
                    
                  </tbody>
                </table>
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
        title: 'Approvement successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: 'Approvement failed.' 
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
 
