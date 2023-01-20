<?php
include '../../constant.php';
//include '../include/header.php';
$token=$_SESSION['token'];
if(isset($_POST["MemberName"]))
//$agent_id= $_POST["agent_id"];
$MemberName = ucwords($_POST["MemberName"]);
$FatherName = ucwords($_POST["FatherName"]);
$MemberEmail = $_POST["MemberEmail"];
$MemberAddress = ucwords($_POST["MemberAddress"]);
$Member_UserType = $_POST["Member_UserType"];
$UserId=$_SESSION['login_session']->UserId;
$UserType=$_SESSION['login_session']->UserType;
$MemberPhone = $_POST["MemberPhone"];
$MemberStatus=0;
$MemberPAN = $_POST["MemberPAN"];
$MemberAadhar = $_POST["MemberAadhar"];
$CreatedBy = $_SESSION['login_session']->UserId;
$CreatedOn=date('Y-m-d H:i:s');


$url = $URL . "User_Members/Users_MembersRegistration.php";

$data = array(
  "MemberName" => $MemberName,
  "FatherName"=>$FatherName,
   "MemberEmail" => $MemberEmail,
   "MemberStatus"=>$MemberStatus,
   "MemberAddress" => $MemberAddress, 
    "Member_UserType"=>$Member_UserType,
    "MemberAadhar"=>$MemberAadhar,
  "MemberPAN" => $MemberPAN,
   "UserId" => $UserId,
    "UserType" => $UserType,
    "MemberPhone"=>$MemberPhone,
     "CreatedBy" => $CreatedBy,
      "CreatedOn" => $CreatedOn,
);


$postdata = json_encode($data);
//$url_agent_login = $URL . "admin/agent_login_create.php";
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
$result = json_decode($response);

//print_r($response);
//print_r($result);


if ($result->message == "Unable to create customer. Data is incomplete." || $result->message == "Unable to create Members") {
  $_SESSION['create_member']="Unable to create customer. Please try again.";
  header('Location:../Users_Members_Create.php');
} else {

  $_SESSION['create_member']="Members Created Successfully";
  header('Location:../Users_Members_Create.php');


 }

exit();
   