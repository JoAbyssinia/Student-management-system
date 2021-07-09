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


$dashSidebar=3;
$pagelication = 6;
$subpagelication=61;
$toast=0;
include('_includes/navbar.php');
  
$TotalChoure=0;
$TotalGpoint=0;
?>

<?php
  
  if(isset($_POST['addrequest'])) {

    $query = "INSERT INTO `rvusrs`.`addcourse` 
    (`st_id`, `cr_code`,`dep`, `year`, `div`, `section`) 
    VALUES 
    ('".$_SESSION['user']."', '".$_POST['cor']."','".$_POST['dep']."', '".$_POST['ayr']."', '".$_POST['div']."', '".$_POST['sec']."');";
    $result = mysqli_query($con,$query);

    if ($result) {
      $toast=1;
    }else {
      $toast=2;
    }

  }

?>

<?php 
    if (isset($_POST['dropcourse'])) {
      $query= "INSERT INTO `rvusrs`.`dropcourse` (`st_id`, `cor_code`,`dip`)
       VALUES ('".$_SESSION['user']."', '".$_POST['cord']."','".$_POST['dep']."');";

      echo $query;
      $result = mysqli_query($con,$query);

      if ($result) {
        $toast=1;
      }else {
        $toast=2;
      }
    }
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
                <h1 class="m-0 text-dark">Add and Drop</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Add and Drop</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
          
        <section class="content " style="padding: 10px 10px;">
          <div class="row">
            <div class="col-md-6 col-sm-12 card card-danger card-outline" >
              <div class="card-header">
                <h3 class="card-title">Add form</h3>
              </div>
              <form method="post">
              <input type="hidden" name="dep" value="<?php echo $profS[6] ?>">
              <div class="card-body">
                  <div class="form-group">
                    <label>Course</label>
                    <select class="select2bs4" name="cor" required="true" data-placeholder="Select a Courses"
                            style="width: 100%;">
                      <option></option>      
                     <?php 
                      $pc = explode(",",$row[5]);
                      
                      $sql=mysqli_query($con," SELECT * FROM rvusrs.course where offering_dep = '".$prof[5]."' or catagory = 'common'; ");
                      while($rowC=mysqli_fetch_array($sql)){?>
                          <option value="<?php echo $rowC[0];?>" ><?php echo "(".$rowC[0].") ".$rowC[1] ?></option> 
                       <?php 
                      } ?>
              
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Year</label>
                    <select class="select2bs4" name="ayr" required="true" data-placeholder="Select a yar"
                            style="width: 100%;">
                      <option></option>  
                      <option value="1st" > 1st year </option>  
                      <option value="2nd" > 2nd year </option>  
                      <option value="3rd" > 3rd year </option>  
                      <option value="4th" > 4th year </option>  
                      <option value="5th" > 5th year </option>  
                    
                    </select>
                  </div>      

                  <div class="form-group">
                    <label>Division</label>
                    <select class="select2bs4" name="div" required="true" data-placeholder="Select a Division"
                            style="width: 100%;">
                      <option></option>  
                      <option value="R" > Regular </option>  
                      <option value="E" > Extention </option>  
                      <option value="W" > Weekend </option>  
                    
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Section</label>
                    <input type="number" class="form-control" name="sec" placeholder="insert section(defualt value 1)" required="true">
                  </div>
              </div>
              <div class="card-footer">
                      <button type="submit" name="addrequest" class="btn btn-success">send request</button>
              </div>
              <!-- /.card -->
              </form>
            </div>
            <!-- add card end -->

            <div class="col-md-6 col-sm-12 card card-danger card-outline " >
              <div class="card-header">
                <h3 class="card-title">Drop form</h3>
              </div>
              <div class="card-body">
                <form method="post">
                <input type="hidden" name="dep" value="<?php echo $profS[6] ?>">
                  <div class="form-group">
                    <label>Course</label>
                    <select class="select2bs4" name="cord" required="true" data-placeholder="Select a Courses"
                            style="width: 100%;">
                      <option></option>      
                     <?php 
                      $pc = explode(",",$row[5]);
                      $sql=mysqli_query($con," SELECT cr_code FROM rvusrs.enroll where st_id = '".$_SESSION['user']."'; ");

                      while($rowC=mysqli_fetch_array($sql)){?>
                          <option value="<?php echo $rowC[0];?>" ><?php echo "(".$rowC[0].") ";
                            $nameC = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code='".$rowC[0]."';"));
                            echo $nameC[0];
                          ?></option> 
                       <?php 
                      } ?>
                    </select>
                  </div>
                
                      <button type="submit" name="dropcourse" class="btn btn-danger">Drop request</button>
             
              </div>
              
              </form>

              <!-- /.card -->
            </div>
          </div>
        </section>

        <section class="content " style="padding: 10px 10px;">
          <div class="row">
            <div class="col-md-12 col-sm-12 card card-danger card-outline" >
                <div class="card-header">
                  Course add reqeust list
                </div> 
                <div class="card-body">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>#</th>
                         <th>Course title</th>
                         <th>Academic year</th>
                         <th>Division</th>
                         <th>Section</th>
                         <th>State</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php 
                       $count=1;
                        $res = mysqli_query($con,"SELECT * FROM rvusrs.addcourse where st_id='".$_SESSION['user']."' order by timestamp desc ;");
                        while ($row=mysqli_fetch_array($res)) {?>
                          
                        <tr>
                          <td>
                            <?php echo $count ?>
                          </td>
                          <td>
                            <?php 
                              $crname = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code='$row[1]';"));
                              echo $crname[0];
                            ?>
                          </td>
                          <td>
                            <?php 
                              echo $row[3]." year";
                            ?>
                          </td>
                          <td><?php 
                           
                            if ($row[4]=="R") {
                              echo "Regular";
                            }elseif ($row[4]=="E") {
                              echo "Extention";
                            }elseif ($row[4]=="W") {
                              echo "Weekend";
                            } 

                          ?></td>
                          <td>
                            <?php 
                              echo $row[5];
                            ?>
                          </td>
                          <td>
                            <span>
                            <?php 
                            
                              if ($row[7]==0) {
                                echo "Requested";
                              }elseif ($row[7]==1) {
                                echo "Dep Approved";
                              }elseif ($row[7]==2) {
                                echo "Submited ";
                              }
                            ?>
                            </span>
                          </td>
                        </tr>

                      <?php $count++;  }
                       ?>
                      
                     </tbody>
                   </table>   
                </div>
                <div class="card-footer">
                  this request list show only semister requestes
                </div>
            </div>
          </div>
        <section>
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
        title: ' Request failed.' 
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
 
