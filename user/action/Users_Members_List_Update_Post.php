<?php

 if(isset($_POST["update_members"])){

 include "../../constant.php";

 $token=$_SESSION['token'];
 $MemberId=$_POST["MemberId"];
 $MemberName=$_POST["MemberName"];
 $FatherName=$_POST["FatherName"];
 $MemberPhone=$_POST["MemberPhone"];
 $MemberEmail=$_POST["MemberEmail"];
 $MemberAddress=$_POST["MemberAddress"];
 $MemberPAN=$_POST["MemberPAN"];
 $MemberAadhar=$_POST["MemberAadhar"];
 $ApprovedBy=$_SESSION['login_session']->UserId;
 $ApprovedOn=date('Y-m-d H:i:s');
 
 $url = $URL."User_Members/Users_Members_List_Update.php";

 $data = array(
   
   "MemberId"=>$MemberId,
   "MemberName"=>$MemberName,
   "FatherName"=>$FatherName,
   "MemberPhone"=>$MemberPhone,
   "MemberEmail"=>$MemberEmail,
   "MemberAddress"=>$MemberAddress,
   "MemberPAN"=>$MemberPAN,
   "MemberAadhar"=>$MemberAadhar,
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
 //print_r($response);
 $result = json_decode($response);
 //print_r($result);

if($result->message="Members details updated successfully."){
  $_SESSION["user_profile"]=$result->message;
  header('Location:../Users_Members_List.php');
 
}else{
  $_SESSION["user_profile"]="Unable to update Members Customer .";
 header('Location:../Users_Members_List.php');
}
exit();

 }

?>