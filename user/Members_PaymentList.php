<?php
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."Members_Payment/Members_PaymentList.php";
$UserRole=$_SESSION['login_session']->userRole;
if(isset($_POST['submit'])){
$PurchaseInvoiceId = $_POST['PurchaseInvoiceId'];
$data = array("PurchaseInvoiceId"=>$PurchaseInvoiceId);
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
}else{

$data = array("PurchaseInvoiceId"=>"");
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

}
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Customer payment List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer payment List</li>
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

                <!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Please Enter Invoice Id</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
  
                <input type="text" class="form-control" placeholder="Invoice" name="PurchaseInvoiceId"  autocomplete="off" >
             </br>
              

              <!-- <input type="checkbox"  placeholder="Agent ID" name="UserId" value="All_Users"  autocomplete="off" > Get All -->


                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
      
		      	<!-- Main content -->
             <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">Customer payment List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if($UserRole=='Admin'||$UserRole=='SuperAdmin') {?>
              <table id="example1" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example2" class="table table-bordered table-striped">
                    <?php }?>
                  <thead>
                    <tr>
                      <th>S.N</th>
                      <th >Customer_ID</th>
                      <th >Customer_Name</th>
                      <th >Invoice_Id</th>
                      <th>Plot_Id</th>
                      <th>Agent_Id</th>
                      <!-- <th> Mobile</th> -->
                      <th>Plot_Amount</th>
                      <th>Plot_Amount(with corner Charges)</th>
                      <th>Paid_Amount</th>
                      <th>Discount</th>
                      <th>Balance_Amount</th>
                      <th>Date</th>
                      <th>Generate_Invoice</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
								     $counter=0;
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                    {?>
               
                    <tr>
                      <td><?php echo ++$counter; ?> </td>
                      <td><?php echo $value1->MemberId; ?> </td>
                      <td><?php echo $value1->MemberName; ?> </td>
                      <td><?php echo $value1->PurchaseInvoiceId; ?> </td>
                      <td><?php echo $value1->PlotNo; ?></td>
					            <td><?php echo $value1->UserId; ?></td>
                      <!-- <td><?php echo $value1->MemberPhone; ?></td> -->
                      <td><span class="fas fa-rupee-sign"></span><?php echo $value1->SiteTotalAmount ?></td>
                      
                      <td><span class="fas fa-rupee-sign"></span><?php echo $value1->SitePurchaseAmount + $value1->SitePurchaseDiscount ?></td>

                      <td> <span class="fas fa-rupee-sign"></span> <?php echo $value1->PurchaseAmountPaid; ?> </td>
                      <td> <span class="fas fa-rupee-sign"></span> <?php echo $value1->SitePurchaseDiscount; ?> </td>
                      <td> <span class="fas fa-rupee-sign"></span> <?php echo $value1->PurchaseAmountLeft; ?> </td>
					            <td><?php echo  date("d-m-Y" , $value1->PurchasedOn); ?></td>

                      
                      <td> <form action="Member_totalPaymentSlip.php" method="get" enctype="multipart/form-data">
                      <input type="text" name="Inv_Id" value="<?php echo $value1->PurchaseInvoiceId ?>"  hidden>
                      <button type="submit" class="btn btn-primary">Generate Invoice</button>
                    </form> </td>
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
<?php
include "include/footer.php";
?>
