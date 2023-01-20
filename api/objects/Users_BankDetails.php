<?php
 class Users_BankDetails{
  
  // database connection and table name
  private $conn;
  private $Users_BankDetails= "users_bankdetails";
  private $users= "users";
  private $user_type= "user_type";
  
  // object properties
   public $BankId;
  public $UserId;
  public $AccountNo;
  public $BankName;
  public $BranchName;
  public $IfscCode;
  public $CreatedBy;
  public $CreatedOn;

  public function __construct($db){
   $this->conn = $db;
}

public function Users_BankDetailsEntry(){
 $query=" INSERT  into
". $this->Users_BankDetails . "
 SET
UserId=:UserId, CreatedBy=:CreatedBy,CreatedOn=:CreatedOn";

$stmt= $this->conn->prepare($query);
$this->UserId=htmlspecialchars(strip_tags($this->UserId));
$this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
$this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));

$stmt->bindParam(":UserId", $this->UserId);
$stmt->bindParam(":CreatedBy", $this->CreatedBy);
$stmt->bindParam(":CreatedOn", $this->CreatedOn);

   if($stmt->execute()){
      return true;
   }
   else
   return false;
}


 public function users_BankdetailsRead(){

 $query=" SELECT BankId,BankName,BranchName, AccountNo,IfscCode,users.UserId,sponsorId,users.UserName,users.UserEmail, users.Address ,users.UserType,
  user_type.userRole, users.UserDOB,users.Password,
 users.AadharNo,users.PanNo,users.CreatedOn, users.Phone,users.CreatedBy
from " . $this->Users_BankDetails ." as Ub join  " . $this->users . " on Ub.UserId=users.UserId
 Join " . $this->user_type ." on users.UserType=user_type.userType  where users.UserId=:UserId
   " ;

   $stmt= $this->conn->prepare($query);
   $stmt->bindParam(":UserId", $this->UserId);
 if($stmt->execute()){
    return $stmt;
 }
 }
 
 public function Users_bankDetails_Update(){
   $query=" UPDATE   ". $this->Users_BankDetails . "
    SET
   UserId=:UserId, AccountNo=:AccountNo, BankName=:BankName,BranchName=:BranchName,IfscCode=:IfscCode where UserId=:UserId";
   
   $stmt= $this->conn->prepare($query);
   $this->UserId=htmlspecialchars(strip_tags($this->UserId));
   $this->AccountNo=htmlspecialchars(strip_tags($this->AccountNo));
   
   $this->BankName=htmlspecialchars(strip_tags($this->BankName));
   $this->BranchName=htmlspecialchars(strip_tags($this->BranchName));
   $this->IfscCode=htmlspecialchars(strip_tags($this->IfscCode));
   
   $stmt->bindParam(":UserId", $this->UserId);
   $stmt->bindParam(":AccountNo", $this->AccountNo);
   
      $stmt->bindParam(":BankName", $this->BankName);
      $stmt->bindParam(":BranchName", $this->BranchName);
      $stmt->bindParam(":IfscCode", $this->IfscCode);
      
      if($stmt->execute()){
         return true;
      }
      else
      return false;
   }

 }
  ?>