<?php
include "include/header.php";
$token=$_SESSION['token'];
$usertype=$_SESSION['login_session']->UserType;
$userRole=$_SESSION['login_session']->userRole;
$userid=$_SESSION['login_session']->UserId;

$url = $URL."admin/site_count.php";
$token=$_SESSION['token'];
$user_id=$_SESSION['login_session']->UserId;
$data = array();
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

// /////////////// Agent Count ///////////////////
$url = $URL."admin/agent_count.php";
$UserId=$_SESSION['UserId'];
$UserType=$_SESSION['UserType'];
$data = array( "UserId" =>$UserId, "UserType"=>$UserType);
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
$response_agent = curl_exec($client);
//print_r($response_agent);
$result_agent = json_decode($response_agent);
//print_r($result_agent);

///////Customer Count/////////////
$url = $URL."admin/customer_count.php";
$UserId=$_SESSION['UserId'];
$data = array( "UserId" =>$UserId);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
curl_setopt(
  $client,
  CURLOPT_HTTPHEADER,
  array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
  )
);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response_customer = curl_exec($client);
//print_r($response);
$result_customer = json_decode($response_customer);
//print_r($result_customer);

// /////////Read Total Plot Amount//////////
$plotamount_url = $URL."admin/total_plot_amount_read.php";
$user_id=$_SESSION['UserId'];
$UserType=$_SESSION['UserType'];
$data = array( "UserId" =>$UserId, "UserType"=>$UserType);
$plotamount_postdata = json_encode($data);
$plotamount_client = curl_init($plotamount_url);
curl_setopt($plotamount_client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($plotamount_client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($plotamount_client, CURLOPT_POSTFIELDS, $plotamount_postdata);
$plotamount_response = curl_exec($plotamount_client);
//print_r($plotamount_response);
$plotamount_result = json_decode($plotamount_response);
//print_r($plotamount_result);


// /////////Read Total Paid Amount//////////
$plotPaidAmount_url = $URL."admin/total_plot_amount_paid.php";
$user_id=$_SESSION['UserId'];
$UserType=$_SESSION['UserType'];
$data = array( "UserId" =>$UserId, "UserType"=>$UserType);
$plotPaidAmount_postdata = json_encode($data);
$plotPaidAmount_client = curl_init($plotPaidAmount_url);
curl_setopt($plotPaidAmount_client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($plotPaidAmount_client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($plotPaidAmount_client, CURLOPT_POSTFIELDS, $plotPaidAmount_postdata);
$plotPaidAmount_response = curl_exec($plotPaidAmount_client);
//print_r($plotPaidAmount_response);
$plotPaidAmount_result = json_decode($plotPaidAmount_response);
//print_r($plotPaidAmount_result);


// //// total income////

$url = $URL."income/Sumof_Users_Directincome.php";
$UserId=$_SESSION['UserId'];
$UserType=$_SESSION['UserType'];
$data = array( "UserId" =>$UserId, "UserType"=>$UserType);
$postdataDirectIncome = json_encode($data);
$clientDirectIncome = curl_init($url);
curl_setopt($clientDirectIncome,CURLOPT_RETURNTRANSFER,true);
curl_setopt($clientDirectIncome,CURLOPT_HTTPHEADER,
   array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($clientDirectIncome, CURLOPT_POSTFIELDS, $postdataDirectIncome);
$responseDirectIncome = curl_exec($clientDirectIncome);
//print_r($responseDirectIncome);
$resultDirectIncome = json_decode($responseDirectIncome);
//print_r($resultDirectIncome);


///Team Income//
$url = $URL."income/Sumof_Team_Income.php";
$UserId=$_SESSION['UserId'];
$UserType=$_SESSION['UserType'];
$data = array( "UserId" =>$UserId, "UserType"=>$UserType);
$postdataTi = json_encode($data);
$clientTi = curl_init($url);
curl_setopt($clientTi,CURLOPT_RETURNTRANSFER,true);
curl_setopt($clientTi,CURLOPT_HTTPHEADER,
   array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($clientTi, CURLOPT_POSTFIELDS, $postdataTi);
$responseTi = curl_exec($clientTi);
//print_r($responseTi);
$resultTi = json_decode($responseTi);
//print_r($resultTi);

// //Total Plot count///

$url = $URL."admin/totle_plot_sale.php";
$UserId=$_SESSION['UserId'];
$UserType=$_SESSION['UserType'];
$data = array( "UserId" => $UserId, "UserType"=>$UserType);
$postdataPlotCount = json_encode($data);
$clientPlotCount = curl_init($url);
curl_setopt($clientPlotCount,CURLOPT_RETURNTRANSFER,true);
curl_setopt($clientPlotCount,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($clientPlotCount, CURLOPT_POSTFIELDS, $postdataPlotCount);
$responsePlotCount = curl_exec($clientPlotCount);
//print_r($responsePlotCount);
$resultPlotCount = json_decode($responsePlotCount);
//print_r($resultPlotCount);
?>

<style>
  #dash{
    font-size: 90%;
  }
</style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
  <?php if(isset($_SESSION['PassError'])){?>
                <div class="alert alert-danger" id="success-alert" role="alert">
                <?php echo $_SESSION['PassError']; unset($_SESSION['PassError'])?> 
               </div>
            <?php  }elseif(isset($_SESSION['UpdatePass'])){?>
              <div class="alert alert-success" id="success-alert" role="alert">
                <?php echo $_SESSION['UpdatePass']; unset($_SESSION['UpdatePass'])?> 
               </div>
            <?php }?>

            <?php if(isset($_SESSION['change_password_page'])){?>
                <div class="alert alert-success" id="success-alert" role="alert">
                <?php echo $_SESSION['change_password_page']; unset($_SESSION['change_password_page'])?> 
               </div>
            <?php  } ?>
           
            

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
              <li class="breadcrumb-item active">Dashboard</li>
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
        <?php
             if (strpos($DASHBOARD, $AVAILABLE_SITE) !== false) { 
        ?>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">

                <h3 id="dash"><?php echo $result->records[0]->site_count;?></h3>
                <p>Available Sites</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="available_plot.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         <?php } ?>
          <!-- ./col -->
          <?php
             if (strpos($DASHBOARD, $AVAILABLE_SITE) !== false) { 
        ?>          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3 id="dash">
              <?php echo $resultPlotCount->records[0]->totalPlot;?>
              </h3>

                <p>Total Plots Sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="Members_PaymentList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         <?php } ?>
         <?php
             if (strpos($DASHBOARD, $TOTAL_AGENT) !== false) { 
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3  id="dash"><?php echo $result_agent->records[0]->agent_count;?></h3>

                <p>Sponsored Agent</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="Users_List_Approve.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php  }?>
          <!-- ./col -->
          <?php
             if (strpos($DASHBOARD, $TOTAL_CUSTOMER) !== false) { 
        ?>
         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3  id="dash"><?php echo $result_customer->records[0]->customer_count;?></h3>

                <p>Total Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="Users_Members_List.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         <?php  }?>
         <?php
             if (strpos($DASHBOARD, $TOTAL_PLOT_AMOUNT) !== false) { 
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
            <h3 id="dash">&#8377;
            <?php echo $total_amount=$plotamount_result->records[0]->totalPlotAmount;?></h3>

                <p>Total Plot Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>
        <?php
             if (strpos($DASHBOARD, $TOTAL_PLOT_PAID_AMOUNT) !== false) { 
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3  id="dash">&#8377;<?php echo $paid_amount=$plotPaidAmount_result->records[0]->totalPlotPaidAmount;?></h3>
                <p>Plot Paid Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>
        <?php
             if (strpos($DASHBOARD, $TOTAL_PLOT_PAID_AMOUNT) !== false) { 
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3  id="dash">&#8377;<?php echo $total_amount-$paid_amount;?></h3>

                <p>Plot Left Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      <?php }?>
      <?php
             if (strpos($DASHBOARD, $TOTAL_PLOT_PAID_AMOUNT) !== false) { 
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3  id="dash">&#8377;<?php echo $resultDirectIncome->records[0]->totalDirectIncome;?></h3>

                <p>Direct Commission</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="User_DirectPayment_List.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>            
        <?php }?>
        <?php
             if (strpos($DASHBOARD, $TOTAL_PLOT_PAID_AMOUNT) !== false) { 
        ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="dash">&#8377;<?php echo $resultTi->records[0]->teamIncome;?></h3>

                <p>Team Commision</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="User_DirectIncome.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>            
        <?php } ?>

        <?php
             if (strpos($DASHBOARD, $TOTAL_COMMISION) !== false) { 
        ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3  id="dash">&#8377;<?php echo ($resultTi->records[0]->teamIncome) + ($resultDirectIncome->records[0]->totalDirectIncome);?></h3>

                <p>Total Commision</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>            
      <?php } ?>

          <!-- ./col -->
        </div>
        
        <!-- /.row -->
        <!-- Main row -->

  <!-- /.content-wrapper -->
      </div>
      </div>
<?php
include "include/footer.php";
?>