<?php

class Members_Payment
{

  private $users = "users";
  private $users_memberslist = "users_memberslist";
  private $user_type = "user_type";
  private $site_purchasehistory = "site_purchasehistory";
  private $site_purchasedetails = "site_purchasedetails";
  private $site_purchasemode = "site_purchasemode";
  private $users_directincome = "users_directincome";
  private $site_sectiondetails = "site_sectiondetails";

  public $DirectIncomeId, $UserId, $MemberId, $Commission, $teamFlag, $userFlag, $PurchaseModeId, $IncomeCreatedBy, $IncomeCreatedOn, $IncomeUpdatedBy, $IncomeUpdatedOn, $PurchaseHistoryId, $PurchaseInvoiceId, $SitePurchaseSection, $SitePurchaseName, $SitePurchaseWidth, $SitePurchaseDepth, $SitePurchaseCorner, $SitePurchaseDiscount, $PurchaseAmountLeft, $PurchasedModeId, $ReceiptNo, $PurchaseAmountPaid, $PurchasedBy, $PurchasedOn, $PurchaseUpdatedBy, $PurchaseUpdatedOn,
    $AmountPaid, $AmountLeft, $CommissionPaid, $CommissionLeft, $MemberName, $TotalCommission, $UserName, $FatherName, $MemberAddress, $SiteId, $SitePricePerSquareFeet, $SiteTotalArea, $SiteTotalAmount, $PurchaseModeName;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function Members_PaymentDetailsList(){

    if($this->PurchaseInvoiceId!=""){
         
    $query = "SELECT   ps.UserId as UserId, ps.MemberId as MemberId,
    PurchaseInvoiceId ,PurchasedOn,PurchaseAmountPaid,PurchaseAmountLeft,
    PlotNo, SiteId, SitePurchaseName,SitePurchaseSection,SitePurchaseDepth, SiteTotalAmount,
    SitePurchaseWidth, SitePurchaseCorner,SitePurchaseDiscount, SitePurchaseAmount,PurchasedOn,
    m.MemberName, m.MemberPhone,m.FatherName, users.UserName  from 
    " . $this->site_purchasedetails . " as ps 
    join " . $this->users_memberslist . " as m on m.MemberId=ps.MemberId join " . $this->users . " on ps.UserId=users.UserId where PurchaseInvoiceId=:PurchaseInvoiceId order By PurchasedOn desc";

     $stmt = $this->conn->prepare($query);
     $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);

   

    }else{

    $query = "SELECT   ps.UserId as UserId, ps.MemberId as MemberId,
    PurchaseInvoiceId ,PurchasedOn,PurchaseAmountPaid,PurchaseAmountLeft,
    PlotNo, SiteId, SitePurchaseName,SitePurchaseSection,SitePurchaseDepth, SiteTotalAmount,
    SitePurchaseWidth, SitePurchaseCorner,SitePurchaseDiscount, SitePurchaseAmount,PurchasedOn,
    m.MemberName, m.MemberPhone,m.FatherName, users.UserName  from 
    " . $this->site_purchasedetails . " as ps 
    join " . $this->users_memberslist . " as m on m.MemberId=ps.MemberId join " . $this->users . " on ps.UserId=users.UserId  order By PurchasedOn desc";

    $stmt = $this->conn->prepare($query);

    }

    $stmt->execute();
    return $stmt;
  }



  public function Members_PaymentHistory()
  {
    $query = " SELECT sp.MemberId, sp.UserId, sp.PurchaseInvoiceId,sp.PlotNo,sp.SitePurchaseSection, 
    sp.SitePurchaseName,sp.SitePurchaseWidth,sp.SitePurchaseDepth,sp.PurchaseAmountLeft,
    sp.PurchaseAmountPaid,sp.ReceiptNo,sp.PurchasedModeId , users.UserName, user_type.userRole,
     m.MemberName,m.FatherName from " . $this->site_purchasehistory . " as sp join
      " . $this->users_memberslist . " as m on sp.MemberId=m.MemberId and sp.UserId=m.UserId 
      join  " . $this->user_type . " on m.Member_UserType= user_type.userType join " . $this->users . " on sp.UserId=users.UserId order By   sp.PurchasedOn desc";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function Total_PaymentByInvoiceId()
  {
    $query="SELECT ps.UserId as UserId, ps.MemberId as MemberId, ps.PurchasedModeId as PurchasedModeId,ps.SiteId as SiteId,SiteName, sd.SitePricePerSquareFeet as SitePricePerSquareFeet,ReceiptNo,PurchaseModeName, FatherName,MemberAddress,
     PurchaseInvoiceId ,PurchasedOn,PurchaseAmountPaid,PurchaseAmountLeft, PlotNo, SitePurchaseName,SitePurchaseSection,
     SitePurchaseDepth, SiteTotalAmount, SitePurchaseWidth, SitePurchaseCorner,SitePurchaseDiscount, SitePurchaseAmount,
      m.MemberName, m.MemberPhone,m.FatherName, users.UserName from  " .
       $this->site_purchasedetails . " as ps join " . $this->site_purchasemode . " as sp
       on ps.purchasedmodeid=sp.purchasemodeid join " . $this->site_sectiondetails ."  as sd
        on ps.SiteId=sd.SiteId join  " . $this->users_memberslist ." as m
         on m.MemberId=ps.MemberId join " . $this->users ."
        on ps.UserId=users.UserId 
    where ps.PurchaseInvoiceId=:PurchaseInvoiceId order By PurchasedOn desc";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);
    $stmt->execute();
    return $stmt;
  }


  public function Left_PaymentByMemberId(){

    if($this->PurchaseInvoiceId!=""){

        $query = "SELECT  ps.SitePurchaseSection, ss.SitePricePerSquareFeet, ss.SoldArea, ss.SiteName, ss.SiteSection, ss.SiteId,ss.SiteDepth,ss.SiteTotalArea,
    sm.PurchaseModeName, sm.PurchaseModeName, ps.UserId, ps.MemberId, ps.PurchaseInvoiceId, 
   ps.ReceiptNo, ps.PurchasedModeId, ps.parentId, ps.sponsorId, sum(ps.PurchaseAmountPaid)as PurchaseAmountPaid,
    sum( ps.PurchaseAmountLeft) as PurchaseAmountLeft, ps.PlotNo, ps.SiteId, ps.SitePurchaseName,ps.SitePurchaseSection,
    ps.SitePurchaseDepth,ps.SitePurchaseWidth, ps.SitePurchaseCorner, ps.SitePurchaseDiscount, 
    ps.SiteTotalAmount, ps.SitePurchaseAmount, ps.PurchasedOn, m.MemberName, m.MemberPhone, 
    m.MemberAddress,m.FatherName, users.UserName
   from  ".$this->site_purchasehistory ."  as ps join ".$this->users_memberslist ."  as m on
    m.MemberId=ps.MemberId join ".$this->users ." on ps.UserId=users.UserId  join ".$this->site_sectiondetails ." as ss
     on ps.SiteId=ss.SiteId join ".$this->site_purchasemode . " as sm on sm.PurchaseModeId=ps.PurchasedModeId
      where ps.PurchaseInvoiceId=:PurchaseInvoiceId 
   order by PurchasehistoryId desc limit 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);


    }else{

        $query = "SELECT  ps.SitePurchaseSection, ss.SitePricePerSquareFeet, ss.SoldArea, ss.SiteName, ss.SiteSection, ss.SiteId,ss.SiteDepth,ss.SiteTotalArea,
    sm.PurchaseModeName, sm.PurchaseModeName, ps.UserId, ps.MemberId, ps.PurchaseInvoiceId, 
   ps.ReceiptNo, ps.PurchasedModeId, ps.parentId, ps.sponsorId, sum(ps.PurchaseAmountPaid)as PurchaseAmountPaid,
    sum( ps.PurchaseAmountLeft) as PurchaseAmountLeft, ps.PlotNo, ps.SiteId, ps.SitePurchaseName,ps.SitePurchaseSection,
    ps.SitePurchaseDepth,ps.SitePurchaseWidth, ps.SitePurchaseCorner, ps.SitePurchaseDiscount, 
    ps.SiteTotalAmount, ps.SitePurchaseAmount, ps.PurchasedOn, m.MemberName, m.MemberPhone, 
    m.MemberAddress,m.FatherName, users.UserName
   from  ".$this->site_purchasehistory ."  as ps join ".$this->users_memberslist ."  as m on
    m.MemberId=ps.MemberId join ".$this->users ." on ps.UserId=users.UserId  join ".$this->site_sectiondetails ." as ss
     on ps.SiteId=ss.SiteId join ".$this->site_purchasemode . " as sm on sm.PurchaseModeId=ps.PurchasedModeId GROUP BY PurchaseInvoiceId";

    $stmt = $this->conn->prepare($query);

    }


    $stmt->execute();
    return $stmt;
  }



  // public function Left_PaymentByMemberId(){

  //   $query="SELECT PurchaseHistoryId, ss.SitePricePerSquareFeet, ss.SoldArea, ss.SiteId,ss.SiteDepth,ss.SiteTotalArea,
  //   sm.PurchaseModeName, sm.PurchaseModeName,  ud.UserId, ud.MemberId, ud.PucrhaseHistoryId,ud.PurchaseInvoiceId, ud.ReceiptNo, ud.PurchaseModeId,
  //   ud.IncomeCreatedOn, SUM(ps.PurchaseAmountPaid) as 	PurchaseAmountPaid, ps.PurchaseAmountLeft, ps.PlotNo, ps.SiteId, 
  //   ps.SitePurchaseName,ps.SitePurchaseSection,ps.SitePurchaseDepth,ps.SitePurchaseWidth, ps.SitePurchaseCorner,
  //   ps.SitePurchaseDiscount, ps.SiteTotalAmount,ps.SitePurchaseAmount, ps.PurchasedOn, m.MemberName, m.MemberPhone,
  //   m.MemberAddress,m.FatherName, users.UserName from ".$this->users_directincome." as ud 
  //   join ".$this->site_purchasehistory." as ps on ud.MemberId=ps.MemberId 
  //   join ".$this->users_memberslist." as m on m.MemberId=ud.MemberId 
  //   join ".$this->users." on ud.UserId=users.UserId left 
  //   join ".$this->site_sectiondetails." as ss on ps.SiteId=ss.SiteId 
  //   join ". $this->site_purchasemode." as sm on ud.PurchaseModeId=sm.PurchaseModeId  
  //   where ps.MemberId=:MemberId  group by ud.MemberId order By ps.PurchasedOn desc limit 1";
  //   $stmt=$this->conn->prepare($query);
  //   $stmt->bindParam(":MemberId", $this->MemberId);
  //   $stmt->execute();
  //    return $stmt;

  //   }




  // this query is use for calculate the sum of total paid amount of a customer
  function membersTotalPaidAmount()
  {

    // select all query
    $query = "SELECT SUM(PurchaseAmountPaid) as 	PurchaseAmountPaid
           FROM
               " . $this->site_purchasehistory . " where 	PlotNo=:PlotNo AND MemberId=:MemberId AND UserId=:UserId";


    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":PlotNo", $this->PlotNo);
    $stmt->bindParam(":MemberId", $this->MemberId);
    $stmt->bindParam(":UserId", $this->UserId);

    // execute query
    $stmt->execute();

    return $stmt;
  }


  public function Total_PaymentByMemberId()
  {

//echo "--------------------".$this->PurchaseHistoryId;
$query="SELECT ss.SitePricePerSquareFeet, ss.SoldArea, ss.SiteName, ss.SiteSection, ss.SiteId,ss.SiteDepth,
ss.SiteTotalArea, sm.PurchaseModeName, sm.PurchaseModeName, pd.UserId, pd.MemberId, pd.PurchasedetailId,
pd.PurchaseInvoiceId, pd.ReceiptNo, pd.PurchasedModeId, pd.PurchaseAmountPaid as PurchaseAmountPaid, 
pd.PurchaseAmountLeft, pd.PlotNo, pd.SiteId, pd.SitePurchaseName,pd.SitePurchaseSection,
pd.SitePurchaseDepth,pd.SitePurchaseWidth, pd.SitePurchaseCorner, pd.SitePurchaseDiscount, 
pd.SiteTotalAmount,pd.SitePurchaseAmount, pd.PurchasedOn, m.MemberName, m.MemberPhone, m.MemberAddress,
m.FatherName, users.UserName , users.parentId,users.sponsorId from " . $this->site_purchasedetails ." as pd
 join " . $this->users_memberslist ." as m on m.MemberId=pd.MemberId
  join  " . $this->users ." on pd.UserId=users.UserId
   left join " . $this->site_sectiondetails  ." as ss on pd.SiteId=ss.SiteId 
   join " . $this->site_purchasemode ." as sm on sm.PurchaseModeId=pd.PurchasedModeId
    where pd.MemberId=:MemberId order By pd.purchasedetailId desc limit 1";
$stmt=$this->conn->prepare($query);
$stmt->bindParam(":MemberId", $this->MemberId);
$stmt->execute();
 return $stmt;

}



  public function Users_DirectIncomeByUserId()
  {
    $query = "SELECT  AmountPaid, AmountLeft,   ud.CommissionLeft, ud.CommissionPaid, ud.UserId, ud.MemberId, ud.PucrhaseHistoryId,ud.PurchaseInvoiceId, ud.PurchaseModeId, ud.IncomeCreatedOn, ps.PlotNo, ps.SiteId, ps.SitePurchaseName,ps.SitePurchaseSection,ps.SitePurchaseDepth,ps.SitePurchaseWidth, ps.SitePurchaseCorner,ps.SitePurchaseDiscount, m.MemberName, m.MemberPhone,m.FatherName, users.UserName  from " . $this->users_directincome . " as ud join " . $this->site_purchasehistory . " as ps on ud.MemberId=ps.MemberId join " . $this->users_memberslist . " as m on m.MemberId=ud.MemberId join " . $this->users . " on ud.UserId=users.UserId where ud.UserId=:UserId order By ud.IncomeCreatedOn desc";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":UserId", $this->UserId);
    $stmt->execute();
    return $stmt;
  }

  function membersPaymentHistryCreate()
  {

    // query to insert record
    $query = "INSERT INTO
           " . $this->site_purchasehistory . "
           SET
           UserId=:UserId, 
           MemberId=:MemberId, 
           PlotNo=:PlotNo, 
           SiteId=:SiteId, 
           sponsorId=:sponsorId, 
           parentId=:parentId, 
           teamFlag=:teamFlag, 
           userFlag=:userFlag, 
           SitePurchaseSection=:SitePurchaseSection, 
           SiteTotalAmount=:SiteTotalAmount, 
           SitePurchaseName=:SitePurchaseName, 
           SitePurchaseWidth=:SitePurchaseWidth, 
           SitePurchaseDepth=:SitePurchaseDepth, 
           SitePurchaseCorner=:SitePurchaseCorner, 
           SitePurchaseDiscount=:SitePurchaseDiscount, 
           PurchaseInvoiceId=:PurchaseInvoiceId,  
           SitePurchaseAmount=:SitePurchaseAmount, 
           PurchaseAmountPaid=:PurchaseAmountPaid,
           PurchaseAmountLeft=:PurchaseAmountLeft,
           PurchasedModeId=:PurchasedModeId,
           ReceiptNo=:ReceiptNo,
           PurchasedBy=:PurchasedBy,
           PurchasedOn=:PurchasedOn
           ";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->UserId = htmlspecialchars(strip_tags($this->UserId));
    $this->MemberId = htmlspecialchars(strip_tags($this->MemberId));
    $this->PlotNo = htmlspecialchars(strip_tags($this->PlotNo));
    $this->SiteId = htmlspecialchars(strip_tags($this->SiteId));
    $this->parentId = htmlspecialchars(strip_tags($this->parentId));
    $this->teamFlag = htmlspecialchars(strip_tags($this->teamFlag));
    $this->userFlag = htmlspecialchars(strip_tags($this->userFlag));
    $this->sponsorId = htmlspecialchars(strip_tags($this->sponsorId));
    $this->SitePurchaseSection = htmlspecialchars(strip_tags($this->SitePurchaseSection));
    $this->SiteTotalAmount = htmlspecialchars(strip_tags($this->SiteTotalAmount));
    $this->SitePurchaseName = htmlspecialchars(strip_tags($this->SitePurchaseName));
    $this->SitePurchaseWidth = htmlspecialchars(strip_tags($this->SitePurchaseWidth));
    $this->SitePurchaseDepth = htmlspecialchars(strip_tags($this->SitePurchaseDepth));
    $this->SitePurchaseCorner = htmlspecialchars(strip_tags($this->SitePurchaseCorner));
    $this->SitePurchaseDiscount = htmlspecialchars(strip_tags($this->SitePurchaseDiscount));
    $this->PurchaseInvoiceId = htmlspecialchars(strip_tags($this->PurchaseInvoiceId));
    $this->SitePurchaseAmount = htmlspecialchars(strip_tags($this->SitePurchaseAmount));
    $this->PurchaseAmountPaid = htmlspecialchars(strip_tags($this->PurchaseAmountPaid));
    $this->PurchaseAmountLeft = htmlspecialchars(strip_tags($this->PurchaseAmountLeft));
    $this->PurchasedModeId = htmlspecialchars(strip_tags($this->PurchasedModeId));
    $this->ReceiptNo = htmlspecialchars(strip_tags($this->ReceiptNo));
    $this->PurchasedBy = htmlspecialchars(strip_tags($this->PurchasedBy));
    $this->PurchasedOn = htmlspecialchars(strip_tags($this->PurchasedOn));


    //bind values
    $stmt->bindParam(":UserId", $this->UserId);
    $stmt->bindParam(":MemberId", $this->MemberId);
    $stmt->bindParam(":PlotNo", $this->PlotNo);
    $stmt->bindParam(":SiteId", $this->SiteId);
    $stmt->bindParam(":sponsorId", $this->sponsorId);
    $stmt->bindParam(":parentId", $this->parentId);
    $stmt->bindParam(":userFlag", $this->userFlag);
    $stmt->bindParam(":teamFlag", $this->teamFlag);
    $stmt->bindParam(":SitePurchaseSection", $this->SitePurchaseSection);
    $stmt->bindParam(":SiteTotalAmount", $this->SiteTotalAmount);
    $stmt->bindParam(":SitePurchaseName", $this->SitePurchaseName);
    $stmt->bindParam(":SitePurchaseWidth", $this->SitePurchaseWidth);
    $stmt->bindParam(":SitePurchaseDepth", $this->SitePurchaseDepth);
    $stmt->bindParam(":SitePurchaseCorner", $this->SitePurchaseCorner);
    $stmt->bindParam(":SitePurchaseDiscount", $this->SitePurchaseDiscount);
    $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);
    $stmt->bindParam(":SitePurchaseAmount", $this->SitePurchaseAmount);
    $stmt->bindparam(":PurchaseAmountPaid", $this->PurchaseAmountPaid);
    $stmt->bindparam(":PurchaseAmountLeft", $this->PurchaseAmountLeft);
    $stmt->bindparam(":PurchasedModeId", $this->PurchasedModeId);
    $stmt->bindparam(":ReceiptNo", $this->ReceiptNo);
    $stmt->bindparam(":PurchasedBy", $this->PurchasedBy);
    $stmt->bindparam(":PurchasedOn", $this->PurchasedOn);

    // execute query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function Installment_PaymentRead()
  {

    $query = "SELECT  ps.PurchaseAmountPaid as TotalCommission, (select sum(PurchaseAmountPaid) 
    from " . $this->site_purchasedetails ." where PurchaseInvoiceId=:PurchaseInvoiceId ) as PurchaseAmountPaid,
    (select sum(PurchaseAmountLeft) from " . $this->site_purchasedetails ." where PurchaseInvoiceId=:PurchaseInvoiceId ) as PurchaseAmountLeft, ps.SitePurchaseSection, ss.SitePricePerSquareFeet, 
    ss.SoldArea, ss.SiteName, ss.SiteSection, ss.SiteId,ss.SiteDepth,ss.SiteTotalArea,
    sm.PurchaseModeName, sm.PurchaseModeName, ps.UserId, ps.MemberId, ps.PurchaseInvoiceId, 
   ps.ReceiptNo, ps.PurchasedModeId, ps.parentId, ps.sponsorId, 
    ps.PurchaseAmountLeft as PurchaseAmountLeft, ps.PlotNo, ps.SiteId, ps.SitePurchaseName,ps.SitePurchaseSection,
    ps.SitePurchaseDepth,ps.SitePurchaseWidth, ps.SitePurchaseCorner, ps.SitePurchaseDiscount, 
    ps.SiteTotalAmount, ps.SitePurchaseAmount, ps.PurchasedOn, m.MemberName, m.MemberPhone, 
    m.MemberAddress,m.FatherName, users.UserName
   from  " . $this->site_purchasehistory . " as ps join " . $this->site_purchasedetails ." as pd 
   on ps.MemberId=ps.MemberId join " . $this->users_memberslist ."   as m on
    m.MemberId=ps.MemberId join " . $this->users ."  on ps.UserId=users.UserId  join
     " . $this->site_sectiondetails." as ss
     on ps.SiteId=ss.SiteId join " . $this->site_purchasemode . " as sm on sm.PurchaseModeId=ps.PurchasedModeId
      where ps.PurchaseInvoiceId=:PurchaseInvoiceId
   order by PurchasehistoryId desc limit 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);
    $stmt->execute();
    return $stmt;
  }


  public function PaymentByInvoice_History(){

      // echo 
      if($this->PurchaseInvoiceId!=""){
         
       

       $query="SELECT ps.UserId as UserId,
            ps.MemberId as MemberId,
            ps.PurchasedModeId as PurchasedModeId,
            ps.SiteId as SiteId,SiteName, 
            sd.SitePricePerSquareFeet as SitePricePerSquareFeet,
            ReceiptNo,PurchaseModeName, 
            FatherName,MemberAddress,
            PurchaseInvoiceId,
            PurchasedOn,
            PurchaseAmountPaid,
            PurchaseAmountLeft, 
            PlotNo, 
            SitePurchaseName,
            SitePurchaseSection,
            SitePurchaseDepth,
            SiteTotalAmount, 
            SitePurchaseWidth, 
            SitePurchaseCorner,
            SitePurchaseDiscount, 
            SitePurchaseAmount,
            m.MemberName, 
            m.MemberPhone,
            m.FatherName, 
            users.UserName from  " .
            $this->site_purchasehistory . " as ps join " . $this->site_purchasemode . " as sp
            on ps.purchasedmodeid=sp.purchasemodeid join " . $this->site_sectiondetails ."  as sd
            on ps.SiteId=sd.SiteId join  " . $this->users_memberslist ." as m
            on m.MemberId=ps.MemberId join " . $this->users ."
            on ps.UserId=users.UserId 
            where ps.PurchaseInvoiceId=:PurchaseInvoiceId order By PurchasedOn desc";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":PurchaseInvoiceId", $this->PurchaseInvoiceId);

}
else{
   
       
       $query="SELECT ps.UserId as UserId,
            ps.MemberId as MemberId,
            ps.PurchasedModeId as PurchasedModeId,
            ps.SiteId as SiteId,SiteName, 
            sd.SitePricePerSquareFeet as SitePricePerSquareFeet,
            ReceiptNo,PurchaseModeName, 
            FatherName,MemberAddress,
            PurchaseInvoiceId,
            PurchasedOn,
            PurchaseAmountPaid,
            PurchaseAmountLeft, 
            PlotNo, 
            SitePurchaseName,
            SitePurchaseSection,
            SitePurchaseDepth,
            SiteTotalAmount, 
            SitePurchaseWidth, 
            SitePurchaseCorner,
            SitePurchaseDiscount, 
            SitePurchaseAmount,
            m.MemberName, 
            m.MemberPhone,
            m.FatherName, 
            users.UserName from  " .
            $this->site_purchasehistory . " as ps join " . $this->site_purchasemode . " as sp
            on ps.purchasedmodeid=sp.purchasemodeid join " . $this->site_sectiondetails ."  as sd
            on ps.SiteId=sd.SiteId join  " . $this->users_memberslist ." as m
            on m.MemberId=ps.MemberId join " . $this->users ."
            on ps.UserId=users.UserId order By PurchasedOn desc";

            $stmt = $this->conn->prepare($query);


}

    $stmt->execute();
    return $stmt;
  }

 

}
