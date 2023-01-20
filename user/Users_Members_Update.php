<?php
//This page is used  by Admin to update the Customer details ( approve or reject)
date_default_timezone_set("Asia/kolkata");
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."User_Members/Users_MembersDetails.php";
echo $MemberId=$_GET['Mid'];
//$data = array("UserId" => $UserId);
$UserId=$_SESSION['login_session']->UserId;
$data = array( "MemberId" =>$MemberId);
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
            <h1>Update Customer Profile Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer Pending Profile</li>
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


<h3 class="profile-username text-center"><?php echo ucfirst($value1->MemberName) ?></h3>

<p class="text-muted text-center"><?php echo  ucfirst($value1->StatusName) ?></p>

<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
    <b>Agent Name:</b> <a class="float-right"><?php echo $value1->AgentName ?></a>
  </li>
  <li class="list-group-item">
    <b>Mobile:</b> <a class="float-right"><?php echo $value1->MemberPhone ?></a>
  </li>
  <li class="list-group-item">
    <b>Email id:</b> <a class="float-right"><?php echo  lcfirst($value1->MemberEmail) ?></a>
  </li>
  <li class="list-group-item">
    <b>Pan Card:</b> <a class="float-right"><?php echo $value1->MemberPAN ?></a>
  </li>
  <li class="list-group-item">
    <b>Adhar No:</b> <a class="float-right"><?php echo  ucfirst($value1->MemberAadhar) ?></a>
  </li>
  <li class="list-group-item">
    <b>Craeted On:</b> <a class="float-right"><?php  $date1=explode(' ',$value1->CreatedOn);
                     echo $date1[0] ?></a>
  </li>
</ul>
<?php
      }
    } 
 ?>
                <a href="User_Members_PendilngList.php" class="btn btn-primary btn-block"><b>Go Back Profile</b></a>
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
              <form action="action/User_MemberApprove_Post.php" method="post" MemberStatus>
              <?php 
								               
                               foreach($result as $key => $value){
                               foreach($value as $key1 => $value1)
                                {
                              ?> 
                <div class="card-body">
                

                <div class="form-group">
                    <label for="exampleInputEmail1">Member Name.*</label>
                    <input type="text" class="form-control" name="MemberName" 
                    value=" <?php echo $value1->MemberName ?>" 
                    id="exampleInputnumber" placeholder="Member's Name" autocomplete="off" required readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">status.*</label>
                    <input type="text" class="form-control" name="MemberStatus" 
                    value=" <?php echo $value1->MemberStatus ?>" 
                    id="exampleInputnumber" placeholder="Member's Status." autocomplete="off" required readonly>
                </div>

				<!-- <div class="form-group">
                    <label>Date of birth*</label>
                    <input type="date"  class="form-control" name="UserDOB" 
                    value="<?php  $date1=explode(' ',$value1->UserDOB);
                     echo $date1[0] ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                </div> -->
				<div class="form-group">
                    <label for="exampleInputEmail1">Address*</label>
                    <input type="text" class="form-control" name="MemberAddress" 
                    value="<?php echo $value1->MemberAddress ?>" id="exampleInputtext" placeholder="Member's Address" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email.*</label>
                    <input type="text" class="form-control" name="MemberEmail" 
                    value=" <?php echo $value1->MemberEmail ?>" 
                    id="exampleInputnumber" placeholder="email" autocomplete="off" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Aadhar.*</label>
                    <input type="text" class="form-control" name="MemberAadhar" 
                    value=" <?php echo $value1->MemberAadhar ?>" 
                    id="exampleInputnumber" placeholder="Member's Aadhar" autocomplete="off" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">PanNo.*</label>
                    <input type="text" class="form-control" name="MemberPAN" 
                    value=" <?php echo $value1->MemberPAN ?>" 
                    id="exampleInputnumber" placeholder="Member's PAN" autocomplete="off" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone No.*</label>
                    <input type="text" class="form-control" name="MemberPhone" 
                    value=" <?php echo $value1->MemberPhone ?>" 
                    id="exampleInputnumber" placeholder="Member's Phone" autocomplete="off" required >
                </div>
                <input type="text" class="form-control" name="MemberId" 
                    value=" <?php echo $value1->MemberId ?>" 
                    id="exampleInputnumber" placeholder="Memberid" autocomplete="off"  hidden >
              
                            
                <!-- /.card-body -->

                <div class="card-footer">
                <input type="text" name="MemberStatus" value="<?php $value1->MemberStatus ?>" hidden>
					            <td style="width: 5px"><button type="submit" name="actionApprove" value="Approve" class="btn btn-primary" style="background-color:green;">Approve</button></td>
                      <td style="width: 5px"><button type="submit" name="actionReject" value="Reject" class="btn btn-primary" style="background-color:red;" >Reject</button></td>
                     

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
