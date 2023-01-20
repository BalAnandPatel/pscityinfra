<?php

class UsersWithdrawal{
  
   // database connection and table name
   private $conn;
   private $site_purchasehistory="site_purchasehistory";
   private $users_directincome="users_directincome";
   private $users_Withdrawal= "users_Withdrawal";
   private $users= "users";
   


    private $users_membersincome = "users_membersincome";
   
   // object properties
    
   public $WithdrawalId, $WithdrawalAmount, $TDS ,$Remark, $AdminCharges, $DirectIncome,$TeamIncome, $WithdrawalStatus, $CreatedBy , $CreatedOn,$ApprovedOn,$ApprovedBy ,$CommissionPaid,$CommissionLeft ,$IncomeCreatedBy, $IncomeCreatedOn, $TotalCommssion,$AmountAfterCharges;

   public function __construct($db){
      $this->conn = $db;
  }

   public function Users_WithdrawalCreate(){
 echo $query= " INSERT into ". $this->users_Withdrawal ." 
SET
WithdrawalAmount=:WithdrawalAmount,
 TDS=:TDS, 
 AdminCharges=:AdminCharges,
 AmountAfterCharges=:AmountAfterCharges,
  WithdrawalStatus=:WithdrawalStatus,
  CreatedBy=:CreatedBy,
  CreatedOn=:CreatedOn";

      $stmt= $this->conn->prepare($query);

      $this->WithdrawalAmount=htmlspecialchars(strip_tags($this->WithdrawalAmount));
       $this->TDS=htmlspecialchars(strip_tags($this->TDS));
       $this->AdminCharges=htmlspecialchars(strip_tags($this->AdminCharges));
       $this->AmountAfterCharges=htmlspecialchars(strip_tags($this->AmountAfterCharges));
       $this->WithdrawalStatus=htmlspecialchars(strip_tags($this->WithdrawalStatus));
       $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
       $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));
       
       $stmt->bindParam(":WithdrawalAmount",$this->WithdrawalAmount);
       $stmt->bindParam(":TDS",$this->TDS);
       $stmt->bindParam(":AdminCharges",$this->AdminCharges);
       $stmt->bindParam(":AmountAfterCharges",$this->AmountAfterCharges);

       $stmt->bindParam(":WithdrawalStatus",$this->WithdrawalStatus);
       $stmt->bindParam(":CreatedBy",$this->CreatedBy);
       $stmt->bindParam(":CreatedOn",$this->CreatedOn);
       
if($stmt->execute()){
   return true;
}
else{
   return false;
}
 }
//status=0
 function Users_WithdrawalPendingList(){
     $query=" SELECT  WithdrawalId,uw.UserId as UserId,  WithdrawalAmount,DirectIncome,TeamIncome, TDS,AdminCharges, AmountAfterCharges, WithdrawalStatus,uw.CreatedBy as CreatedBy,uw.CreatedOn as CreatedOn, us.UserName as UserName, us.UserEmail as UserEmail , us.Phone as Phone,us.Address
 from " . $this->users_Withdrawal . " AS uw   JOIN " . $this->users . " as us on uw.CreatedBy=us.UserId  where WithdrawalStatus=:WithdrawalStatus";
$stmt = $this->conn->prepare($query); 
$stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);

$stmt->execute();
return $stmt;
}
//status=1
function Users_WithdrawalApprovedList(){
   $query=" SELECT WithdrawalId, uw.UserId as UserId, WithdrawalAmount, TDS, AdminCharges, WithdrawalStatus, uw.CreatedBy,uw.CreatedOn, us.UserName, us.UserEmail , us.Phone,us.Address, (select UserName from " . $this->users . " join " . $this->users_Withdrawal .  " as w on users.UserId=w.ApprovedBy ) as ApproverName, ApprovedOn
 from " . $this->users_Withdrawal . "  as uw  JOIN " . $this->users . " as us on uw.CreatedBy=us.UserId  where WithdrawalStatus=:WithdrawalStatus";
$stmt = $this->conn->prepare($query); 
$stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);

$stmt->execute();
return $stmt;
}
//Status=2
function Users_WithdrawalRejectedList(){
    $query=" SELECT WithdrawalId, WithdrawalAmount, TDS, AdminCharges, WithdrawalStatus, uw.CreatedBy,uw.CreatedOn, us.UserName, us.UserEmail , us.Phone,us.Address, (select UserName from " . $this->users . " join " . $this->users_Withdrawal .  " as w on users.UserId=w.ApprovedBy ) as RejectorName, ApprovedOn
 from " . $this->users_Withdrawal . "  as uw  JOIN " . $this->users . " as us on uw.CreatedBy=us.UserId  where WithdrawalStatus=:WithdrawalStatus";
$stmt = $this->conn->prepare($query); 
$stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);

$stmt->execute();
return $stmt;
}
// either reject =2 or approve=1
public function Users_WithdrawalUpdate(){
     $query = "UPDATE
     " . $this->users_Withdrawal . "
     SET 
  
         WithdrawalStatus=:WithdrawalStatus, Remark=:Remark, ApprovedBy=:ApprovedBy, ApprovedOn=:ApprovedOn
          WHERE 
          WithdrawalId=:WithdrawalId and UserId=:UserId ";
  // prepare query
  $stmt = $this->conn->prepare($query);
  
  // sanitize
  $this->WithdrawalStatus=htmlspecialchars(strip_tags($this->WithdrawalStatus));
  $this->UserId=htmlspecialchars(strip_tags($this->UserId));
  $this->Remark=htmlspecialchars(strip_tags($this->Remark));

  $this->ApprovedBy=htmlspecialchars(strip_tags($this->ApprovedBy));
  $this->ApprovedOn=htmlspecialchars(strip_tags($this->ApprovedOn));
  $this->WithdrawalId=htmlspecialchars(strip_tags($this->WithdrawalId));
    
  //bind values
  $stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);
  $stmt->bindParam(":UserId", $this->UserId);
  $stmt->bindParam(":Remark", $this->Remark);

  $stmt->bindParam(":ApprovedBy", $this->ApprovedBy);
  $stmt->bindParam(":ApprovedOn", $this->ApprovedOn);
  $stmt->bindParam(":WithdrawalId", $this->WithdrawalId);

  // execute query
  if($stmt->execute()){
  return true;
  }
  
  return false;
  
  }

 function User_TotalDirectIncome(){
  $query="SELECT SUM(sp.TotalCommission) as TotalCommission, SUM(ud.CommissionPaid) as CommissionPaid , Min(ud.CommissionLeft) as CommissionLeft,PucrhaseHistoryId,ud.UserId,AmountPaid, Amountleft from ".$this->users_directincome." as ud left join ".$this->site_purchasehistory." as sp on sp.UserId=ud.UserId where ud.UserId=:UserId GROUP by ud.UserId";
  $stmt = $this->conn->prepare($query); 
$stmt->bindParam(":UserId", $this->UserId);

$stmt->execute();
return $stmt;
}

 function Team_TotalIncome(){
  
   $query="SELECT SUM(Commission) as Commission,AmountPaid,AmountLeft,UserId,MemberId,IncomeCreatedBy,IncomeCreatedOn from ".$this->users_membersincome." where users_membersincome.UserId=:UserId";
$stmt=$this->conn->prepare($query);
$stmt->bindParam(":UserId", $this->UserId);
$stmt->execute();
return $stmt;
}

public function User_TotalWithdrawalIncome(){
  
   $query="select SUM(WithdrawalAmount) as WithdrawalAmount,WithdrawalStatus, TDS,AdminCharges,SUM(AmountAfterCharges) as AmountAfterCharges, CreatedBy, CreatedOn,ApprovedBy,ApprovedOn from ". $this->users_Withdrawal ."  where WithdrawalStatus=:WithdrawalStatus and CreatedBy=:UserId";
$stmt=$this->conn->prepare($query);
$stmt->bindParam(":UserId", $this->UserId);
$stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);
 
$stmt->execute();
return $stmt;
}

public function User_WithdrawalList(){
$query="select WithdrawalId, UserId, WithdrawalAmount ,DirectIncome,TeamIncome ,WithdrawalStatus,
 TDS,AdminCharges,AmountAfterCharges, Remark ,CreatedBy, CreatedOn,ApprovedBy,ApprovedOn 
 from ". $this->users_Withdrawal ."  where  CreatedBy=:UserId";
   $stmt=$this->conn->prepare($query);
$stmt->bindParam(":UserId", $this->UserId);

$stmt->execute();
return $stmt;
}


public function Update_User_Withdrawal_Status(){
   $query = "UPDATE
   " . $this->users_Withdrawal . "
   SET 

       WithdrawalStatus=:WithdrawalStatus
        WHERE 
        WithdrawalId=:WithdrawalId  and UserId=:UserId";
// prepare query
$stmt = $this->conn->prepare($query);

// sanitize
$this->WithdrawalStatus=htmlspecialchars(strip_tags($this->WithdrawalStatus));
$this->UserId=htmlspecialchars(strip_tags($this->UserId));
$this->WithdrawalId=htmlspecialchars(strip_tags($this->WithdrawalId));
  
//bind values
$stmt->bindParam(":WithdrawalStatus", $this->WithdrawalStatus);
$stmt->bindParam(":UserId", $this->UserId);
$stmt->bindParam(":WithdrawalId", $this->WithdrawalId);

// execute query
if($stmt->execute()){
return true;
}

return false;

}

}
?>