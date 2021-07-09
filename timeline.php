<?php 
include("connection/connection.php");
session_start();
include('_includes/header.php');
include('_includes/logincheck.php');
check_login();
$pagelication = 2;
include('_includes/navbar.php');

?>
<?php 
$id =1;
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
  }
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
          <div class="col-lg-4 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <div class="card card-danger card-outline">
              <div class="card-header">
                  <div class="card-title">
                    Letest posts
                  </div>
              </div>
              <div class="card-body">
                  <table class="table">
                    <?php 
                     $rsult=mysqli_query($con,"SELECT * FROM rvusrs.timeline order by date desc");

                     while ($row=mysqli_fetch_array($rsult)) {
                    ?>
                   
                    <tr>
                      <th> <?php echo $row[1] ?> </th>
                      <td><?php echo (substr( html_entity_decode($row['msg']),0,50))  ?></td>
                    </tr>

                    <tr>
                      <td class="text-center"><a href="timeline.php?id=<?php echo $row['id'] ?>"> Read more </a></td>
                      <td  class="text-gray" > <small> <i class="fa fa-clock"></i> <?php  
                      $date = explode(" ",$row['date']);
                      echo  $date[0] ?> </small> </td>
            
                    </tr>
               <?php }?>
                   
                  </table>
              </div>
            </div>
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 order-2 order-lg-1 content">

            <?php
            if (!isset($_GET['id'])) {
             
              $news = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.timeline order by date desc")); 
            }else {
              $news = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.timeline where id='$id';"));
              
            }
           
            ?>
           
            <h3>Timeline blog posts</h3>
            <hr>
              <table class="table table-sm table-borderless">
                <tr>
                  <th colspan="2"> <h2><?php echo ucfirst( $news['subject']) ?> </h2> </th> 
                </tr>
                <tr>
                  <td ><?php  
                    $adim = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM rvusrs.admin_staff where id ='".$news['from']."'"));

                    echo "From: ".$adim['fullname'];
                  ?></td>
                  <td class="float-right text-gray"> <i class="fa fa-clock"></i> <?php  
                      $date = explode(" ",$news['date']);
                      echo  $date[0] ?></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo $news['office'] ?></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo "To: ".$news['to'] ?></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo html_entity_decode($news['msg']) ?></td>
                </tr>
                <tr>
                  <td colspan="2">Tel: <?php echo $news['cont_tel'] ?></td>
                </tr>
                <tr>
                  <td colspan="2">email: <?php echo $news['cont_email'] ?></td>
                </tr>
              </table>

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

<script src="assets/vendor/php-email-form/validate.js"></script>