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
          <h1 class="m-0">Site Entry</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Site Entry</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-12">
          <!---------------************--------->
          <!-- Main content -->
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Site Entry</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="action/site_create_post.php" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-box"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Enter Site Name" name="plot_location_name" required autocomplete="off">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-boxes"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Enter Section" name="section" required autocomplete="off">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-vertical">&nbsp;&nbsp;</span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Enter Plot Depth(Feet)" name="plot_depth" required autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-layer-group"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Total Ploted Area(Square Feet)" name="total_ploted_area" required autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign">&nbsp;&nbsp;</span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Amount (Per Square Feet)" name="price_per_square_feet" required autocomplete="off">
                </div>
                <!--        <input type="hidden" name="rand_check" value="<?php echo $rand; ?>">-->


                <!-- /.card-body -->

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
    $(function() {
      bsCustomFileInput.init();
    });
  </script>

  <?php
  include "include/footer.php";
  ?>