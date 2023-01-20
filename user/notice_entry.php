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
            <h1 class="m-0">Notice Entry</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notice Entry</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  <!-- Content Header (Page header) -->  <!-- Content Header (Page header) -->
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
                <h3 class="card-title">Notice Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/notice_post.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
  
          <div class="input-group mb-3">
          <select class="form-control" name="notice_type">
             <option class="form-control" value="Please Select">Please Select Notice Type</option>
             <option class="form-control" value="Agent Notice">Agent Notice</option>
             <option class="form-control" value="Public Notice">Public Notice</option>
             
         </select>
       </div>
	
       <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Notice" name="content" required autocomplete="off"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-money"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="date" class="form-control" placeholder="Notice Start Date" name="start_date" required autocomplete="off"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-money"></span>
            </div>
          </div>
        </div>

        
        <div class="input-group mb-3">
          <input type="date" class="form-control" placeholder="Notice Expire Date" name="end_date" required autocomplete="off"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-money"></span>
            </div>
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