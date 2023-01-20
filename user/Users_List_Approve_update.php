<?php
//This page is used for Agent Listing where usertype=3 . Used by admin
include "include/header.php";
$token=$_SESSION['token'];
$LogingUserType=$_SESSION['login_session']->UserType;
$LoginUserRole=$_SESSION['login_session']->userRole;
if(isset($_POST['update'])){
$url = $URL."Users/Users_List_ById.php";
$UserId=$_POST['UserId'];
$Status=1;
$data = array( "UserId"=>$UserId);
//print_r($data);
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
} 
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Update Agent Details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Update Agent Details</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <?php if (isset($_SESSION['user_create'])) { ?>
        <div class="alert alert-success" id="success-alert" role="alert">
          <?php echo $_SESSION['user_create'];
          unset($_SESSION['user_create']) ?>
        </div>
      <?php  } ?>
      <div class="row">

        <div class="col-md-11 m-auto">
          <!---------------************--------->
           <?php 
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>
          <!-- Main content -->
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="action/Users_List_Approve_update_post.php" method="post" enctype="multipart/form-data">
               <div class="card-body">
          <label for="usr">Agent Id</label>
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="agent_id" value="<?php echo $value1->UserId; ?>" readonly> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div> 
        </div>

         <label for="usr">Sponsor Id</label>
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="agent_id" value="<?php echo $value1->sponsorId; ?>" readonly> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div> 
        </div>

         <label for="usr">Parent Id</label>
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="agent_id" value="<?php echo $value1->parentId; ?>" readonly> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div> 
        </div>

         <label for="usr">Position</label>
          <div class="input-group mb-3">
          <input type="text" class="form-control" name="agent_id" value="<?php echo $value1->position; ?>" readonly> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div> 
        </div>

            <label for="usr">Agent Name</label>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="hidden" name="Id" value="<?php echo $value1->UserId; ?>">
            <input type="text" class="form-control" name="UserName" value="<?php echo $value1->UserName; ?>" autocomplete="off" data-toggle="tooltip">
          </div>
   
         
        
          <label for="usr">Mobile No</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-mobile"></span>
              </div>
            </div>
            <input type="number" class="form-control" name="Phone" value="<?php echo $value1->Phone; ?>" data-toggle="tooltip">
          </div>

         <label for="usr">Pan No:</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
            <input type="text" class="form-control" name="PanNo" value="<?php echo $value1->PanNo; ?>" data-toggle="tooltip">
          </div>

          <label for="usr">Adhar No:</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
            <input type="number" class="form-control" name="AadharNo" value="<?php echo $value1->AadharNo; ?>" data-toggle="tooltip">
          </div>


         <label for="usr">Password</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>

            <input type="text" class="form-control" name="Password" value="<?php echo $value1->Password; ?>" data-toggle="tooltip">
          </div>

      

          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Update</button> <button type="Cancel" name="Cancel" class="btn btn-primary">Cancel</button>
          </div>
          </form>
        </div>
        <?php } } ?>
        <!-----------*******************------->
      </div>
    </div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- <script>
  $(function() {
    bsCustomFileInput.init();
  });
</script> -->

<?php
include "include/footer.php";

?>