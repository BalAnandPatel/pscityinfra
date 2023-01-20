<?php
include '../../constant.php';

 if(isset($_POST["submit"])){

    $AwardName=$_POST["AwardName"];
    $RewardAccessories= $_POST["RewardAccessories"];
    $AmountUpto= $_POST["AmountUpto"];
    $RankPercentage= $_POST["RankPercentage"];
    $FamilySupportBonus= $_POST["FamilySupportBonus"];
    $RewardDuration= $_POST["RewardDuration"];
    $Status=1;
    $CreatedBy=$_POST["RewardAccessories"];
    
   $url = $URL."awardReward/Award_Reward_create.php";
   
   $data = array("AwardName"=>$AwardName, "RewardAccessories" =>$RewardAccessories, "AmountUpto" =>$AmountUpto, "RankPercentage" =>$RankPercentage,
   "FamilySupportBonus"=>$FamilySupportBonus, "RewardDuration"=>$RewardDuration, "Status"=>$Status, "CreatedBy"=>$CreatedBy);
   //print_r($data);
   $postdata = json_encode($data);
   $client = curl_init($url);
   curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   //curl_setopt($client, CURLOPT_POST, 5);
   curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
   $response = curl_exec($client);
   //print_r($response);
   $result = json_decode($response);
   //print_r($result);
   
   
   header('Location:../award_reward_entry.php?success');
exit();
 }

?>