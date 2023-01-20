<?php
class income{
  
// database connection and table name
private $conn;
private $users="users";
private $users_memberslist="users_memberslist";
private $usertype="usertype";
private $site_purchasehistory="site_purchasehistory";
private $site_purchasemode="site_purchasemode";
private $users_directincome="users_directincome";
private $site_sectiondetails="site_sectiondetails";
private $users_membersincome = "users_membersincome";
  
// object properties
public 
$DirectIncomeId,$PucrhaseHistoryId, $UserId, $MemberId,$PurchaseModeId,$parentId,$sponsorId,
$Phone, $MemberPhone,  $Commission, $IncomeCreatedBy, $IncomeCreatedOn,$DirectIncomeFlag,$PlotPaidAmount,
$PurchaseHistoryId, $PurchaseInvoiceId, $SitePurchaseSection,$SitePurchaseName,$SitePurchaseWidth,$SitePurchaseDepth,
$SitePurchaseCorner,$SitePurchaseDiscount,$PurchaseAmountLeft,$PurchasedModeId,$ReceiptNo,$PurchaseAmountPaid,$PurchasedBy,
$PurchasedOn, $AmountPaid, $AmountLeft, $CommissionPaid, $CommissionLeft, $MemberName, $UserName, $FatherName,
$MemberAddress, $SiteId, $SitePricePerSquareFeet, $SiteTotalArea, $SiteTotalAmount,$PurchaseModeName;
    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


// direct income
function DirectIncomeCreate(){
     
   // query to insert record
  $query = "INSERT INTO
           " . $this->users_directincome . "
           SET
           PucrhaseHistoryId=:PucrhaseHistoryId,
           PurchaseInvoiceId=:PurchaseInvoiceId,
           ReceiptNo=:ReceiptNo,
           PurchaseModeId=:PurchaseModeId,
           UserId=:UserId,
           sponsorId=:sponsorId,
           parentId=:parentId,
           MemberId=:MemberId, 
           AmountPaid=:AmountPaid,
           PlotPaidAmount=:PlotPaidAmount,
           DirectIncomeFlag=:DirectIncomeFlag,
           IncomeCreatedBy=:IncomeCreatedBy,
           IncomeCreatedOn=:IncomeCreatedOn
           ";

 // prepare query
 $stmt = $this->conn->prepare($query);

 // sanitize
 $this->PucrhaseHistoryId=htmlspecialchars(strip_tags($this->PucrhaseHistoryId));
 $this->PurchaseInvoiceId=htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
 $this->ReceiptNo=htmlspecialchars(strip_tags($this->ReceiptNo));
 $this->PurchaseModeId=htmlspecialchars(strip_tags($this->PurchaseModeId));
 $this->UserId=htmlspecialchars(strip_tags($this->UserId));
 $this->parentId=htmlspecialchars(strip_tags($this->parentId));
 $this->sponsorId=htmlspecialchars(strip_tags($this->sponsorId));
 $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
 $this->AmountPaid=htmlspecialchars(strip_tags($this->AmountPaid));
 $this->PlotPaidAmount=htmlspecialchars(strip_tags($this->PlotPaidAmount));
 $this->DirectIncomeFlag=htmlspecialchars(strip_tags($this->DirectIncomeFlag));
 $this->IncomeCreatedBy=htmlspecialchars(strip_tags($this->IncomeCreatedBy));
 $this->IncomeCreatedOn=htmlspecialchars(strip_tags($this->IncomeCreatedOn));
 //bind values

 $stmt->bindParam(":PucrhaseHistoryId", $this->PucrhaseHistoryId);
 $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);
 $stmt->bindParam(":ReceiptNo", $this->ReceiptNo);
 $stmt->bindParam(":PurchaseModeId", $this->PurchaseModeId);
 $stmt->bindParam(":UserId", $this->UserId);
 $stmt->bindParam(":sponsorId", $this->sponsorId);
 $stmt->bindParam(":parentId", $this->parentId);
 $stmt->bindParam(":MemberId", $this->MemberId);
 $stmt->bindParam(":AmountPaid", $this->AmountPaid);
 $stmt->bindParam(":PlotPaidAmount", $this->PlotPaidAmount);
 $stmt->bindParam(":DirectIncomeFlag", $this->DirectIncomeFlag);
 $stmt->bindParam(":IncomeCreatedBy", $this->IncomeCreatedBy);
 $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);

 // execute query
 if($stmt->execute()){
 return true;
 }
 return false;

}

//Read all agent direct income list
// function DirectIncomeRead(){
//   // select all queryß
//  $query = "SELECT
//                 DirectIncomeId,
//                 UserId,
//                 MemberId,
//                 AmountPaid,
//                 AmountLeft,
//                 Commission,
//                 IncomeCreatedBy, 
//                 IncomeCreatedOn
//           FROM
//               " . $this->users_directincome;

//   // prepare query statement
//   $stmt = $this->conn->prepare($query);
  
//   $stmt->bindParam(":id", $this->id);
  
//   // execute query
//   $stmt->execute();

//   return $stmt;
// }

// Direct income Update

function DirectIncomeUpdate(){
     
  // query to insert record
  $query = "UPDATE
           " . $this->users_directincome . "
           SET
           UserId=:UserId, 
           MemberId=:MemberId,
           AmountPaid=:AmountPaid,
           AmountLeft=:AmountLeft,
           Commission=:Commission where DirectIncomeId=:DirectIncomeId";

  // prepare query
  $stmt = $this->conn->prepare($query);

  // sanitize
 $this->UserId=htmlspecialchars(strip_tags($this->UserId));
 $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
 $this->AmountPaid=htmlspecialchars(strip_tags($this->AmountPaid));
 $this->AmountLeft=htmlspecialchars(strip_tags($this->AmountLeft));
 $this->Commission=htmlspecialchars(strip_tags($this->Commission));
 

 //bind values
 $stmt->bindparam(":DirectIncomeId", $this->DirectIncomeId);
 $stmt->bindParam(":UserId", $this->UserId);
 $stmt->bindparam(":MemberId", $this->MemberId);
 $stmt->bindparam(":AmountPaid", $this->AmountPaid);
 $stmt->bindparam(":AmountLeft", $this->AmountLeft);
 $stmt->bindparam(":Commission", $this->Commission); 

 // execute query
 if($stmt->execute()){
 return true;
 }
 return false;
 
}

// direct income
function MemberIncomeCreate(){
     
  // query to insert record
 $query = "INSERT INTO
          " . $this->users_membersincome . "
          SET
          UserId=:UserId,
          MemberId=:MemberId, 
          AmountPaid=:AmountPaid,
          AmountLeft=:AmountLeft,
          Commission=:Commission,
          IncomeCreatedBy=:IncomeCreatedBy,
          IncomeCreatedOn=:IncomeCreatedOn
          ";

 // prepare query
 $stmt = $this->conn->prepare($query);

 // sanitize
 $this->UserId=htmlspecialchars(strip_tags($this->UserId));
 $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
 $this->AmountPaid=htmlspecialchars(strip_tags($this->AmountPaid));
 $this->AmountLeft=htmlspecialchars(strip_tags($this->AmountLeft));
 $this->Commission=htmlspecialchars(strip_tags($this->Commission));
 $this->IncomeCreatedBy=htmlspecialchars(strip_tags($this->IncomeCreatedBy));
 $this->IncomeCreatedOn=htmlspecialchars(strip_tags($this->IncomeCreatedOn));
 //bind values

 $stmt->bindParam(":UserId", $this->UserId);
 $stmt->bindParam(":MemberId", $this->MemberId);
 $stmt->bindParam(":AmountPaid", $this->AmountPaid);
 $stmt->bindParam(":AmountLeft", $this->AmountLeft);
 $stmt->bindParam(":Commission", $this->Commission);
 $stmt->bindParam(":IncomeCreatedBy", $this->IncomeCreatedBy);
 $stmt->bindParam(":IncomeCreatedOn", $this->IncomeCreatedOn);

 // execute query
 if($stmt->execute()){
 return true;
 }
 return false;

}

// memberincome Read

function MemberIncomeRead(){
     
  if($this->UserId=='All_Users'){

  //select all query
  $query = "SELECT
          MembersIncomeId,
          UserId,
          sponsorId,
          parentId,
          AmountPaid,
          TotalAmount,
          IncomeCreatedBy, 
          IncomeCreatedOn,
          updatedBy,
          updatedOn
          FROM
          " . $this->users_membersincome;
  

  // prepare query statement
  $stmt = $this->conn->prepare($query);
  

  }else{

     $query = "SELECT
          MembersIncomeId,
          UserId,
          sponsorId,
          parentId,
          AmountPaid,
          TotalAmount,
          IncomeCreatedBy, 
          IncomeCreatedOn,
          updatedBy,
          updatedOn
          FROM
          " . $this->users_membersincome ." where UserId=:UserId ";
  

  // prepare query statement
  $stmt = $this->conn->prepare($query);
  
  $stmt->bindParam(":UserId", $this->UserId);

}
  
  // execute query
  $stmt->execute();
  return $stmt;

}

// 	// Update family income //
function MemberIncomeUpdate(){
     
  // query to insert record
  $query = "UPDATE
           " . $this->users_membersincome . "
           SET
           UserId=:UserId, 
           MemberId=:MemberId,
           AmountPaid=:AmountPaid,
           AmountLeft=:AmountLeft,
           Commission=:Commission WHERE MembersIncomeId=:MembersIncomeId ";

 // prepare query
 $stmt = $this->conn->prepare($query);

  // sanitize
  $this->UserId=htmlspecialchars(strip_tags($this->UserId));
  $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));
  $this->AmountPaid=htmlspecialchars(strip_tags($this->AmountPaid));
  $this->AmountLeft=htmlspecialchars(strip_tags($this->AmountLeft));
  $this->Commission=htmlspecialchars(strip_tags($this->Commission));
  
 
  //bind values
  $stmt->bindparam(":MembersIncomeId", $this->MembersIncomeId);
  $stmt->bindParam(":UserId", $this->UserId);
  $stmt->bindparam(":MemberId", $this->MemberId);
  $stmt->bindparam(":AmountPaid", $this->AmountPaid);
  $stmt->bindparam(":AmountLeft", $this->AmountLeft);
  $stmt->bindparam(":Commission", $this->Commission);

 // execute query
 if($stmt->execute()){
 return true;
 }

 return false;

}
// this method is used for agent income
public function DirectIncomeRead(){
  if($this->UserId=='All_Users'){
    $query="SELECT  AmountPaid, ps.PurchaseAmountPaid as PurchaseAmountPaid,  ud.UserId as UserId, ud.MemberId as MemberId, ud.PucrhaseHistoryId  as PucrhaseHistoryId,ud.PurchaseInvoiceId as PurchaseInvoiceId, ud.PurchaseModeId as PurchaseModeId, ud.PlotPaidAmount, ud.IncomeCreatedOn as IncomeCreatedOn, ps.PlotNo as PlotNo, ps.SiteId as SiteId, ps.SitePurchaseName as SitePurchaseName,ps.SitePurchaseSection as SitePurchaseSection,ps.SitePurchaseDepth as SitePurchaseDepth,ps.SitePurchaseWidth as SitePurchaseWidth, ps.SitePurchaseCorner as SitePurchaseCorner,ps.SitePurchaseDiscount as SitePurchaseDiscount, m.MemberName as MemberName, m.MemberPhone as MemberPhone,m.FatherName as FatherName, users.UserName as UserName,users.Phone as Phone  from ".$this->users_directincome." as ud join ".$this->site_purchasehistory." as ps on ud.MemberId=ps.MemberId join ".$this->users_memberslist." as m on m.MemberId=ud.MemberId join ".$this->users." on ud.UserId=users.UserId  order By ud.IncomeCreatedOn desc";
    $stmt = $this->conn->prepare($query);
  }
  else{
  $query="SELECT  AmountPaid, ps.PurchaseAmountPaid as PurchaseAmountPaid,  ud.UserId as UserId, ud.MemberId as MemberId, ud.PucrhaseHistoryId  as PucrhaseHistoryId,ud.PlotPaidAmount, ud.PurchaseInvoiceId as PurchaseInvoiceId, ud.PurchaseModeId as PurchaseModeId, ud.IncomeCreatedOn as IncomeCreatedOn, ps.PlotNo as PlotNo, ps.SiteId as SiteId, ps.SitePurchaseName as SitePurchaseName,ps.SitePurchaseSection as SitePurchaseSection,ps.SitePurchaseDepth as SitePurchaseDepth,ps.SitePurchaseWidth as SitePurchaseWidth, ps.SitePurchaseCorner as SitePurchaseCorner,ps.SitePurchaseDiscount as SitePurchaseDiscount, m.MemberName as MemberName, m.MemberPhone as MemberPhone,m.FatherName as FatherName, users.UserName as UserName,users.Phone as Phone  from ".$this->users_directincome." as ud join ".$this->site_purchasehistory." as ps on ud.MemberId=ps.MemberId join ".$this->users_memberslist." as m on m.MemberId=ud.MemberId join ".$this->users." on ud.UserId=users.UserId where ud.UserId=:UserId order By ud.IncomeCreatedOn desc";
$stmt=$this->conn->prepare($query);
$stmt->bindParam(":UserId", $this->UserId);
  }
$stmt->execute();
return $stmt;
}
//This method is for direct income 
public function All_User_PaymentList(){
  
    $query="SELECT  AmountPaid, ps.PurchaseAmountPaid as PurchaseAmountPaid, 
    ud.UserId as UserId, ud.MemberId as MemberId, ud.PucrhaseHistoryId as PucrhaseHistoryId,
    ud.PurchaseInvoiceId as PurchaseInvoiceId, ud.PurchaseModeId as PurchaseModeId, ud.IncomeCreatedOn
     as IncomeCreatedOn, ps.PlotNo as PlotNo, ps.SiteId as SiteId, ps.SitePurchaseName as
      SitePurchaseName,ps.SitePurchaseSection as SitePurchaseSection,ps.SitePurchaseDepth as
       SitePurchaseDepth,ps.SitePurchaseWidth as SitePurchaseWidth, ps.SitePurchaseCorner as
        SitePurchaseCorner,ps.SitePurchaseDiscount, ps.SitePurchaseAmount,ps.SiteTotalAmount as 
        SiteTotalAmount, users.UserName as  UserName,users.Phone as Phone 
         from ".$this->users_directincome." as ud join ".$this->site_purchasehistory." as ps
          on ud.MemberId=ps.MemberId join ".$this->users." on ud.UserId=users.UserId 
           where ud.UserId=:UserId order By ud.IncomeCreatedOn desc";
$stmt=$this->conn->prepare($query);
$stmt->bindParam(":UserId", $this->UserId);
  
$stmt->execute();
return $stmt;
}


//Sum Of direct Income//
function sumOfDirectIncome(){
  if($this->UserType==2){
 
 
    $query = "SELECT sum(AmountPaid) as totalDirectIncome
   FROM " . $this->users_directincome;
 
 
  // prepare query statement
  $stmt = $this->conn->prepare($query);
 
  }   
  else
  {
  // select all query
    $query = "SELECT sum(AmountPaid) as totalDirectIncome
    FROM " . $this->users_directincome . " where UserId=:UserId";
 
 
   // prepare query statement
   $stmt = $this->conn->prepare($query);
   $stmt->bindParam(":UserId", $this->UserId);
 } 
   // execute query
   $stmt->execute();
 
   return $stmt;
 }


//sum of users member income

 function sumOfTeamIncome(){
  if($this->UserType==2){
 
 // select all query
 $query = "SELECT sum(AmountPaid) as teamIncome
 FROM " . $this->users_membersincome;
 
 
 // prepare query statement
 $stmt = $this->conn->prepare($query);
 
  }
  else{
      
   // select all query
   $query = "SELECT sum(AmountPaid) as teamIncome 
    FROM " . $this->users_membersincome. " where sponsorId=:sponsorId";
 
   // prepare query statement
   $stmt = $this->conn->prepare($query);
   $stmt->bindParam(":sponsorId", $this->sponsorId);
  
 }  
   // execute query
   $stmt->execute();
 
   return $stmt;
 }

}
?>