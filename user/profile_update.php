<?php
date_default_timezone_set("Asia/kolkata");
include "include/header.php";
$url = $URL."admin/agent_registration_read.php";
$user_id=$_SESSION['login_session']->agent_id;
$data = array( "agent_id" =>$user_id);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
//$uid=$_SESSION["ID"];
//$img="img/".$uid."/profile"."/".$uid.".png";
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
                       src="new.jpg"
                       alt="User profile picture">
                </div>

                <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>


<h3 class="profile-username text-center"><?php echo ucfirst($value1->name) ?></h3>

<p class="text-muted text-center"><?php echo  ucfirst($value1->agent_id) ?></p>

<ul class="list-group list-group-unbordered mb-3">
  
  <li class="list-group-item">
    <b>Mobile:</b> <a class="float-right"><?php echo $value1->mobile ?></a>
  </li>
  <li class="list-group-item">
    <b>Pan Card:</b> <a class="float-right"><?php echo $value1->pan ?></a>
  </li>
  <li class="list-group-item">
    <b>Adhar No:</b> <a class="float-right"><?php echo  ucfirst($value1->aadhaar) ?></a>
  </li>
  <li class="list-group-item">
    <b>Sponsor ID:</b> <a class="float-right"><?php echo  ucfirst($value1->sponsor_id) ?></a>
  </li>
  <li class="list-group-item">
    <b>Email id:</b> <a class="float-right"><?php echo  lcfirst($value1->email) ?></a>
  </li>

</ul>
<?php
      }
    } 
 ?>
                <a href="profile.php" class="btn btn-primary btn-block"><b>Go Back Profile</b></a>
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
              <form action="action/agent_registration_update_post.php" method="post">
              <?php 
								               
                               foreach($result as $key => $value){
                               foreach($value as $key1 => $value1)
                                {
                              ?> 
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Rank*</label>
                    <input type="email" class="form-control" name="email" 
                    value=" <?php echo $value1->rank ?>"
                     id="exampleInputemail" placeholder="rank" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Father Name.*</label>
                    <input type="text" class="form-control" name="father_name" 
                    value=" <?php echo $value1->father_name ?>" 
                    id="exampleInputnumber" placeholder="Mobile NO." autocomplete="off" required>
                </div>

				<div class="form-group">
                    <label>Date of birth*</label>
                    <input type="date"  class="form-control" name="dob" 
                    value="<?php  $date1=explode(' ',$value1->dob);
                     echo $date1[0] ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                </div>
				<div class="form-group">
                    <label for="exampleInputEmail1">Address*</label>
                    <input type="text" class="form-control" name="address" 
                    value="<?php echo $value1->address ?>" id="exampleInputtext" placeholder="User Address" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">status.*</label>
                    <input type="text" class="form-control" name="status" 
                    value=" <?php echo $value1->status ?>" 
                    id="exampleInputnumber" placeholder="rank." autocomplete="off" required readonly>
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
