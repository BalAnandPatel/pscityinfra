<?php
//This page is for agent /Admin profile.
include "include/header.php";
$token=$_SESSION['token'];
 $url = $URL."Users/User_Login_Details.php";
$UserId=$_SESSION['login_session']->UserId;
$UserRole=$_SESSION['login_session']->userRole;
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome your profile <?php echo ucwords($result->records[0]->UserName); ?></h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
          <?php if(isset($_SESSION['user_profile'])){?>
                <div class="alert alert-success rounded-0" id="success-alert" role="alert">
                <?php echo $_SESSION['user_profile']; unset($_SESSION['user_profile'])?> 
               </div>
            <?php  }?>

             <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile</h3>
              </div>
              </div>
            
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
                <a href="User_Profile_Update.php" class="btn btn-primary btn-block"><b>Update More Details</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
   
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Main content -->
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Profile Details</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                 <?php if($UserRole=='Admin'||$UserRole=='SuperAdmin') {?>
              <table id="example" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example" class="table table-bordered table-striped">
                    <?php }?>
                                 <?php 
								               
                                  foreach($result as $key => $value){
                                  foreach($value as $key1 => $value1)
                                   {
                                 ?>              
                                  <thead>
				      			               <tr>
				      			                <th>User Name</th>
				      			                 <td><?php echo  ucfirst($value1->UserName) ?></td>
                                    </tr>
                                    <tr>
				      			                <th>User Role</th>
				      			                 <td><?php echo  ucfirst($value1->userRole) ?></td>
                                    </tr>
                                    <tr>
                                    <th>DOB</th>
				      			                <td><?php echo date('d-m-Y',strtotime($value1->UserDOB)); ?></td>
                                   </tr>
                                   <!-- <tr>
                                   <th>Rank</th>
				      			                <td><?php echo $value1->rank?></td>
                                   </tr> -->
				      			               
				      			                <tr>
				      			                 <th>Address</th>
				      			                 <td><?php echo ucfirst($value1-> Address); ?></td>
                                    </tr>
				      			                <tr>
				      			                 <th>Status</th>
				      			                 <td><?php if($value1->Status==1){ echo '<p class="text-success">Active</p>';}else if($value1->Status==0){ echo '<p class="text-primary">Pendig</p>'; }  ?></td>
                                    </tr>
				      			               
				      			               </thead>
			                              <?php 
                                      }
                                     } 
                                    ?>
                                </table>
                              </div>
                              <!-- /.card-body -->
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.container-fluid -->
                    </section>
    <!-- /.content -->
                  
                   </div>
                 
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include "include/footer.php";
                                 
?>
