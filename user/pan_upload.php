<?php
include "include/header.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pan Upload</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pan Upload</li>
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
                <h3 class="card-title">UPLOAD SCANNED COPY OF PAN CARD</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/pan_post.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">

                  <div class="input-group">
                      
                        <input type="text" name="pan" class="form-control" placeholder="Enter PAN Number" autocomplete="off" required>
</div>
                    <label for="exampleInputFile">Upload your pan card</label>
              
                      <div class="custom-file">
                     
                        <input type="file" name="fileUpload" class="custom-file-input" id="exampleInputFile" required>
                        <label class="custom-file-label" for="exampleInputFile" >Choose file</label>
                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Upload</button>
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