<?php
//This page is used by admin to view the login details of created agents.
include '../constant.php';

$url = $URL ."registration/read_profile_by_id.php";
$id=$_GET['id'];
$data=array("id"=>$id);
$postdata1 = json_encode($data);
$result=giplCurl($url,$postdata1);

//print_r($result);


function giplCurl($api,$postdata){
    $url = $api; 
      $client = curl_init($url);
      curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
      $response = curl_exec($client);
  //   print_r($response);
      return $result = json_decode($response);
  }

  
?>

<script>
function getFileData(object){
  //alert("Hello");
var file = object.files[0];
var name = file.name;//you can set the name to the paragraph id 
document.getElementById('selectedFile').innerHTML=name;//set name using core javascript
// alert(name);
}
function getFileThumbData(object){
  //alert("Hello");
var file = object.files[0];
var name = file.name;//you can set the name to the paragraph id 
document.getElementById('selectedFileThumb').innerHTML=name;//set name using core javascript
// alert(name);
}

</script>
<html>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SP News</title>
  <!---link to style sheet----->
  <link rel="stylesheet" href="../common/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../common/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../common/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../common/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../common/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../common/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../common/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../common/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../common/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../common/assets/img/logo/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Member Login Detail</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  <!-- Content Header (Page header) -->
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  
        <div class="row">
          
          <div class="col-md-10">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registration Detail- Please save it for future use</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="registration_edit.php" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <?php 
								     
                     foreach($results as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>
      
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
          <input type="text" class="form-control" placeholder="User ID- <?php echo  $value1->id ?>"  required autocomplete="off" readonly> 
          </div>

          <form action="action/update_registration_post.php" method="post">
	 
     <label for="exampleInput">Full Name*</label>
     <div class="input-group mb-3">
     
       <input type="text" class="form-control" placeholder="Full name - <?php echo  $value1->full_name ?>" name="full_name" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Date of Birth*</label>
     <div class="input-group mb-3">
       <input type="date" class="form-control" placeholder="Date of Birth - <?php echo  $value1->dob ?>" name="dob" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-calendar"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Gender*</label>
     <div class="input-group mb-3">
       <input type="date" class="form-control" placeholder="Gender - <?php echo  $value1->gender ?>" name="dob" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-calendar"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Father's Name*</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Father's name- <?php echo  $value1->father_name ?>" name="father_name" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Mother's Name*</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Mother's name- <?php echo  $value1->mother_name ?>" name="mother_name" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Spouse Name</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Spouse's name - <?php echo  $value1->spouse_name ?>" name="spouse_name" autocomplete="off" >
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Email*</label>
     <div class="input-group mb-3">
       <input type="email" class="form-control" placeholder="Email - <?php echo  $value1->email ?>" name="email" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-envelope"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Mobile No*</label>
     <div class="input-group mb-3">
       <input type="number" class="form-control" placeholder="Mobile No.- <?php echo  $value1->mobile ?>" name="mobile" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-phone"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Aletrnate Mobile No</label>
     <div class="input-group mb-3">
       <input type="number" class="form-control" placeholder="Alternate Mobile No.- <?php echo  $value1->alternate_mobile ?>" name="alternate_mobile" autocomplete="off" >
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-phone"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Correspondance Address</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Correspondance Address- <?php echo  $value1->cor_address ?>" name="cor_address" autocomplete="off" >
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Address 1*</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Address 1- <?php echo  $value1->address1 ?>" name="address1" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Address 2*</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Address 2- <?php echo  $value1->address2 ?>" name="address2" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Address 3</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Address 3- <?php echo  $value1->address3 ?>" name="address3" autocomplete="off" >
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-envelope"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">District*</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="District- <?php echo  $value1->district ?>" name="district" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">State*</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="State- <?php echo  $value1->state ?>" name="state" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div> 
     <label for="exampleInputEmail1">Pincode*</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="PinCode- <?php echo  $value1->pincode ?>" name="pincode" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div> 
     <label for="exampleInputEmail1">Religion*</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Religion- <?php echo  $value1->relegion ?>" name="relegion" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>
     <label for="exampleInputEmail1">Nationality*</label>

     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Nationality- <?php echo  $value1->nationality ?>" name="nationality" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-map"></span>
         </div>
       </div>
     </div>  
     <label for="exampleInputEmail1">Category*</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Category- <?php echo  $value1->category ?>" name="category" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>  


<h2 class="login-box-msg"><b><u>Qualification & Other Details</u></b></h2>
   <hr>
   <label for="exampleInputEmail1">Highest Qualification*</label>
     <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Category- <?php echo  $value1->h_qualification ?>" name="h_qualification" autocomplete="off" required>
       <div class="input-group-append">
         <div class="input-group-text">
           <span class="fas fa-user"></span>
         </div>
       </div>
     </div>  

     <label for="exampleInputEmail1">Subject/Stream/Degree*</label>
     <div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Subject/Stream/Degree<?php echo  $value1->subject ?>" name="subject" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>
<label for="exampleInputEmail1">Passing Date*</label>
     <div class="input-group mb-3">
<input type="date" class="form-control" placeholder="Passing Date<?php echo  $value1->passing_date ?>" name="passing_date" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>
<label for="exampleInputEmail1">Marks Obtained(%)*</label>
     <div class="input-group mb-3">
<input type="number" class="form-control" placeholder="Marks Obtained(%)-<?php echo  $value1->h_percentage ?>" name="h_percentage" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-number"></span>
 </div>
</div>
</div> 
<label for="exampleInputEmail1">Grade*</label>
<div class="input-group mb-3">
<input type="number" class="form-control" placeholder="Grade- <?php echo  $value1->grade ?>" name="grade" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-number"></span>
 </div>
</div>
</div> 
     <label for="exampleInputEmail1">Language*</label>
     <div class="input-group mb-3">
<input type="number" class="form-control" placeholder="Language- <?php echo  $value1->language ?>" name="language" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-number"></span>
 </div>
</div>
</div> 

     <label for="exampleInputEmail1">Able to Read*</label>
     <div class="input-group mb-3">
<input type="number" class="form-control" placeholder="Read- <?php echo  $value1->read ?>" name="read" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-number"></span>
 </div>
</div>
</div>

     <label for="exampleInputEmail1">Able to Write*</label>
     <div class="input-group mb-3">
<input type="number" class="form-control" placeholder="Write- <?php echo  $value1->write ?>" name="write" autocomplete="off" required>
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-number"></span>
 </div>
</div>
</div>
<label for="exampleInputEmail1">Disability Category(If any)</label>
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Disability Category- <?php echo  $value1->disability_cat ?>" name="disability_cat" autocomplete="off">
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>
<label for="exampleInputEmail1">Disability Type(If Any)</label>
<div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Disability Type- <?php echo  $value1->disability_typet ?>" name="disability_type" autocomplete="off">
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>

<label for="exampleInputEmail1">Are you Ex-Serviceman</label>
     <div class="input-group mb-3">
<input type="text" class="form-control" placeholder="Ex Serviceman- <?php echo  $value1->ex_serviceman ?>" name="ex_serviceman" autocomplete="off">
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>
     
     <label for="exampleInputEmail1">Are you Serving Defence Personnel</label>
        <div class="input-group mb-3">
<input type="text" class="form-control" placeholder=" Serving Defence Personnel- <?php echo  $value1->serving_defence_per ?>" name="serving_defence_per" autocomplete="off">
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>

     <label for="exampleInputEmail1">Service Period (In Month)</label>
<div class="input-group mb-3">
<input type="number" class="form-control" placeholder="Service Period - <?php echo  $value1->service_period ?>" name="service_period	" autocomplete="off">
<div class="input-group-append">
 <div class="input-group-text">
   <span class="fas fa-user"></span>
 </div>
</div>
</div>

<?php }
                     }
?>

<div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFile">Please select a Photo</label>
                     <div class="input-group">
                      <div class="custom-file">
                        <input type="file"  id="file" name="fileUpload" onchange='getFileData(this)' class="custom-file-input" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                    <label id="selectedFile"  style="background-color:skyblue;"></label>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFile">Please upload thumb's Image</label>
                     <div class="input-group">
                      <div class="custom-file">
                        <input type="file"  id="fileThumb" name="fileUploadThumb" onchange='getFileThumbData(this)' class="custom-file-input" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                    <label id="selectedFileThumb"  style="background-color:skyblue;"></label>
                  </div>
                </div>

                <div class="card-footer">
                <input type="hidden" name="id" value="<?php echo $id?>" readonly>
                  <button type="submit" name="submit" class="btn btn-primary">Update Registration</button>
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
  </html>
  <!-- /.content-wrapper -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<?php
include "include/footer.php";
?>