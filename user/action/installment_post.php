<?php
if(isset($_POST["paymentsubmit"])){

include '../../constant.php';

$url = $URL."Site_Purchasehistory/Site_Purchasehistory_Create.php";
$SiteDetailUpdateurl = $URL."site_PurchaseDetails/sitePurchaseDetails_Update.php";
$UsersDirIncomeurl = $URL."income/Users_DirectIncome_create.php";
$PH_MaxIdurl = $URL."Site_Purchasehistory/PucrhaseHistory_MaxId_Read.php";
$updateFlagUrl= $URL ."Site_Purchasehistory/update_userFlag.php";
$token=$_SESSION['token'];
$user_id=$_SESSION['login_session']->UserId;
$MemberId =$_POST["MemberId"];
$SiteId =$_POST["SiteId"];
$SiteName= $_POST["SiteName"];
$PlotNo =$_POST["PlotNo"];
$plotSectionName= $_POST["plotSectionName"];
$sponsorId =$_POST["sponsorId"];
$parentId =$_POST["parentId"];
$SitePurchaseSection =$_POST["SitePurchaseSection"];
$SiteTotalAmount =$_POST["SiteTotalAmount"];
$SitePurchaseName =$_POST["SitePurchaseName"];
$SitePurchaseWidth =$_POST["SitePurchaseWidth"];
$SitePurchaseDepth =$_POST["SitePurchaseDepth"];
$SitePurchaseCorner =$_POST["SitePurchaseCorner"];
$SitePurchaseDiscount =$_POST["SitePurchaseDiscount"];
$SitePurchaseAmount =$_POST["SitePurchaseAmount"];
// $PurchaseInvoiceId=uniqid();
$PurchaseInvoiceId= $_POST["PurchaseInvoiceId"];
$PurchasehistoryId=$_POST["PurchasehistoryId"];
$MemberName =$_POST["MemberName"];
$userFlag =1;
$teamFlag =1;
$PurchaseAmountPaid= $_POST["PurchaseAmountPaid"];
$PurchaseAmountLeft= $_POST["PurchaseAmountLeft"];
$PlotNo= $_POST["PlotNo"];
$PurchasedModeId= $_POST["PurchasedModeId"];
$UserId= $_POST["UserId"];
$receiptNumber=$_POST["receiptNumber"];
$time=strtotime(date('Y-m-d H:i:s'));

$directpaidAmount=$PurchaseAmountPaid*10/100;
$DirectIncomeFlag=1;


$data = array(
  "PurchaseInvoiceId"=>$PurchaseInvoiceId,
  "SiteId" =>$SiteId,
  "plotId"=>$PlotNo,
  "plotAmount"=>$SiteTotalAmount,
 "SiteName" =>$SiteName, 
"plotSectionName" =>$plotSectionName,
"MemberId"=>$MemberId, 
"UserId"=>$UserId,
"parentId"=>$parentId,
"sponsorId"=>$sponsorId,
"teamFlag"=>$teamFlag,
 "userFlag"=>$userFlag,
 "plotDepth" =>$SitePurchaseDepth,
"plotWidth" =>$SitePurchaseWidth,
 "cornerCharge"=>$SitePurchaseCorner,
  "discount"=>$SitePurchaseDiscount,
 

  "leftAmount"=>$PurchaseAmountLeft, 

"paymentMode"=>$PurchasedModeId, 

"receiptNumber"=>$receiptNumber,
"paidAmount"=>$PurchaseAmountPaid,

 "plotTotalAmount"=>$SitePurchaseAmount,
 
 "PurchasedOn"=>$time,
 "PurchasedBy"=>$UserId);
//print_r($data);

$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);

//echo "<br>";
/// --- get max purchase history id
// if($result->message == "Site Purchase History created Successfully"){

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
     curl_setopt($PH_MaxIdclient, CURLOPT_POSTFIELDS, $PH_MaxIdPostdata);
     $PH_MaxIdresponse = curl_exec($PH_MaxIdclient);
     //print_r($PH_MaxIdresponse);
     $PH_MaxIdresult = json_decode($PH_MaxIdresponse);
    // print_r($PH_MaxIdresult); 
     
     $PurchaseHistoryId=$PH_MaxIdresult->records[0]->PurchaseHistoryId;
      


/// direct income insret 

//echo "<br>";
$U_DirIncomedata = array("PucrhaseHistoryId" =>$PH_MaxIdresult->records[0]->PurchaseHistoryId, "PurchaseInvoiceId" =>$PurchaseInvoiceId, 
"ReceiptNo" =>$receiptNumber, "PurchaseModeId" =>$PurchasedModeId, "UserId" =>$UserId, "MemberId"=>$MemberId, 
"PlotPaidAmount"=>$PurchaseAmountPaid, "paidAmount"=>$directpaidAmount, "DirectIncomeFlag"=>$DirectIncomeFlag,
 "parentId"=>$parentId, "sponsorId"=>$sponsorId, "IncomeCreatedBy"=>$UserId, 
"IncomeCreatedOn"=>$time);
 //print_r($U_DirIncomedata);

$U_DirIncomepostdata = json_encode($U_DirIncomedata);
$UsersDirIncomeclient = curl_init($UsersDirIncomeurl);
curl_setopt($UsersDirIncomeclient,CURLOPT_RETURNTRANSFER,true);
curl_setopt($UsersDirIncomeclient, CURLOPT_POST, 5);
curl_setopt($UsersDirIncomeclient, CURLOPT_POSTFIELDS, $U_DirIncomepostdata);
$U_DirIncomeresponse = curl_exec($UsersDirIncomeclient);
//print_r($U_DirIncomeresponse);
$U_DirIncomeresult = json_decode($U_DirIncomeresponse);
//print_r($U_DirIncomeresult);


   //   }
  // echo "<br>";
// update userflag in purchase history table;
$data_updateFlag=array("PurchaseInvoiceId"=>$PurchaseInvoiceId,"userFlag"=>0,"updatedBy"=>$user_id,"updatedOn"=>$time);
//print_r($data_updateFlag);
$Post_data = json_encode($data_updateFlag);
$client_Flag = curl_init($updateFlagUrl);
curl_setopt($client_Flag,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client_Flag, CURLOPT_POST, 5);
curl_setopt($client_Flag, CURLOPT_POSTFIELDS, $Post_data);
$response_Flag = curl_exec($client_Flag);
//print_r($response_Flag);
$result_Flag = json_decode($response_Flag);
//print_r($response_Flag);



// update site purchase details 

$url_get_leftAmount = $URL."Members_Payment/Left_PaymentRead.php";
$data_get_left_amount = array( "PurchaseInvoiceId" =>$PurchaseInvoiceId);
//print_r($data);
$postdata = json_encode($data_get_left_amount);
$client = curl_init($url_get_leftAmount);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response_get_leftAmount = curl_exec($client);
//print_r($response_get_leftAmount);
$result_get_leftAmount = json_decode($response_get_leftAmount);
//print_r($result_get_leftAmount);
$updated_AmountPaid=$result_get_leftAmount->records[0]->PurchaseAmountPaid;

//echo "<br>";

$SiteDetailUpdatedata = array("SiteId"=>$SiteId, "PlotNo"=>$PlotNo,"PurchaseInvoiceId"=>$PurchaseInvoiceId,
"PurchaseAmountPaid"=>$updated_AmountPaid,
"UpdatedOn"=>$time, "UpdatedBy"=>$UserId,
"PurchaseAmountLeft"=>$SitePurchaseAmount-$updated_AmountPaid);
//print_r($SiteDetailUpdatedata);

$Sitepostdata = json_encode($SiteDetailUpdatedata);
$Siteclient = curl_init($SiteDetailUpdateurl);
curl_setopt($Siteclient,CURLOPT_RETURNTRANSFER,true);
curl_setopt($Siteclient,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($Siteclient, CURLOPT_POSTFIELDS, $Sitepostdata);
$SiteDetailUpdateresponse = curl_exec($Siteclient);
//print_r($SiteDetailUpdateresponse);
$SiteDetailUpdateresult = json_decode($SiteDetailUpdateresponse);
//print_r($SiteDetailUpdateresult);



header('Location:../installment_slip.php?PurchaseInvoiceId='.$PurchaseInvoiceId);
exit();

}

?>