<?php
error_reporting(0);
//This page is used for Agent income section. This is not the direct income
include "include/header.php";
$token=$_SESSION['token'];
$UserRole=$_SESSION['login_session']->userRole;
if(isset($_POST['submit'])){
$UserId= $_POST["UserId"];
$url = $URL."income/Users_DirectIncome_read.php";
$data = array( "UserId" =>$UserId);
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
            <h1 class="m-0">Agent Direct Income</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Agent Direct Income List</li>
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
                <h3 class="card-title">Please Enter Agent Id</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
  
                <input type="text" class="form-control" placeholder="Agent ID" name="UserId"  autocomplete="off" >
</br>
                <span>OR</span> </br></br>

              <input type="checkbox"  placeholder="Agent ID" name="UserId" value="All_Users"  autocomplete="off" > Get All


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
              <h3 class="card-title">Agent Direct Income List </h3>
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
                      <th style="width: 10px">S.N</th>
                      <th>Agent Id</th>
                      <th>Cust. Id</th>
					            <th>Plot ID</th>
                      <th>Location</th>
                      <th>Incoice ID</th>
                      <th>Agent Income</th>
                      <th>Plot Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
								     $counter = 0;
                     foreach($result_plot as $key => $value_plot){
                     foreach($value_plot as $key1 => $value1_plot)
                    {
                      ?>
                    <tr>
                      <td><?php echo ++$counter; ?></td>
                      <td><?php echo $value1_plot->UserId; ?> </td>
                      <td><?php echo $value1_plot->MemberId; ?> </td>
					            <td><?php echo $value1_plot->SiteId; ?></td>
                      
					            <td><?php echo $value1_plot->SitePurchaseName; ?></td>
                      
                      <td><?php echo $value1_plot->PurchaseInvoiceId; ?></td>
                      <td><?php echo $value1_plot->AmountPaid; ?></td> 
                      <td><?php echo $value1_plot->PlotPaidAmount; ?></td>                   
                      <td><?php  echo $date1=date("d-m-Y",$value1_plot->IncomeCreatedOn) ?></td>                   

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