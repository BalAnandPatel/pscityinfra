<?php
include "include/header.php";
include '../constant.php';
  
	$url = $URL."video_income/watched_video.php";  
	$data = array("id" => $_SESSION['ID']);
	$postdata = json_encode($data);
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
	//curl_setopt($client, CURLOPT_POST, 5);
	curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
	$response = curl_exec($client);
 // print_r($response);
  $result = json_decode($response);
  //print_r($result);
  
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Watched Video Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Watched Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
      
		      	<!-- Main content -->
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Watched Details</h3>
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
                      
                      <th>Video Id</th>
                      <th>Name</th>
                      <th>Amount</th>
					             <th>Remark</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>Created On</th>
                     
                      
                     
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                     {
                     //print_r($value[0][0]);
                     //print_r($value[0]->userid);
 
                 ?>
                    <tr>
                     
                      <td> <?php echo $value1->id ?></td>
                      <td><?php echo $value1->v_name ?></td>
					            <td> &#8377; <?php echo $value1->v_amount ?></td>
                      <td><?php echo $value1->v_remark ?></td>
                      <td><?php echo $value1->duration ?>s</td>
                      <td><?php if($value1->status==0)echo "Pending"; elseif($value1->status==1)echo"Completed"; 
                      elseif($value1->status==2)echo "Rejected";  ?></td>
                                          <td> <?php echo $value1->created_on ?> </td>
                     
                    
                      
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

<?php
include "include/footer.php";
?>
