<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=9;
$asidesubelocation=92;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    if (isset($_GET['updateSection'])) {
      $noSect = $_GET['newsec'];
      $toStudent = $_GET['tst'];
      if ($noSect >= $toStudent) {
        $toast=2;
        $msg = "faild ,check again (number of section is shound be less than number of students)";
       
      }else {
        
     
        $query = "SELECT * FROM rvusrs.student 
        where department ='".$_GET['dep']."' and 
        division ='".$_GET['div']."' and 
        academic_year='".$_GET['year']."';";

        $result = mysqli_query($con,$query);
          $section=1;
        while ($row=mysqli_fetch_array($result)) {

          $updateQ = "UPDATE `rvusrs`.`student` SET `section` = '".$section."' WHERE (`st_id` = '".$row[0]."');";
          mysqli_query($con,$updateQ);
          $section ++;
          if ($section > $noSect) {
            $section=1;
          }
         
        }

     
        $toast = 1;
        $msg = " Sectioning Successfull.";
      
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
            <h1 class="m-0 text-dark">Class sectioning </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Class sectioning</li>
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
              <h4 class="card-title">Sections</h4>
            </div>
            <!-- /.card-header -->
           
                <div class="card-body" style="min-height: 500px;">
                  <div class="row">
                      <?php
                       $cardCaunter = 1;
                        $query="SELECT * FROM rvusrs.numberofstudent order by department asc, academic_year asc ,division asc;";
                        $result=mysqli_query($con,$query);
                        while ($row=mysqli_fetch_array($result)) {?>

                    <div class="accordion md-accordion col-md-12" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <div class="card elevation-0">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingOne<?php echo $cardCaunter ?>">
                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?php echo $cardCaunter ?>" aria-expanded="true"
                          aria-controls="collapseOne<?php echo $cardCaunter ?>">
                          <table class="table table-borderless text-gray-dark">
                            <tr>
                              <th>
                                 <?php 
                                  $naquery = "SELECT * FROM rvusrs.department where dep_code='".$row[0]."';";
                                  $nam = mysqli_fetch_array(mysqli_query($con,$naquery));
                                 echo $nam[1] ?>
                               </th>
                              <td>
                               <?php 
                                echo $row[2];
                               ?> 
                              year</td>
                              <td><?php
                                if ($row[1]=="R") {
                                  echo "Regular";
                                }elseif ($row[1]=="E") {
                                  echo "Extention";
                                }else {
                                  echo "Weekend";
                                }
                              ?></td>
                              <td class="text-center" >
                                  <span class="badge bg-info" style="font-size: 20px;">
                                  <?php echo $row[3] ?>
                                  Students</span>
                              </td>
                            </tr>
                          </table>
                         
                        </a>
                      </div>
                      </div>

                      <!-- Card body -->
                      <div id="collapseOne<?php echo $cardCaunter ?>" class="collapse bg-gray" role="tabpanel" aria-labelledby="headingOne<?php echo $cardCaunter ?>" data-parent="#accordionEx">
                        <div class="card-body">
                              <table class="table table-borderless">
                                <tr>
                                  <td> 
                                    Currently <span class="text text-bold font-weight-bold">
                                      <?php 
                                        $queryCu = "SELECT section FROM rvusrs.student where department ='".$row[0]."' and division ='".$row[1]."' and academic_year='".$row[2]."' group by section ;";
                                        $current = mysqli_fetch_array(mysqli_query($con,$queryCu));
                                        echo mysqli_affected_rows($con);
                                      ?>
                                    </span> Sections 
                                  </td>
                                  <td> <form action="sections.php" method="get">
                                    <input type="hidden" name="dep" value="<?php echo $row[0] ?>">
                                    <input type="hidden" name="year" value="<?php echo $row[2] ?>">
                                    <input type="hidden" name="div" value="<?php echo $row[1] ?>">
                                    <input type="hidden" name="tst" value="<?php echo $row[3] ?>">
                                    <div class="input-group mb-3">
                                   
                                      <input type="number" name="newsec" required class="form-control" placeholder="no. section">
                                      <div class="input-group-append">
                                        <button type="submit" name="updateSection" class="btn btn-danger">Divided</button>
                                      </div>
                                      
                                    </div>
                                  </form> 
                                  </td>
                                </tr>
                              </table>

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