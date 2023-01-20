<?php
//This page is used for Agent's bank  details update
date_default_timezone_set("Asia/kolkata");
include "include/header.php";
$url = $URL."Users_BankDetails/Users_BankDetailsRead.php";
$UserId=$_SESSION['login_session']->UserId;
$data = array( "UserId" =>$UserId);
//print_r($data);
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php if(isset($_SESSION['acount_update'])){?>
                <div class="alert alert-success" id="success-alert" role="alert">
                <?php echo $_SESSION['acount_update']; unset($_SESSION['acount_update'])?> 
               </div>
            <?php  }?>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Account Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Bank Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="image/profilepic.png"
                       alt="User profile picture">
                </div>

                <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>


<h3 class="profile-username text-center"><?php echo ucfirst($value1->UserName) ?></h3>

<p class="text-muted text-center"><?php echo  ucfirst($value1->UserRole) ?></p>

<ul class="list-group list-group-unbordered mb-3">
  
  <li class="list-group-item">
    <b>Mobile:</b> <a class="float-right"><?php echo $value1->Phone ?></a>
  </li>
  <li class="list-group-item">
    <b>Pan Card:</b> <a class="float-right"><?php echo $value1->PanNo ?></a>
  </li>
  <li class="list-group-item">
    <b>Adhar No:</b> <a class="float-right"><?php echo  ucfirst($value1->AadharNo) ?></a>
  </li>
  <li class="list-group-item">
    <b>Sponsor ID:</b> <a class="float-right"><?php echo $value1->sponsorId; ?></a>
  </li>
  <li class="list-group-item">
    <b>Email id:</b> <a class="float-right"><?php echo  lcfirst($value1->UserEmail) ?></a>
  </li>

</ul>
<?php
      }
    } 
 ?>
                <a href="User_Profile.php" class="btn btn-primary btn-block"><b>Go Back Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Account Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/User_Bank_Update_Post.php" method="post">
              <?php 
								               
                               foreach($result as $key => $value){
                               foreach($value as $key1 => $value1)
                                {
                              ?> 
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Account Holder Name*</label>
                    <input type="text" class="form-control" name="UserName" 
                    value=" <?php echo ucfirst($value1->UserName) ?>"
                     id="exampleInputemail" placeholder="rank" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Account No.*</label>
                    <input type="text" class="form-control" name="AccountNo" 
                    value=" <?php echo $value1->AccountNo ?>" 
                    id="exampleInputnumber" placeholder="Account No." autocomplete="off" required>
                </div>

				<div class="form-group">
                    <label>IFSC CODE*</label>
                    <input type="text"  class="form-control" name="IfscCode" 
                    value="<?php echo $value1->IfscCode ?>" placeholder="IFSC" autocomplete="off" required>
                </div>
				<div class="form-group">
                    <label for="exampleInputEmail1">BANK NAME*</label>
                    <input type="text" class="form-control" name="BankName" 
                    value="<?php echo ucfirst($value1->BankName) ?>" id="exampleInputtext" placeholder="Bank Name" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">BRANCH NAME*</label>
                    <input type="text" class="form-control" name="BranchName" 
                    value=" <?php echo ucfirst($value1->BranchName) ?>" 
                    id="exampleInputnumber" placeholder="Branch Name" autocomplete="off" required>
                </div>

            
                 
                            
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Account</button>
                </div>
                <?php 
                                      }
                                     } 
                                    ?>
              </form>
            </div>
<!-----------*******************------->			
            </div>
          </div>
       </div>
 </section>
    <!-- /.content -->
  </div>
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
