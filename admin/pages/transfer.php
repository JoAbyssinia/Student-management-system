<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=9;
$asidesubelocation=93;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    if (isset($_POST['transfer'])) {
        
        mysqli_query($con,"SELECT * FROM rvusrs.enroll;");
         $check = mysqli_affected_rows($con);
         
        if ($check==0) {
          $result= mysqli_query($con,"SELECT * FROM rvusrs.student order by academic_year desc;");
        while ($row=mysqli_fetch_array($result)) {
             
         if($row[6]=='med' && $row[11]=='6th' ||
            $row[6]=='ceng' && $row[11]=='5th' || 
            $row[6]=='cotm' && $row[11]=='5th' || 
            $row[6]=='md' && $row[11]=='5th' || 
            $row[6]=='cs' && $row[11]=='4th' ||
            $row[6]=='mid' && $row[11]=='4th' || 
            $row[6]=='ho' && $row[11]=='4th' || 
            $row[6]=='nurs' && $row[11]=='4th' || 
            $row[6]=='phr' && $row[11]=='4th' || 
            $row[6]=='acc' && $row[11]=='3rd' ||
            $row[6]=='buma' && $row[11]=='3rd') {
               mysqli_query($con,"UPDATE `rvusrs`.`student` SET `academic_year` = 'grt' WHERE
                   (`st_id` = '".$row[0]."');"); 
            }elseif ($row[11]=='4th') {
              mysqli_query($con,"UPDATE `rvusrs`.`student` SET `academic_year` = '5th' WHERE
                   (`st_id` = '".$row[0]."');"); 
            }elseif ($row[11]=='3rd') {
              mysqli_query($con,"UPDATE `rvusrs`.`student` SET `academic_year` = '4th' WHERE
                   (`st_id` = '".$row[0]."');"); 
            }elseif ($row[11]=='2nd') {
              mysqli_query($con,"UPDATE `rvusrs`.`student` SET `academic_year` = '3rd' WHERE
                   (`st_id` = '".$row[0]."');"); 
            }elseif ($row[11]=='1st') {
              mysqli_query($con,"UPDATE `rvusrs`.`student` SET `academic_year` = '2nd' WHERE
                   (`st_id` = '".$row[0]."');"); 
            }
        }
        $toast =1;
        $msg = "Year transfer seccussfull";
        }else {
         $toast=2;
         $msg="Error transfer failed <br> make sure all this semister grades are sumbited "; 
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
            <h1 class="m-0 text-dark">Class Transfer </h1>
            <blockquote style="border-left: .3rem solid #dc3545;">
              please make sure this time is right time and do ones a time
            </blockquote>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Class Transfer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- single Admin staff form -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline"  >
            <div class="card-header">
              <h4 class="card-title">List of class</h4>
              <div class="card-tools">
              <form method="post">
                <button class="btn btn-outline-danger" name="transfer" onclick="return confirm('Are you sure?')" > <i class="fa fa-long-arrow-alt-right"></i> Transfer</button>
              </form>
              </div>
            </div>
            <!-- /.card-header -->
           
                <div class="card-body" style="min-height: 500px;">
                  <div class="row">
                    <table class="table">
                    <thead>
                      <tr>
                        <th>Departement</th>
                        <th>Academic year</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $result= mysqli_query($con,"SELECT department,academic_year FROM rvusrs.student where not academic_year='grt'  group by  department,academic_year order by academic_year asc ;");
                    while ($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td>
                        <?php $dep = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code = '".$row[0]."'"));
                          echo $dep[1];
                           ?>
                        </td>
                        <td>
                        <?php 
                          echo $row[1]." Year";
                        ?>
                        </td>
                      </tr>

                    <?php }

                    ?>
                      
                    </tbody>
                    </table>
                  </div>
                </div>
           
            <!-- /.card-body -->
            
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