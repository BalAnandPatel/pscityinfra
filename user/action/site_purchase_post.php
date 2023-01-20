<?php
if(isset($_POST["submit"])){

    include '../../constant.php';
    $token=$_SESSION['token'];

    $sitePurchaseUrl = $URL."site_PurchaseDetails/sitePurchaseDetails_Create.php";
    $url = $URL."Site_Purchasehistory/Site_Purchasehistory_Create.php";
    $SiteSectionurl = $URL."Site_SectionDetails/Site_SectionDetails_Update.php";
    $PH_MaxIdurl = $URL."Site_Purchasehistory/PucrhaseHistory_MaxId_Read.php";
    $UsersDirIncomeurl = $URL."income/Users_DirectIncome_create.php";
    $updateFlagUrl= $URL ."Site_Purchasehistory/update_userFlag.php";
    $PurchaseInvoiceId_url = $URL."Site_Purchasehistory/Max_PurchaseInvoiceId.php";

    $url_get_agent="";
    $pan="";
    $MemberId =$_POST['MemberId'];
    $user_id=$_SESSION['login_session']->UserId;
    $userFlag=1;
    $teamFlag=1;
    $SiteId= $_POST["SiteId"];
    $SiteName= $_POST["SiteName"];
    $plotSectionName= $_POST["plotSectionName"];
    $amountPerSquareFeet= $_POST["amountPerSquareFeet"];
    $plotDepth= $_POST["plotDepth"];
    $plotWidth= $_POST["plotWidth"];
    $plotAvailableArea= $_POST["plotAvailableArea"];
    $plotTotalProposedArea= $_POST["plotTotalProposedArea"];
    $cornerCharge= $_POST["cornerCharge"];
    $discount= $_POST["discount"];
    $plotAmount= $_POST["plotAmount"];
    $plotTotalAmount= $_POST["plotTotalAmount"];
    $paidAmount= $_POST["paidAmount"];
    $directpaidAmount=$paidAmount*10/100;
    $DirectIncomeFlag=1;
    $PlotPaidAmount= $_POST["paidAmount"];
    $TotalCommission=1;
    $leftAmount= $_POST["leftAmount"];
    $plotId= $_POST["plotId"];
   
    $paymentMode= $_POST["paymentMode"];
    $MemberName= $_POST["MemberName"];
    $FatherName= $_POST["FatherName"];
    $MemberPhone= $_POST["MemberPhone"];
    $MemberAddress= $_POST["MemberAddress"];
    $UserId= $_POST["UserId"];
    $receiptNumber=$_POST["receiptNumber"];
    $SitePurchaseAmount=$_POST["plotTotalAmount"];
    $UserName= $_POST["UserName"];
    $parentId= $_POST["parentId"];
    $sponsorId=$_POST["sponsorId"];   
    $time=strtotime(date('Y-m-d H:i:s'));

    // select max invoice id from purchasedetails table se
   // $PurchaseInvoiceId = uniqid();
//


$PayModedata = array();
$PayModepostdata = json_encode($PayModedata);
$PayModeclient = curl_init($PurchaseInvoiceId_url);
curl_setopt($PayModeclient,CURLOPT_RETURNTRANSFER,true);
curl_setopt($PayModeclient,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($PayModeclient, CURLOPT_POSTFIELDS, $PayModepostdata);
$PayModeresponse = curl_exec($PayModeclient);
//print_r($PayModeresponse);
$PayModeresult = json_decode($PayModeresponse);
//print_r($PayModeresult);

$Max_PurchaseInvoiceId=$PayModeresult->records[0]->PurchaseInvoiceId;

list($mem_prefix,$mem_num) = sscanf($Max_PurchaseInvoiceId,"%[A-Za-z]%[0-9]");
//echo $mem_prefix . str_pad($mem_num + 1,5,'0',STR_PAD_LEFT);



$PurchaseInvoiceId=$mem_prefix . str_pad($mem_num + 1,5,'0',STR_PAD_LEFT);
    $SiteSectiondata = array("SiteId" =>$SiteId, "plotAvailableArea"=>$plotAvailableArea, "plotTotalProposedArea"=>$plotTotalProposedArea,
    "SiteUpdatedOn"=>$time,"SiteUpdatedBy"=>$UserId);
    //print_r($SiteSectiondata);

    $SiteSectionpostdata = json_encode($SiteSectiondata);
    $SiteSectionclient = curl_init($SiteSectionurl);
    curl_setopt($SiteSectionclient,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($SiteSectionclient, CURLOPT_POST, 5);
    curl_setopt($SiteSectionclient, CURLOPT_POSTFIELDS, $SiteSectionpostdata);
    $SiteSectionresponse = curl_exec($SiteSectionclient);
    //print_r($SiteSectionresponse);
    $SiteSectionresult = json_decode($SiteSectionresponse);
    //print_r($SiteSectionresult);

//************ site purchase details create ************

    $sitePurchasedata = array("SiteId" =>$SiteId, "SiteName" =>$SiteName, "plotSectionName" =>$plotSectionName, 
    "plotDepth" =>$plotDepth, "plotWidth" =>$plotWidth, "cornerCharge"=>$cornerCharge, "discount"=>$discount,
    "plotTotalAmount"=>$plotTotalAmount, "plotAmount"=>$plotAmount, "paidAmount"=>$paidAmount,
    "leftAmount"=>$leftAmount, "plotId"=>$plotId, "paymentMode"=>$paymentMode, "PurchaseInvoiceId"=>$PurchaseInvoiceId,
    "MemberId"=>$MemberId, "UserId"=>$UserId, "SitePurchaseAmount"=>$SitePurchaseAmount, "receiptNumber"=>$receiptNumber, 
    "PurchasedOn"=>$time,"PurchasedBy"=>$UserId);
   //print_r($sitePurchasedata);

    $sitePurchasePostdata = json_encode($sitePurchasedata);
    $sitePurchaseclient = curl_init($sitePurchaseUrl);
    curl_setopt($sitePurchaseclient,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($sitePurchaseclient, CURLOPT_POST, 5);
    curl_setopt($sitePurchaseclient, CURLOPT_POSTFIELDS, $sitePurchasePostdata);
    $sitePurchaseresponse = curl_exec($sitePurchaseclient);
    print_r($sitePurchaseresponse);
    $sitePurchaseresult = json_decode($sitePurchaseresponse);
    print_r($sitePurchaseresult);


  //  **************** site purchase histry create ***************** //
      
     $data = array("SiteId" =>$SiteId, "SiteName" =>$SiteName, "plotSectionName" =>$plotSectionName,
      "plotDepth" =>$plotDepth,
     "plotWidth" =>$plotWidth, "cornerCharge"=>$cornerCharge, "discount"=>$discount,
      "plotTotalAmount"=>$plotTotalAmount,
     "paidAmount"=>$paidAmount,"TotalCommission"=>$TotalCommission,"leftAmount"=>$leftAmount,
      "plotId"=>$plotId,
     "paymentMode"=>$paymentMode, "PurchaseInvoiceId"=>$PurchaseInvoiceId, "MemberId"=>$MemberId,
      "UserId"=>$UserId,
     "parentId"=>$parentId, "sponsorId"=>$sponsorId, "teamFlag"=>$teamFlag, "userFlag"=>$userFlag,
      "plotAmount"=>$plotAmount,
     "SitePurchaseAmount"=>$SitePurchaseAmount, "receiptNumber"=>$receiptNumber,"PurchasedOn"=>$time,"PurchasedBy"=>$UserId);
     //print_r($data);

     $postdata = json_encode($data);
     $client = curl_init($url);
     curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
     curl_setopt($client, CURLOPT_POST, 5);
     curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
     $response = curl_exec($client);
     //print_r($response);
     $result = json_decode($response);
     //print_r($result);

   if($result->message == "Site Purchase History created Successfully"){

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
     //print_r($PH_MaxIdresult); 
     
     $PurchaseHistoryId=$PH_MaxIdresult->records[0]->PurchaseHistoryId;
     
//******* users direct income create ******** //

     $U_DirIncomedata = array("PucrhaseHistoryId" =>$PurchaseHistoryId, "PurchaseInvoiceId" =>$PurchaseInvoiceId, 
     "ReceiptNo" =>$receiptNumber, "PurchaseModeId" =>$paymentMode, "UserId" =>$UserId, "MemberId"=>$MemberId, 
     "PlotPaidAmount"=>$PlotPaidAmount, "paidAmount"=>$directpaidAmount, "DirectIncomeFlag"=>$DirectIncomeFlag, "parentId"=>$parentId, "sponsorId"=>$sponsorId, "IncomeCreatedBy"=>$UserId, 
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


     //echo "<br>";
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
     

   //header('Location:../payment_slip.php?MemberId='.$MemberId);

     }
 

    } 
    else{
     //header('Location:../site_purchase.php');    
}
exit();
?>