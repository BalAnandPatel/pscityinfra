<?php
include "include/header.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                      </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-11">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Enter New Password</h3>
              </div>
             
              <form action="action/change_password_post.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">

                  <div class="input-group">
                      
                        <input type="text" name="Password" class="form-control" 
                        placeholder="Enter New Password" autocomplete="off" required>
</div>
              
                    </div>
                  </div>
                </div>
              

                <div class="card-footer">
                  <button type="submit" name="updatepass" class="btn btn-primary">Change Password</button>
                </div>
              </form>
            </div>
<!-----------*******************------->			
            </div>
          </div>
       </div>
 </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<?php
include "include/footer.php";
?>