<?php
include "include/header.php";

function giplCurl($url,$postdata){
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  $response = curl_exec($client);      
  // print_r($response);
  return $result = json_decode($response);
}
$sum=0;
function giplSum($result){
  foreach($result as $key => $value){                            
    foreach($value as $key1 => $value1)
    {
      return $value1->amount;
    }

  }
}

function giplUser($result){
  foreach($result as $key => $value){                            
    foreach($value as $key1 => $value1)
    {
      return $total= array_sum($value);
    }
    echo $total;

  }
} 
$url_read_member_list = $URL."registration/read_all_users_count.php";
$url_donation_list = $URL."donation_ads/read_all_donation_count.php";
$url_rank_income_list = $URL."rank_income/read_rank_income_count.php";
$url_video_income_list=$URL."video_income/read_video_income_count.php";
$url_direct_income_list =$URL. "direct_income/read_direct_income_count.php";
$url_withdrawa_income_list =$URL."withdraw_income/read_withdraw_income_count.php";


$data_pending = array( "status" =>'0');
	$postdata_pending = json_encode($data_pending);

  $data_approved=array( "status" =>'1');
	$postdata_approved = json_encode($data_approved);

  $data_rejected=array( "status" =>'2');
	$postdata_rejected = json_encode($data_rejected);


?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> <?php echo 0 ?></h3>

                <p>Pending User</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="adm_pending_member_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php  echo 0 ?></h3>

                <p>Active User</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="adm_active_member_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php  echo 0 ?></h3>

                <p>Rejected User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="adm_reject_member_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              
              <h2 class="fa fa-user"><?php echo 0  ?></h2>
              <p>Pending Donation</p>   
            </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="adm_pending_donation_detail.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
        <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                  <h2 class="fa fa-user"><?php echo 0  ?></h2>
                <p>Approved Donation</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="adm_approved_donation_detail.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h2 class="fa fa-user"><?php echo 0  ?> </h2>
                <p>Rejected Donation</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="adm_reject_donation.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h2 class="fa fa-user"><?php echo 0  ?> </h2>
                <p>Pending Video Income</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h2 class="fa fa-user"><?php echo 0  ?> </h2>
                <p>Approved Video Income</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
       
        <!-- /.row -->
        <!-- Main row -->
      <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include "include/footer.php";
?>

