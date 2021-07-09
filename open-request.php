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


$subdashpagelication=51;
$dashSidebar=5;
$subpagelication=61;
$toast=0;
include('_includes/navbar.php');
  
$TotalChoure=0;
$TotalGpoint=0;
?>

<?php 
   $req = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.addcourse where `row` = '".$_GET['row']."';"));
?>

<?php
    if (isset($_POST['approve'])) {
      
      $result=mysqli_query($con,"UPDATE `rvusrs`.`addcourse` SET `state` = '1' 
      WHERE 
      (`row` = '".$_GET['row']."') and 
      (`st_id` = '".$req[0]."') and 
      (`cr_code` = '".$req[1]."');");

      if ($result) {
        $extra="add-request.php?toast=1";
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

          echo "<script>  location.replace('http://$host$uri/$extra');  </script>";  
      }else {
        $toast=2;
      }
    }
?>

<?php 


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
                <h1 class="m-0 text-dark">View Request</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">View Request</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
          <?php
         

          $stinfo = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.student where st_id='".$req[0]."';"));

          ?>

        <section class="content " style="padding: 10px 10px;">
          <div class="row">
            <div class="col-md-6 col-sm-12 card card-danger card-outline" style="min-height:450px" >
              <div class="card-header">
                <h3 class="card-title">Student info</h3>
              </div>
              <div class="card-body">

                  <table class="table table-sm table-borderless">
                    <tbody>
                      <tr>
                        <th>Id:</th>
                        <td> <?php echo $stinfo[0] ?> </td>
                      </tr>
                      <tr>
                        <th>full name:</th>
                        <td><?php echo $stinfo[1]." ".$stinfo[2]." ".$stinfo[3] ?></td>
                      </tr>
                      <tr>
                        <th>Academic year:</th>
                        <td><?php echo $stinfo['academic_year']." year" ?></td>
                      </tr>
                      <tr>
                        <th>Division:</th>
                        <td>
                        <?php if ($stinfo['division']=="R") {
                          echo "Regular";
                        }elseif ($stinfo['division']=="E") {
                          echo "Extention";
                        }elseif ($stinfo['division']=="W") {
                          echo "Weekend";
                        } ?></td>
                      </tr>
                      <tr>
                        <th>Section:</th>
                        <td><?php echo $stinfo['section'] ?></td>
                      </tr>
                      <tr>
                        <th>Gender:</th>
                        <td><?php echo $stinfo['gender'] ?></td>
                      </tr>
                    </tbody>
                  </table>

              </div>
              
              <!-- /.card -->
            
            </div>
            <!-- add card end -->

            <div class="col-md-6 col-sm-12 card card-danger card-outline " >
              <div class="card-header">
                <h3 class="card-title">Add Class info</h3>
              </div>
              <div class="card-body">
                
                <table class="table table-sm table-borderless">
                  <tbody>
                    <tr>
                        <th>course title:</th>
                        <td>
                        <?php 
                          $crname = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code='$req[1]';"));
                          echo $crname[0];
                        ?>
                        </td>
                    </tr>
                    <tr>
                      <th>Academic year: </th>
                      <td><?php 
                        echo $req['year']." year";
                      ?></td>
                    </tr>
                    <tr>
                      <th>Division: </th>
                      <td><?php 
                        if ($req['div']=="R") {
                          echo "Regular";
                        }elseif ($req['div']=="E") {
                          echo "Extention";
                        }elseif ($req['div']=="W") {
                          echo "Weekend";
                        }
                      ?></td>
                    </tr>
                    <tr>
                      <th>Section: </th>
                      <td><?php 
                        echo $req['section'];
                      ?></td>
                    </tr>
                    <tr>
                      <th>State: </th>
                      <td><?php 
                       
                        if ($req['state']==0) {
                          echo "Requested";
                        }elseif ($req['state']==1) {
                          echo "Approved";
                        }elseif ($req['state']==2) {
                          echo "Added ";
                        }
                      ?></td>
                    </tr>

                  </tbody>
                </table>
                    <br><br>
               <form method="post">
                  <button type="submit" name="approve" <?php
                    if ($req['state']!=0) {
                      echo "disabled";
                    }
                  ?> class="btn btn-success"> <i class="fa fa-check-circle"></i> Approve</button>
               </form>
              <!-- /.card -->
            </div>
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
        title: ' Request successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: ' Aprovement failed.' 
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
 
