<?php
//This page is use to create any user from admin.
include "include/header.php";
$token=$_SESSION['token'];
try{
$url_call_sp_get_next_position = $URL . "Users/call_sp_get_next_position.php";
$url_get_sponsorName= $URL. "Users/User_Login_Details.php";
$url = $URL . "Users/UserType_Read.php";
$data = array();
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
?>
<script>
  function get_next_position(position) {
    var sponsorId = document.getElementById("sponsorId").value;
    document.getElementById("parentId").value="";
    
////alert(position);
    $.ajax({
      url: "<?php echo $url_call_sp_get_next_position ?>",
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify({
        'sponsorId': sponsorId,
        'position': position
      }),
      success: function(response) {
        //console.log(response);
        document.getElementById("parentName").value = response.records[0].UserName;

        document.getElementById("parentId").value = response.records[0].parentId;
       // document.getElementById("position").value = response.records[0].position;
        $('#parentId').attr('readonly', 'true');
        $('#sponsorId').attr('readonly', 'true');

        $('#position').attr('disabled', 'true');

      },
      error: function(response) {
        console.log("site" + JSON.stringify(response));
        if(response.responseText="No next position found."){

          get_sponsorName(sponsorId);
alert (sponsorId);
        document.getElementById("parentId").value =sponsorId;
        document.getElementById("parentName").value = response.records[0].UserName;
        }
      }
    });

  }
    function get_sponsorName(sponsorId) {
      $.ajax({
      url: "<?php echo $url_get_sponsorName ?>",
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify({
        'UserId': sponsorId
      }),
      success: function(response) {
        console.log(response);
        document.getElementById("parentName").value = response.records[0].UserName;
      },
      error: function(response) {
        console.log("site" + JSON.stringify(response));
       
        }
      
    });
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Agent Entry</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Agent Entry</li>
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
          <!-- Main content -->
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Agent Entry</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="action/User_Create_Post.php" method="post" enctype="multipart/form-data">

          </div>
          <div class="form-group">
          <label>Agent Name*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Agent Name" name="UserName" required autocomplete="off" data-toggle="tooltip" title="Please Enter Agent Name">
          </div>
          </div>

          <div class="form-group">
          <label>Sponsor Id*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Sponsor ID" id="sponsorId" name="sponsorId" autocomplete="off" data-toggle="tooltip" title="Please Enter Sponsor ID" >
          </div>
          </div>
          
          <div class="form-group">
          <label>Position*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <select class="form-control"  name="position" onchange="get_next_position(this.value)">
              <option value="select" selected>Please Select Position</option>

              <option value="R">Right</option>
              <option value="L">Left</option>
            </select>
          </div>
          </div>
          
        <div class="form-row">
          <div class="form-group col-md-6">
          <label>Parent ID*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Parent ID" id="parentId" name="parentId" autocomplete="off" data-toggle="tooltip" title="Please Enter Parent ID" readonly>
         
          </div>
         </div>
        <div class="form-group col-md-6">
          <label>Parent Name*</label>
          <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-boxes"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Parent Name" id="parentName" name="parentName" autocomplete="off" data-toggle="tooltip" title="Parent Name" readonly>
          </div>
         </div>
         </div>
         
          <div class="form-group">
          <label>User Role*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <select class="form-control" name="UserType">
              <option value="select" selected>Please Select User Role</option>
              <?php if ($_SESSION['UserType'] == 2) { ?>
                <?php

                foreach ($result as $key => $value) {
                  foreach ($value as $key1 => $value1) {

                ?>
                    <option value="<?php echo $value1->userType ?>">
                    <?php echo $value1->userRole ?></option>
                <?php
                  }
                }
                ?>
              <?php } else if ($_SESSION['UserType'] == 3) { ?>
                <option>Agent</option>
              <?php } ?>

            </select>
          </div>
          </div>
          
          <div class="form-group">
          <label>Email ID*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control" placeholder="Email ID" name="UserEmail" required autocomplete="off" data-toggle="tooltip" title="Please Enter Email ID">
          </div>
          </div>
          
          <div class="form-group">
          <label>Agent's Date Of Birth*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="date" class="form-control" placeholder="Agent Date Of Birth" name="UserDOB" required autocomplete="off" data-toggle="tooltip" title="Please Enter Date Of Birth">
          </div>
          </div>

          <div class="form-group">
          <label>Agent Password*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Agent Password" name="Password" required autocomplete="off" data-toggle="tooltip" title="Please Enter Password">
          </div>
          </div>
          
          <div class="form-group">
          <label>Address*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-secret"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Agent Address as per Aadhar" name="Address" required autocomplete="off" data-toggle="tooltip" title="Please Enter Agent address as per Aadhar">
          </div>
          </div>

          <div class="form-group">
          <label>Mobile Number*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-mobile"></span>
              </div>
            </div>
            <input type="number" class="form-control" placeholder=" 10 digit Mobile Number" name="Phone" required autocomplete="off" data-toggle="tooltip" title="Please Enter 10 digit Mobile Number">
          </div>
          </div>

          <div class="form-group">
          <label>Pan No*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Pan No" name="PanNo" required autocomplete="off" data-toggle="tooltip" title="Please Enter PAN Number">
          </div>
          </div>
          
         <div class="form-group">
          <label>Aadhaar No*</label>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
            <input type="number" class="form-control" placeholder="Aadhaar No" name="AadharNo" required autocomplete="off" data-toggle="tooltip" title="Please Enter Aadhar Number">
          </div>
          </div>




          *Note, we need valid sponsor. proceed or left it blank if no sponsor

          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
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
}
catch (Exception $e){

   if($e->getMessage() == "Expired token"){

     
 // set response code
       http_response_code(401);
   
       // show error message
       echo json_encode(array(
           "message" => "Access denied.",
           "error" => $e->getMessage()
       ));

          
   } else {

       die();
       }
   }
?>