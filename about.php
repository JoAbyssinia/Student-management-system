<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();
$pagelication = 4;
include('_includes/navbar.php');

?>


<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="" data-aos="fade-in">
      <div class="container">
        <h2>about</h2>
        <p></p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about1.png" style="height: 415px; width: 500px; border-radius: 5px;" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <u> <h2>About</h2> </u>
            <h3>Historical Background of University</h3>
            <p class="text-justify" >
              When the first eager students set foot on the campus in Adama in October 2000, they beheld a very different setting from the spacious and forested compound with one modern building, and a number of blocks that house administrative offices, laboratories, libraries and quite a number of classrooms students see today. Ato Dinku Deyasa, a renowned investor and owner of NAFYAD PLC and Ato Reta Bekele, former President of Adama and Jima High Courts   envisaged the necessity of founding a private higher education institution mainly aimed at curbing the country’s death of qualified human resources. Needs analysis was conducted to identify the fields of study most desired by the community in and around Adama and Asella towns. On the basis of the findings, the founders made all the necessary preparations that would enable them to begin academic programs at a diploma level in five fields of study – namely, Accounting, Computer Science, Law, Marketing Management, and Secretarial Science and Office Management.

               The Oromia Justice Bureau officially registered RVU as a PLC under Registration No. W/D/0001/93 on August 3, 1993 EC. The Company’s authenticity was  publicized in the Addis Zemen, August 10, 2000 GC issue, by the Oromia Bureau of Trade and Tourism, which issued a Trade License No. 13/W/D/DH/YE/002/93 and a Registration ID No. 13/D/DH/I/093/93 to the organization. The first accreditation by the Ministry of Education in five diploma level programs of study was earned in the year 1993 EC. Currently the Ministry of Education and the Oromyia Regional Government Bureau of Education in collaboration with the Ministry of Health accredit RVU.

               Rift Valley University began operations in October 2000 in Adama Town, with a capital of 1,300,000 Eth. Birr, a total number of 154 evening program students, and five part time faculty staff. The Asella branch campus was begun three months later with Accounting, Law and Marketing Management being the fields of study. This new “learning community” was housed in just one rented block that consisted of a single administrative office and a few classrooms; by the end of the year 2000/2001 academic year, total enrolment at the two locations was about 250 students in the five diploma programs of study.

               In September 2003 and 2004, Gotera and Batu branch campuses came into being respectively; Bishoftu campus was created two years later followed by two other branch campuses – namely, Dire Dawa and Chiro, which went functional in August/September 2005. Bole and Gulele came into being in October 2005. Harar campus was created in October 2006. 

               When the institution was empowered to grant a bachelor’s degree, accounting, business management and law were the first academic programs on offer on the campus in Adama. </p>

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
      </section><
</main><!-- End #main -->



<?php 
include("_includes/footer-top.php");
include("_includes/footer.php");

?>

<script src="assets/vendor/php-email-form/validate.js"></script>