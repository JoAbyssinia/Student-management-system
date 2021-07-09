<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=4;
$asidesubelocation=41;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
  if (isset($_GET['toast'])==1) {
      $toast=1;
      $msg="Student Grade update successfull";
  }
?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Import Grade</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Import Grade</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- upload -->

    <section class="content">

      <div class="row">
      <div class="col-12">
        <div class="card card-danger card-outline" >
          
          <!-- /.card-header -->
          <div class="card-body">

            <?php
               $classPro = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.grade_submit where id='".$_GET['cid']."';"));
               $_SESSION['depClass']=$classPro['dep'];
               $_SESSION['corClass']=$classPro['cor_id'];
               $_SESSION['yrClass']=$classPro['year'];
               $_SESSION['divClass']=$classPro['div'];
               $_SESSION['semClass']=$classPro['sem'];
               $_SESSION['lecClass']=$classPro['lec_id'];
            ?>
            <div class="row">
                          <div class="col-md-6">
                            <table>
                              <tr>
                                <th>Department:</th>
                                <td><?php  
                                    $dep = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.department where dep_code = '".$classPro[1]."'"));
                                    echo ucfirst($dep[1]);
                                ?></td>
                              </tr>
                              <tr>
                                <th>Course:</th>
                                <td><?php  
                                    $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$classPro[9]."';"));
                                    echo ucfirst($crs[0]);
                                ?></td>
                              </tr>
                              <tr>
                                <th>Academic year:</th>
                                <td><?php echo $classPro['year']." year" ?> </td>
                              </tr>
                              <tr>
                                <th>Division:</th>
                                <td><?php
                                  if ($classPro[3]=="R") {
                                    echo "Regular";
                                  }elseif ($classPro[3]=="W") {
                                    echo "Weekend";
                                  }elseif ($classPro[3]=="E") {
                                    echo "Extention";
                                  }
                                ?></td>
                              </tr>
                              <tr>
                                <th>Semester:</th>
                                <td><?php 
                                echo $classPro['sem'];
                                ?></td>
                              </tr>
                              <tr>
                                <th>Section:</th>
                                <td><?php 
                                echo $classPro['section'];
                                ?></td>
                              </tr>
                              <tr>
                                <th>Instructor:</th>
                                <td><?php  
                                  $lec = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.instructor where ins_id = '".$classPro[10]."';"));
                                  echo $lec[1]." ".$lec[2];
                                ?></td>
                              </tr>
                            </table> 
                          </div>
                          <div class="col-md-6">
                              <form  id="uploadData"  enctype="multipart/form-data" method="post">
                                  <div class="form-group">
                                  <span id="message"></span>
                                  <label for="exampleInputFile">File input 
                                      <span class="text-sm text-gray font-weight-light">(excel only)</span> 
                                   </label>
                                          
                                        <div class="input-group">
                                          <div class="custom-file">
                                              <input type="file" name="gradeimport" class="custom-file-input" required="true" id="exampleInputFile">
                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                          </div>
                                        </div>
                                          <br>
                                        <button  id="btn_grade" name="btn_grade" class="btn btn-success btn-block" type="submit"> 
                                        <span class="spinner-grow spinner-grow-sm load " role="status" aria-hidden="true"></span>  
                                        Import
                                        <span class="spinner-grow spinner-grow-sm load " role="status" aria-hidden="true"></span>
                                        </button>
                                          
                                  </div>
                              </form>
                          </div>
                        
                      </div>  

            </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      </div>  

</section>
    <!-- list of class student -->
    <section class="content">

        <div class="row">
        <div class="col-12">
          <div class="card card-danger card-outline" >
            <div class="card-header">
              <h3 class="card-title">List of Student </h3>
              <div class="card-tools">
                 <button class="btn btn-info" onClick="window.location.reload();" ><i class="fa fa-sync-alt"></i> Referesh</button>  
              </div>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>Full name</th>
                      <th>Ass 1</th>
                      <th>Ass 2</th>
                      <th>Mid exam</th>
                      <th>Final exam</th>
                      <th>Grade point</th>
                      <th>grade</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                     $queryStList = "SELECT * FROM rvusrs.acadamic_history where dep='".$classPro['dep']."' and cors='".$classPro['cor_id']."' and `year`='".$classPro['year']."' and `div`='".$classPro['div']."' and semister='".$classPro['sem']."' and lecture='".$classPro['lec_id']."';";
                    
                     $cout=1;
                     $resultSlist = mysqli_query($con,$queryStList);
                     if (mysqli_affected_rows($con)) {
                      
                     while ($row=mysqli_fetch_array($resultSlist)) {?>
                      <tr>
                        <td><?php echo $cout ?></td>
                        <td><?php echo $row[0] ?></td>
                        <td><?php 
                          $stuname = mysqli_fetch_array(mysqli_query($con,"SELECT fname,mname,lname FROM rvusrs.student where st_id='".$row[0]."';"));
                          echo $stuname[0]." ".$stuname[1]." ".$stuname[2];
                        ?></td>
                        <td><?php echo $row['asses1'] ?></td>
                        <td><?php echo $row['asses2'] ?></td>
                        <td><?php echo $row['midexam'] ?></td>
                        <td><?php echo $row['finalexam'] ?></td>
                        <td><?php echo $row['gradepoint'] ?></td>
                        <td><?php echo  strtoupper($row['grade']) ?></td>

                       
                        <td> 
                         <a href="edit-grade.php?cid=<?php echo $_GET['cid']?>&&st_id=<?php echo $row[0]?>&&cors=<?php echo $row[1]?>&&dep=<?php echo $row[2]?>&&div=<?php echo $row[3]?>&&yr=<?php echo $row[4]?>&&sem=<?php echo $row[5]?>"> <button class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> </button></a>
                        </td>
                      </tr>
                     <?php $cout++; }
                     }else { ?>
                      <tr class="text-center">
                        <td colspan="10" class="font-weight-bold text-red"> <i class="fa fa-star"></i>  Not Submit Yet <i class="fa fa-star"></i> </td>
                      </tr>
                      
                    <?php }
                    ?>
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        </div>  
    </section>
  </div>
  <?php 
 include('_includes/footer.php');
?>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
$(document).ready(function(){
  bsCustomFileInput.init();
  $(".load").hide();


  $('#uploadData').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"importGrade.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#btn_grade').attr('disabled', 'disabled');
        $('#btn_grade').html('Importing...');
        $(".load").show();

      },
      success:function(data)
      {
        $(".load").hide();
        $('#message').html(data);
        $('#uploadData')[0].reset();
        $('#btn_grade').attr('disabled', false);
        $('#btn_grade').html('Import');
      }
    })
  });
});
</script>





