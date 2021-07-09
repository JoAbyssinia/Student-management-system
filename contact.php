<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();
$pagelication = 5;
include('_includes/navbar.php');

?>


<main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs" style="background-color: white;" data-aos="fade-in">
  <div class="container">
    <h2 style="color: gray;" > Contact Us</h2>
    <p style="color: gray;">we are here</p>
  </div>
</div><!-- End Breadcrumbs -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div data-aos="fade-up">
  
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1972.7952824476672!2d39.264509!3d8.539069!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5dd4e322beeaac6b!2sRift%20Valley%20Univarsity%2C%20Yunivarsitii%20Riift%20Vaalii!5e0!3m2!1sen!2set!4v1597956442862!5m2!1sen!2set" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>

  <div class="container" data-aos="fade-up">

    <div class="row mt-5">

      <div class="col-lg-4">
        <div class="info">
          <div class="address">
            <i class="icofont-google-map"></i>
            <h4>Location:</h4>
            <p>Adama, Oromia, Ethiopia</p>
          </div>

          <div class="email">
            <i class="icofont-envelope"></i>
            <h4>Email:</h4>
            <p>rvuadama4student@gmial.com</p>
          </div>

          <div class="phone">
            <i class="icofont-phone"></i>
            <h4>Call:</h4>
            <p>+251 455 455</p>
          </div>

        </div>

      </div>

      <div class="col-lg-8 mt-5 mt-lg-0">

        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
          <div class="form-row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
              <div class="validate"></div>
            </div>
            <div class="col-md-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validate"></div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
            <div class="validate"></div>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
            <div class="validate"></div>
          </div>
          <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>

      </div>

    </div>

  </div>
</section><!-- End Contact Section -->

</main><!-- End #main -->



<?php 
include("_includes/footer-top.php");
include("_includes/footer.php");

?>