<?php 
include("../../connection/connection.php");
session_start();
include('_includes/checklogin.php');
check_login();
include('_includes/header.php');
$toast = 0;
$asidelocation=0;
$asidesubelocation=0;
?>

<?php 
 include('_includes/navbar.php');
?>

<?php 
 include('_includes/aside.php');
?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashbourd</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashbourd</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <!-- ./col -->
       
          <!-- small box -->
          <?php 
            if ($_SESSION['roll']=="admin") {?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>
                      <?php 
                        $sql = mysqli_query($con,"SELECT count(*) FROM rvusrs.student;");
                        $no = mysqli_fetch_array($sql);
                        echo $no[0];
                      ?>

                    </h3>

                    <p>Total Students</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user-alt"></i>
                    
                  </div>
                  <a href="view-student.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                 <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      
                    <?php 
                        $sql = mysqli_query($con,"SELECT count(*) FROM rvusrs.instructor;");
                        $no = mysqli_fetch_array($sql);
                        echo $no[0];
                      ?>
                    
                    </h3>

                    <p>Total Instructor</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user-tie"></i>
                  </div>
                  <a href="view-instructor.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
             <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>
                    
                  <?php 
                        $sql = mysqli_query($con,"SELECT count(*) FROM rvusrs.admin_staff;");
                        $no = mysqli_fetch_array($sql);
                        echo $no[0];
                    ?>
                    

                  </h3>

                  <p>Total admin staffs</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users-cog"></i>
                </div>
                <a href="view-admin-staff.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>

                  <?php 
                        $sql = mysqli_query($con,"SELECT count(*) FROM rvusrs.department;");
                        $no = mysqli_fetch_array($sql);
                        echo $no[0];
                    ?>

                  </h3>

                  <p>Total Deprtments</p>
                </div>
                <div class="icon">
                  <i class="fa fa-building"></i>
                </div>
                <a href="view-departement.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

           <?php }else if(trim($_SESSION['roll']," ")=="data") {?>
           
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><small>
                    <?php 
                      $regSt = mysqli_num_rows(mysqli_query($con,"SELECT count(*) FROM rvusrs.enroll where reg_st=1 and reg=1 GROUP BY st_id ;"));
                    
                     echo $regSt."/";
                     $regStTo = mysqli_num_rows(mysqli_query($con,"SELECT count(*) FROM rvusrs.enroll GROUP BY st_id ;"));
                     echo $regStTo;
                    ?>
                   </small> </h3>

                  <p>Registered Students</p>
                </div>
                <div class="icon">
                  <i class="fa fa-registered"></i>
                  
                </div>
                <a href="student-register.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>  <small>
                    <?php  
                    $subG = mysqli_fetch_array(mysqli_query($con,"SELECT count(*) FROM rvusrs.grade_submit"));
                     echo $subG[0] ?>
                  </small></h3>

                  <p>Submited grades </p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-tie"></i>
                </div>
                <a href="submited.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php 
                        $sql = mysqli_query($con,"SELECT count(*) FROM rvusrs.admin_staff where roll = 'data'");
                        $no = mysqli_fetch_array($sql);
                        echo $no[0];
                    ?></h3>

                  <p>Total admin staffs</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users-cog"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3> <?php 
                        $sql = mysqli_query($con,"SELECT count(*) FROM rvusrs.department;");
                        $no = mysqli_fetch_array($sql);
                        echo $no[0];
                    ?></h3>

                  <p>Total Deprtments</p>
                </div>
                <div class="icon">
                  <i class="fa fa-building"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          <?php }

           
          ?>
       
          

      
       
        <!-- ./col -->
      </div>




      <div class="row">
              <h4 class="m-2 text-gray">Recent posts</h4> 
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="timeline">
            <!-- one post -->
            
            
            <?php 
                $notSql = mysqli_query($con,"SELECT subject,msg,timeline.id,date,office,fullname FROM rvusrs.timeline inner join admin_staff on `from`= admin_staff.id order by date desc limit 5;");
                while ($row=mysqli_fetch_array($notSql)) {
                ?>  
             


            <div><i class="fas fa-newspaper bg-cyan"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> <?php echo $row[3] ?></span>
                <h3 class="timeline-header"><a href="#">  <?php echo $row[5] ?> </a> <span class="text-sm">  <?php echo $row[4] ?>  </span> 
                  <br>
                  <br>
                <span class="product-title text-bold"> <i class="fa fa-hand-point-right"></i>  <?php echo $row[0] ?></span>
                </h3>
               
                <div class="timeline-body">
                <?php echo html_entity_decode(substr($row[1],0,250)."..."); ?>
                </div>
                <div class="timeline-footer">
                  <a href="read-timeline.php?pcond=<?php echo $row[2] ?>" class="btn btn-info btn-sm">Read more</a>
                </div>
              </div>
            </div>

            <?php }
            ?>
            <!-- /one post -->
           

          </div>
        </div>
      </div>
        
    </section>


    <!-- recccent post  -->


  </div>
  <!-- /.content-wrapper -->

  
  <?php 
 include('_includes/footer.php');
?>






