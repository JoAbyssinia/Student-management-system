

 <div class="col-md-2 elevation-2 sidebar-light-danger  elevation-2">
         


       <div class="sidebar" style="margin-top: 100px;">
         <!-- Sidebar user panel (optional) -->
         <?php 
                  if ($_SESSION['who']=="Inst") {
                     $nimP = "SELECT * FROM rvusrs.instructor where ins_id = '".$_SESSION['user']."' ;";
                     $rsP = mysqli_query($con,$nimP);
                     $prof = mysqli_fetch_array($rsP);   
                  }else {
                    $nimP = "SELECT * FROM rvusrs.student where st_id = '".$_SESSION['user']."' ;";
                    $rsP = mysqli_query($con,$nimP);
                    $profS = mysqli_fetch_array($rsP);  
                  }
                
               ?>

         <div class="user-panel mt-3 pb-3 mb-3 d-flex "> 
           <div class="image">
             <?php 
              if ($_SESSION['who']=="Inst") {?>
             <img src="assets/img/blank_avatar.png" class="img-circle elevation-2" alt="User Image">
             <?php }else { ?>
             <img src="<?php echo $profS['profile'] ?>" style="width: 40px; height: 40px;" class="img-circle elevation-2" alt="User Image">
             <?php }
             ?>
           </div>
           <div class="info">
            <p class="text text-gray-dark" > 
              

               <?php   if ($_SESSION['who']=="Inst") {
                 echo ucwords($prof[1]." ".$prof[2]);
               }else {
                echo ucwords($profS[1]." ".$profS[2]."<br>".$profS[3]);
               }
                 ?>
            <br> 
            <?php  if ($_SESSION['who']=="Inst") { ?>
            Instructor <br> <small> 
                  <?php 

                     $qd = "SELECT depname,dephead FROM rvusrs.department where dep_code = '".$prof[5]."';";
                     $rd = mysqli_query($con,$qd);
                     $dep = mysqli_fetch_array($rd);
                     
                     echo $dep[0];

                    if ($dep[1]==$_SESSION['user']) {
                      $head=1;
                    }else {
                      $head=0;
                    }

                   ?>   
           </small> </p>
            <?php }else {?>
            <strong> Student </strong>   <br> <small>
              <?php 
              $depS = mysqli_fetch_array(mysqli_query($con,"SELECT depname FROM rvusrs.department where dep_code = '".$profS[6]."';"));
              echo $depS[0];
              ?>
              </small>
           <?php } ?>
           </div>
         </div>
   
         <!-- Sidebar Menu -->
         <nav class="mt-2">
           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"     ta-accordion="false">
           
            <!--  dashbourd -->
               <li class="nav-item">
                 <a href="dashboard.php" class="nav-link  <?php if ($dashSidebar==1) {
                   echo "active";
                 } ?> ">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                    Dashboard
                   </p>
                 </a>
               </li>

               <?php 
                if ($_SESSION['who']=="Inst") {?>

                       <!-- instructor-->
                  <?php 
                    if ($head) {?>
                    
                  <li class="nav-item has-treeview <?php echo ($dashSidebar==3) ? "menu-open" : "" ;   ?>">
                    <a href=""  class="nav-link <?php echo ($dashSidebar==3) ? "active" : "" ;   ?> ">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Instructor 
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="assigned-instructor.php" class="nav-link <?php echo ($subdashpagelication==31) ? "active" : "" ;   ?>  ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Assign </p>
                        </a>
                      </li>
                    </ul>
                  </li>  

                <?php }
                  ?>

           

             <!-- grade -->         
             <li class="nav-item has-treeview <?php echo ($dashSidebar==4) ? "menu-open" : "" ;   ?> ">
               <a href="#" class="nav-link  <?php echo ($dashSidebar==4) ? "active" : "" ;   ?>">
                 <i class="nav-icon fas fa-chart-bar"></i>
                 <p>
                   Grade 
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="submit-grade.php" class="nav-link <?php echo ($subdashpagelication==41) ? "active" : "" ;   ?>   ">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Submit grade</p>
                   </a>
                 </li>
                <?php 
                  if ($head) {?>
                       <li class="nav-item">
                   <a href="view-submitted.php" class="nav-link  <?php echo ($subdashpagelication==42) ? "active" : "" ;?> ">
                     <i class="far fa-circle nav-icon"></i>
                     <p>view submited</p>
                   </a>
                 </li>
                <?php  }
                ?>
            

               </ul>
             </li>
                  <!-- Course  -->
             <li class="nav-item has-treeview menu <?php echo ($dashSidebar==2) ? "menu-open" : "" ;   ?>  ">
               <a href="#" class="nav-link <?php echo ($dashSidebar==2) ? "active" : "" ;   ?>  ">
                 <i class="nav-icon fas fa-briefcase"></i>
                 <p>
                   Course
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">

                <?php
                  if ($head) {?>

                  <li class="nav-item">
                   <a href="assign-course.php" class="nav-link <?php echo ($subdashpagelication==21) ? "active" : "" ;   ?>  ">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Assign</p>
                   </a>
                 </li>
                  <?php }
                ?>
                 <li class="nav-item">
                   <a href="view-assigned.php" class="nav-link <?php echo ($subdashpagelication==22) ? "active" : "" ;   ?>  ">
                     <i class="far fa-circle nav-icon"></i>
                     <p>View Assigned</p>
                   </a>
                 </li>

               </ul>
             </li>

             <?php
              if ($head) {?>
                  <li class="nav-item has-treeview <?php echo ($dashSidebar==5) ? "menu-open" : "" ;   ?> ">
               <a href="#" class="nav-link  <?php echo ($dashSidebar==5) ? "active" : "" ;   ?>">
                 <i class="nav-icon fas fa-question-circle"></i>
                 <p>
                   Request 
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="add-request.php" class="nav-link <?php echo ($subdashpagelication==51) ? "active" : "" ;   ?> ">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Add Request</p>
                   </a>
                 </li>
                <?php 
                  if ($head) {?>
                       <li class="nav-item">
                   <a href="drop-request.php" class="nav-link  <?php echo ($subdashpagelication==52) ? "active" : "" ;?> ">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Drop Request</p>
                   </a>
                 </li>
                <?php  }
                ?>
            

               </ul>
             </li>

             <?php }
             ?>
             <!--request -->      
           

               <?php }else{?>
                  <!-- acadamic history -->
               <li class="nav-item">
                 <a href="acadamic-history.php" class="nav-link  <?php if ($dashSidebar==2) {
                   echo "active";
                 } ?> ">
                   <i class="nav-icon fas fa-history"></i>
                   <p>
                    Academic History
                     </p>
                 </a>
               </li>

               <li class="nav-item">
                 <a href="add-drop.php" class="nav-link  <?php if ($dashSidebar==3) {
                   echo "active";
                 } ?> ">
                   <i class="nav-icon fas fa-question-circle"></i>
                   <p>
                   Add and drop
                     </p>
                 </a>
               </li>


               <?php }
               ?>

           </ul>
         </nav>
         <!-- /.sidebar-menu -->
       </div>
       <!-- /.sidebar -->
 
   </div>