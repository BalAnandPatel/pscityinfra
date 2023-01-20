<?php
//session_start();
include "include/header.php";
$token=$_SESSION['token'];
$userRole=$_SESSION['login_session']->userRole;
if(isset($_POST['submit'])){
$PurchaseInvoiceId= $_POST["PurchaseInvoiceId"];
// $SiteId= $_POST["SiteId"];
// $PlotNo= $_POST["PlotNo"];  
$url = $URL."Members_Payment/Left_PaymentRead.php";
$data = array( "PurchaseInvoiceId" =>$PurchaseInvoiceId);
//print_r($data);
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
$response_plot = curl_exec($client);
//print_r($response_plot);
$result_plot = json_decode($response_plot);
//print_r($result_plot);

}else{

$PurchaseInvoiceId="";

$url = $URL."Members_Payment/Left_PaymentRead.php";
$data = array( "PurchaseInvoiceId" =>$PurchaseInvoiceId);
//print_r($data);
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
            <h1 class="m-0">Plot Payment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Plot Payment</li>
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
                <h3 class="card-title">Please Enter Customer Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
  
                <input type="text" class="form-control" placeholder="PurchaseInvoiceId" name="PurchaseInvoiceId" required autocomplete="off" >

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
              <?php if($userRole=='Admin'||$userRole=='Super_Admin') {?>
              <table id="example1" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example2" class="table table-bordered table-striped">
                    <?php
                  }?>
               
                                        
                 
                  <thead>
                    <tr>
                      <th style="width: 10px">S.N</th>
                      <th>Customer Name</th>
                      <th>Plot ID</th>
                      <th>Mobile No</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Left Amount</th>
                      <th>Receipt No.</th>
                      <th>Invoice No.</th>
                      <th>Plot Booking Date</td>
                      <th>Option</th>
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
                      <td><?php echo $value1_plot->MemberName; ?> </td>
                      <td><?php echo $value1_plot->PlotNo; ?></td>
                      <td><?php echo $value1_plot->MemberPhone; ?></td>
                      <td><?php echo $value1_plot->SitePurchaseAmount; ?></td>
                      <td><span class="fas fa-rupee-sign"></span> <?php echo $value1_plot->PurchaseAmountPaid; ?></td>
                      <td><span class="fas fa-rupee-sign"></span> <?php echo $value1_plot->SitePurchaseAmount-$value1_plot->PurchaseAmountPaid ; ?></td>
                      <td><?php echo $value1_plot->ReceiptNo; ?></td>
                      <td><?php echo $value1_plot->PurchaseInvoiceId; ?></td>
                      <td><?php echo date('d-m-Y',$value1_plot->PurchasedOn); ?></td>
                      <td><form action="plot_payment.php" method="post">
                        <input type="hidden" name="PurchaseInvoiceId" value="<?php echo $value1_plot->PurchaseInvoiceId; ?>">
                        <!-- <input type="hidden" name="PurchasehistoryId" value="<?php echo $value1_plot->PurchasehistoryId; ?>"> -->
                       
                        <button type="submit" <?php
                                                    if (($value1_plot->SitePurchaseAmount-$value1_plot->PurchaseAmountPaid) ==0) { ?> disabled="disabled" <?php } ?> class="btn btn-primary">Pay Now</button>
                         
                    </form></td>
                   
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
?>