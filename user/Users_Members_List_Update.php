<?php
if(isset($_POST["submit"])){
$MemberId = $_POST['MemberId'];
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."User_Members/User_MembersList.php";
$data = array("MemberId"=>$MemberId);
$postdata = json_encode($data);
//print_r($data);
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
///echo $result;
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Update Customer Details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Update Customer Details</li>
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

        <div class="col-md-11">
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
            <form action="action/Users_Members_List_Update_Post.php" method="post" enctype="multipart/form-data">

          </div>
            <label for="usr">Member's Name</label>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="hidden" name="MemberId" value="<?php echo $value1->MemberId; ?>">
            <input type="text" class="form-control" name="MemberName" value="<?php echo $value1->MemberName; ?>" autocomplete="off" data-toggle="tooltip">
          </div>
   

          <label for="usr">Father's Name</label>

          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="text" class="form-control" name="FatherName" value="<?php echo $value1->FatherName; ?>" autocomplete="off" data-toggle="tooltip">
          </div>
   
         
        
          <label for="usr">Mobile No</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-phone"></span>
              </div>
            </div>
            <input type="number" class="form-control" name="MemberPhone" value="<?php echo $value1->MemberPhone; ?>" data-toggle="tooltip">
          </div>

          <label for="usr">Email Id</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control" name="MemberEmail" value="<?php echo $value1->MemberEmail; ?>" data-toggle="tooltip">
          </div>

          <label for="usr">Address</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-home"></span>
              </div>
            </div>
            <input type="text" class="form-control" name="MemberAddress" value="<?php echo $value1->MemberAddress; ?>" autocomplete="off" data-toggle="tooltip">
          </div>
   

         <label for="usr">Pan No:</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
            <input type="text" class="form-control" name="MemberPAN" value="<?php echo $value1->MemberPAN; ?>" data-toggle="tooltip">
          </div>

          <label for="usr">Adhar No:</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
            <input type="number" class="form-control" name="MemberAadhar" value="<?php echo $value1->MemberAadhar; ?>" data-toggle="tooltip">
          </div>


      

          <div class="card-footer">
            <button type="submit" name="update_members" class="btn btn-primary">Update</button>
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