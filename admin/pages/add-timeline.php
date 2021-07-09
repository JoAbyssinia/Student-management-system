<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=2;
$asidesubelocation=1;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>


<?php 
$cont_ph= "0985742136";
$cont_email = "rvuadamaregisrar@gmail.com";

  if (isset($_GET['post'])) {
 
    $query = "INSERT INTO `rvusrs`.`timeline` 
    (`subject`, `msg`, `to`, `office`, `from`, `cont_tel`, `cont_email`) 
    VALUES 
    ('".$_GET['subject']."','".htmlentities($_GET['msg'])."', '".$_GET['to']."', '".$_GET['office']."', '".$_SESSION['id']."', '".$cont_ph."', '".$cont_email."');";
    $result = mysqli_query($con,$query);

    if ($result) {
      $toast = 1;
      $msg = "add timeline post Successfull.";
    }else {
      $toast=2;
      $msg = "faild";
    }
    
  }


?>

<!-- summernote -->
<link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">add timeline</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Timeline</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      
     <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="card card-danger card-outline" style="min-height: 500px;">
              <div class="card-header">
                <h3 class="card-title">Compose New timeline post </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form role="form" name="timeline" method="GET" onSubmit="return valid();" >
                      <div class="form-group">
                        <input class="form-control" name="to" placeholder="To:" required="true">
                      </div>
                      <div class="form-group">
                        <input class="form-control" name="subject" placeholder="sublect:" required="true">
                      </div>
                      <div class="form-group">
                        <input class="form-control" name="office" required="true" placeholder="office: registrar office or computer science department">
                      </div>
                      <div class="form-group" >
                          <textarea id="compose-textarea" name="msg" required="true" data-placeholder="write hire..."
                          class="form-control" ></textarea>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <div class="float-left">
                        <button type="submit" name="post" class="btn btn-success"><i class="far fa-arrow-alt-circle-up"></i> Post</button>
                      </div>
                      <div class="float-right">
                        <p> <strong>coution: </strong> please anyware befor using apostrof (') user backslash frist e.g: student\'s </p>
                      </div>
                  </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div> 
          

        </div>
      </div>
      
    </section>


    <!-- recccent post  -->


  </div>

<?php 
 include('_includes/footer.php');
?>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    $('#compose-textarea').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
});
  

  })
  
</script> 



