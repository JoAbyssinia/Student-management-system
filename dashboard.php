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

$dashSidebar=1;
$pagelication = 6;
$subpagelication=61;
$toast=0;
include('_includes/navbar.php');
$tab=1;
?>


<?php 
  if (isset($_POST['updatePro'])) {

      if ($_SESSION['who']=="Inst") {
        $uery = "UPDATE `rvusrs`.`instructor` SET
        `phone` = '".$_POST['number']."',
         `email` = '".$_POST['emailA']."',
          `password` = '".$_POST['passA']."'
           WHERE 
           (`ins_id` = '".$_SESSION['user']."');"; 

      }elseif ($_SESSION['who']=="student") {
        
        $uery ="UPDATE `rvusrs`.`student` SET 
        `email` = '".$_POST['emailA']."', 
        `phone` = '".$_POST['number']."', 
        `password` = '".$_POST['passA']."' 
        WHERE (`st_id` = '".$_SESSION['user']."');";
            
      }
        
            $result = mysqli_query($con,$uery);
            if ($result) {
              $extra="dashboard.php?toast=1";
              $host=$_SERVER['HTTP_HOST'];
              $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
  
              echo "<script>  location.replace('http://$host$uri/$extra');  </script>";
            }else {
              $toast=2;
            }
  }

  if (isset($_POST['change'])) {
        if (isset($_FILES['pro-pic'])) {
          $allowed_extension = array('png', 'jpg');
          $img_array = explode(".", $_FILES["pro-pic"]["name"]);
          $img_extension = end($img_array);

          if (in_array($img_extension,$allowed_extension)) {

              $location = "admin/dist/storege/";      

              $img = addslashes($_FILES['pro-pic']['name']);
              $img_temp =$_FILES['pro-pic']['tmp_name'];
              
              $tempA = explode(".", $img);

              $userName = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.student where st_id='".$_SESSION['user']."' "));

              $img_new_name= ($tempA[0]."-".$userName[1].$userName[2].$userName[3]."-".date("Y").'.'.end($tempA));

                 
              if (move_uploaded_file($img_temp,$location.$img_new_name)) {

                if ($userName[13]!='assets/img/blank_avatar.png') {
                  
                  $img_path = explode("/",$userName[13]);
                  chdir($img_path[0]."/".$img_path[1]."/".$img_path[2]);
                  chown($img_path[3],465);
                  unlink($img_path[3]);
                }

                $upPic = "UPDATE `rvusrs`.`student` SET `profile` = '$location$img_new_name' WHERE (`st_id` = '".$_SESSION['user']."');";

                  if (mysqli_query($con,$upPic)) {

                    $extra="dashboard.php?toast=1";
                    $host=$_SERVER['HTTP_HOST'];
                    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        
                    echo "<script>  location.replace('http://$host$uri/$extra');  </script>";
                  }

               
              }
            

          }else {
            $tab=2;
            $toast=2;
          
          }

        }
  }

  if (isset($_GET['reg_id'])) {

        $regQ = "SELECT * FROM rvusrs.enroll where st_id='".$_GET['reg_id']."';";

        $resR = mysqli_query($con,$regQ);
        while ($row=mysqli_fetch_array($resR)) {
             mysqli_query($con,"UPDATE `rvusrs`.`enroll` SET `reg_st` = '1' WHERE (`st_id` = '$row[0]');");
        }

  }


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
                <h1 class="m-0 text-dark">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard </li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <section class="content" style="padding: 10px 10px;">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
    
                <!-- Profile Image -->
                <div class="card card-danger card-outline" style="min-height:510px;">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <?php 
                        if ($_SESSION['who']=="Inst") {?>
                          <img class="profile-user-img img-fluid img-circle"
                           src="assets/img/blank_avatar.png"
                           alt="User profile picture">
                        <?php }else {?>
                          <img style="height: 120px; width: 120px;" class="profile-user-img img-fluid img-circle"
                           src="<?php 
                            echo  $profS['profile'];  ?>"
                           alt="User profile picture">
                       <?php }
                      ?>
                      
                    </div>
    
                    <h3 class="profile-username text-center"> 
                     <?php
                      if ($_SESSION['who']=="student") {
                         echo  ucwords($profS[1]." ".$profS[2]." ".$profS[3]);
                      }else {
                        echo ucfirst ($prof[1]." ".$prof[2]);
                      }
                      ?> 
                  </h3>
    
                    <p class="text-muted text-center">
                     <?php 
                        if ($_SESSION['who']=="Inst") {
                          $headq = "SELECT * FROM rvusrs.department where dephead ='".$_SESSION['user']."';";
                          
                           $resH = mysqli_query($con,$headq); 
                           ?>
                             Instructor <?php echo  (mysqli_affected_rows($con)) ? "(Head)" : "" ; ?> </p>
                             <center> <big><?php echo $_SESSION['user'] ?> </big></center> 
                           <?php

                        }else {?>
                          Student <br> <big><?php echo $_SESSION['user'] ?> </big> 
                        <?php }
    
                     ?>   
                  
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Dep: </b> <a class="float-right"> <?php 
                          if ($_SESSION['who']=="Inst") {
                            echo $dep[0];
                          }else {
                             echo $depS[0];
                          }
                        ?> </a>
                      </li>
                      <?php 
                        if ($_SESSION['who']=="Inst") { ?>
                      <li class="list-group-item">
                        <b>Service</b> <a class="float-right"> <?php echo ucfirst($prof[3])." Time" ; ?> </a>
                      </li> 
                       <?php }else {?>
                      <li class="list-group-item">
                        <b>Division: </b> <a class="float-right"> 
                          <?php if ($profS[7]=="R") {
                                    echo "Regular";
                                  }elseif ($profS[7]=="W") {
                                    echo "Weekend";
                                  }elseif ($profS[7]=="E") {
                                    echo "Extention";
                                  } ?> </a>
                      </li> 
                       <?php }
                      ?>
                     
                      <li class="list-group-item">
                         <?php 
                          if ($_SESSION['who']=="Inst") { ?>
                          <b>phone</b> <a class="float-right">
                           <?php  echo $prof[7]; ?>
                          </a>
                         <?php  }else { ?>
                          <b>Acadamic Year:</b> <a class="float-right">
                           <?php  if ($profS['academic_year']=='grt') {
                                            echo "Graduated";
                                          }else {
                                            echo  $profS['academic_year'];
                                          } ?>
                           </a>
                        <?php }
                       
                         ?> 
                      </li>

                      <?php 
                        if ($_SESSION['who']=="student") {?>
                          <li class="list-group-item">
                         
                          <b>Section:</b> <a class="float-right">
                           <?php echo $profS['section']; ?>
                           </a>
                      </li>
                       <?php }
                      ?>

                     <!-- email -->
                         <?php  
                         if ($_SESSION['who']=="Inst") {?>
                          <li class="list-group-item text-center text-m">
                           <?php  echo $prof[8]; ?>
                            </li>
                          <?php }?> 
                     
                    </ul>
    
                   
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card card-danger card-outline">
                  <div class="card-header p-2">
                    <ul class="nav nav-fill ">
                      <li class="nav-item">
                        <a class="nav-link active" href="#activity" data-toggle="tab">Semister info</a>
                      </li>
                      <!-- student profile -->
                      <?php 
                        if ($_SESSION['who']=="student") {?>
                           <li class="nav-item">
                        <a class="nav-link" href="#profile" data-toggle="tab">Profile</a>
                      </li>
                      <?php }
                      ?>
                     
                      <li class="nav-item">
                        <a class="nav-link" href="#settings" data-toggle="tab">Edit profile</a>
                      </li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body" style="min-height: 450px;">
                    <div class="tab-content">
                      <div class="tab-pane fade show <?php echo ($tab==1) ? "active" : "" ; ?> " id="activity">
                        <!-- instructor course table -->
                       <?php 
                          if ($_SESSION['who']=="Inst") {?>
                          
                          <table class="table">
                          <thead>
                            <tr>
                              <th>Course</th>
                              <th>Department</th>
                              <th>Year</th>
                              <th>Division</th>
                              <th>Semister</th>
                              <th>Section</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $ass = "SELECT * FROM rvusrs.assigndetail1 where lecture = '".$_SESSION['user']."';";
                            $resultA = mysqli_query($con,$ass);
                            if (mysqli_affected_rows($con)) { 
                            while ($row=mysqli_fetch_array($resultA)) {?>

                            <tr>
                              <td><?php  
                                $crs = mysqli_fetch_array(mysqli_query($con,"SELECT course_tilte FROM rvusrs.course where cr_code = '".$row[0]."';"));
                                echo $crs[0];
                              ?></td>
                              <td><?php 
                                echo $row[2];
                              ?></td>
                              <td><?php 
                                echo $row[1]." Year";
                              ?></td>
                              <td>
                                <?php
                                  if ($row[3]=="R") {
                                    echo "Regular";
                                  }elseif ($row[3]=="W") {
                                    echo "Weekend";
                                  }elseif ($row[3]=="E") {
                                    echo "Extention";
                                  }
                                ?>
                              </td>
                              <td> 
                                  <?php 
                                    echo $row[4];
                                  ?>
                              </td>
                              <td> 
                                  <?php 
                                    echo $row[6];
                                  ?>
                              </td>
                            </tr>  
                            <?php  }
                            }else{?>
                                
                              <tr>
                                <td colspan="6" class="text-center" > Not assign yet </td>
                              </tr>
                              <?php  }
                            
                          ?>

                          </tbody>
                        </table>

                        <?php  }else{
                       ?>     
                          <!-- student table -->
                        
                        <table class="table">
                          <thead>
                            <tr>
                              <th>C. code</th>
                              <th>Course Title</th>
                              <th style="width: 100px; text-align: center; " >Cr. Hr.</th>
                              <th class="text-center" >prerequisite</th>
                              <th>Instructor</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php  
                              $reg=0;
                              $thour=0;
                              $queReg = "SELECT * FROM rvusrs.enroll where st_id='".$_SESSION['user']."';";
                              $resultReg =mysqli_query($con,$queReg);
                                  
                              if (mysqli_affected_rows($con)) { 
                                while ($row=mysqli_fetch_array($resultReg)) { 
                                    $reg =$row['reg_st'];
                                    $reg_en = $row['reg'];
                                  ?>
                                 <tr>
                                   <td> <?php echo strtoupper($row[1]) ?> </td>
                                   <td><?php 
                                      $cors= mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.course where cr_code='$row[1]';"));
                                      echo $cors[1];
                                   ?></td>

                                   <td class="text-center"> <?php  $thour = intval($cors[3])+ $thour; 
                                    echo $cors[3] ?> </td>
                                   <td><?php echo strtoupper($cors[5]) ?></td>
                                   <td><?php 
                                      $inst= mysqli_fetch_array(mysqli_query($con,"SELECT fname,lname FROM rvusrs.instructor where ins_id='$row[7]';"));
                                      echo $inst[0]." ".$inst[1];
                                   ?></td>
                                 </tr> 
                              <?php 
                               }?>
                            <tr class="bg-gradient-danger" >
                              <th colspan="2">Total</th>
                              <td colspan="3" > <?php   echo $thour; ?> </td>
                            </tr>
                            <tr>
                              <td colspan="5">
                                <div class="float-right">
                                  <?php 
                                    if ($reg && $reg_en) {?>
                                        <span class="text text-success "> <i class="fa fa-registered"></i> Registered </span>
                                    <?php }elseif ($reg && !$reg_en) {?>
                                         <span class="text text-info "> <i class="fa fa-check-circle"></i> registration requested... </span>
                                    <?php }else { ?>
                                      <a href="dashboard.php?reg_id=<?php echo $_SESSION['user']?>">
                                       <button class="btn btn-success"> regester </button></a>
                                  <?php }
                                  ?>
                                </div>
                               
                              </td>
                            </tr>
                           <?php }else {?>
                                
                            <tr>
                              <td colspan="5" class="text-center" > Not assign yet </td>
                            </tr>
                            <?php  }
                            ?>
                            
                          </tbody>
                        </table>


                        <?php } ?> 
                      </div>


                      <!-- profile -->
                      <?php 
                        if ($_SESSION['who']=="student") {?>
                            <div class="tab-pane fade" id="profile">
                          <table class="table table-borderless ">
                            <tbody>
                                 <tr>
                                  <td> 
                                    <table>
                                      <tr>
                                        <th>ID:</th>
                                        <td><?php echo $profS[0]; ?></td>
                                      </tr>
                                      <tr>
                                        <th>First name:</th>
                                        <td><?php echo $profS[1]; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Father name:</th>
                                        <td><?php echo $profS[2]; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Grand Father name:</th>
                                        <td><?php echo $profS[3]; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Gender:</th>
                                        <td><?php echo $profS[4]; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Birth of date:</th>
                                        <td><?php echo $profS[5]; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Admission Date:</th>
                                        <td><?php  $date = explode(" ", $profS[8]); echo $date[0]; ?></td>
                                      </tr>
                                    </table>
                                </td>
                                  <td> 
                                  <table >
                                      <tr>
                                        <th>Department:</th>
                                        <td><?php
                                        $qd = "SELECT depname FROM rvusrs.department where dep_code = '".$profS[6]."';";
                                        $rd = mysqli_query($con,$qd);
                                        $dep = mysqli_fetch_array($rd);
                   
                                        echo $dep[0];
                                        ?></td>
                                      </tr>
                                      <tr>
                                        <th>Acadamic Year:</th>
                                        <td><?php 
                                          if ($profS['academic_year']=='grt') {
                                            echo "Graduated";
                                          }else {
                                            echo  $profS['academic_year'];
                                          }
                                        ?></td>
                                      </tr>
                                      <tr>
                                        <th>Division:</th>
                                        <td><?php echo $profS['division']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Section:</th>
                                        <td><?php echo $profS['section']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Email:</th>
                                        <td><?php echo $profS['email']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Phone:</th>
                                        <td><?php echo $profS['phone']; ?></td>
                                      </tr>
                                      
                                    </table> 
                                 </td>
                                </tr>  
                                                  
                            </tbody>
                          </table>
                      </div>
                    
                      <?php }?>
                      
                    
                      <!-- /.tab-pane -->
    
                      <div class="tab-pane fade show <?php echo ($tab==2) ? "active" : "" ; ?>" id="settings">
                      

                        <?php 
                          if ($_SESSION['who']=="student") {?>
                          <form enctype="multipart/form-data" method="post">
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Profile Picture</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="pro-pic" required class="custom-file-input" id="exampleInputFile">
                                  <label class="custom-file-label" disabled for="exampleInputFile">Choose profile picture</label>
                                </div>
                                <div class="input-group-append">
                                  <button type="submit" name="change"  class="btn btn-block btn-danger">Change</button>
                                </div>
                              </div>
                            </div>
                           </div>
                          </form>
                          <hr>
                        <?php  }
                        ?>

                        <form class="form-horizontal"  method="post"> 
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" name="emailA" class="form-control" value="<?php 
                                echo ($_SESSION['who']=="student") ? $profS['email'] : $prof['email'] ;
                             ?>" id="inputEmail" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="number" id="inputName2" value="<?php 
                                 echo ($_SESSION['who']=="student") ? $profS['phone'] : $prof['phone'] ;
                               ?>" placeholder="phone number">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">
                            <?php 
                              if ($_SESSION['who']=="student" && $profS['password']="stu123rvu") {?>
                                <small class="text-sm text-red">password is default</small>   
                              <?php }else if ($prof[9]=="inst123rvu" && $_SESSION['who']=="Inst") {?>
                              <small class="text-sm text-red">password is default</small>
                           <?php  } ?>
                            password  </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"  name="passA"  value="<?php 
                               echo ($_SESSION['who']=="student") ? $profS['password'] : $prof['password'] ; ?>" id="inputSkills" placeholder="Password">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" name="updatePro" class="btn btn-danger">update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        </div>
      </div>
    </div>
  
  </main><!-- End #main -->


  <footer id="footer">
<?php 
include("_includes/footer.php");
?>
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
        title: ' profile update successfull.'
      })
      <?php  }else if($toast==2) { ?>
        Toast.fire({
        icon: 'error',
        title: ' profile update failed.' 
      })
     <?php }
      ?>
      

    });
  </script>
