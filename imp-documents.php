<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();
$pagelication = 3;
$subpagelication = 2;
include('_includes/navbar.php');

?>


<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="" data-aos="fade-in">
      <div class="container">
        <h2>Acadamic Documents</h2>
        <p></p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          
          <div class="col-lg-9 pt-4 pt-lg-0 order-2 order-lg-1 content">
             <h2>Acadamic Documents </h2>

             <table class="table ">
               <thead>
                 <tr>
                   <th>name</th>
                   <th> <i class="fa fa-file-pdf"></i> download</th>
                   <th>date</th>
                 </tr>
               </thead>
               <tbody>
                  
               <?php 
                $cquery = "SELECT * FROM rvusrs.`important-docs` where type='important' order by timestamp desc;";
                $resultc = mysqli_query($con,$cquery);
                while ($row=mysqli_fetch_array($resultc)) {?>
                 
                 <tr>
                   <td><?php echo $row[1] ?></td>
                   <td> <a href="<?php echo "admin".$row[2] ?>">
                     <button class="btn btn-success">Download</button>
                   </a>
                     </td>
                   <td> <?php 
                    $date = explode(" ",$row[3]);
                   echo $date[0] ?> </td>
                 </tr>

               <?php }

               ?>


               </tbody>
             </table>


            
          </div>
          <div class="col-lg-3 order-1 order-lg-2   text-center " data-aos="fade-left" data-aos-delay="100">
            
            <blockquote style="border-left: .7rem solid #dc3545;">
              this is Rift Valley Unversity for better education. <br>
              Exellence for Development. 
            </blockquote>

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