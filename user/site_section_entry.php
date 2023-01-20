<?php
include "include/header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php if(isset($_SESSION['siteEntry'])){?>
                <div class="alert alert-danger rounded-0" id="success-alert" role="alert">
                <?php echo $_SESSION['siteEntry']; unset($_SESSION['siteEntry'])?> 
               </div>
            <?php  }?>
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
    <?php if (isset($_SESSION['siteEntry'])) { ?>
        <div class="alert alert-success" id="success-alert" role="alert">
          <?php echo $_SESSION['siteEntry'];
          unset($_SESSION['siteEntry']) ?>
        </div>
      <?php  } ?>
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
            <form action="action/site_section_entry_post.php" method="post">
              <div class="card-body">
               <div class="form-group">
                <lebel>Site Name*</lebel>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-box"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Enter Site Name" name="SiteName" required autocomplete="off" data-toggle="tooltip" title="Please Enter Site Name">
                </div>
              </div>

              <div class="form-group">
              <lebel>Site Section*</lebel>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-boxes"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="SiteSection" name="SiteSection" required autocomplete="off" data-toggle="tooltip" title="Please Enter Section Name Such as : A,B etc.">
                </div>
              </div>
               
                <div class="form-group">
                <lebel>Plot Depth(In Feet)*</lebel>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-vertical">&nbsp;&nbsp;</span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Enter Plot Depth(Feet)" name="SiteDepth" required autocomplete="off" data-toggle="tooltip" title="Please Enter Plot Depth (In Feet)">
                </div>
              </div>
               
                <div class="form-group">
                <lebel>Total Ploted Area(Square Feet)*</lebel>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-layer-group"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Total Ploted Area(Square Feet)" name="SiteTotalArea" required autocomplete="off" data-toggle="tooltip" title="Please Enter Total Ploted Area(Square Feet)">
                </div>
              </div>

                <div class="form-group">
                <lebel>Amount (Per Square Feet)*</lebel>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign">&nbsp;&nbsp;</span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Amount (Per Square Feet)" name="SitePricePerSquareFeet" required autocomplete="off" data-toggle="tooltip" title="Please Enter Amount (Per Square Feet)">
                </div>
              
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button> <button type="cancel" name="cancel" class="btn btn-primary">Cancel</button>
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