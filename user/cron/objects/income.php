<?php

class income{

    private $conn;
    private $site_purchasehistory="site_purchasehistory", $users="users" ,
     $team_income_job="team_income_job", $usertype="usertype",
    $users_directincome="users_directincome" ,$users_withdrawal="users_withdrawal" 
     ,$users_membersincome="users_membersincome";
    public $PurchaseHistoryId, $PurchaseInvoiceId, $SiteId,$PlotNo,$SiteTotalAmount,$SitePurchaseSection,
    $SitePurchaseName,$MemberId,$UserId,$SitePurchaseWidth,$SitePurchaseDepth,$SitePurchaseCorner,
    $SitePurchaseDiscount,$PurchaseAmountLeft,$PurchasedModeId,$ReceiptNo,$PurchaseAmountPaid,$TotalCommission,
    $SitePurchaseAmount,$PurchasedBy,$PurchasedOn ,$userFlag,$memberFlag,$PurchaseUpdatedBy,$PurchaseUpdatedOn,$sponsorId,$WithdrawalAmount,$AmountAfterCharges,
    $TDS,$AdminCharges,$DirectIncome,$TeamIncome,$parentId, $WithdrawalStatus,$CreatedBy,$CreatedOn, $TotalAmount,
    $DirectIncomeFlag,$MemberIncomeFlag,$IncomeCreatedOn,$IncomeCreatedBy,$updatedBy,$updatedOn;
    public function __construct($db){
        $this->conn = $db;
    }

    public function getUserDirectIncome(){
        $query= "Select PurchaseHistoryId, PurchaseInvoiceId, SiteId,PlotNo,SiteTotalAmount,SitePurchaseSection,
        SitePurchaseName,MemberId,site_purchasehistory.UserId as UserId, userFlag,memberFlag, users.sponsorId as sponsorId, SitePurchaseWidth,SitePurchaseDepth,SitePurchaseCorner,
        SitePurchaseDiscount,PurchaseAmountLeft,PurchasedModeId,ReceiptNo,PurchaseAmountPaid,TotalCommission,
        SitePurchaseAmount,PurchasedBy,PurchasedOn from " . $this->site_purchasehistory ." join  " . $this->users ."
        on site_purchasehistory.UserId=users.UserId        
        where userFlag=1 ";
        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        return $stmt;
        }


    

    public function updateUserFlag(){
        $query=" UPDATE   ". $this->site_purchasehistory . "
        SET
      userFlag=1, PurchaseUpdatedBy=:PurchaseUpdatedBy, PurchaseUpdatedOn=:PurchaseUpdatedOn where PurchaseHistoryId=:PurchaseHistoryId";
       
       $stmt= $this->conn->prepare($query);
       $this->userFlag=htmlspecialchars(strip_tags($this->userFlag));
       $this->PurchaseUpdatedBy=htmlspecialchars(strip_tags($this->PurchaseUpdatedBy));
       
       $this->PurchaseUpdatedOn=htmlspecialchars(strip_tags($this->PurchaseUpdatedOn));
       $this->PurchaseHistoryId=htmlspecialchars(strip_tags($this->PurchaseHistoryId)); 
       $stmt->bindParam(":userFlag", $this->userFlag);
       $stmt->bindParam(":PurchaseUpdatedBy", $this->PurchaseUpdatedBy);
       
          $stmt->bindParam(":PurchaseUpdatedOn", $this->PurchaseUpdatedOn);
          $stmt->bindParam(":PurchaseHistoryId", $this->PurchaseHistoryId);
          
          if($stmt->execute()){
             return true;
          }
          else
          return false;
       }

    function directIncomeCreate(){
     
        // query to insert record
       $query = "INSERT INTO
                " . $this->users_directincome . "
                SET
                PurchaseHistoryId=:PurchaseHistoryId,
                PurchaseInvoiceId=:PurchaseInvoiceId,
                ReceiptNo=:ReceiptNo,
                PurchaseModeId=:PurchaseModeId,
                UserId=:UserId,
                MemberId=:MemberId, 
                AmountPaid=:AmountPaid,
                CommissionPaid=:CommissionPaid,
                IncomeCreatedBy=:IncomeCreatedBy,
                IncomeCreatedOn=:IncomeCreatedOn
                ";
     
      // prepare query
      $stmt = $this->conn->prepare($query);
     
      // sanitize
      $this->PurchaseHistoryId =htmlspecialchars(strip_tags($this->PurchaseHistoryId ));
      $this->PurchaseInvoiceId=htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
      $this->ReceiptNo=htmlspecialchars(strip_tags($this->ReceiptNo));
      $this->PurchaseModeId=htmlspecialchars(strip_tags($this->PurchaseModeId));
      $this->UserId=htmlspecialchars(strip_tags($this->UserId));
      $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
      $this->AmountPaid=htmlspecialchars(strip_tags($this->AmountPaid));
      $this->CommissionPaid=htmlspecialchars(strip_tags($this->CommissionPaid));
      
      $this->IncomeCreatedBy=htmlspecialchars(strip_tags($this->IncomeCreatedBy));
      $this->IncomeCreatedOn=htmlspecialchars(strip_tags($this->IncomeCreatedOn));
      //bind values
     
      $stmt->bindParam(":PurchaseHistoryId", $this->PurchaseHistoryId);
      $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);
      $stmt->bindParam(":ReceiptNo", $this->ReceiptNo);
      $stmt->bindParam(":PurchaseModeId", $this->PurchaseModeId);
      $stmt->bindParam(":UserId", $this->UserId);
      $stmt->bindParam(":MemberId", $this->MemberId);
      $stmt->bindParam(":AmountPaid", $this->AmountPaid);
      $stmt->bindParam(":CommissionPaid", $this->CommissionPaid);
      
      $stmt->bindParam(":IncomeCreatedBy", $this->IncomeCreatedBy);
      $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);
     
      // execute query
      if($stmt->execute()){
      return true;
      }
      return false;
     
     }
     //----------------------------------------------------------------


    function insertUsersWithdrawal(){
     
        // query to insert record
       $query = "INSERT INTO
                " . $this->users_withdrawal . "
                SET
                WithdrawalAmount=:WithdrawalAmount,
                AmountAfterCharges=:AmountAfterCharges,
                TDS=:TDS,
                AdminCharges=:AdminCharges,
                UserId=:UserId,
                WithdrawalStatus=:WithdrawalStatus,
                DirectIncome=:DirectIncome,
                TeamIncome=:TeamIncome, 
                CreatedBy=:CreatedBy,
                CreatedOn=:CreatedOn
                ";
     
      // prepare query
      $stmt = $this->conn->prepare($query);
     
      // sanitize
      $this->WithdrawalAmount =htmlspecialchars(strip_tags($this->WithdrawalAmount ));
      $this->AmountAfterCharges=htmlspecialchars(strip_tags($this->AmountAfterCharges));
      $this->TDS=htmlspecialchars(strip_tags($this->TDS));
      $this->AdminCharges=htmlspecialchars(strip_tags($this->AdminCharges));
      $this->UserId=htmlspecialchars(strip_tags($this->UserId));
      $this->DirectIncome=htmlspecialchars(strip_tags($this->DirectIncome));
      $this->TeamIncome=htmlspecialchars(strip_tags($this->TeamIncome));
      $this->WithdrawalStatus=htmlspecialchars(strip_tags($this->WithdrawalStatus));
      
      $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
      $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));
      //bind values
     
      $stmt->bindParam(":WithdrawalAmount", $this->WithdrawalAmount);
      $stmt->bindParam(":AmountAfterCharges", $this->AmountAfterCharges);
      $stmt->bindParam(":TDS", $this->TDS);
      $stmt->bindParam(":AdminCharges", $this->AdminCharges);
      $stmt->bindParam(":UserId", $this->UserId);
      $stmt->bindParam(":DirectIncome", $this->DirectIncome);
      $stmt->bindParam(":TeamIncome", $this->TeamIncome);
      $stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);
      
      $stmt->bindParam(":CreatedBy", $this->CreatedBy);
      $stmt->bindParam(":CreatedOn", $this->CreatedOn);
     
      // execute query
      if($stmt->execute()){
      return true;
      }
      return false;
     
     }

    
     public function getUsersDirectIncome(){
$query="select UserId, Sum(AmountPaid) as AmountPaid,DirectIncomeFlag,IncomeCreatedBy,IncomeCreatedOn
 from " . $this->users_directincome . "  where  DirectIncomeFlag=1  and IncomeCreatedOn <=:IncomeCreatedOn";
 $stmt = $this->conn->prepare($query);
$stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);

 $stmt->execute();
 return $stmt;

     }
    
  
     
     public function getUsersTeamIncome(){
        $query="select UserId, Sum(AmountPaid) as AmountPaid,MemberIncomeFlag,IncomeCreatedBy,IncomeCreatedOn
         from " . $this->users_membersincome . "  where  MemberIncomeFlag=1  and IncomeCreatedOn <=:IncomeCreatedOn and UserId=:UserId";
         $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":UserId", $this->UserId);
        $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);
         $stmt->execute();
         return $stmt;
      
             }

             function Insert_team_details()
  {

    // select all query
    $query = "CREATE or replace View `team_income_job` as  SELECT UserId, ParentId,teamFlag, sum(PurchaseAmountPaid) as amount
  FROM
  " . $this->site_purchasehistory . "
    where teamFlag=1 group by UserId";
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
  }

  function read_team_income_job()
  {

    // select all query
    $query = "SELECT UserId, ParentId,teamFlag, amount
  FROM
  " . $this->team_income_job . " ";
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
  }

  function customer_payment_Teamflag_update()
  {

    // query to insert record
    $query = "UPDATE
              " . $this->site_purchasehistory . "
          SET
          teamFlag=:teamFlag,
                updatedBy=:updatedBy,
                updatedOn=:updatedOn
                       WHERE
                       PurchasedOn<=:PurchasedOn";
    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->teamFlag = htmlspecialchars(strip_tags($this->teamFlag));
    //$this->agent_id = htmlspecialchars(strip_tags($this->agent_id));
    $this->PurchasedOn = htmlspecialchars(strip_tags($this->PurchasedOn));
    //$this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
    $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
    $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
    //bind values
    $stmt->bindParam(":teamFlag", $this->teamFlag);
    // $stmt->bindParam(":id", $this->id);
    // /$stmt->bindParam(":agent_id", $this->agent_id);
    $stmt->bindParam(":PurchasedOn", $this->PurchasedOn);
    $stmt->bindParam(":updatedOn", $this->updatedOn);
    $stmt->bindParam(":updatedBy", $this->updatedBy);

    // execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
  function Call_team_income_sp()
  {
    $stmt = $this->conn->prepare("CALL sp_get_team_income(?, ?)");
    $stmt->bindParam(1, $this->UserId, PDO::PARAM_STR);
    $stmt->bindParam(2, $this->level, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
  }

  function insert_team_income()
  {
    // query to insert record
    $query = "INSERT INTO
  " . $this->users_membersincome . "
SET
       UserId=:UserId,
       sponsorId=:sponsorId,
      parentId=:parentId,
      AmountPaid=:AmountPaid,
      MemberIncomeFlag=:MemberIncomeFlag,
       TotalAmount=:TotalAmount,
        IncomeCreatedBy=:IncomeCreatedBy,
        IncomeCreatedOn=:IncomeCreatedOn";
    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize

    $this->UserId = htmlspecialchars(strip_tags($this->UserId));
    $this->sponsorId = htmlspecialchars(strip_tags($this->sponsorId));
    $this->parentId = htmlspecialchars(strip_tags($this->parentId));
    $this->AmountPaid = htmlspecialchars(strip_tags($this->AmountPaid));
    $this->MemberIncomeFlag = htmlspecialchars(strip_tags($this->MemberIncomeFlag));
    $this->TotalAmount = htmlspecialchars(strip_tags($this->TotalAmount));
   

    $this->IncomeCreatedBy = htmlspecialchars(strip_tags($this->IncomeCreatedBy));
    $this->IncomeCreatedOn = htmlspecialchars(strip_tags($this->IncomeCreatedOn));
   
    $stmt->bindParam(":UserId", $this->UserId);
    $stmt->bindParam(":sponsorId", $this->sponsorId);
    $stmt->bindParam(":parentId", $this->parentId);
    $stmt->bindParam(":AmountPaid", $this->AmountPaid);
    $stmt->bindParam(":TotalAmount", $this->TotalAmount);

    $stmt->bindParam(":MemberIncomeFlag", $this->MemberIncomeFlag);
    $stmt->bindParam(":IncomeCreatedBy", $this->IncomeCreatedBy);
    $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);
    // execute query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  function All_Users(){

    $query= " Select UserId, UserName,UserEmail,Position,sponsorId,parentId, Phone,UserDOB,Password,AadharNo, PanNo , Users.UserType, userType.userRole,
    CreatedBy, Status, Address, CreatedOn from " . $this->users . "  join  " . $this->usertype . 
    " on Users.UserType=usertype.userType   where  Users.UserType=3";
    $stmt = $this->conn->prepare($query);  
 $stmt->execute();
 return $stmt;
 }

 function get_children_count(){

    $query= " Select count(*) as Counts from " . $this->users . "  where  parentId=:parentId";
    $stmt = $this->conn->prepare($query);  
    $stmt->bindParam(":parentId", $this->parentId);
 $stmt->execute();
 return $stmt;
 }
 function getChildrenDetails(){

    $query= " Select UserId,UserName,UserEmail,Position,sponsorId,parentId,UserType
     from " . $this->users . "  where  parentId=:parentId";
    $stmt = $this->conn->prepare($query); 
      $stmt->bindParam(":parentId", $this->parentId); 
 $stmt->execute();
 return $stmt;
 }

 function getPreviousTeamIncome(){

    $query= " Select UserId,AmountPaid,sum(TotalAmount) as TotalAmount
     from " . $this->users_membersincome . "  where  UserId=:UserId order by MembersIncomeId Desc limit 1";
    $stmt = $this->conn->prepare($query); 
      $stmt->bindParam(":UserId", $this->UserId); 
 $stmt->execute();
 return $stmt;
 }

 function updateDirectIncomeFlag()
 {

   // query to insert record
   $query = "UPDATE
             " . $this->users_directincome . "
         SET
         DirectIncomeFlag=:DirectIncomeFlag,
               updatedBy=:updatedBy,
               updatedOn=:updatedOn
                      WHERE
                      IncomeCreatedOn<=:IncomeCreatedOn";
   // prepare query
   $stmt = $this->conn->prepare($query);

   // sanitize
   $this->DirectIncomeFlag = htmlspecialchars(strip_tags($this->DirectIncomeFlag));
   //$this->agent_id = htmlspecialchars(strip_tags($this->agent_id));
   $this->IncomeCreatedOn = htmlspecialchars(strip_tags($this->IncomeCreatedOn));
   //$this->agent_id=htmlspecialchars(strip_tags($this->agent_id));
   $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
   $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
   //bind values
   $stmt->bindParam(":DirectIncomeFlag", $this->DirectIncomeFlag);
   // $stmt->bindParam(":id", $this->id);
   // /$stmt->bindParam(":agent_id", $this->agent_id);
   $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);
   $stmt->bindParam(":updatedOn", $this->updatedOn);
   $stmt->bindParam(":updatedBy", $this->updatedBy);

   // execute query
   if ($stmt->execute()) {
     return true;
   }

   return false;
 }

 
 function updateTeamIncomeFlag()
 {

   // query to insert record
   $query = "UPDATE
             " . $this->users_membersincome . "
         SET
         MemberIncomeFlag=:MemberIncomeFlag,
               updatedBy=:updatedBy,
               updatedOn=:updatedOn
                      WHERE
                      IncomeCreatedOn<=:IncomeCreatedOn";
   // prepare query
   $stmt = $this->conn->prepare($query);

   // sanitize
   $this->MemberIncomeFlag = htmlspecialchars(strip_tags($this->MemberIncomeFlag));
   
   $this->IncomeCreatedOn = htmlspecialchars(strip_tags($this->IncomeCreatedOn));
   
   $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
   $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
   //bind values
   $stmt->bindParam(":MemberIncomeFlag", $this->MemberIncomeFlag);
   $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);
   $stmt->bindParam(":updatedOn", $this->updatedOn);
   $stmt->bindParam(":updatedBy", $this->updatedBy);

   // execute query
   if ($stmt->execute()) {
     return true;
   }

   return false;
 }
    }
