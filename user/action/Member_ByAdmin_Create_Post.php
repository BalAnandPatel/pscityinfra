<?php
include '../../constant.php';
//include '../include/header.php';
if(isset($_POST["MemberName"]))
//$agent_id= $_POST["agent_id"];
$MemberName = ucwords($_POST["MemberName"]);
$FatherName = ucwords($_POST["FatherName"]);
$MemberEmail = $_POST["MemberEmail"];
$MemberAddress = ucwords($_POST["MemberAddress"]);
$Member_UserType = 4;

$LoginUserType=$_SESSION['login_session']->UserType;
$MemberPhone = $_POST["MemberPhone"];
if($LoginUserType==2 || $LoginUserType==1 )
{
   $UserId=$_POST["UserId"];
   
}
$UserType=2;
$MemberStatus=1;
$MemberPAN = $_POST["MemberPAN"];
$MemberAadhar = $_POST["MemberAadhar"];
$CreatedBy = $_SESSION['login_session']->UserId;
$CreatedOn=date('Y-m-d H:i:s');
$ApprovedBy = $_SESSION['login_session']->UserId;
$ApprovedOn=date('Y-m-d H:i:s');
//echo " Approved By" . $ApprovedBy . "Approved ON : " . $ApprovedOn;

$url = $URL . "User_Members/MemberRegistration_ByAdmin.php";

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
      "ApprovedBy"=>$ApprovedBy,
      "ApprovedOn"=>$ApprovedOn
);


$postdata = json_encode($data);
//$url_agent_login = $URL . "admin/agent_login_create.php";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
$result = json_decode($response);

//print_r($response);
//print_r($result);


if ($result->message == "Unable to create customer. Data is incomplete." || $result->message == "Unable to create Members") {
  header('Location:../Users_Members_Create.php?id=error creating user');
} else {

   
  header('Location:../Users_Members_List.php');


 }

exit();
   