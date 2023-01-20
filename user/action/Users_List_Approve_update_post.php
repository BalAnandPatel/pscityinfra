<?php

 include "../../constant.php";

 $token=$_SESSION['token'];
 $UserId=$_POST["Id"];
 $UserName=$_POST["UserName"];
 $Phone=$_POST["Phone"];
 $AadharNo=$_POST["AadharNo"];
 $Password=$_POST["Password"];
 $PanNo=$_POST["PanNo"];
 $UpdatedBy=$_SESSION['login_session']->UserId;
 $UpdatedOn=date('Y-m-d H:i:s');
 
 $url = $URL."Users/Users_List_Approve_update.php";

 $data = array(
   
   "UserId"=>$UserId,
   "UserName" => $UserName,
   "Password"=>$Password,
   "Phone" => $Phone,
   "PanNo" => $PanNo,
   "AadharNo" => $AadharNo,
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

if($result->message="Users list Updated Successfully"){
  $_SESSION["user_profile"]=$result->message;
  header('Location:../Users_List_Approve.php');
 
}else{
  $_SESSION["user_profile"]="Unable to update Users list.";
 header('Location:../Users_List_Approve_update.php');
}
exit();

?>