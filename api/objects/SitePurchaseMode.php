<?php

class SitePurchaseMode{

   private $conn;
   private $site_purchasemode="site_purchasemode";
   private $users= "users";

   public $PurchaseModeId;
   public $PurchaseModeName;
   public $CreatedBy;
   public $CreatedOn;

   public function __construct($db){
      $this->conn = $db;
  }

   public function PurchaseModeCreate(){

      $query=" INSERT into " .  $this->site_purchasemode." 
      set
      PurchaseModeName=:PurchaseModeName, CreatedBy=:CreatedBy, CreatedOn=:CreatedOn ";

      $stmt=$this->conn->prepare($query);
      $this->PurchaseModeName=htmlspecialchars(strip_tags($this->PurchaseModeName));
      $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
      $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));  
      $stmt->bindParam(":PurchaseModeName",$this->PurchaseModeName);
      $stmt->bindParam(":CreatedBy",$this->CreatedBy);
      $stmt->bindParam(":CreatedOn",$this->CreatedOn);

    if($stmt->execute()){
    return true;
     }
    else{
    return false; 
     }
   }

   function SelectPurchaseMode(){

      $query=" SELECT PurchaseModeId, PurchaseModeName
      from  " .  $this->site_purchasemode;
    
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;

    }

 function PurchaseModeRead(){

  $query=" SELECT PurchaseModeId, PurchaseModeName, sp.CreatedOn, sp.CreatedBy,us.UserName
  from  " .  $this->site_purchasemode." as sp join " .  $this->users ." as us 
  on us.UserId= sp.CreatedBy  
  where PurchaseModeId=:PurchaseModeId ";

  $stmt = $this->conn->prepare($query); 
  $stmt->bindParam(":PurchaseModeId", $this->PurchaseModeId);
  $stmt->execute();
  return $stmt;
 }


}

?>