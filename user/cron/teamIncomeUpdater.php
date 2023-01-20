<?php

$BASE_URL = "http://localhost/pscity";
$URL = $BASE_URL . "/cron/src/";
date_default_timezone_set("Asia/Kolkata");
$url_Insert_customer_purchase_team_details = $URL . "insert_team_details.php";
$url_read_team_income_job = $URL . "read_team_income_job.php";
$url_update_team_flag = $URL . "customer_payment_teamFlag_update.php";
$url_get_teamIncome_from_SP = $URL . "Call_Stored_procedure.php";
$url_get_all_agent = $URL . "All_Users.php";
$url_get_children_count = $URL . "getChildrenCount.php";
$url_get_all_direct_sponsor = $URL . "getChildrenDetails.php";
$url_insert_team_income = $URL . "insert_team_income.php";
$url_get_previous_amount = $URL . "getLastTeamIncome.php";
$constantAmount = 50000;
$result_Insert = null;

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
    return $result;
}

function CallSpToGetAmount($UserId, $level, $url_get_teamIncome_from_SP)
{
    $data_SP_team_income = array("UserId" => $UserId, "level" => $level);
    return  $result_SP_team_income = Encode_Decode_DataAndURL($data_SP_team_income, $url_get_teamIncome_from_SP);
}

$JobStartDateTime = strtotime(date('Y-m-d'));
echo "<br>" . "--------------*********----------------";
// ********************************* INSERT TEAM_INCOME_JOB *****************
$data_InsertcustomerPaymentTeam = array();
$result_InsertcustomerPaymentTeamDetails = Encode_Decode_DataAndURL($data_InsertcustomerPaymentTeam, $url_Insert_customer_purchase_team_details);
print_r($result_InsertcustomerPaymentTeamDetails);


echo "<br>" . "--------------********------------";

//***************************** READ TEAM_INCOME_JOB***********************
if ($result_InsertcustomerPaymentTeamDetails->message == "team_income_job table created.") {

    $data_readTeamIncome = array();
    $result_readTeamIncomeDetails = Encode_Decode_DataAndURL($data_readTeamIncome, $url_read_team_income_job);
    //echo "Reading view table team income job : " ."<br>";
    echo "<br>" . "--------------********------------";

    print_r($result_readTeamIncomeDetails);

    echo "<br>" . "--------------********------------";

    if (!empty($result_readTeamIncomeDetails->records[0]->UserId)) {
        // LOOP THROUGH AGENT ID 

        $data_get_all_agent = array();
        $result_get_all_agent = Encode_Decode_DataAndURL($data_get_all_agent, $url_get_all_agent);
        echo "<br>" . "--------------------printing all agent details .......";
        print_r($result_get_all_agent);
        echo "<br>" . "--------------********------------";

        // echo " AGENT ID : " .$result_readTeamIncomeDetails->records[0]->agent_id;
        if (!empty($result_get_all_agent->records[0]->UserId)) {

            //--------------------- LOOP THROUGH PARENT ID---------------------------

            foreach ($result_get_all_agent as $key => $value) {
                foreach ($value as $key1 => $value1) {


                    echo "<br>" . "User Id : " . $value1->UserId . "<br>";
                    // get count of childer of this userId.

                    $data_get_children_count = array("parentId" => $value1->UserId);
                    $result_get_children_count = Encode_Decode_DataAndURL($data_get_children_count, $url_get_children_count);
                    if ($result_get_children_count->records[0]->Counts == 2) {

                        //------------------------------Get AGENT ka  direct team  details ------------------------------
                        $data_get_all_direct_sponsor = array("parentId" => $value1->UserId);
                        $result_get_all_direct_sponsor = Encode_Decode_DataAndURL($data_get_all_direct_sponsor, $url_get_all_direct_sponsor);;
                        echo "<br>" . "--------------printing all children details--------------";

                        print_r($result_get_all_direct_sponsor);
                        echo "<br>" . "---------------------------";

                        if (!empty($result_get_all_direct_sponsor->records[0]->UserId)) {

                            $FirstChildAmount = 0;
                            $SecondChildAmount = 0;
                            if ($result_get_all_direct_sponsor->records[0]->UserId)
                                $result_SP_teamIncomeForFirstChild =  CallSpToGetAmount($result_get_all_direct_sponsor->records[0]->UserId, 9, $url_get_teamIncome_from_SP);
                            if (!empty($result_SP_teamIncomeForFirstChild->records[0]->amount)) {
                                $FirstChildAmount = abs($result_SP_teamIncomeForFirstChild->records[0]->amount);
                            }
                            $result_SP_teamIncomeForSecondChild =  CallSpToGetAmount($result_get_all_direct_sponsor->records[1]->UserId, 9, $url_get_teamIncome_from_SP);
                            if (!empty($result_SP_teamIncomeForSecondChild->records[0]->amount)) {
                                $SecondChildAmount = abs($result_SP_teamIncomeForSecondChild->records[0]->amount);
                            }

                            echo "First Child Amount : " . $FirstChildAmount . "<br>";
                            echo "Secod Child Amount : " . $SecondChildAmount . "<br>";

                            if (($FirstChildAmount == null) || ($SecondChildAmount == null)) {
                                $AmountPaidFromSP = 0;
                            } else {
                                echo "First Child amount : " . $FirstChildAmount;
                                echo "second Child amount : " . $SecondChildAmount;

                                $AmountPaidFromSP = ($FirstChildAmount >= $SecondChildAmount) ? $SecondChildAmount : $FirstChildAmount;
                            }
                            $data_get_previous_amount = array("UserId" => $value1->UserId);
                            $result_get_previou_amount = Encode_Decode_DataAndURL($data_get_previous_amount, $url_get_previous_amount);
                            echo "<br>" . "Previous Amount for Parent  : " . $value1->UserId . "----------------------------";

                            print_r($result_get_previou_amount);
                            if (isset($result_get_previou_amount->message)) {

                                $PreviousAmountOfUsers = 0;
                            } else {
                                $PreviousAmountOfUsers = abs($result_get_previou_amount->records[0]->TotalAmount);
                            }

                            /// yaha pe is set kro ki id set hai kya ??
                            // agar nhi hai to by default 10 le other wise id 
                              $NoOfDays = isset($_GET['Id']) ? $NoOfDays : 10;
                                 $TotalAmountFromConstantAmount = $constantAmount * $NoOfDays;
                              $TotalAmountPaid = ($AmountPaidFromSP - $PreviousAmountOfUsers);
                            $TotalAmountFromSP = $TotalAmountPaid > 0 ? $TotalAmountPaid : 0;
                             $AmountToBePaid = ($TotalAmountFromConstantAmount > $TotalAmountFromSP) ? $TotalAmountFromSP : $TotalAmountFromConstantAmount;
                            $FinalAmount = (5 / 100) * $AmountToBePaid;
                            echo "Last amount to be paid for User : " . $value1->UserId . "-- Amount --" . $AmountToBePaid;
                            echo "sponsor Id : "  . $value1->sponsorId;
                            if ($FinalAmount > 0) {
                                //--- insert krte time team and agent dono agr same ho to  by default 1 percentage dena hoga
                                $data_insert_team_income = array(
                                    "UserId" => $value1->UserId,
                                    "parentId" => $value1->parentId,
                                    "sponsorId" => $value1->sponsorId,
                                    "AmountPaid" => $FinalAmount,
                                    "TotalAmount" => $AmountToBePaid,
                                    "MemberIncomeFlag" => 1,

                                    "IncomeCreatedBy" => $value1->UserId,
                                    "IncomeCreatedOn" => strtotime(date('Y-m-d H:i:s')),

                                );
                                echo "<br>" . "PRINTING INSERT DATA******************" . "<br>";
                                echo "<br>";

                                print_r($data_insert_team_income);

                                $result_Insert = Encode_Decode_DataAndURL($data_insert_team_income, $url_insert_team_income);
                                print_r($result_Insert);
                            }
                        }
                    }
                }
            }
        }
    }
}
