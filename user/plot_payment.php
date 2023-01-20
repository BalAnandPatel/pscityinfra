<?php
//session_start();
include "include/header.php";
$token=$_SESSION['token'];
$PurchaseInvoiceId= $_POST["PurchaseInvoiceId"]; 
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
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);


//read payment mode
 $PayMode_url =  $URL . "Site_PurchaseMode/SelectPurchaseMode.php";
 $PayModedata = array();
 $PayModepostdata = json_encode($PayModedata);
 $PayModeclient = curl_init($PayMode_url);
 curl_setopt($PayModeclient,CURLOPT_RETURNTRANSFER,true);
curl_setopt($PayModeclient,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($PayModeclient, CURLOPT_POSTFIELDS, $PayModedata);
 $PayModeresponse = curl_exec($PayModeclient);
 //print_r($PayModeresponse);
 $PayModeresult = json_decode($PayModeresponse);
// print_r($PayModeresult);


 $PH_MaxIdurl = $URL."Site_Purchasehistory/PucrhaseHistory_MaxId_Read.php";
 $PH_MaxIddata = array();
 $PH_MaxIdPostdata = json_encode($PH_MaxIddata);
 $PH_MaxIdclient = curl_init($PH_MaxIdurl);
 curl_setopt($PH_MaxIdclient,CURLOPT_RETURNTRANSFER,true);
curl_setopt($PH_MaxIdclient,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($PH_MaxIdclient, CURLOPT_POSTFIELDS, $PH_MaxIddata);
 $PH_MaxIdresponse = curl_exec($PH_MaxIdclient);
 //print_r($PH_MaxIdresponse);
 $PH_MaxIdresult = json_decode($PH_MaxIdresponse);
 //print_r($PH_MaxIdresult); 
 
 $PurchaseHistoryId=$PH_MaxIdresult->records[0]->PurchaseHistoryId;

?>


<script>
  var totalAmount = 0;
  var finalAmt = 0;
  var plotAvailableArea = 0;
  var discountAmt = 0;

  function paidLeftAmount(paidAmt,leftAmount) {
    
     var plot_paid_amt= document.getElementById("paidAmount").value;
     //alert(plot_paid_amt);
     if(plot_paid_amt>0){
    
      document.getElementById("leftAmount").value= leftAmount - plot_paid_amt;
      //alert(leftAmount);
      if(document.getElementById("leftAmount").value<0){
        alert("Payment is greater than assigned value");
        document.getElementById("leftAmount").value = leftAmount;
        document.getElementById("paidAmount").value=0;
      }

    } 
    else{
      document.getElementById("leftAmount").value = leftAmount;

    }
    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Installment Payment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Installment Payment</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


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
              <h3 class="card-title">Installment Payment</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
            <form action="action/installment_post.php" method="post">

            <!-- <input type="text" class="form-control"  name="plotSiteName" readonly> -->
    
              <div class="card-body">
                <div class="row">
                  <span class="col-md-6">Site Name</span>
                  <span class="col-md-6">Section Name</span>
                </div>
                <div class="input-group mb-3">

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-box"></span>
                    </div>
                  </div>
                  <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                    {
                      ?>
                  <input type="hidden" name="SiteId" value="<?php echo $value1->SiteId; ?>">
                  <input type="hidden" name="sponsorId" value="<?php echo $value1->sponsorId; ?>">
                  <input type="hidden" name="parentId" value="<?php echo $value1->parentId; ?>">
                  <input type="text" class="form-control"  name="SitePurchaseName" value="<?php echo $value1->SitePurchaseName; ?>" readonly>
                         
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-boxes"></span>
                    </div>
                  </div>

                  <input type="text" class="form-control" name="SitePurchaseSection" value="<?php echo $value1->SitePurchaseSection; ?>" readonly>
                
                </div>
                <div class="input-group mb-3">


                </div>
                <div class="row">
                  <span class="col-md-6">Amount (Per Square Feet)</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="amountPerSquareFeet" 
                  value="<?php echo $value1->SitePricePerSquareFeet;?>" readonly>

                </div>


                <div class="row">
                  <span class="col-md-6">Plot Depth(Feet)</span>
                  <span class="col-md-6">Plot Width (Feet)</span>
                </div>
                <div class="input-group mb-3">

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-vertical"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="SitePurchaseDepth" value="<?php echo $value1->SitePurchaseDepth;?>" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>

                  <input type="text" class="form-control" name="SitePurchaseWidth" value="<?php echo $value1->SitePurchaseWidth;?>" readonly>
                </div>

                <div class="input-group mb-3">
                </div>
                <div class="row">

                  
                  <span class="col-md-6">Proposed plot area (Square feet)</span>

                </div>
                <div class="input-group mb-3">


                   <input type="hidden" class="form-control" placeholder="Plot Size in Square Feet"
                   id="plotAvailableArea" name="plotAvailableArea" required autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">

                    <div class="input-group-text">
                      <span class="fas fa-layer-group"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="plotTotalProposedArea" value="<?php echo $value1->SoldArea;?>" readonly>

                </div>

                <div class="row">
                  <span class="col-md-6">Corner Charges(Percentage %)</span>
                  <span class="col-md-6">Discount</span>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-percent"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="SitePurchaseCorner" value="<?php echo $value1->SitePurchaseCorner;?>" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="SitePurchaseDiscount" value="<?php echo $value1->SitePurchaseDiscount;?>" readonly>
                </div>


                <div class="row">
                  <span class="col-md-6">Plot Total Amount</span>
                  <span class="col-md-6">Plot Paid Amount</span>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="SiteTotalAmount" value="<?php echo $value1->SiteTotalAmount;?>" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control"  value="<?php echo $value1->PurchaseAmountPaid;?>" readonly>

                </div>

                <div class="row">
                  <span class="col-md-6">Paid Amount</span>
                  <span class="col-md-6">Pending Amount</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Paid Amount" id="paidAmount" name="PurchaseAmountPaid" value="0" required autocomplete="off" onchange="paidLeftAmount(this.value,<?php echo $value1->SitePurchaseAmount-$value1->PurchaseAmountPaid;?>)">
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Pending Amount" id="leftAmount" name="PurchaseAmountLeft" value="<?php echo $value1->SitePurchaseAmount-$value1->PurchaseAmountPaid;?>" required autocomplete="off" readonly>
                </div>
<div id="glintelPlot" >
                <div class="row">
                  <span class="col-md-6">Plot Number(ID)</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-cash-register"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control"  name="PlotNo" value="<?php echo $value1->PlotNo;?>" readonly>
                </div>

                <div class="row">
                  <span class="col-md-6">Payment Mode</span>
                  <span class="col-md-6">Receipt/Txn Number(if any)</span>

                </div>
                <div class="input-group mb-3">

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-credit-card"></span>
                    </div>
                  </div>
                  <select name="PurchasedModeId" class="form-control">
                  <?php 
                     foreach($PayModeresult as $key => $PayModevalue){
                     foreach($PayModevalue as $key1 => $PayModevalue1)
                      {
                    ?>
                    <option value="<?php echo $PayModevalue1->PurchaseModeId; ?>"><?php echo $PayModevalue1->PurchaseModeName; ?></option>
                    <?php } } ?>
                  </select>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-receipt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Receipt No" name="receiptNumber" required autocomplete="off">

                </div>

                <div class="row">
                  <span class="col-md-6">Customer (ID)</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-cash-register"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control"  name="MemberId" value="<?php echo $value1->MemberId;?>" readonly>
                </div>

                <div class="row">
                  <span class="col-md-6"> Customer Name</span>
                  <span class="col-md-6">Father Name</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="MemberName" value="<?php echo $value1->MemberName;?>" readonly>
                      &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="fName" value="<?php echo $value1->FatherName;?>" readonly>

                </div>

                <div class="row">
                  <span class="col-md-6">Mobile No</span>
                  <span class="col-md-6">Address</span>

                </div>

                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-mobile"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="MemberPhone" value="<?php echo $value1->MemberPhone;?>" readonly>
                   &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="cAddress" value="<?php echo $value1->MemberAddress;?>" readonly>
                </div>

                <div class="row">
                  <span class="col-md-6">Agent Id</span>
                  <span class="col-md-6">Agent Name</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tags"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="UserId" value="<?php echo $value1->UserId;?>" readonly> 
                   &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tags"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control"  name="UserName" value="<?php echo $value1->UserName;?>" readonly>
                 </div>

                  </div>
                  <?php }
                     }
                     ?>
                <div class="card-footer">
                <input type="hidden" name="SiteName" value="<?php echo $value1->SiteName; ?>">

<input type="hidden" name="SiteId" value="<?php echo $value1->SiteId; ?>">
<input type="hidden" name="plotSectionName" value="<?php echo $value1->SitePurchaseSection; ?>">
<input type="hidden" name="SitePurchaseAmount" value="<?php echo $value1->SitePurchaseAmount; ?>">



                <input type="hidden" name="PurchaseInvoiceId" value="<?php echo $value1->PurchaseInvoiceId; ?>">
                  <button type="submit" name="paymentsubmit" class="btn btn-primary">Submit</button>
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
<!-- <script>
$(function () {
  bsCustomFileInput.init();
});
</script> -->

<?php
include "include/footer.php";
?>