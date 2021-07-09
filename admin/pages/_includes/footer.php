  
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Profile</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="#" method="post">

              <?php
                 $query = "SELECT fullname,email,phone,password FROM admin_staff WHERE id='".$_SESSION['id']."';";
                 $result = mysqli_query($con,$query);
                 $row = mysqli_fetch_array($result);
              ?>
              <div class="form-group">
                <label for="doctorname">full name</label>
                <input type="text" name="chfullname"  class="form-control" value="<?php  echo ucwords($row[0]); ?> "  placeholder="user name" >
              </div>
              <div class="form-group">
                <label for="doctorname">email</label>
                <input type="email" name="chemail"  class="form-control"  value="<?php  echo ucwords($row[1]); ?> "  placeholder="email" >
              </div>
              <div class="form-group">
                <label for="doctorname">phone</label>
                <input type="text" class="form-control" name="chphone" placeholder="phone number"   value="<?php  echo ucwords($row[2]); ?> " data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
              </div>
             <div class="form-group">
                <label for="doctorname">Password</label>
                <?php 
               
                  if ( trim($row[3]," ") =="Adminstaff") {
                ?>
                 <small class="text-red">(password is default) </small>
                <?php   
                  }
                ?>
                <input type="text" name="chpass"  class="form-control"   value="<?php  echo ucwords($row[3]); ?> " placeholder="password" >
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="change" class="btn btn-success">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
   </div>
  
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="text-lg-center">
    
      <strong>Copyright &copy; 2020 RVU Adama.</strong> All rights reserved.

    </div>
    <!-- Default to the left -->
    
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>

<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>

<?php 
   if ($toast==1) {
     
    echo "<script type='text/javascript'>  
    toastr.success('$msg') 
     </script>";

  }else if ($toast==2) {
    echo "<script type='text/javascript'>  
    toastr.error('$msg.') 
     </script>";
  }
?>