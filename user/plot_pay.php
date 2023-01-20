<?php
//session_start();
include "include/header.php";
$c_id = '6257de4e8573a';
$url = $URL . "customer/customer_read.php";
$data = array("c_id" => $c_id);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
print_r($response);
$result = json_decode($response);
print_r($result);
//$rand=$rand(10,10000);
//$_SESSION['my_rand']=$rand;
?>


<!-- <script>
  var totalAmount = 0;
  var finalAmt = 0;
  var plotAvailableArea = 0;
  var discountAmt = 0;



  function siteSection() {

    var location_name = document.getElementById('plotSiteName').value;
    var plot_section = "NONE";
    $.ajax({
      url: "<?php  //$site_url ?>",
      type: 'POST',
      dataType: 'json',
      data: {
        "plot_location_name": location_name,
        "plot_section": plot_section
      },
      success: function(response) {
        //  console.log("--------");
        //  console.log(response);
        //   console.log(response.records);
        // console.log(response.records[0]['price_per_square_feet']);
        var s = '<option value="-1">Please Select Plot Size</option>';
        document.getElementById("plotSectionName").value = response.records[0]['section'];
        for (var i = 0; i < response.records.length; i++) {
          s += '<option value="' + response.records[i].section + '">' + response.records[i].section + '</option>';
        }
        $('#plotSectionName').empty();
        $('#plotSectionName').append(s);
      },
      error: function(response) {
        console.log("site" + JSON.stringify(response));
      }
    });
  }

  function siteSectionDepth(section) {
    var location_name = document.getElementById('plotSiteName').value;
    var plot_section = section;

    $.ajax({
      url: "<?php //echo $site_url ?>",
      type: 'POST',
      dataType: 'json',
      data: {
        "plot_location_name": location_name,
        "plot_section": plot_section
      },
      success: function(response) {
        // console.log(response);
        //     console.log(response.records);
        document.getElementById("amountPerSquareFeet").value = response.records[0].amount_per_square_feet;
        document.getElementById("plotDepth").value = response.records[0].plot_depth;
        document.getElementById("plotTotalAmount").value = 0;
        plotAvailableArea = response.records[0].total_area - response.records[0].sold_area;
        document.getElementById("plotAvailableArea").value = plotAvailableArea;
      },
      error: function(response) {
        console.log("depth" + JSON.stringify(response));
      }
    });
  }

  function calculateAreaByWidth(width) {
    var depth = parseInt(document.getElementById("plotDepth").value);
    var propsedArea = width * document.getElementById("plotDepth").value;
    var amountPerSquareFeet = parseInt(document.getElementById("amountPerSquareFeet").value);
    document.getElementById("cornerCharge").value = 0;
    document.getElementById("discount").value = 0;
    document.getElementById("plotTotalAmount").value = 0;
    document.getElementById("paidAmount").value = 0;
    document.getElementById("leftAmount").value = 0;
    if (propsedArea > plotAvailableArea) {
      alert("Plot area exceed the available area");
      document.getElementById("plotTotalProposedArea").value = 0;
      document.getElementById("plotWidth").value = 0;
      document.getElementById("plotTotalAmount").value = 0;
      document.getElementById("plotAmount").value = 0;
      document.getElementById("paidAmount").value = 0;
      document.getElementById("leftAmount").value = 0;
    } else {
      document.getElementById("plotTotalProposedArea").value = propsedArea;
      document.getElementById("plotTotalAmount").value = amountPerSquareFeet * depth * parseInt(width);
      document.getElementById("plotAmount").value = amountPerSquareFeet * depth * parseInt(width);;
      totalAmount = amountPerSquareFeet * depth * parseInt(width);
      finalAmt = totalAmount;
    }
  }



  function cornerCharges(percentage) {
    finalAmt = parseInt(totalAmount) + parseInt(totalAmount) * (percentage / 100);
    document.getElementById("plotTotalAmount").value = finalAmt;
    document.getElementById("paidAmount").value = 0;
    document.getElementById("leftAmount").value = 0;
  }


  function plotDiscount(discountAmount) {
    discountAmt = finalAmt - discountAmount;
    document.getElementById("plotTotalAmount").value = discountAmt;
    document.getElementById("paidAmount").value = 0;
    document.getElementById("leftAmount").value = 0;

  }

  function paidLeftAmount(paidAmt) {
    document.getElementById("leftAmount").value = 0;
    var total = 0;
    if (document.getElementById("discount").value == 0)
      total = finalAmt - parseInt(paidAmt);
    else total = discountAmt - parseInt(paidAmt);

    if (totalAmount <= 0) {
      alert("Please fill the plot details first");
      document.getElementById("paidAmount").value = 0;
      document.getElementById("glintelPlot").style.display="none";
    } else if (total <= 0) {
      alert("Please check the paid amount, it should be less or same to total amount ");
      document.getElementById("paidAmount").value = 0;
      document.getElementById("glintelPlot").style.display="none";
    } else {
      document.getElementById("leftAmount").value = parseInt(total);
      document.getElementById("glintelPlot").style.display="block";
    }


  }

  function getAgentName(id) {

    $.ajax({
      url: "<?php //echo $agent_url ?>",
      type: 'POST',
      dataType: 'json',
      data: {
        "agent_id": id
      },
      success: function(response) {
        console.log(response);
        document.getElementById("agentName").value = response.records[0].name;

      },
      error: function(response) {
        console.log("site" + JSON.stringify(response));
      }
    });
  }
</script> -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
              <h3 class="card-title">Plot Intallment Payment</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="action/plot_sale_post.php" method="post" enctype="multipart/form-data">
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

                  <input type="text" class="form-control" name="amountPerSquareFeet" id="amountPerSquareFeet" placeholder="Plot Amount Per Square Feet" required autocomplete="off" readonly>

                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-boxes"></span>
                    </div>
                  </div>

                  <input type="text" class="form-control" name="amountPerSquareFeet" id="amountPerSquareFeet" placeholder="Plot Amount Per Square Feet" required autocomplete="off" readonly>                </div>
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
                  <input type="text" class="form-control" name="amountPerSquareFeet" id="amountPerSquareFeet" placeholder="Plot Amount Per Square Feet" required autocomplete="off" readonly>

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
                  <input type="text" class="form-control" id="plotDepth" name="plotDepth" placeholder="Plot Depth in Feet" required autocomplete="off" readonly>

                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>

                  <input type="number" class="form-control" placeholder="Plot Width in Feet" name="plotWidth" id="plotWidth" required autocomplete="off" onchange="calculateAreaByWidth(this.value)" readonly>

                </div>

                <div class="input-group mb-3">
                </div>
                <div class="row">

                  <span class="col-md-6">Plot available area (Square Feet)</span>
                  <span class="col-md-6">Proposed plot area (Square feet)</span>

                </div>
                <div class="input-group mb-3">


                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-layer-group"></span>
                    </div>
                  </div>

                  <input type="text" class="form-control" placeholder="Plot Size in Square Feet" id="plotAvailableArea" name="plotAvailableArea" required autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">

                    <div class="input-group-text">
                      <span class="fas fa-layer-group"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Available Ploted Area" id="plotTotalProposedArea" name="plotTotalProposedArea" required autocomplete="off" readonly>




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
                  <input type="number" class="form-control" placeholder="Plot Corner Charges(if any, then Please Input Percentage value)" 
                   name="cornerCharge" id="cornerCharge" autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" onchange="plotDiscount(this.value)" placeholder="Discount"
                   id="discount" name="discount" autocomplete="off" readonly>

                </div>


                <div class="row">
                  <span class="col-md-6">Plot Total Amount</span>
                  <span class="col-md-6">Plot Total Amount(with corner charges & discount)</span>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Plot Amount" id="plotAmount" name="plotAmount" required autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Plot Total Amount" id="plotTotalAmount" name="plotTotalAmount" required autocomplete="off" readonly>


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
                  <input type="number" class="form-control" placeholder="Paid Amount" id="paidAmount" name="paidAmount" 
                  required autocomplete="off">
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-rupee-sign"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" placeholder="Pending Amount" id="leftAmount" name="leftAmount" 
                  required autocomplete="off" readonly>
                </div>
<div>
                <div class="row">
                  <span class="col-md-6">Plot Number(ID)</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-cash-register"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Plot No" name="plotId" required autocomplete="off" readonly>
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
                  <select name="paymentMode" class="form-control">
                    <option value="cash">Cash</option>
                    <option value="cheque">Cheque</option>
                    <option value="debit card">Debit Card</option>
                    <option value="credit card">Credit Card</option>
                    <option value="bank deposit">Bank Deposit</option>
                    <option value="Online">Online</option>
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
                  <span class="col-md-6"> Customer Name</span>
                  <span class="col-md-6">Father Name</span>

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Customer Name" name="cName" required autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Father Name" name="fName" required autocomplete="off" readonly>
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
                  <input type="number" class="form-control" placeholder="Mobile No" name="cMobile" required autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Customer Address" name="cAddress" required autocomplete="off" readonly>
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
                  <input type="text" class="form-control" placeholder="Agent ID" name="agentId" required autocomplete="off" readonly>
                  &nbsp;&nbsp;
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tags"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Agent Name" id="agentName" name="agentName" required autocomplete="off" readonly>
                </div>

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