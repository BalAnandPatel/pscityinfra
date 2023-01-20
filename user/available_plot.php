<?php
//session_start();
include "include/header.php";
$token=$_SESSION['token'];
try{
$url = $URL . "Site_SectionDetails/SiteName_Read.php";
$data = array();
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 curl_setopt(
    $client,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $token
    )
  );
 curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);


if(isset($_POST['submit'])){
$SiteName= $_POST["SiteName"];
$url = $URL."Site_SectionDetails/Site_SectionDetails_Read.php";
$data = array("SiteName"=>$SiteName);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 curl_setopt(
    $client,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $token
    )
  );
 curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response_plot = curl_exec($client);
//print_r($response_plot);
$result_plot = json_decode($response_plot);
//print_r($result_plot);
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Available Plots</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Available Plots</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Select Site Name</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
  
          <div class="input-group mb-3">
          <select class="form-control" name="SiteName">
                      <option value="select" selected>Please Select Site Name</option>
                      <?php 
								     
                         foreach($result as $key => $value){
                         foreach($value as $key1 => $value1)
                        {
                     
                      ?>
                      <option value="<?php echo $value1->SiteName ?>"><?php echo ucfirst($value1->SiteName); ?></option>
                      <?php
                        }
                       }
                       ?>
                    </select>
       </div>


                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
<!-----------*******************------->			
            </div>
          </div>
       </div>
 </section>
 <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
      
		      	<!-- Main content -->
             <div class="card">
              <div class="card-header">
              <h3 class="card-title">Plot List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
               
                                        
                 
                  <thead>
                    <tr>
                      <th style="width: 10px">S.N</th>
                      <th>Site Name</th>
					            <th>Amount Per Square Feet</th>
                      <th>Section</th>
                      <th>Total Ploted Area</th>
                      <th>Sold Area</th>
                      <th>Available Ploted Area</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
								     $counter=0;
                     foreach($result_plot as $key => $value_plot){
                     foreach($value_plot as $key1 => $value1_plot)
                    {
                      ?>
                    <tr>
                      <td><?php echo ++$counter; ?></td>
                      <td><?php echo ucfirst($value1_plot->SiteName); ?> </td>
					            <td><span class="fas fa-rupee-sign"></span> <?php echo $value1_plot->SitePricePerSquareFeet; ?></td>
                      <td><?php echo ucfirst($value1_plot->SiteSection); ?></td>
                      <td><?php echo $value1_plot->SiteTotalArea;?>(Square Feet) </td>
                      <td><?php echo $value1_plot->SiteTotalArea - ($value1_plot->SiteCurrentAvailableArea - $value1_plot->SoldArea);?> (Square Feet) </td>
                      <td><?php echo $value1_plot->SiteCurrentAvailableArea - $value1_plot->SoldArea;?> (Square Feet) </td>
                      
                   
                    </tr>
                    <?php  }
                  }
                  ?>
                                        
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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