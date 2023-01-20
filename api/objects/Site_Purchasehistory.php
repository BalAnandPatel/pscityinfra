<?php

class SitePurchaseHistory{

   private $conn;
   private $site_purchasedetails="site_purchasedetails";
   private $site_purchasehistory="site_purchasehistory";

   public $PurchaseHistoryId, $PurchaseDetailsId, $parentId, $sponsorId, $userFlag, $teamFlag, $PurchaseInvoiceId, $SiteId, $PlotNo, $SiteTotalAmount, $SitePurchaseSection, $SitePurchaseName,
          $MemberId, $UserId, $SitePurchaseWidth, $SitePurchaseDepth, $SitePurchaseCorner, $SitePurchaseDiscount,
          $PurchaseAmountLeft, $PurchasedModeId, $ReceiptNo, $PurchaseAmountPaid, $TotalCommission,
           $SitePurchaseAmount, $PurchasedBy,$PurchasedOn,$updatedBy,$updatedOn;


   public function __construct($db){
      $this->conn = $db;
  }

 public function SitePurchaseHistory_Create(){

    $query = "INSERT INTO
    ". $this->site_purchasehistory ."
    set
    PurchaseInvoiceId=:PurchaseInvoiceId,
    SiteId=:SiteId,
    PlotNo=:PlotNo,
    PurchasedModeId=:PurchasedModeId,
    SiteTotalAmount=:SiteTotalAmount,
    SitePurchaseSection=:SitePurchaseSection,
    SitePurchaseName=:SitePurchaseName,
    MemberId=:MemberId,
    UserId=:UserId,
    sponsorId=:sponsorId,
    parentId=:parentId,
    teamFlag=:teamFlag,
    userFlag=:userFlag,
    SitePurchaseWidth=:SitePurchaseWidth,
    SitePurchaseDepth=:SitePurchaseDepth,
    SitePurchaseCorner=:SitePurchaseCorner,
    SitePurchaseDiscount=:SitePurchaseDiscount,
    PurchaseAmountLeft=:PurchaseAmountLeft,
    SitePurchaseAmount=:SitePurchaseAmount,
    ReceiptNo=:ReceiptNo,
    PurchaseAmountPaid=:PurchaseAmountPaid,
    PurchasedOn=:PurchasedOn,
    PurchasedBy=:PurchasedBy
    ";

    $stmt = $this->conn->prepare($query);

    $this->PurchaseInvoiceId=htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
    $this->SiteId=htmlspecialchars(strip_tags($this->SiteId));
    $this->PlotNo=htmlspecialchars(strip_tags($this->PlotNo));
    $this->SiteTotalAmount=htmlspecialchars(strip_tags($this->SiteTotalAmount));
    $this->SitePurchaseSection=htmlspecialchars(strip_tags($this->SitePurchaseSection));
    $this->SitePurchaseName=htmlspecialchars(strip_tags($this->SitePurchaseName));
    $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
    $this->parentId=htmlspecialchars(strip_tags($this->parentId));
    $this->sponsorId=htmlspecialchars(strip_tags($this->sponsorId));
    $this->UserId=htmlspecialchars(strip_tags($this->UserId));
    $this->userFlag=htmlspecialchars(strip_tags($this->userFlag));
    $this->teamFlag=htmlspecialchars(strip_tags($this->teamFlag));
    $this->SitePurchaseWidth=htmlspecialchars(strip_tags($this->SitePurchaseWidth));
    $this->SitePurchaseDepth=htmlspecialchars(strip_tags($this->SitePurchaseDepth));
    $this->SitePurchaseCorner=htmlspecialchars(strip_tags($this->SitePurchaseCorner));
    $this->SitePurchaseDiscount=htmlspecialchars(strip_tags($this->SitePurchaseDiscount));
    $this->PurchaseAmountLeft=htmlspecialchars(strip_tags($this->PurchaseAmountLeft));
    $this->SitePurchaseAmount=htmlspecialchars(strip_tags($this->SitePurchaseAmount));
    $this->PurchasedModeId=htmlspecialchars(strip_tags($this->PurchasedModeId));
    $this->ReceiptNo=htmlspecialchars(strip_tags($this->ReceiptNo));
    $this->PurchaseAmountPaid=htmlspecialchars(strip_tags($this->PurchaseAmountPaid));
    $this->PurchasedOn=htmlspecialchars(strip_tags($this->PurchasedOn));
    $this->PurchasedBy=htmlspecialchars(strip_tags($this->PurchasedBy));


    $stmt->bindParam(":PurchaseInvoiceId",$this->PurchaseInvoiceId);
    $stmt->bindParam(":SiteId",$this->SiteId);
    $stmt->bindParam(":PlotNo",$this->PlotNo);
    $stmt->bindParam(":SiteTotalAmount",$this->SiteTotalAmount);
    $stmt->bindParam(":SitePurchaseSection",$this->SitePurchaseSection);
    $stmt->bindParam(":SitePurchaseName",$this->SitePurchaseName);
    $stmt->bindParam(":MemberId",$this->MemberId);
    $stmt->bindParam(":UserId",$this->UserId);
    $stmt->bindParam(":sponsorId",$this->sponsorId);
    $stmt->bindParam(":parentId",$this->parentId);
    $stmt->bindParam(":teamFlag",$this->teamFlag);
    $stmt->bindParam(":userFlag",$this->userFlag);
    $stmt->bindParam(":SitePurchaseWidth",$this->SitePurchaseWidth);
    $stmt->bindParam(":SitePurchaseDepth",$this->SitePurchaseDepth);
    $stmt->bindParam(":SitePurchaseCorner",$this->SitePurchaseCorner);
    $stmt->bindParam(":SitePurchaseDiscount",$this->SitePurchaseDiscount);
    $stmt->bindParam(":PurchaseAmountLeft",$this->PurchaseAmountLeft);
    $stmt->bindParam(":SitePurchaseAmount",$this->SitePurchaseAmount);
    $stmt->bindParam(":PurchasedModeId",$this->PurchasedModeId);
    $stmt->bindParam(":ReceiptNo",$this->ReceiptNo);
    $stmt->bindParam(":PurchaseAmountPaid",$this->PurchaseAmountPaid);
    $stmt->bindParam(":PurchasedOn",$this->PurchasedOn);
    $stmt->bindParam(":PurchasedBy",$this->PurchasedBy);

    if($stmt->execute()){
    return true;
    }
    return false;

   }

   public function sitePurchaseDetails_Create(){

      $query = "INSERT INTO
      ". $this->site_purchasedetails ."
      set
      PurchaseInvoiceId=:PurchaseInvoiceId,
      SiteId=:SiteId,
      PlotNo=:PlotNo,
      PurchasedModeId=:PurchasedModeId,
      SiteTotalAmount=:SiteTotalAmount,
      SitePurchaseSection=:SitePurchaseSection,
      SitePurchaseName=:SitePurchaseName,
      MemberId=:MemberId,
      UserId=:UserId,
      SitePurchaseWidth=:SitePurchaseWidth,
      SitePurchaseDepth=:SitePurchaseDepth,
      SitePurchaseCorner=:SitePurchaseCorner,
      SitePurchaseDiscount=:SitePurchaseDiscount,
      PurchaseAmountLeft=:PurchaseAmountLeft,
      SitePurchaseAmount=:SitePurchaseAmount,
      ReceiptNo=:ReceiptNo,
      PurchaseAmountPaid=:PurchaseAmountPaid,
      PurchasedOn=:PurchasedOn,
      PurchasedBy=:PurchasedBy
      ";
  
      $stmt = $this->conn->prepare($query);
  
      $this->PurchaseInvoiceId=htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
      $this->SiteId=htmlspecialchars(strip_tags($this->SiteId));
      $this->PlotNo=htmlspecialchars(strip_tags($this->PlotNo));
      $this->SiteTotalAmount=htmlspecialchars(strip_tags($this->SiteTotalAmount));
      $this->SitePurchaseSection=htmlspecialchars(strip_tags($this->SitePurchaseSection));
      $this->SitePurchaseName=htmlspecialchars(strip_tags($this->SitePurchaseName));
      $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
      $this->UserId=htmlspecialchars(strip_tags($this->UserId));
      $this->SitePurchaseWidth=htmlspecialchars(strip_tags($this->SitePurchaseWidth));
      $this->SitePurchaseDepth=htmlspecialchars(strip_tags($this->SitePurchaseDepth));
      $this->SitePurchaseCorner=htmlspecialchars(strip_tags($this->SitePurchaseCorner));
      $this->SitePurchaseDiscount=htmlspecialchars(strip_tags($this->SitePurchaseDiscount));
      $this->PurchaseAmountLeft=htmlspecialchars(strip_tags($this->PurchaseAmountLeft));
      $this->SitePurchaseAmount=htmlspecialchars(strip_tags($this->SitePurchaseAmount));
      $this->PurchasedModeId=htmlspecialchars(strip_tags($this->PurchasedModeId));
      $this->ReceiptNo=htmlspecialchars(strip_tags($this->ReceiptNo));
      $this->PurchaseAmountPaid=htmlspecialchars(strip_tags($this->PurchaseAmountPaid));
      $this->PurchasedOn=htmlspecialchars(strip_tags($this->PurchasedOn));
      $this->PurchasedBy=htmlspecialchars(strip_tags($this->PurchasedBy));
  
  
      $stmt->bindParam(":PurchaseInvoiceId",$this->PurchaseInvoiceId);
      $stmt->bindParam(":SiteId",$this->SiteId);
      $stmt->bindParam(":PlotNo",$this->PlotNo);
      $stmt->bindParam(":SiteTotalAmount",$this->SiteTotalAmount);
      $stmt->bindParam(":SitePurchaseSection",$this->SitePurchaseSection);
      $stmt->bindParam(":SitePurchaseName",$this->SitePurchaseName);
      $stmt->bindParam(":MemberId",$this->MemberId);
      $stmt->bindParam(":UserId",$this->UserId);
      $stmt->bindParam(":SitePurchaseWidth",$this->SitePurchaseWidth);
      $stmt->bindParam(":SitePurchaseDepth",$this->SitePurchaseDepth);
      $stmt->bindParam(":SitePurchaseCorner",$this->SitePurchaseCorner);
      $stmt->bindParam(":SitePurchaseDiscount",$this->SitePurchaseDiscount);
      $stmt->bindParam(":PurchaseAmountLeft",$this->PurchaseAmountLeft);
      $stmt->bindParam(":SitePurchaseAmount",$this->SitePurchaseAmount);
      $stmt->bindParam(":PurchasedModeId",$this->PurchasedModeId);
      $stmt->bindParam(":ReceiptNo",$this->ReceiptNo);
      $stmt->bindParam(":PurchaseAmountPaid",$this->PurchaseAmountPaid);
      $stmt->bindParam(":PurchasedOn",$this->PurchasedOn);
      $stmt->bindParam(":PurchasedBy",$this->PurchasedBy);
  
      if($stmt->execute()){
      return true;
      }
      return false;
  
     }

     /////////////////////////Site Purchage Detail Update//////////////////////////////
     public function sitePurchaseDetails_Update(){

     $query = "UPDATE
       ". $this->site_purchasedetails ."
       set
       PurchaseAmountPaid=:PurchaseAmountPaid, PurchaseAmountLeft=:PurchaseAmountLeft,
       UpdatedOn=:UpdatedOn,
       UpdatedBy=:UpdatedBy where SiteId=:SiteId and PlotNo=:PlotNo and PurchaseInvoiceId=:PurchaseInvoiceId";
   

       $stmt = $this->conn->prepare($query);
   
       $this->PurchaseAmountPaid=htmlspecialchars(strip_tags($this->PurchaseAmountPaid));
       $this->PurchaseAmountLeft=htmlspecialchars(strip_tags($this->PurchaseAmountLeft));
       $this->UpdatedOn=htmlspecialchars(strip_tags($this->UpdatedOn));
       $this->UpdatedBy=htmlspecialchars(strip_tags($this->UpdatedBy));
       $this->PlotNo=htmlspecialchars(strip_tags($this->PlotNo));
       $this->SiteId=htmlspecialchars(strip_tags($this->SiteId));
       $this->PurchaseInvoiceId=htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
             
   
   
       $stmt->bindParam(":PurchaseAmountPaid",$this->PurchaseAmountPaid);
       $stmt->bindParam(":UpdatedOn",$this->UpdatedOn);
       $stmt->bindParam(":PurchaseAmountLeft",$this->PurchaseAmountLeft);
       $stmt->bindParam(":UpdatedBy",$this->UpdatedBy);
       $stmt->bindParam(":SiteId",$this->SiteId);
       $stmt->bindParam(":PlotNo",$this->PlotNo);
       $stmt->bindParam(":PurchaseInvoiceId",$this->PurchaseInvoiceId);
   
       if($stmt->execute()){
       return true;
       }
       return false;
   
      }
 

   function PucrhaseHistory_MaxId(){
      $query= "Select max(PurchaseHistoryId) as PurchaseHistoryId from " . $this->site_purchasehistory;
      $stmt = $this->conn->prepare($query); 
      $stmt->execute();
      return $stmt;
      }


      function updateDirectIncomeFlag()
 {

   // query to insert record
   $query = "UPDATE
             " . $this->site_purchasehistory . "
         SET
         userFlag=:userFlag,
               updatedBy=:updatedBy,
               updatedOn=:updatedOn
                      WHERE
                      PurchaseInvoiceId=:PurchaseInvoiceId";
   // prepare query
   $stmt = $this->conn->prepare($query);

   // sanitize
   $this->userFlag = htmlspecialchars(strip_tags($this->userFlag));
  $this->PurchaseInvoiceId = htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
   $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
   $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
   //bind values
   $stmt->bindParam(":userFlag", $this->userFlag);
   $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);
   $stmt->bindParam(":updatedOn", $this->updatedOn);
   $stmt->bindParam(":updatedBy", $this->updatedBy);

   // execute query
   if ($stmt->execute()) {
     return true;
   }

   return false;
 }

 function Get_Max_PurchaseInvoiceId(){
   $query = "SELECT PurchaseInvoiceId FROM $this->site_purchasedetails order by PurchaseInvoiceId desc limit 1; ";
   $stmt = $this->conn->prepare($query);
   $stmt->execute();
   return $stmt;
   
  }
}

?>