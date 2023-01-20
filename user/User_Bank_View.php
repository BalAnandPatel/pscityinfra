<?php
//This page is redirected to View the agent bank details after submitting the details.
include "include/header.php";
$url = $URL . "Users_BankDetails/Users_BankDetailsRead.php";
$UserId=$_GET['Uid'];
echo $UserType;
$data = array("UserId" => $UserId);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
?>

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Bank Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Bank Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  <!-- Content Header (Page header) -->
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-10">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- <div class="card-header">
                <h3 class="card-title">Agent Login Detail- Please save it for Further Use</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              <form action="User_Bank_Create.php" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>
 <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Registration Date- <?php echo  $value1->UserName ?>"  required autocomplete="off" readonly> 
        </div>

              <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Role- <?php echo  $value1->userRole ?>"  required autocomplete="off" readonly> 
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Aadhar No- <?php echo  $value1->AadharNo ?>"  required autocomplete="off" readonly> 
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Pan No- <?php echo  $value1->PanNo ?>"  required autocomplete="off" readonly> 
        </div>
       

        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
          <input type="text" class="form-control" placeholder="Bank Name- <?php echo  $value1->BankName ?>"  required autocomplete="off" readonly> 
          </div>

        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Branch Name- <?php echo  $value1->BranchName ?>"  required autocomplete="off" readonly> 
        </div>
      <div class="input-group mb-3">
      <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <input type="text" class="form-control" placeholder="Ifsc Code -<?php echo  $value1->IfscCode ?>"  required autocomplete="off" readonly> 
         
                      </div>
              

<?php }
                     }
?>
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">BACK TO REGISTRATION</button>
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