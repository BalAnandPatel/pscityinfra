<?php
include "include/header.php";
  $uid= $_SESSION["ID"];
	$url = $URL."bank_profile/read.php";
	$data = array( "id" => $uid);
	$postdata = json_encode($data);
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
	//curl_setopt($client, CURLOPT_POST, 5);
	curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
	$response = curl_exec($client);
  //print_r($response);
  $result = json_decode($response);
 // print_r($result);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Bank Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bank Detail</li>
              <li class="breadcrumb-item active">Update Bank Detail</li>
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
                <h3 class="card-title">UPDATE BANK DETAILS</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/update_bankdetail_post.php" method="post">
              <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>

                <div class="card-body">
                 <div class="form-group">
                    <label>Account Holder </label>
                    <input type="text"  class="form-control" name="account_holder" value="<?php echo $value1->name ?>"
                    readonly>
                  </div>
                  <div class="form-group">
                    <label>User id </label>
                    <input type="text"  class="form-control" name="account_holder" value="<?php echo $value1->userid?>"
                    readonly>
                  </div>
				         <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" name="bank_name"  placeholder="Your Bank Name" 
                    autocomplete="off" required>
                 </div>
				         <div class="form-group">
                    <label>Account Number</label>
                    <input type="text" class="form-control" name="account_no"
                      placeholder="Your Account Number" autocomplete="off" required>
                 </div>
				         <div class="form-group">
                    <label>IFSC Code</label>
                    <input type="text" class="form-control" name="ifsc"
                      placeholder="IFSC" autocomplete="off" required>
                 </div>

				         <div class="form-group">
                    <label>Branch Name</label>
                    <input type="text" class="form-control" name="branch"
                      placeholder="Branch Name" autocomplete="off" required>
                 </div>
               </div>
			         <div class="card-header">
                  <button type="submit" class="btn btn-primary">UPDATE </button>
               </div>
              </div>
              <?php
                      }
                    } 
                 ?>
              
                <!-- /.card-body -->
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