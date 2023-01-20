<?php
 include "../../constant.php";
 $token=$_SESSION['token'];
 $UserId=$_SESSION['login_session']->UserId;
 $CreatedBy=$_SESSION['login_session']->CreatedBy;
 $CreatedOn= $_SESSION['login_session']->CreatedOn;
 $Password= $_SESSION['login_session']->Password; 
// $PasswordHistory= $_SESSION['login_session']->Password; 
$UserType=$_SESSION['login_session']->UserType;
 $Address= ucwords($_POST["Address"]);
$UserName= ucwords($_POST["UserName"]);
 $Status=1;
 $UserDOB= $_POST["UserDOB"];
 $Phone= $_POST["Phone"];
 $UserEmail= $_POST["UserEmail"];
 $AadharNo= $_POST["AadharNo"];
 $PanNo= $_POST["PanNo"];
 $UpdatedBy=$_SESSION['login_session']->UserId;
 $UpdatedOn=date('Y-m-d H:i:s');
 $url = $URL."Users/User_Profile_Update.php";

 $data = array(
    "UserId"=>$UserId,
   "UserName" => $UserName,
    "UserEmail" => $UserEmail,
   "Password"=>$Password,
  // "PasswordHistory"=>$PasswordHistory,
    "UserDOB" => $UserDOB, 
     "Address"=>$Address,
    "UserType"=>$UserType,
   "Phone" => $Phone,
    "PanNo" => $PanNo,
     "AadharNo" => $AadharNo,
   "CreatedBy" => $CreatedBy,
       "CreatedOn" => $CreatedOn,
   "Status"=>$Status,
    "UpdatedBy"=>$UpdatedBy,
    "UpdatedOn"=>$UpdatedOn
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
 //print_r($response);
 $result = json_decode($response);
//print_r($result);
if($result->message="User Updated Successfully"){
  $_SESSION["user_profile"]=$result->message;
  header('Location:../User_Profile.php');
 
}else{
  $_SESSION["user_profile"]="Unable to update User details.";
  header('Location:../User_Profile_Update.php');
}
exit();

?>