<?php
//session_start();
include "include/header.php";

//$rand=$rand(10,10000);
//$_SESSION['my_rand']=$rand;
//session_start();
$url = $URL."plot/site_name_read.php";
$data = array( "plot_id" =>6);
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

<script>
function plotAmount() {
  $.ajax({
    url: 'http://localhost/Ultrimax/ui/api/src/plot/plot_amount_read.php',
    type: 'POST',
    dataType:'json',
    data: {"plot_location_name":"Allahabad Jhusi"},
    success: function(response) {
       // response = JSON.stringify(response);
//        console.log(response.records);
// console.log(response.records[0]['price_per_square_feet']);
var s = '<option value="-1">Please Select Plot Size</option>';  
document.getElementById("plotAmt").value=response.records[0]['price_per_square_feet'];
for(var i=0;i<response.records.length;i++){
  s += '<option value="' + response.records[i].total_area_txt + '">' +  response.records[i].total_area_txt + '</option>'; 
}
$('#plotSize').empty();
$('#plotSize').append(s);
},
    error:function(response){
      console.log("dh"+JSON.stringify(response));
    }
});

  
}

</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Plot Entry</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-11">
                <!---------------************--------->
				<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Plot Entry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="action/plot_entry_post.php" method="post" enctype="multipart/form-data">
                <div class="card-body">

            
                <div class="input-group mb-3">
                <select class="form-control" name="PlotLocationName" onchange="plotAmount()">
                      <option value="select" selected>Please Select Site Name</option>
                      <?php 
								     
                         foreach($result as $key => $value){
                         foreach($value as $key1 => $value1)
                        {
                     
                      ?>
                      <option value="<?php echo $value1->plot_location_name ?>"><?php echo $value1->plot_location_name ?></option>
                      <?php
                        }
                       }
                       ?>
                    </select>
       </div>
	
       <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Amount per Square Feet" id="plotAmt" name="amount"
           required autocomplete="off" readonly> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-rupee-sign"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Plot No" name="PlotNo" required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Plot Size in Square Feet in Numeric" name="PlotAreaText" required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Plot size in text like as (10 x 50)" name="PlotInSquareFeet" required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Plot Total Amount" name="PlotTotalAmount" required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>


<!--        <input type="hidden" name="rand_check" value="<?php echo $rand; ?>">-->

                  
                <!-- /.card-body -->

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