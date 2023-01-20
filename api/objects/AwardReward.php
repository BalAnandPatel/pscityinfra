<?php
class Awardreward{

    // database connection and table name
    private $conn;
    private $reward_rank = "reward_rank";
    private $users_awardrewardhistory = "users_awardrewardhistory";
      
    // object properties
    public $AwardRewardId;
    public $UserId;
    public $RewardId;
    public $RewardCreatedBy;
    public $RewardCreatedOn;
    public $AwardName;
    public $RewardAccessories;
    public $AmountUpto;
    public $RewardDuration;
    public $RankPercentage;
    public $FamilySupportBonus;
    public $RewardStatus;
    public $CreatedBy;
    public $CreatedOn;
        

    // constructor with $db as database connection
    public function __construct($db){
       $this->conn = $db;
    }

    // direct income
    function RewardRankCreate(){
     
     // query to insert record
       $query = "INSERT INTO
            " . $this->reward_rank . "
            SET
            AwardName=:AwardName,
            RewardAccessories=:RewardAccessories, 
            AmountUpto=:AmountUpto,
            RankPercentage=:RankPercentage,
            FamilySupportBonus=:FamilySupportBonus,
            RewardDuration=:RewardDuration,
            RewardStatus=:RewardStatus,
            CreatedBy=:CreatedBy,
            CreatedOn=:CreatedOn
            ";
 
     // prepare query
     $stmt = $this->conn->prepare($query);
 
     // sanitize
    
     $this->AwardName=htmlspecialchars(strip_tags($this->AwardName));
     $this->RewardAccessories=htmlspecialchars(strip_tags($this->RewardAccessories));
     $this->AmountUpto=htmlspecialchars(strip_tags($this->AmountUpto));
     $this->RankPercentage=htmlspecialchars(strip_tags($this->RankPercentage));
     $this->FamilySupportBonus	=htmlspecialchars(strip_tags($this->FamilySupportBonus));
     $this->RewardDuration=htmlspecialchars(strip_tags($this->RewardDuration));
     $this->RewardStatus=htmlspecialchars(strip_tags($this->RewardStatus));
     $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
     $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));

     //bind values
     $stmt->bindParam(":AwardName", $this->AwardName);
     $stmt->bindParam(":RewardAccessories", $this->RewardAccessories);
     $stmt->bindParam(":AmountUpto", $this->AmountUpto);
     $stmt->bindParam(":RankPercentage", $this->RankPercentage);
     $stmt->bindParam(":FamilySupportBonus", $this->FamilySupportBonus);
     $stmt->bindParam(":RewardDuration", $this->RewardDuration);
     $stmt->bindParam(":RewardStatus", $this->RewardStatus);
     $stmt->bindParam(":CreatedBy", $this->CreatedBy);
     $stmt->bindParam(":CreatedOn", $this->CreatedOn);
 
     // execute query
     if($stmt->execute()){
        return true;
       }
      return false;
 
    }
 
 //Read all agent direct income list
 function AwardRankRead(){
   // select all query
  $query = "SELECT
                 RewardId,
                 AwardName,
                 RewardAccessories,
                 AmountUpto,
                 RewardDuration,
                 RankPercentage,
                 FamilySupportBonus,
                 RewardStatus, 
                 CreatedBy,
                 CreatedOn
           FROM
               " . $this->reward_rank;
 
   // prepare query statement
   $stmt = $this->conn->prepare($query);
   
   //$stmt->bindParam(":RewardId", $this->RewardId);
   
   // execute query
   $stmt->execute();
 
   return $stmt;
 }
 
 // Direct income Update
 
 function AwardRankUpdate(){
      
   // query to insert record
   $query = "UPDATE
            " . $this->reward_rank . "
            SET
            AwardName=:AwardName,
            RewardAccessories=:RewardAccessories, 
            AmountUpto=:AmountUpto,
            RewardDuration=:RewardDuration,
            RankPercentage=:RankPercentage,
            FamilySupportBonus=:FamilySupportBonus,
            RewardStatus=:RewardStatus where RewardId=:RewardId";
 
   // prepare query
   $stmt = $this->conn->prepare($query);
 
     // sanitize
     $this->AwardName=htmlspecialchars(strip_tags($this->AwardName));
     $this->RewardAccessories=htmlspecialchars(strip_tags($this->RewardAccessories));
     $this->AmountUpto=htmlspecialchars(strip_tags($this->AmountUpto));
     $this->RewardDuration=htmlspecialchars(strip_tags($this->RewardDuration));
     $this->RankPercentage=htmlspecialchars(strip_tags($this->RankPercentage));
     $this->FamilySupportBonus=htmlspecialchars(strip_tags($this->FamilySupportBonus));
     $this->RewardStatus=htmlspecialchars(strip_tags($this->RewardStatus));

     //bind values
     $stmt->bindParam(":RewardId", $this->RewardId);
     $stmt->bindParam(":AwardName", $this->AwardName);
     $stmt->bindParam(":RewardAccessories", $this->RewardAccessories);
     $stmt->bindParam(":AmountUpto", $this->AmountUpto);
     $stmt->bindParam(":RewardDuration", $this->RewardDuration);
     $stmt->bindParam(":RankPercentage", $this->RankPercentage);
     $stmt->bindParam(":FamilySupportBonus", $this->FamilySupportBonus);
     $stmt->bindParam(":RewardStatus", $this->RewardStatus);
 
  // execute query
  if($stmt->execute()){
  return true;
  }
  return false;
  
 }
 
 // direct income
 function AwardRewardHistryCreate(){
      
   // query to insert record
  $query = "INSERT INTO
           " . $this->users_awardrewardhistory . "
           SET
           UserId=:UserId,
           RewardId=:RewardId, 
           RewardCreatedBy=:RewardCreatedBy,
           RewardCreatedOn=:RewardCreatedOn";
 
  // prepare query
  $stmt = $this->conn->prepare($query);
 
  // sanitize
  $this->UserId=htmlspecialchars(strip_tags($this->UserId));
  $this->RewardId=htmlspecialchars(strip_tags($this->RewardId));
  $this->RewardCreatedBy=htmlspecialchars(strip_tags($this->RewardCreatedBy));
  $this->RewardCreatedOn=htmlspecialchars(strip_tags($this->RewardCreatedOn));

  //bind values 
  $stmt->bindParam(":UserId", $this->UserId);
  $stmt->bindParam(":RewardId", $this->RewardId);
  $stmt->bindParam(":RewardCreatedBy", $this->RewardCreatedBy);
  $stmt->bindParam(":RewardCreatedOn", $this->RewardCreatedOn);
 
  // execute query
  if($stmt->execute()){
  return true;
  }
  return false;
 
 }
 
 // memberincome Read
 
 function AwardRewardHistryRead(){
      
   //select all query
  $query = "SELECT
           AwardRewardId,
           UserId,
           RewardId,
           RewardCreatedBy,
           RewardCreatedOn
           FROM
           " . $this->users_awardrewardhistory." where AwardRewardId=:AwardRewardId";
   
 
   // prepare query statement
   $stmt = $this->conn->prepare($query);
   
   $stmt->bindParam(":AwardRewardId", $this->AwardRewardId);
   
   // execute query
   $stmt->execute();
   return $stmt;
 
 }
 
 // 	// Update family income //
 function AwardRewardHistryUpdate(){
      
   // query to insert record
   $query = "UPDATE
            " . $this->users_membersincome . "
            SET
            UserId=:UserId,
            RewardId=:RewardId 
            WHERE AwardRewardId=:AwardRewardId";
 
  // prepare query
  $stmt = $this->conn->prepare($query);
 
  // sanitize
  $this->UserId=htmlspecialchars(strip_tags($this->UserId));
  $this->RewardId=htmlspecialchars(strip_tags($this->RewardId));

  //bind values 
  $stmt->bindParam(":AwardRewardId", $this->AwardRewardId);
  $stmt->bindParam(":UserId", $this->UserId);
  $stmt->bindParam(":RewardId", $this->RewardId);
 
  // execute query
  if($stmt->execute()){
  return true;
  }
 
  return false;
 
 }

}

?>