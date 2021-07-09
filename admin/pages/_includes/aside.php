 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-red elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link elevation-4" style="background-color: #343a40;">
      <img src="../dist/img/logo_rvu.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">RVU Adama <br>Student Registration System </span> <br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: 40px;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex "> 
        <div class="image">
          <img src="../dist/img/default_picture.png" class="img-circle elevation-3" alt="User Image">
        </div>
        <div class="info">
         <p class="text text-white" > 
          <?php 
             $query = "SELECT fullname,roll FROM admin_staff WHERE id = '".$_SESSION['id']."';";
             $result = mysqli_query($con,$query);
             $row = mysqli_fetch_array($result);
             echo ucwords($row[0]);
          ?>
         <br> <?php  if ($row[1]=='data') {
           echo ucfirst($row[1])." Encoder";
         }else{
             echo ucfirst($row[1]);
             } ?> </p>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
         <!--  dashbourd -->
         <li class="nav-item">
              <a href="dashboard.php" class="nav-link <?php if($asidelocation==0){echo "active";}else{ echo "";} ?> ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                 Dashboard
                </p>
              </a>
            </li>

            <!-- acadanic calender -->

            <li class="nav-item">
              <a href="acadamic-calender.php" class="nav-link <?php if($asidelocation==1){echo "active";}else{ echo "";} ?> ">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                 Acadamic calender
                </p>
              </a>
            </li>
      <?php 
        $roll= $_SESSION['roll'];

        if ($roll=="admin") {
      ?>
           

               <!-- open menu   -->
          <li class="nav-item has-treeview <?php if($asidelocation==2){echo "menu-open";}else{ echo "menu";} ?> ">
            <a href="#" class="nav-link <?php if($asidelocation==2){echo "active";}else{ echo "";} ?> ">
              <i class="nav-icon fas fa-hourglass-start"></i>
              <p>
                Timeline
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-timeline.php" class="nav-link <?php if($asidesubelocation==1){echo "active";}else{ echo "";} ?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add  post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-timeline.php" class="nav-link <?php if($asidesubelocation==2){echo "active";}else{ echo "";} ?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view post</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- student add -->

          <li class="nav-item has-treeview <?php if($asidelocation==3){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==3){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Student 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_student.php" class="nav-link <?php if($asidesubelocation==31){echo "active";}else{ echo "";} ?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>add student </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-student.php" class="nav-link <?php if($asidesubelocation==32){echo "active";}else{ echo "";} ?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Student</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- add instracter -->         
          <li class="nav-item has-treeview <?php if($asidelocation==4){echo "menu-open";}else{ echo "menu";} ?> ">
            <a href="#" class="nav-link <?php if($asidelocation==4){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Instructor 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-instructor.php" class="nav-link <?php if($asidesubelocation==41){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Instructor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-instructor.php" class="nav-link <?php if($asidesubelocation==42){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Instructor</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Course  -->

          <li class="nav-item has-treeview <?php if($asidelocation==5){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==5){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Course
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-course.php" class="nav-link  <?php if($asidesubelocation==51){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-course.php" class="nav-link  <?php if($asidesubelocation==52){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Course</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Departement -->

          <li class="nav-item has-treeview <?php if($asidelocation==6){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==6){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Departement
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-departement.php" class="nav-link <?php if($asidesubelocation==61){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Departement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-departement.php" class="nav-link <?php if($asidesubelocation==62){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Departement</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- facality  -->

          <li class="nav-item has-treeview <?php if($asidelocation==7){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==7){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Faculty
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-faculty.php" class="nav-link  <?php if($asidesubelocation==71){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Faculty</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-faculty.php" class="nav-link <?php if($asidesubelocation==72){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view Faculty</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- staff admin  -->

          <li class="nav-item has-treeview <?php if($asidelocation==8){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==8){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Admin Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-admin-staff.php" class="nav-link  <?php if($asidesubelocation==81){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-admin-staff.php" class="nav-link  <?php if($asidesubelocation==82){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View staff</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview <?php if($asidelocation==9){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==9){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="documents.php" class="nav-link  <?php if($asidesubelocation==91){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doucments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sections.php" class="nav-link  <?php if($asidesubelocation==92){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="transfer.php" class="nav-link  <?php if($asidesubelocation==93){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transfer</p>
                </a>
              </li>
            </ul>
          </li>


        <?php
        }elseif ($roll=="data") {
        ?>

            <li class="nav-item">
              <a href="submited.php" class="nav-link <?php if($asidelocation==3){echo "active";}else{ echo "";} ?> ">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                  Instructor Subminted
                </p>
              </a>
            </li>

               <!-- open menu   -->
          <li class="nav-item ">
            <a href="upload-grade.php" class="nav-link <?php if($asidelocation==4){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-hourglass-start"></i>
              <p>
                Grade
              </p>
            </a>
          </li>

          <!-- register -->

          <li class="nav-item">
            <a href="student-register.php" class="nav-link  <?php if($asidelocation==5){echo "active";}else{ echo "";} ?> ">
              <i class="nav-icon fas fa-registered"></i>
              <p>
               Register
              </p>
            </a>
          </li>


          <!-- add and drop -->

          <li class="nav-item has-treeview <?php if($asidelocation==6){echo "menu-open";}else{ echo "menu";} ?>">
            <a href="#" class="nav-link <?php if($asidelocation==6){echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Requestes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add-request.php" class="nav-link  <?php if($asidesubelocation==61){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="drop-request.php" class="nav-link  <?php if($asidesubelocation==62){echo "active";}else{ echo "";} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Drop request</p>
                </a>
              </li>
            </ul>
          </li>
        <?php
        }else{
       
        }


      ?>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
