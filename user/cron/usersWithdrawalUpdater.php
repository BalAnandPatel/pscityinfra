<?php

$BASE_URL = "http://localhost/pscity";
$URL = $BASE_URL . "/cron/src/";

$url_get_users_direct_income = $URL . "getUsersDirectIncome.php";
$url_get_users_team_income = $URL . "getUsersTeamIncome.php";
$url_insert_users_withdrawal = $URL . "insertUsersWithdrawal.php";
$url_update_Direct_Income_Flag = $URL . "updateDirectIncomeFlag.php";
$url_update_Team_Income_Flag = $URL . "updateTeamIncomeFlag.php";
date_default_timezone_set("Asia/Kolkata");

function Encode_Decode_DataAndURL($data, $url)
{
    $postdata = json_encode($data);
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($client, CURLOPT_POST, 5);
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    $response = curl_exec($client);
   // print_r($response);
    $result = json_decode($response);
    //print_r($result);
    return $result;
}

echo "date : " . $JobStartedDateTime = strtotime(date('Y-m-d'));
$dataGetDirectIncome = array("IncomeCreatedOn" => $JobStartedDateTime);
$resultGetDirectIncome = Encode_Decode_DataAndURL($dataGetDirectIncome, $url_get_users_direct_income);
if (!empty($resultGetDirectIncome->records[0]->UserId)) {
    foreach ($resultGetDirectIncome as $key => $value) {
        foreach ($value as $key1 => $value1) {

            $dataGetTeamIncome = array("UserId" => $value1->UserId, "IncomeCreatedOn" => $JobStartedDateTime);
            $resultGetTeamIncome = Encode_Decode_DataAndURL($dataGetTeamIncome, $url_get_users_team_income);
            if ((!$resultGetTeamIncome->records[0]->UserId==null) || ($resultGetTeamIncome->records[0]->UserId==null)) {
                 if(($resultGetTeamIncome->records[0]->AmountPaid==null) || ($resultGetTeamIncome->records[0]->AmountPaid=="")){
                    $Team_Income=0.00;
                 }
                 else{
                    $Team_Income=$resultGetTeamIncome->records[0]->AmountPaid;
                 }

                $UserId = $value1->UserId;
                $TeamIncome = $Team_Income;
                $Directincome = $value1->AmountPaid;
                $WithdrawalAmount = $TeamIncome + $Directincome;
                $WithdrawalStatus = 3;
                $TDS = 5;
                $AdminCharges = 5;
                $AmountAfterCharges = ($TDS + $AdminCharges) / 100 * ($WithdrawalAmount);
                $CreatedBy = $value1->UserId;
                $CreatedOn = strtotime(date('Y-m-d H:i:s'));
                $dataInsertUsersWithdrawal = array("UserId" => $UserId, "AmountAfterCharges"=>$AmountAfterCharges, "WithdrawalAmount" => $WithdrawalAmount, "DirectIncome" => $Directincome, "TeamIncome" => $TeamIncome, "TDS" => $TDS, "AdminCharges" => $AdminCharges, "WithdrawalStatus" => $WithdrawalStatus, "CreatedBy" => $CreatedBy, "CreatedOn" => $CreatedOn);
                print_r($dataInsertUsersWithdrawal);
                $resultInsertUsersWithdrawal = Encode_Decode_DataAndURL($dataInsertUsersWithdrawal, $url_insert_users_withdrawal);
                print_r($resultInsertUsersWithdrawal);
            }
            if ($resultInsertUsersWithdrawal->message == "Users Withdrawal created Succssfully.") {
                //updated all the direct team income and direct income


                $updatedBy = $value1->UserId;
                $updatedOn = strtotime(date('Y-m-d H:i:s'));
                $DirectIncomeFlag = 0;
                $MemberIncomeFlag = 0;

                $data_update_Direct_Income_Flag = array("IncomeCreatedOn" => $JobStartedDateTime, "updatedOn" => $updatedOn, "updatedBy" => $updatedBy, "DirectIncomeFlag" => $DirectIncomeFlag);
                $result_direct_Income_flag = Encode_Decode_DataAndURL($data_update_Direct_Income_Flag, $url_update_Direct_Income_Flag);

                $data_update_Team_Income_Flag = array("IncomeCreatedOn" => $JobStartedDateTime, "updatedOn" => $updatedOn, "updatedBy" => $updatedBy, "MemberIncomeFlag" => $MemberIncomeFlag);
                $result_team_Income_flag = Encode_Decode_DataAndURL($data_update_Team_Income_Flag, $url_update_Team_Income_Flag);
            }
        }
    }
}
