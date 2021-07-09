<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=9;
$asidesubelocation=91;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>
<?php 
// delete 
  if (isset($_GET['did']) && $_GET['del']=="delete" ) {
  

    $queryFilepath = "SELECT * FROM rvusrs.`important-docs` where `id` = '".$_GET['did']."';";
    $resultPath = mysqli_query($con,$queryFilepath);
    $pathf = mysqli_fetch_array($resultPath);  

    $delQuery = "DELETE FROM `rvusrs`.`important-docs` WHERE (`id` = '".$_GET['did']."');";
    $deResult = mysqli_query($con,$delQuery);

    if ($deResult) {
      
      unlink($pathf['path']);
        $toast = 1;
        $msg = "delete successfull.";
      
    }
  }

  if (isset($_GET['toast'])==1) {
        $toast =1;
				$msg="Document Upload successfull";
  }
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6 text-bold">
            <h1 class="m-0 text-dark">Documents </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Documents</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline"  >
            <div class="card-header">
              <h4 class="card-title">Upload Documents</h4>
            </div>
            <!-- /.card-header -->
                <div class="card-body">
                
                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <span id="message"></span>
                            <form id="DocumentForm" enctype="multipart/form-data" method="post" >
                            
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
                            <button type="submit" name="fileuploadDocument" id="fileuploadDocument" class="btn btn-block btn-success">  
                              <span class="spinner-grow spinner-grow-sm load" role="status"></span> 
                              <span class="spinner-grow spinner-grow-sm load" role="status" ></span> 
                              <span class="spinner-grow spinner-grow-sm load" role="status"></span> 
                              <i class="fa fa-upload"></i> Import   
                              <span class="spinner-grow spinner-grow-sm load" role="status" ></span> 
                              <span class="spinner-grow spinner-grow-sm load" role="status" ></span> 
                              <span class="spinner-grow spinner-grow-sm load" role="status" ></span> </button>

                            </form>
                        </div>
                        <div class="col-md-3"></div>

                    </div>
                
                </div>    
          </div>
      </div>
    </section>

<!-- List of documents -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-danger card-outline"  >
            <div class="card-header">
              <h4 class="card-title">List Documents</h4>
            </div>
            <!-- /.card-header -->
                <div class="card-body" style="min-height: 450px;">
                
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Document title</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php 
                    $qyeryDoc = "SELECT * FROM rvusrs.`important-docs` where `type` != 'calender' order by `timestamp` desc ;";
                    $result = mysqli_query($con,$qyeryDoc);
                    $count=1;
                    while ($row= mysqli_fetch_array($result)) {?>

                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $row[1] ?></td>
                      <td> <?php echo $row[3] ?></td>
                      <td>
                      <div class="small">
                      <a href="<?php echo trim("../".$row[2]);?>" class="btn btn-success " tooltip-placement="top" tooltip="Edit"><i class="fa fa-file-download"></i></a>
                      
                      <a href="documents.php?did=<?php echo trim($row[0])?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-danger tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-trash-alt "></i></a>
                    </div>
                   

                      </td>
                     
                    </tr>
                    <?php $count++;
                    }
                  ?>
                    
                
                  </tbody>
                </table>
                
                </div>
        
            <!-- /.card-body -->
            <div class="card-footer">
              fill correct infromation properly 
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
</script>

<script>
$(document).ready(function(){
  $(".load").hide();


  $('#DocumentForm').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"importDocument.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#fileuploadDocument').attr('disabled', 'disabled');
        $(".load").show();
        $('#fileuploadDocument').val('Importing...');
      },
      success:function(data)
      {
        $(".load").hide();
        $('#message').html(data);
        $('#DocumentForm')[0].reset();
        $('#fileuploadDocument').attr('disabled', false);
        $('#fileuploadDocument').val('Import');
      }
    })
  });
});
</script>