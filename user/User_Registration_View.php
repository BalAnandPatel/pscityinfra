<?php
//This page is used by admin to view the login details of created agents.
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL . "Users/User_Login_Details.php";
$UserId=$_GET['Uid'];
$data = array("UserId" => $UserId);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agent Login Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Agent</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  <!-- Content Header (Page header) -->
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <?php if(isset($_SESSION['user_create'])){?>
                <div class="alert alert-success" id="success-alert" role="alert">
                <?php echo $_SESSION['user_create']; unset($_SESSION['user_create'])?> 
               </div>
               <?php  }?>
        <div class="row">
          
          <div class="col-md-10">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agent Login Detail- Please save it for future use</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="User_Create.php" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>
      
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
          <input type="text" class="form-control" placeholder="User ID- <?php echo  $value1->UserId ?>"  required autocomplete="off" readonly> 
          </div>

        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Name- <?php echo  ucfirst($value1->UserName) ?>"  required autocomplete="off" readonly> 
        </div>
      <div class="input-group mb-3">
      <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <input type="text" class="form-control" placeholder="Password -<?php echo  $value1->Password ?>"  required autocomplete="off" readonly> 
         
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

          <input type="text" class="form-control" placeholder="Position- <?php echo  $value1->position ?>"  required autocomplete="off" readonly> 
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Parent ID- <?php echo  $value1->parentId ?>"  required autocomplete="off" readonly> 
        </div>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Sponsor ID- <?php echo  $value1->sponsorId ?>"  required autocomplete="off" readonly> 
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
              <span class="fas fa-id-card"></span>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Registration Date- <?php echo date("d/m/y",$value1->CreatedOn) ?>"  required autocomplete="off" readonly> 
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