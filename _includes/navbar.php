<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">
        <img src="assets/img/logo-rvu.png" class="image img-circle" alt="">
        RVU adama</a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class=" <?php if ($pagelication==1) {
           echo "active";
          } ?> " ><a href="index.php">Home</a></li>
         <li class=" <?php if ($pagelication==2) {
           echo "active";
          } ?> " ><a href="timeline.php">Timeline</a></li>

         <li class="drop-down  <?php if ($pagelication==3) {
               echo "active";
               } ?> "><a href="#"> Acadamics </a>
            <ul>
               
              <li class=" <?php if ($subpagelication==1) {
               echo "active";
               } ?> "  ><a href="calender.php">Calender</a></li>
              <li class=" <?php if ($subpagelication==2) {
               echo "active";
               } ?> " ><a href="imp-documents.php">Documents</a></li>
            
            </ul>
          </li>
           <li class=" <?php if ($pagelication==4) {
            echo "active";
            } ?> " ><a href="about.php">About</a></li>

          <li class=" <?php if ($pagelication==5) {
           echo "active";
          } ?> "><a href="contact.php">Contact</a></li>


           <?php 


               if ($_SESSION['user']!="" && $_SESSION['who']!=""  ) {

                  if ($_SESSION['who']=="student") {
                  $sq = "SELECT fname,mname FROM rvusrs.student where st_id = '".$_SESSION['user']."'";
                  }else {
                  $sq = "SELECT fname,lname FROM rvusrs.instructor where ins_id= '".$_SESSION['user']."'";
                  }

                  $res=mysqli_query($con,$sq);
                  $name = mysqli_fetch_array($res); 

                  ?>
                  
                  <li class="drop-down <?php if ($pagelication==6) {
                     echo "active";
                    } ?>   "><a href="#"><i class="fa fa-user-alt"></i> <?php echo $name[0]." ".$name[1] ?> </a>
                     <ul>
                     
                     <li class=" <?php if ($subpagelication==61) {
                        echo "active";
                        } ?> " ><a href="dashboard.php  " >Dashboard</a></li>
                     <li><a href="logout.php">log out</a></li>
                     
                     </ul>
                  </li>

            <?php   }

           ?> 

        </ul>
      </nav><!-- .nav-menu -->
       
      <?php 

           if ($_SESSION['user']=="" || $_SESSION['who']=="" ) { ?>
          <a href="login.php" class="get-started-btn ">Login </a>
      <?php } 
      
      ?>
                  
     

    </div>
  </header><!-- End Header -->
