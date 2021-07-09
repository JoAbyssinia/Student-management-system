<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();

$pagelication = 1;
$subpagelication=0;
include('_includes/navbar.php');

?>
   <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Rift Vally University<br>Excellence<br>for Development</h1>
      <!-- <h2>Excellence for Development</h2> -->
      <a href="admin/dist/apk/RVU adama.apk" class="btn-get-started">Get Rvu adama srs on mobile.</a>
    </div>
  </section>

  <main id="main">

<!-- ======= About Section ======= -->
      <section id="about" class="about">
         <div class="container" data-aos="fade-up">

         <div class="section-title">
            <h2>About</h2>
            <p>About RVU adama</p>
         </div>

         <div class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about1.png" style="height: 415px; width: 500px; border-radius: 5px;" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Historical Background of University</h3>
            <p class="font-weight-normal text-justify">
               When the first eager students set foot on the campus in Adama in October 2000, they beheld a very different setting from the spacious and forested compound with one modern building, and a number of blocks that house administrative offices, laboratories, libraries and quite a number of classrooms students see today. Ato Dinku Deyasa, a renowned investor and owner of NAFYAD PLC and Ato Reta Bekele, former President of Adama and Jima High Courts   envisaged the necessity of founding a private higher education institution mainly aimed at curbing the country’s death of qualified human resources. Needs analysis was conducted to identify the fields of study most desired by the community in and around Adama and Asella towns. On the basis of the findings, the founders made all the necessary preparations that would enable them to begin academic programs at a diploma level in five fields of study – namely, Accounting, Computer Science, Law, Marketing Management, and Secretarial Science and Office Management
            </p>
            <a href="about.php" class="learn-more-btn">Learn More</a>
            </div>
         </div>

      </div>
      </section><!-- End About Section -->

      <!-- ======= Counts Section ======= -->
      <section id="counts" class="counts section-bg">
         <div class="container">

         <div class="row counters">

            <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
               <?php 
               $sq = "SELECT count(*) FROM rvusrs.student;";
               $result = mysqli_query($con,$sq);
               $nu = mysqli_fetch_array($result);
               echo $nu[0];

               ?>

            </span>
            <p>Students</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
            <?php 
               $sq = "SELECT count(*) FROM rvusrs.instructor;";
               $result = mysqli_query($con,$sq);
               $nu = mysqli_fetch_array($result);
               echo $nu[0];

               ?>
            </span>
            <p>Instractor</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
            <?php 
               $sq = "SELECT count(*) FROM rvusrs.faculty;";
               $result = mysqli_query($con,$sq);
               $nu = mysqli_fetch_array($result);
               echo $nu[0];

               ?>
            </span>
            <p>Faculty</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">
            <?php 
               $sq = "SELECT count(*) FROM rvusrs.department;";
               $result = mysqli_query($con,$sq);
               $nu = mysqli_fetch_array($result);
               echo $nu[0];

               ?>
            </span>
            <p>Department</p>
            </div>

         </div>

      </div>
      </section><!-- End Counts Section -->



      <!-- ======= Popular Courses Section ======= -->
      <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

         <div class="section-title">
            <h2>Department</h2>
            <p>Popular Depaetments</p>
         </div>

         <div class="row" data-aos="zoom-in" data-aos-delay="100">

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
               <img src="assets/img/computersciecse.jpg" style="height: 235px;" class="img-fluid" alt="...">
               <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Computer science</h4>
                  
                  </div>

                  <h3><a href="#">Techinology</a></h3>
                  <p>we pationet to learn our students 21 first secnturey courses.</p>
                  
               </div>
            </div>
            </div> <!-- End Course Item-->

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
               <img src="assets/img/accounting.jpg" style="height: 235px;"  class="img-fluid" alt="...">
               <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Accounting</h4>
                  </div>

                  <h3><a href="#">Business and Social Science</a></h3>
                  <p>we stands of our counter developent, our studentes are qualify everyware.</p>
                  
               </div>
            </div>
            </div> <!-- End Course Item-->

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="course-item">
               <img src="assets/img/medicne.jpg" style="height: 235px;" class="img-fluid" alt="...">
               <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Medicine</h4>
                  
                  </div>

                  <h3><a href="#">Health Sciences</a></h3>
                  <p>we work for the socaity, by study and qualifeing our students  </p>
                  
               </div>
            </div>
            </div> <!-- End Course Item-->

         </div>

      </div>
      </section><!-- End Popular Courses Section -->


</main><!-- End #main -->

<?php 
include("_includes/footer-top.php");
include("_includes/footer.php");

?>