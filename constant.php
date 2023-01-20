<?php
//error_reporting(0);
session_start();
date_default_timezone_set('Asia/Kolkata');

$BASE_URL="http://pscityinfra.com";
$URL=$BASE_URL."/api/src/";
//$IN_URL=$BASE_URL."/user/api/src/";
$TREE_SIZE=8;
$CLIENT_NAME= "P.S CITY ALLAHABAD";
$ADDRESS=" Civil Line,
NEAR HEERA HALWAI,
CITY CART BASMENT,
Prayagraj (Allahabad),
Uttar Pradesh 211013";
$COMPANY_REG_NUM="REG NO";

$directIncomePercentage=10;
$teamIncomePercentage=6;

// $DIRECT_PERCENTAGE="0.10";

// $HOME="index.php";

$SECRET_KEY="dKgLINTEL2021aN99840$@#";  
$ISSUER_CLAIM = "GLINTEL TECHNOLOGY PVT LTD"; // this can be the servername
$AUDIENCE_CLAIM = "ULTRIMAX MLM";
$LOGIN_SUCCESS_MSG="Login Successful";
$LOGIN_FAILED_MSG="Login Failed";
$LOGIN_ACTION="";
$ADMIN_IMG_PATH=$BASE_URL."user/img/";
$PLOT_ACCESS="plot_access";

$ROLE="";
if(isset($_SESSION['UserType']))
if($_SESSION['UserType']=="")
{
$ROLE="";
}
else if($_SESSION['UserType']==2){
$ROLE="site_entry, site_list, plot_entry, available_plot, plot_sale,
award_reward_entry, award_reward_list, family_entry, family_bonus_list,
bonanza_entry, bonanza_list, User_Create, User_Withdrawal_List_For_Admin, User_Withdrawal_List,User_Withdrawal
notice_entry, notice_list, Users_All_List, plot_payment, Members_Create_byadmin,Members_ByAdmin_Create,
Users_Members_List, User_Members_PendingList, User_DirectIncome, reward_income, award_income,Users_List_Approve
User_Direct_Payment_Income, family_income,installment,Customer_Payment_List,network_tree";
}
else if($_SESSION['UserType']==3){
$ROLE="plot_access, site_list,
available_plot, award_reward_list, 
User_Profile, upload_photo, User_Bank_Update,
Users_Direct_Team_List, User_DirectMembers_List,
upload_pan, network_tree,customer_pro_update, 
pay_emi, team_income, direct_income,
bonanza_list, family_bonus_list, available_plot, User_Withdrawal_Req,
User_Withdrawal_List,notice_list, award_income, reward_income,
award_income, User_DirectIncome, family_income,User_Direct_Payment_Income, User_Withdrawal,team_list,Customer_Payment_List";
}

$DASHBOARD="";
if(isset($_SESSION['UserType']))
if($_SESSION['UserType']==3)
{
$DASHBOARD="total_plot,total_customer,
total_plot_amount,
total_plot_paid_amount,
total_plot,total_agent,available_site,total_commision";
}
else if($_SESSION['UserType']==2){
    $DASHBOARD= "total_plot,total_agent, available_site,
    total_customer,total_plot_amount,total_plot_paid_amount,total_commision";
}

$PLOT_ENTRY="plot_entry";
$SITE_ENTRY="site_entry";
$SITE_LIST="site_list";
$AVAILABLE_PLOT="available_plot"; 
$PLOT_SALE="plot_sale";
$AWARD_REWARD_ENTRY="award_reward_entry";
$AWARD_REWARD_LIST="award_reward_list";
$BONANZA_ENTRY="bonanza_entry";
$BONANZA_LIST="bonanza_list";
$USER_ALL_LIST="Users_List_Approve";
$MY_TEAM_LIST="Users_Direct_Team_List";
$NOTICE_ENTRY="notice_entry";
$NOTICE_LIST="notice_list";
$USERS_MEMBER_LIST="Users_Members_List";
$USERS_MEMBER_PENDING_LIST="User_Members_PendingList";
$TEAM_LIST="team_list";
$USERS_MEMBERS_CREATE="Users_Members_Create";
$MEMBER_CREATE_BY_ADMIN="Members_ByAdmin_Create";
$EMI_LIST="emi_list";
$PAY_EMI="pay_emi";
$DIRECT_INCOME="direct_income";
$TEAM_INCOME="team_income";
$USER_PROFILE="User_Profile";
$USER_BANK_UPDATE="User_Bank_Update";
$DIRECT_TEAM_LIST="director_team_list";
$USER_DIRECTMEMBERS_LIST ="User_DirectMembers_List";
$UPLOAD_PAN="upload_pan";
$UPLOAD_PHOTO="upload_photo";
$NETWORK_TREE="network_tree";
$FAMILY_ENTRY="family_entry";
$FAMILY_BONUS_LIST="family_bonus_list";
$USER_CREATE="User_Create";
$PLOT_PAYMENT="installment";
$USER_DIRECT_INCOME="User_DirectIncome";
$USER_WITHDRAWAL_LIST_FOR_ADMIN="User_Withdrawal_List_For_Admin";
$USER_WITHDRAWAL="User_Withdrawal";
$USER_WITHDRAWAL_LIST="User_Withdrawal_List";
$AWARD_INCOME="award_income";
$REWARD_INCOME="reward_income";
$FAMILY_INCOME="family_income";
$USER_DIRECT_PAYMENT_INCOME="User_Direct_Payment_Income";
$Customer_Payment_List="Customer_Payment_List";




/**
 * DASHBOARD
 */
$TOTAL_AGENT="total_agent";
$TOTAL_CUSTOMER ="total_customer";
$TOTAL_PLOT="total_plot";
$AVAILABLE_SITE="available_site";
$TOTAL_PLOT_AMOUNT="total_plot_amount";
$TOTAL_PLOT_PAID_AMOUNT="total_plot_paid_amount";
$TOTAL_COMMISION="total_commision"
?>