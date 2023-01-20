<?php
 include "../../constant.php";
 $token = $_SESSION['token'];
 $UserId=$_SESSION['login_session']->UserId;
 
$UserType=$_SESSION['login_session']->UserType;
 $MemberAddress= $_POST["MemberAddress"];
 
 if (isset($_POST['actionApprove'])) {
  $MemberStatus= 1;
} else {
  $MemberStatus= 2;
}
//echo $MemberStatus;
 //$this->request->getParam('action');
$MemberId=$_POST["MemberId"];
 $MemberPhone= $_POST["MemberPhone"];
 $MemberEmail= $_POST["MemberEmail"];
 $MemberAadhar= $_POST["MemberAadhar"];
 $MemberPAN= $_POST["MemberPAN"];
 $ApprovedBy=$_SESSION['login_session']->UserId;
 $ApprovedOn=date('Y-m-d H:i:s');
 $url = $URL."User_Members/Users_MembersUpdate.php";

 
 $data = array(
    "MemberId"=>$MemberId,
    "MemberEmail" => $MemberEmail,
     "MemberAddress"=>$MemberAddress,
   "MemberPhone" => $MemberPhone,
    "MemberPAN" => $MemberPAN,
     "MemberAadhar" => $MemberAadhar,
   "MemberStatus"=>$MemberStatus,
    "ApprovedBy"=>$ApprovedBy,
    "ApprovedOn"=>$ApprovedOn
 );
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
// print_r($response);
 $result = json_decode($response);
//print_r($result);
if($result->message=="Members/Customers details updated successfully."){
$_SESSION['User_status']=$result->message ;
header('Location:../User_Members_PendingList.php');
}
else{
  $_SESSION['User_status']="Unable to Approve customer details." ;
  header('Location:../User_Members_PendingList.php');
}
exit();

?>