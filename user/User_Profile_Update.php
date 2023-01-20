<?php
//This profile is used by both agent and admin to update self profile details. 
date_default_timezone_set("Asia/kolkata");
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."Users/User_Login_Details.php";
$UserId=$_SESSION['login_session']->UserId;
$data = array( "UserId" =>$UserId);
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Profile Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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

<p class="text-muted text-center"><?php echo  ucfirst($value1->UserId) ?></p>

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
    <b>Sponsor ID:</b> <a class="float-right"><?php echo  ucfirst($value1->sponsorId) ?></a>
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
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/User_Profile_Update_Post.php" method="post">
              <?php 
								               
                               foreach($result as $key => $value){
                               foreach($value as $key1 => $value1)
                                {
                              ?> 
                <div class="card-body">
                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Rank*</label>
                    <input type="email" class="form-control" name="email" 
                    value=" <?php echo $value1->rank ?>"
                     id="exampleInputemail" placeholder="rank" readonly>
                </div> -->

                <div class="form-group">
                    <label for="exampleInputEmail1">User Name*</label>
                    <input type="text" class="form-control" name="UserName" 
                    value="<?php echo ucfirst($value1->UserName) ?>" 
                    id="exampleInputnumber" placeholder="Mobile NO." autocomplete="off" required readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">status*</label>
                    <input type="text" class="form-control" name="Status" 
                    value=" <?php if($value1->Status=1) echo "Active" ?>" 
                    id="exampleInputnumber" placeholder="rank." autocomplete="off" required readonly>
                </div>

				<div class="form-group">
                    <label>Date of birth*</label>
                    <input type="date"  class="form-control" name="UserDOB" 
                    value="<?php  $date1=explode(' ',$value1->UserDOB);
                     echo $date1[0] ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                </div>
				<div class="form-group">
                    <label for="exampleInputEmail1">Address*</label>
                    <input type="text" class="form-control" name="Address" 
                    value="<?php echo ucfirst($value1->Address) ?>" id="exampleInputtext" placeholder="User Address" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email*</label>
                    <input type="text" class="form-control" name="UserEmail" 
                    value=" <?php echo $value1->UserEmail ?>" 
                    id="exampleInputnumber" placeholder="email" autocomplete="off" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Aadhar*</label>
                    <input type="text" class="form-control" name="AadharNo" 
                    value=" <?php echo $value1->AadharNo ?>" 
                    id="exampleInputnumber" placeholder="email" autocomplete="off" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pan No.*</label>
                    <input type="text" class="form-control" name="PanNo" 
                    value=" <?php echo $value1->PanNo ?>" 
                    id="exampleInputnumber" placeholder="email" autocomplete="off" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone No.*</label>
                    <input type="text" class="form-control" name="Phone" 
                    value=" <?php echo $value1->Phone ?>" 
                    id="exampleInputnumber" placeholder="email" autocomplete="off" required >
                </div>
              
                            
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
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
