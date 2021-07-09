  
  <?php 
  if (isset($_POST['change'])) {
      
    $query = "UPDATE `rvusrs`.`admin_staff` SET 
    `fullname`='".$_POST['chfullname']."', 
    `phone`='".$_POST['chphone']."', 
    `email`='".$_POST['chemail']."', 
    `password`='".$_POST['chpass']."' 
    WHERE `id`='".$_SESSION['id']."';";
    
    if (mysqli_query($con,$query)) {
     $toast =1;
     $msg = "update successfull.";
    }else {
      $toast=2;
      $msg="update faild.";
    }

   

  }

?>
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-red  navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link text-white">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-white">Contact</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto ">

          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/default_picture.png" class="user-image img-circle elevation-2" alt="User Image">
              <span class="d-none d-md-inline text-bold text-white">
              <?php 
               
                $query = "SELECT fullname,roll FROM admin_staff WHERE id = '".$_SESSION['id']."';";
                $result = mysqli_query($con,$query);
                $row = mysqli_fetch_array($result);
                echo ucwords($row[0]);

              ?>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-danger">
                <img src="../dist/img/default_picture.png" class="img-circle elevation-2" alt="User Image">
    
                <p>
                  <?php  echo $row[0];?>
                  <small><?php echo $row[1] ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
              <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-default">
               Profile
                </button>

                  

                <a href="logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
              </li>
            </ul>
          </li>


        </li>


     
    </ul>
  </nav>
  <!-- /.navbar -->