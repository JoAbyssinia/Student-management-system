<?php
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=1;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>

<?php 
    require '_includes/phpspreedsheet/vendor/autoload.php';
    $connect = new PDO("mysql:host=localhost;dbname=rvusrs", "root", ""); 
?>

<?php 
// delete 
  if (isset($_GET['id'])) {
   
    $queryFilepath = "SELECT * FROM rvusrs.`important-docs` where `id` = '".$_GET['id']."';";
    $resultPath = mysqli_query($con,$queryFilepath);
    $pathf = mysqli_fetch_array($resultPath);  

     $idc = array();

    $q= "SELECT * FROM rvusrs.`acadamic-calender`";
      $res = mysqli_query($con,$q);
      while ($row=mysqli_fetch_array($res)) {
          $idc[] = $row[0];
      }

        foreach ($idc as $value) {
          $delQuery = "DELETE FROM `rvusrs`.`acadamic-calender` WHERE (`row` = '".$value."');";
          mysqli_query($con,$delQuery);
        }

    $delQuery = "DELETE FROM `rvusrs`.`important-docs` WHERE (`id` = '".$_GET['id']."');";
    $deResult = mysqli_query($con,$delQuery);

    if ($deResult) {
        unlink($pathf['path']);
    }

  }

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">Acadamic Calender</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Acadamic Calender</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid" >
        <div class="row">
          <div class="card card-danger card-outline col-sm-12"  >
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-calendar-alt"></i>
                <span class="text">Year 2020</span>
              </h3>
            </div>
            <div class="card-body" style="min-height: 450px;">
             
              <!-- <h4 class="mt-4">Right Sided <small>(nav-tabs-right)</small></h4> -->
              <div class="row">
                <div class="col-12 col-sm-9">
                  <?php 
                    $queryFilename = "SELECT * FROM rvusrs.`important-docs` where `type` = 'calender'";
                    $resultF = mysqli_query($con,$queryFilename);
                    $name = mysqli_fetch_array($resultF);
                  
                  ?>
                  
                  <div class="tab-content" id="vert-tabs-right-tabContent">
                    
                    <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel" aria-labelledby="vert-tabs-right-home-tab">
                        
                    <a href=" <?php echo '../'.$name['path'] ?> ">
                      <button class="btn btn-danger"><i class="fa fa-file-pdf"></i>  <?php echo $name['docname'] ?>  </button>
                    </a>

                    <br>

                      <table class="table table-bordered table table-head-fixed text-nowrap">
                        <thead>
                          <tr>
                            <th>ocasions</th>
                            <th>1st semister</th>
                            <th>2nd semister</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php 
                            $cal = "SELECT * FROM rvusrs.`acadamic-calender`;";
                           
                            $resultC = mysqli_query($con,$cal);
                            while ($row=mysqli_fetch_array($resultC)) {?>
                             
                             <tr>
                                <td><?php echo $row[1]?></td>
                                <td><?php echo $row[2]?></td>
                                <td><?php echo $row[3]?></td>
                              </tr>

                           <?php }
                          
                          ?>

                        </tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade" id="vert-tabs-right-profile" role="tabpanel" aria-labelledby="vert-tabs-right-profile-tab">
                      
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <span id="message"></span>
                            <form id="calenderform" enctype="multipart/form-data" method="post" >
                                <div class="form-group">
                                  
                                <label for="exampleInputFile">File input 
                                    <span class="text-sm text-gray font-weight-light">(excel only)</span> 
                                    <a class="link font-weight-lighter" href="../dist/docs/acadamic calender sample form.xlsx"> acadamic calender form <i class="fa fa-file-download"></i></a>
                                  </label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="ecxel" class="custom-file-input" id="exampleInputFile" required="true">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">File input 
                                      <span class="text-sm text-gray font-weight-light">(pdf only)</span> </label>
                                          <div class="input-group">
                                          <div class="custom-file">
                                              <input type="file" name="pdf" class="custom-file-input" id="exampleInputFile" required="true">
                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                          </div>
                                          <div class="input-group-append">
                                              
                                              
                                          </div>
                                          </div>
                                  </div>
                                  <br>
                            <button type="submit" name="fileuploadCalender" id="fileuploadCalender" class="btn btn-block btn-success  "><i class="fa fa-upload"></i> Upload</button>

                            </form>
                        </div>
                        <div class="col-md-3"></div>

                    </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-right-messages" role="tabpanel" aria-labelledby="vert-tabs-right-messages-tab">
                      
                      <p><span class="text"><i class="fa fa-eraser"></i> erese acadamic calender 
                      <small class="font-weight-lighter">( both text and pdf format)</small>
                      </span></p>
                        <a href="acadamic-calender.php?id=<?php echo $name['id'] ?>">
                       <button class="btn btn btn-danger" 
                        onClick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-eraser"></i> Delete</button>
                        </a>

            
                    </div>
                   
                  </div>
                </div>
                <div class="col-5 col-sm-3">
                  <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="vert-tabs-right-home-tab" data-toggle="pill" href="#vert-tabs-right-home" role="tab" aria-controls="vert-tabs-right-home" aria-selected="true">Calender</a>
                    <?php 
                        if ($_SESSION['roll']=='admin') {?>
                        
                      
                    <a class="nav-link" id="vert-tabs-right-profile-tab" data-toggle="pill" href="#vert-tabs-right-profile" role="tab" aria-controls="vert-tabs-right-profile" aria-selected="false">Add new</a>
                    <a class="nav-link" id="vert-tabs-right-messages-tab" data-toggle="pill" href="#vert-tabs-right-messages" role="tab" aria-controls="vert-tabs-right-messages" aria-selected="false">Manage</a>
                    <?php  }
                    ?>
                 
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
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

    $(function () {
  
  //Money Euro
  $('[data-mask]').inputmask()

  })
</script>

<script>
$(document).ready(function(){
  $('#calenderform').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"importcalender.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#fileuploadCalender').attr('disabled', 'disabled');
        $('#fileuploadCalender').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#calenderform')[0].reset();
        $('#fileuploadCalender').attr('disabled', false);
        $('#fileuploadCalender').val('Import');
      }
    })
  });
});
</script>