<?php
include '../../constant.php';

if(isset($_POST["exam_name"])){

 $exam_name=strtoupper($_POST["exam_name"]);
 $type=$_POST["type"];
 $amount=$_POST["amount"];
 $eligibility=ucfirst($_POST["eligibility"]);
 $total_post=$_POST["total_post"];
 $age=$_POST["age"];
 $exam_date_start=date("Y-m-d", strtotime($_POST["exam_date_start"]));
 $exam_date_end=date("Y-m-d", strtotime($_POST["exam_date_end"]));
 $admit_card_date=date("Y-m-d", strtotime($_POST["admit_card_date"]));
 $result_date=date("Y-m-d", strtotime($_POST["result_date"]));

 $url=$URL. "exam/insert_exam.php";
 $data = array("exam_name"=>$exam_name,"amount"=>$amount, "eligibility"=>$eligibility, 
 "total_post"=>$total_post, "type"=>$type, "age"=>$age, "exam_date_start"=>$exam_date_start,
 "admit_card_date"=>$admit_card_date, "result_date"=>$result_date, "status"=>"1", "created_by"=>"Admin",
 "exam_date_end"=>$exam_date_end, "created_on"=>date("Y-m-d"));

 //print_r($data);
 $postdata = json_encode($data);
 $result=url_encode_Decode($url,$postdata);
 //print_r($result);
 if($result->message=="Successfull"){
 header('Location:../exam_list.php');
 } 
 header('Location:../exam_list.php');
 }

 function url_encode_Decode($url,$postdata){
 $client = curl_init($url);
 curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
 $response = curl_exec($client);
 //print_r($response);
 $result = json_decode($response);
 return $result;

}

?>