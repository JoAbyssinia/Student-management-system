<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();
$pagelication = 3;
$subpagelication = 1;
include('_includes/navbar.php');

?>


<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="" data-aos="fade-in">
      <div class="container">
        <h2>Acadamic calender</h2>
        <p></p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          
          <div class="col-lg-9 pt-4 pt-lg-0 order-2 order-lg-1 content">
             <h2>Acadamic calender</h2>

             <table class="table table-bordered ">
               <thead>
                 <tr>
                   <th>Activity</th>
                   <th>1st semister</th>
                   <th>2nd semister</th>
                 </tr>
               </thead>
               <tbody>
                  
               <?php 
                $cquery = "SELECT * FROM rvusrs.`acadamic-calender`;";
                $resultc = mysqli_query($con,$cquery);
                while ($row=mysqli_fetch_array($resultc)) {?>
                 
                 <tr>
                   <td><?php echo $row[1] ?></td>
                   <td> <?php echo $row[2] ?> </td>
                   <td> <?php echo $row[3] ?> </td>
                 </tr>

               <?php }

               ?>


               </tbody>
             </table>


            
          </div>
          <div class="col-lg-3 order-1 order-lg-2   text-center " data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/pdficon1.png" style="height: 140px; width: 120px; border-radius: 5px;" class="img-fluid m-5" alt="">
            
            <?php 
               $cquer = "SELECT * FROM rvusrs.`important-docs` where `type` = 'calender';";
               $result = mysqli_query($con,$cquer);
               $data = mysqli_fetch_array($result);
            ?>
            
            <a href="<?php echo "admin".$data[2] ?>">
              <button class="btn btn-danger btn-block"> <i class="fa fa-file-download"></i> <?php echo $data[1] ?> </button>
            </a>


          </div>

        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
  
</main><!-- End #main -->





<?php 
include("_includes/footer-top.php");
include("_includes/footer.php");

?>