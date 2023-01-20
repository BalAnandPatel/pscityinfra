<?php
include "include/header.php";
$url = $URL."income/direct_income_read.php";
$data = array( "id" => 1);
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Direct Income</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Direct Income</li>
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
             <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">DIRECT INCOME</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if($L_ROLE->role=='Admin'||$L_ROLE->role=='Super_Admin') {?>
              <table id="example1" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example2" class="table table-bordered table-striped">
                    <?php }?>
                  <thead>
                    <tr>
                      <th style="width: 10px">S.N</th>
                      <th>Agent Id</th>
                      <th>Plot ID</th>
					            <th>Customer ID</th>
                      <th>Commission</th>
                      <th>Payment Date</th>
                      <th>Payment Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
								     $counter = 0;
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>

                    <tr>
                      <td><?php echo ++$counter ?> </td>
                      <td><?php echo $value1->agent_id ?> </td>
                      <td><?php echo $value1->plot_id ?> </td>
					            <td><?php echo $value1->c_id ?></td>
                      <td><span class="fas fa-rupee-sign"></span> <?php echo $value1->paid_commission ?></td>
                      <td><?php echo $time = date("m/d/Y",$value1->payment_date)?></td>
                      <td><?php if($value1->payment_status==0) echo "UNPAID"; else if($value1->payment_status==1) echo "PAID"; ?></td>
                  
                      
                     
             
                      
                      
                    </tr>
                    <?php
      }
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
