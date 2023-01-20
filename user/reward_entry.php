<?php
//session_start();
include "include/header.php";

//$rand=$rand(10,10000);
//$_SESSION['my_rand']=$rand;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Reward Entry</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reward Entry</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
                <h3 class="card-title">Reward Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/reward_entry_post.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
  
          
       <div class="input-group mb-3">
            <div class="input-group-text">
            <i class="fa fa-award"></i>
            </div>
          <input type="text" class="form-control" placeholder="Reward Name" name="name" required autocomplete="off"> 
          <div class="input-group-append">
          </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">
            <i class="fa fa-award"></i>
            </div>
          <input type="text" class="form-control" placeholder="Reward Amount" name="amount" required autocomplete="off"> 
          <div class="input-group-append">
          </div>
        </div>

        
        <div class="input-group mb-3">
            <div class="input-group-text">
            <i class="fa fa-award"></i>
            </div>
          <input type="text" class="form-control" placeholder="Level" name="level" required autocomplete="off"> 
          <div class="input-group-append">
          </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-text">
              <span class="fa fa-clock"></span>
            </div>
          <input type="text" class="form-control" placeholder="Duration" name="duration" required autocomplete="off"> 
          <div class="input-group-append">
          </div>
        </div>
       

       

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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