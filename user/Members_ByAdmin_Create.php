<?php
//This page is used to create agent by Admin, we have to put SponsreID. and memberstatus=1
include "include/header.php";
$token=$_SESSION['token'];
//$rand=$rand(10,10000);
//$_SESSION['my_rand']=$rand;
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
//print_r($result);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Customer Entry</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customer Entry</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-11">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Customer Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/Member_ByAdmin_Create_Post.php" method="post" enctype="multipart/form-data">
           

        </div>
          
         <div class="form-group">
          <label>Name*</label> 
          <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
          
          <input type="text" class="form-control" placeholder="Customer Name" name="MemberName" required autocomplete="off" data-toggle="tooltip" title="Customer Name" > 
          </div> 
        </div>
        
          <div class="form-group">
          <label>Father's Name*</label> 
          <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
          
          <input type="text" class="form-control" placeholder="Father's Name" name="FatherName" required autocomplete="off" data-toggle="tooltip" title="Customer Name" > 
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
          <input type="email" class="form-control" placeholder="Email ID" name="MemberEmail" required autocomplete="off" data-toggle="tooltip" title="Customer Email" > 
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
          <input type="text" class="form-control" placeholder="Member Address" name="MemberAddress" required autocomplete="off" data-toggle="tooltip" title="Customer Address" > 
          </div> 
          </div>
          
          <div class="form-group">
          <label>Mobile No.*</label>
          <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
          <input type="number" class="form-control" placeholder="Mobile No." name="MemberPhone" required autocomplete="off" data-toggle="tooltip" title="Customer Phone" > 
          </div> 
        </div>
        
        <div class="form-group">
        <label>Aadhar No.*</label>
       <div class="input-group mb-3">
       <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mobile"></span>
            </div>
          </div>
          <input type="text" class="form-control" placeholder="Aadhar No." name="MemberAadhar" required autocomplete="off"  data-toggle="tooltip" title="Customer Aadhar Details" > 
       </div>
     </div>

        <div class="form-group">
         <label>Pan No.*</label>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
      <input type="text" class="form-control" placeholder="Pan No." name="MemberPAN" required autocomplete="off" data-toggle="tooltip" title="Customer Pan Details" > 
         </div>
    </div>
         
        <div class="form-group">
        <label>Agent Id*</label>
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
      <input type="text" class="form-control" placeholder="Agent Id" name="UserId" required autocomplete="off" data-toggle="tooltip" title="Agent Id" > 
         </div>
     </div>

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button> <button type="Cancel" name="Cancel" class="btn btn-primary">Cancel</button>
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