<?php
include '../../constant.php';
$name= $_POST["name"];
$pwd= $_POST["password"];
$group= $_POST["group"];
$rank= $_POST["rank"];
$email= $_POST["email"];
$sponsor_id= $_POST["sponsor_id"];
$url = $URL."registration/register_user.php";
$data = array( "name" =>$name, "password" =>$pwd, "group"=>$group, "rank" =>$rank, "email" =>$email, 
"sponsor_id"=>$sponsor_id );
$postdata = json_encode($data);
$result=giplCurl($url,$postdata);
if($result->message=="Registration Successfull"){


  //set bank
  $rank_data=array("id"=>$rank);
  $postdata1 = json_encode($rank_data);
  $rank_res=giplCurl($URL."rank/read_by_id.php",$postdata1);
  $r_amt=$rank_res->records[0]->code;

  //Set the rank data
    $rank_data=array("name"=>$rank,"status"=>"1");
    $postdata1 = json_encode($rank_data);
    $rank_res=giplCurl($URL."rank/read_by_id.php",$postdata1);
    $r_amt=$rank_res->records[0]->code;
    $rank_percentage=$rank_res->records[0]->percentage;



//Direct Income    
    $direct_amount=($DIRECT_PERCENTAGE+$rank_percentage)*$r_amt;
    $data=array("uid"=>$sponsor_id,"credited_by"=>$sponsor_id,"amount"=>$direct_amount,"total"=>$r_amt,"created_by"=>"Website UI");
    $postdata3 = json_encode($data);
    giplCurl($URL."direct_income/direct_create.php",$postdata3);

    header("Location: ../index.php?msg=success"); 
}
else{
  header("Location: ../register.php?msg=".$result->message); 
}


function giplCurl($api,$postdata){
  echo $url = $api; 
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    $response = curl_exec($client);
//   print_r($response);
    return $result = json_decode($response);
}
exit();


?>