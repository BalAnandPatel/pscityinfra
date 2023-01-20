<?php
include "include/header.php";
//Direct Income//
$url = $URL."income/sumOfDirectIncome.php";
$user_id=$_SESSION['login_session']->agent_id;
$role=$_SESSION['login_session']->role;
$data = array( "agent_id" => $user_id,"role"=>$role);
$postdataDirectIncome = json_encode($data);
$clientDirectIncome = curl_init($url);
curl_setopt($clientDirectIncome,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($clientDirectIncome, CURLOPT_POSTFIELDS, $postdataDirectIncome);
$responseDirectIncome = curl_exec($clientDirectIncome);
//print_r($responseDirectIncome);
$resultDirectIncome = json_decode($responseDirectIncome);
//print_r($resultDirectIncome);

///Team Income//
$url = $URL."income/sumOfTeamIncome.php";
$user_id=$_SESSION['login_session']->agent_id;
$role=$_SESSION['login_session']->role;
$data = array( "agent_id" => $user_id,"role"=>$role);
$postdataTi = json_encode($data);
$clientTi = curl_init($url);
curl_setopt($clientTi,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($clientTi, CURLOPT_POSTFIELDS, $postdataTi);
$responseTi = curl_exec($clientTi);
//print_r($responseTi);
$resultTi = json_decode($responseTi);
//print_r($resultTi);

/// Total Withdraw Amount///

$url = $URL."income/sumOfWithdrawAmt.php";
$user_id=$_SESSION['login_session']->agent_id;
//$role=$_SESSION['login_session']->role;
$data = array( "agent_id" => $user_id,"status"=>1);
$postdataWithdraw = json_encode($data);
$clientWithdraw = curl_init($url);
curl_setopt($clientWithdraw,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($clientWithdraw, CURLOPT_POSTFIELDS, $postdataWithdraw);
$responseWithdraw = curl_exec($clientWithdraw);
//print_r($responseWithdraw);
$resultWithdraw = json_decode($responseWithdraw);
//print_r($resultWithdraw);

/// Total Not Withdraw Amount///

$url = $URL."income/sumOfNotWithdrawAmt.php";
$user_id=$_SESSION['login_session']->agent_id;
$role=$_SESSION['login_session']->role;
$data = array( "agent_id" => $user_id,"status"=>0);
$postdataNotWithdraw = json_encode($data);
$clientNotWithdraw = curl_init($url);
curl_setopt($clientNotWithdraw,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($clientNotWithdraw, CURLOPT_POSTFIELDS, $postdataNotWithdraw);
$responseNotWithdraw = curl_exec($clientNotWithdraw);
//print_r($responseNotWithdraw);
$resultNotWithdraw = json_decode($responseNotWithdraw);
//print_r($resultNotWithdraw);

// Request 
$directIncome=$totalIncome1=$resultDirectIncome->records[0]->totalIncome;
$teamIncome=$totalIncome2=$resultTi->records[0]->totalIncome;
$toalAmount=$totalIncome1+$totalIncome2;
$totalWithdraw=$resultWithdraw->records[0]->totalwithdraw;
$admin_pending_amt= ($totalIncome1+$totalIncome2) -($resultWithdraw->records[0]->totalwithdraw);
$user_pending_amt= ($totalIncome1+$totalIncome2) -($resultWithdraw->records[0]->totalwithdraw);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Withdraw Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Withdrow ammount</li>
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
		    <div class="card">
             <div class="card-body">
			 <h5 class="text-primary">WITHDRAW AMOUNT</h5>
       
               <div class="row">
                 <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">

                 <div class="row">
                     <div class="col-12 col-sm-4">
                       <div class="info-box bg-light">
                         <div class="info-box-content">
                           <span class="info-box-text text-center text-muted">Direct Income</span>
                           <span class="info-box-number text-center text-muted mb-0">
                           &#8377; <?php echo $directIncome;?>
                         </span>
                         </div>
                       </div>
                     </div>
                     <div class="col-12 col-sm-4">
                       <div class="info-box bg-light">
                         <div class="info-box-content">
                           <span class="info-box-text text-center text-muted">Team Income</span>
                           <span class="info-box-number text-center text-muted mb-0"> 
                           &#8377; <?php echo $teamIncome;?>
                           </span>
                         </div>
                       </div>
                     </div>
                     <div class="col-12 col-sm-3">
                       <div class="info-box bg-light">
                         <div class="info-box-content">
                           <span class="info-box-text text-center text-muted">Total Amount</span>
                           <span class="info-box-number text-center text-muted mb-0">	&#8377;
                              <?php echo $toalAmount;?></span>
                         </div>
                       </div>
                     </div> 
                  </div>

                   <div class="row">

                  

                     <div class="col-12 col-sm-3">
                       <div class="info-box bg-light">
                         <div class="info-box-content">
                           <span class="info-box-text text-center text-muted">Total Withdraw Amount</span>
                           <span class="info-box-number text-center text-muted mb-0">
                           &#8377; <?php echo $totalWithdraw;?>
                      </span>
                         </div>
                       </div>
                     </div>
                     <div class="col-12 col-sm-3">
                       <div class="info-box bg-light">
                         <div class="info-box-content">
                           <span class="info-box-text text-center text-muted">Pending Withdraw Amount</span>
                           <span class="info-box-number text-center text-muted mb-0"> 
                           &#8377; <?php
                          echo ($user_pending_amt-$admin_pending_amt); ?>
                    </span>
                         </div>
                       </div>
                     </div>
                    
                     <div class="col-12 col-sm-3">
                       <div class="info-box bg-light">
                         <div class="info-box-content">
                           <span class="info-box-text text-center text-muted">Pending Admin Approval</span>
                           <span class="info-box-number text-center text-muted mb-0">	&#8377; <?php
                          echo $admin_pending_amt; ?> </span>
                         </div>
                       </div>
                     </div>
                  </div>
                   <div class="row">
                     <div class="col-12">
                       <div class="alert alert-warning" role="alert">
                      
					               
                         </div>
                           <h5 class="text-primary">WITHDRAW AMOUNT LIST</h5>
                       
 <form action="action/withdraw_request_post.php" method="post">
   <input type="hidden" name="amount" value="<?php echo $user_pending_amt ?>" readonly>
     <button type="submit" class="btn btn-block btn-outline-success">WITHDRAW REQUEST</button>
          </form>
            <p class="text-danger">
                           <span class="sr-only">Danger: </span>
                            You can withdraw minimum amount of 1000 INR
                           </p>
       
     <p class="text-danger">
<span class="sr-only">Danger: </span>
Request already made
</p>   
    
                         
                     </div>
                   </div>
                 </div>
               </div>
             </div>
        <!-- /.card-body -->
      
			 
            </div>
            
         </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include "include/footer.php";
?>
