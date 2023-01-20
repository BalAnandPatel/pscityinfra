<?php

$BASE_URL="http://localhost/pscity";
$URL=$BASE_URL."/cron/src/";

$urlGetUserFlagList =  $URL. "getUserDirectIncome.php";
$urlInsertDirectIncome =$URL. "directIncomeCreate.php";
$urlUpdateuserFlag=$URL. "updateUserFlag.php";
echo $urlGetUserFlagList;
date_default_timezone_set("Asia/Kolkata");

function Encode_Decode_DataAndURL($data,$url){
   $postdata = json_encode($data);
   $client = curl_init($url);
   curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
   //curl_setopt($client, CURLOPT_POST, 5);
   curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
   $response = curl_exec($client);
  // print_r($response);
   $result = json_decode($response);
  // print_r($result);
   return $result;
}

function insertDirectIncomeDetails($PurchaseHistoryId ,$PurchaseInvoiceId,$ReceiptNo,$PurchaseModeId,
$UserId,$MemberId,$AmountPaid,$CommissionPaid,$IncomeCreatedBy,$IncomeCreatedOn ,$urlInsertDirectIncome){
  // $url_insert_direct_income= $URL. "income/direct_income.php";
    $data_direct_income=array("PurchaseHistoryId"=>$PurchaseHistoryId,
"PurchaseInvoiceId"=>$PurchaseInvoiceId,
"ReceiptNo"=>$ReceiptNo,
"PurchaseModeId"=>$PurchaseModeId,
"UserId"=>$UserId,
"MemberId"=>$MemberId,
"AmountPaid"=>$AmountPaid,
"CommissionPaid"=>$CommissionPaid,
"IncomeCreatedBy"=>$IncomeCreatedBy,
"IncomeCreatedBy"=>$IncomeCreatedBy,
"IncomeCreatedOn"=>$IncomeCreatedOn);
//print_r($data_direct_income);
$result_insert_direct_income=Encode_Decode_DataAndURL($data_direct_income,$urlInsertDirectIncome);
//print_r($result_insert_direct_income);
return $result_insert_direct_income;
}

$dataGetuserFlagList=array();
$resultGetUserFlag=Encode_Decode_DataAndURL($dataGetuserFlagList,$urlGetUserFlagList);
print_r($resultGetUserFlag);
if(!empty($resultGetUserFlag->records[0]->userFlag)){
    foreach($resultGetUserFlag as $key => $value){
        foreach($value as $key1 => $value1)
         {
            echo "<br>"."-------------------------------------------------------------";
            echo "<br>"."Inside foreach loop : ". $value1->UserId ;
 $UserId= $value1->sponsorId;
 $MemberId=$value1->UserId;
 $PurchaseHistoryId  =$value1->PurchaseHistoryId;
 echo "<br>"."idd------". $PurchaseHistoryId;
 $PurchaseInvoiceId=$value1->PurchaseInvoiceId;
 $ReceiptNo=$value1->ReceiptNo;
 $PurchaseModeId=$value1->PurchasedModeId;
$AmountPaid=$value1->PurchaseAmountPaid;
$CommissionPaid = 10/100*$value1->PurchaseAmountPaid;
$IncomeCreatedBy=$value1->PurchasedBy;
$IncomeCreatedOn =strtotime(date('Y-m-d H:i:s'));

$resultInsertDirectIncome=insertDirectIncomeDetails($PurchaseHistoryId,$PurchaseInvoiceId,$ReceiptNo,$PurchaseModeId,$UserId,$MemberId,$AmountPaid,$CommissionPaid,$IncomeCreatedBy,$IncomeCreatedOn,$urlInsertDirectIncome);

if($resultInsertDirectIncome->message=="Direct income created Succssfully."){

    $dataUpdateUserFlag=array("userFlag"=>1,"PurchaseUpdatedOn"=>strtotime(date('Y-m-d H:i:s')),"PurchaseUpdatedBy"=>$value1->UserId,"PurchaseHistoryId"=>$PurchaseHistoryId);
}
         }
        }

}
