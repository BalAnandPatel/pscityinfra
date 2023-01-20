<?php 

class Members{

   private $conn;
   private $users_memberslist="users_memberslist";
   private $user_type="user_type";
   private $users="users";
   private $member_status="member_status";
   //private $site_purchasehistory="site_purchasehistory";

public $MemberId, $MemberName, $FatherName, $MemberEmail, $MemberAddress, $Member_UserType
, $UserId, $UserType, $MemberPhone, $MemberStatus, $MemberAadhar, $MemberPAN, $CreatedBy
, $CreatedOn, $ApprovedBy, $ApprovedOn;


public function __construct($db){
   $this->conn = $db;
}

public function users_MembersRegistration(){

   $query="Insert into   
  " . $this->users_memberslist . "
   SET 
   MemberName=:MemberName,
   FatherName=:FatherName,
   MemberEmail=:MemberEmail,
   MemberAddress=:MemberAddress,
   Member_UserType=:Member_UserType,
   UserId=:UserId,
   UserType=:UserType,
   MemberPhone=:MemberPhone,
   MemberStatus=:MemberStatus,
   MemberAadhar=:MemberAadhar,
   MemberPAN=:MemberPAN,
   CreatedBy=:CreatedBy,
   CreatedOn=:CreatedOn
   ";

   $stmt = $this->conn->prepare($query);

   $this->MemberName=htmlspecialchars(strip_tags($this->MemberName));
   $this->FatherName=htmlspecialchars(strip_tags($this->FatherName));
   $this->MemberEmail=htmlspecialchars(strip_tags($this->MemberEmail));
   $this->MemberAddress=htmlspecialchars(strip_tags($this->MemberAddress));
   $this->UserId=htmlspecialchars(strip_tags($this->UserId));
   $this->UserType=htmlspecialchars(strip_tags($this->UserType));
   $this->Member_UserType=htmlspecialchars(strip_tags($this->Member_UserType));

   $this->MemberPhone=htmlspecialchars(strip_tags($this->MemberPhone));
   $this->MemberStatus=htmlspecialchars(strip_tags($this->MemberStatus));
   $this->MemberAadhar=htmlspecialchars(strip_tags($this->MemberAadhar));
   $this->MemberPAN=htmlspecialchars(strip_tags($this->MemberPAN));
   $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
   $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));
   // $this->ApprovedBy=htmlspecialchars(strip_tags($this->ApprovedBy));
   // $this->ApprovedOn=htmlspecialchars(strip_tags($this->ApprovedOn));
 
   $stmt->bindParam(":MemberName", $this->MemberName);
   $stmt->bindParam(":FatherName", $this->FatherName);
   $stmt->bindParam(":MemberEmail", $this->MemberEmail);
   $stmt->bindParam(":MemberAddress", $this->MemberAddress);
   $stmt->bindParam(":UserId", $this->UserId);
   $stmt->bindParam(":UserType", $this->UserType);
   $stmt->bindParam(":MemberAddress", $this->MemberAddress);
   $stmt->bindParam(":Member_UserType", $this->Member_UserType);
   $stmt->bindParam(":MemberPhone", $this->MemberPhone);
   $stmt->bindParam(":MemberStatus", $this->MemberStatus);
   $stmt->bindParam(":MemberAadhar", $this->MemberAadhar);
   $stmt->bindParam(":MemberPAN", $this->MemberPAN);
   $stmt->bindParam(":CreatedBy", $this->CreatedBy);
   $stmt->bindParam(":CreatedOn", $this->CreatedOn);
   // $stmt->bindParam(":ApprovedBy", $this->ApprovedBy);
   // $stmt->bindParam(":ApprovedOn", $this->ApprovedOn);

   if($stmt->execute()){
            return true;
        }    
        return false;
}
//For Approved list members status=1
public function Users_MembersApprovedList(){
   $query=" Select MemberId, MemberName, FtaherName, MemberEmail, list.MemberStatus, Member_UserType, MemberPhone,MemberAadhar,MemberPAN, ApprovedOn, users.UserName as AgentName, user_type.userRole,member_status.StatusName,list.CreatedOn,list.CreatedBy,list.ApprovedBy,list.UserId
   from
   " . $this->users_memberslist . " as list left join "  .$this->users. " on  list.UserId=users.UserId  left
     join " . $this->user_type . " on list.Member_UserType=user_type.userType left join " . $this->member_status . " on list.MemberStatus=member_status.MemberStatus where list.Member_UserType=4 and list.MemberStatus=1  order By   list.MemberId desc
   ";
$stmt=$this->conn->prepare($query);
$stmt->execute();
return $stmt;
}




//For pending list of members status=0
public function Users_MembersPendingList(){
$query=" Select MemberId, MemberName,FatherName, MemberEmail, list.MemberStatus, Member_UserType, MemberPhone,
MemberAadhar,MemberPAN, ApprovedOn, users.UserName as AgentName, user_type.userRole,member_status.StatusName,list.CreatedOn,list.CreatedBy,list.ApprovedBy,list.UserId
from
" . $this->users_memberslist . " as list left join "  .$this->users. " on 
 list.UserId=users.UserId  left join " . $this->user_type . " on list.Member_UserType=user_type.userType
  left join " . $this->member_status . " on list.MemberStatus=member_status.MemberStatus where list.Member_UserType=4 
  and list.MemberStatus=0  order By   list.MemberId desc
 ";
 $stmt=$this->conn->prepare($query);
 $stmt->execute();
 return $stmt;
 }

 //update Members Status set 
 public function Users_MembersUpdate(){

   $query = " UPDATE
   " . $this->users_memberslist . "
   SET 
   MemberAddress=:MemberAddress, MemberEmail=:MemberEmail,MemberPhone=:MemberPhone,MemberAadhar=:MemberAadhar,MemberPAN=:MemberPAN,MemberStatus=:MemberStatus, ApprovedBy=:ApprovedBy, ApprovedOn=:ApprovedOn
        WHERE 
       MemberId=:MemberId";
    // prepare query
   $stmt = $this->conn->prepare($query);

  //sanitize
  $this->MemberAddress=htmlspecialchars(strip_tags($this->MemberAddress));
  $this->MemberAadhar=htmlspecialchars(strip_tags($this->MemberAadhar));
  $this->MemberPAN=htmlspecialchars(strip_tags($this->MemberPAN));
  $this->MemberEmail=htmlspecialchars(strip_tags($this->MemberEmail)); 
  $this->MemberPhone=htmlspecialchars(strip_tags($this->MemberPhone));
  $this->MemberStatus=htmlspecialchars(strip_tags($this->MemberStatus));
  $this->ApprovedBy=htmlspecialchars(strip_tags($this->ApprovedBy));
  $this->ApprovedOn=htmlspecialchars(strip_tags($this->ApprovedOn));
  $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));

 //bind values
 $stmt->bindParam(":MemberAddress", $this->MemberAddress);
 $stmt->bindParam(":MemberAadhar", $this->MemberAadhar);
 $stmt->bindParam(":MemberPAN", $this->MemberPAN);
 $stmt->bindParam(":MemberEmail", $this->MemberEmail);
 $stmt->bindParam(":MemberPhone", $this->MemberPhone);
 $stmt->bindParam(":MemberStatus", $this->MemberStatus);
 $stmt->bindParam(":ApprovedBy", $this->ApprovedBy);
 $stmt->bindParam(":ApprovedOn", $this->ApprovedOn);
 $stmt->bindParam(":MemberId", $this->MemberId);

 // execute query
 if($stmt->execute()){
 return true;
 }

return false;

}


 //update Members Status set 
 public function Users_Members_List_Update(){

   $query = " UPDATE
   " . $this->users_memberslist . "
   SET
   MemberName=:MemberName, 
   FatherName=:FatherName,
   MemberAddress=:MemberAddress,
   MemberEmail=:MemberEmail,
   MemberPhone=:MemberPhone,
   MemberAadhar=:MemberAadhar,
   MemberPAN=:MemberPAN,
   ApprovedBy=:ApprovedBy,
   ApprovedOn=:ApprovedOn
   WHERE 
   MemberId=:MemberId";

   //prepare query
   $stmt = $this->conn->prepare($query);

  //sanitize
  $this->MemberName=htmlspecialchars(strip_tags($this->MemberName));
  $this->FatherName=htmlspecialchars(strip_tags($this->FatherName));
  $this->MemberAddress=htmlspecialchars(strip_tags($this->MemberAddress));
  $this->MemberAadhar=htmlspecialchars(strip_tags($this->MemberAadhar));
  $this->MemberPAN=htmlspecialchars(strip_tags($this->MemberPAN));
  $this->MemberEmail=htmlspecialchars(strip_tags($this->MemberEmail)); 
  $this->MemberPhone=htmlspecialchars(strip_tags($this->MemberPhone));
  $this->ApprovedBy=htmlspecialchars(strip_tags($this->ApprovedBy));
  $this->ApprovedOn=htmlspecialchars(strip_tags($this->ApprovedOn));
  $this->MemberId=htmlspecialchars(strip_tags($this->MemberId));

 //bind values
 $stmt->bindParam(":MemberName", $this->MemberName);
 $stmt->bindParam(":FatherName", $this->FatherName);
 $stmt->bindParam(":MemberAddress", $this->MemberAddress);
 $stmt->bindParam(":MemberAadhar", $this->MemberAadhar);
 $stmt->bindParam(":MemberPAN", $this->MemberPAN);
 $stmt->bindParam(":MemberEmail", $this->MemberEmail);
 $stmt->bindParam(":MemberPhone", $this->MemberPhone);
 $stmt->bindParam(":ApprovedBy", $this->ApprovedBy);
 $stmt->bindParam(":ApprovedOn", $this->ApprovedOn);
 $stmt->bindParam(":MemberId", $this->MemberId);

 // execute query
 if($stmt->execute()){
 return true;
 }

return false;

}

// For all the customer details . Admin use this page.
public function User_MebersLists(){

   if($this->MemberId!=""){

    $query=" Select MemberId, MemberName,FatherName, MemberAddress, list.UserId, MemberEmail, list.MemberStatus,
    Member_UserType, MemberPhone,MemberAadhar,MemberPAN,
    ApprovedOn, users.UserName as AgentName, user_type.userRole,
    member_status.StatusName,list.CreatedOn,list.CreatedBy,list.ApprovedBy
    from
    " . $this->users_memberslist . " as list left join "  .$this->users.
    " on  list.UserId=users.UserId  left join " . $this->user_type . 
    " on list.Member_UserType=user_type.userType left join " . $this->member_status .
    " on list.MemberStatus=member_status.MemberStatus where list.MemberId=:MemberId and list.Member_UserType=4 order By list.MemberId desc";

   $stmt=$this->conn->prepare($query);
   $stmt->bindParam(":MemberId", $this->MemberId);

   }else{

    $query=" Select MemberId, MemberName,FatherName, MemberAddress, list.UserId, MemberEmail, list.MemberStatus,
    Member_UserType, MemberPhone,MemberAadhar,MemberPAN,
    ApprovedOn, users.UserName as AgentName, user_type.userRole,
    member_status.StatusName,list.CreatedOn,list.CreatedBy,list.ApprovedBy
    from
    " . $this->users_memberslist . " as list left join "  .$this->users.
    " on  list.UserId=users.UserId  left join " . $this->user_type . 
    " on list.Member_UserType=user_type.userType left join " . $this->member_status .
    " on list.MemberStatus=member_status.MemberStatus where list.Member_UserType=4 order By
       list.MemberId desc";

    $stmt=$this->conn->prepare($query);

   }  

 $stmt->execute();
 return $stmt;
}


// This method is used for search member by member id.
public function Users_MembersDetails(){
   $query=" Select MemberId, MemberName,FatherName, MemberEmail, list.MemberStatus, Member_UserType, MemberPhone,
   MemberAadhar,MemberPAN, ApprovedOn, users.UserName as AgentName,
    user_type.userRole,member_status.StatusName,list.CreatedOn,list.CreatedBy,list.ApprovedBy,list.UserId, 
    list.MemberAddress
 from
 " . $this->users_memberslist . " as list left join "  .$this->users. " on  list.UserId=users.UserId  left join " . $this->user_type . " on list.Member_UserType=user_type.userType left join " . $this->member_status . " on list.MemberStatus=member_status.MemberStatus where list.Member_UserType=4 and list.MemberId=:MemberId  order By   list.MemberId desc
 ";
 $stmt=$this->conn->prepare($query);

 $stmt->bindParam(":MemberId", $this->MemberId);

 $stmt->execute();
 return $stmt;
 }

// This method is used for search member by member id.
public function MembersDetailsById(){

 $query=" Select MemberId, MemberName, FatherName, MemberPhone, MemberAddress 
 from
 " . $this->users_memberslist . "  where Member_UserType=4 and MemberId=:MemberId  order By  MemberId desc ";
 $stmt=$this->conn->prepare($query);

 $stmt->bindParam(":MemberId", $this->MemberId);

 $stmt->execute();
 return $stmt;

 }


 
 public function User_DirectMembers_List(){

   $query=" Select MemberId, MemberName,FatherName, MemberEmail, list.MemberStatus, Member_UserType, MemberPhone,
   MemberAadhar,MemberPAN, ApprovedOn, users.UserName as AgentName, user_type.userRole,member_status.StatusName,
   list.CreatedOn,list.CreatedBy,list.ApprovedBy,list.UserId
 from
 " . $this->users_memberslist . " as list left join "  .$this->users. " on  list.UserId=users.UserId  left join " . $this->user_type . " on list.Member_UserType=user_type.userType left
  join " . $this->member_status . " on list.MemberStatus=member_status.MemberStatus where list.Member_UserType=:Member_UserType and list.UserId=:UserId order By   list.MemberId desc
 ";
 $stmt=$this->conn->prepare($query);
 $stmt->bindParam(":Member_UserType", $this->Member_UserType);

 $stmt->bindParam(":UserId", $this->UserId);

 $stmt->execute();
 return $stmt;
}


public function MembersRegistration_ByAdmin(){

  $query=" INSERT into   
  " . $this->users_memberslist . "
   SET 
   MemberName=:MemberName,
   FatherName=:FatherName,
   MemberEmail=:MemberEmail,
   MemberAddress=:MemberAddress,
   Member_UserType=:Member_UserType,
   UserId=:UserId,
   UserType=:UserType,
   MemberPhone=:MemberPhone,
   MemberStatus=:MemberStatus,
   MemberAadhar=:MemberAadhar,
   MemberPAN=:MemberPAN,
   CreatedBy=:CreatedBy,
   CreatedOn=:CreatedOn,
   ApprovedBy=:ApprovedBy,
   ApprovedOn=:ApprovedOn
   ";

   $stmt = $this->conn->prepare($query);

   $this->MemberName=htmlspecialchars(strip_tags($this->MemberName));
   $this->FatherName=htmlspecialchars(strip_tags($this->FatherName));
   $this->MemberEmail=htmlspecialchars(strip_tags($this->MemberEmail));
   $this->MemberAddress=htmlspecialchars(strip_tags($this->MemberAddress));
   $this->UserId=htmlspecialchars(strip_tags($this->UserId));
   $this->UserType=htmlspecialchars(strip_tags($this->UserType));
   $this->Member_UserType=htmlspecialchars(strip_tags($this->Member_UserType));$this->MemberPhone=htmlspecialchars(strip_tags($this->MemberPhone));
   $this->MemberStatus=htmlspecialchars(strip_tags($this->MemberStatus));
   $this->MemberAadhar=htmlspecialchars(strip_tags($this->MemberAadhar));
   $this->MemberPAN=htmlspecialchars(strip_tags($this->MemberPAN));
   $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
   $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));
   $this->ApprovedBy=htmlspecialchars(strip_tags($this->ApprovedBy));
   $this->ApprovedOn=htmlspecialchars(strip_tags($this->ApprovedOn));
 
   $stmt->bindParam(":MemberName", $this->MemberName);
   $stmt->bindParam(":FatherName", $this->FatherName);
   $stmt->bindParam(":MemberEmail", $this->MemberEmail);
   $stmt->bindParam(":MemberAddress", $this->MemberAddress);
   $stmt->bindParam(":UserId", $this->UserId);
   $stmt->bindParam(":UserType", $this->UserType); 
   $stmt->bindParam(":Member_UserType", $this->Member_UserType);
   $stmt->bindParam(":MemberPhone", $this->MemberPhone);
   $stmt->bindParam(":MemberStatus", $this->MemberStatus);
   $stmt->bindParam(":MemberAadhar", $this->MemberAadhar);
   $stmt->bindParam(":MemberPAN", $this->MemberPAN);
   $stmt->bindParam(":CreatedBy", $this->CreatedBy);
   $stmt->bindParam(":CreatedOn", $this->CreatedOn);
   $stmt->bindParam(":ApprovedBy", $this->ApprovedBy);
   $stmt->bindParam(":ApprovedOn", $this->ApprovedOn);

   if($stmt->execute()){
            return true;
        }    
        return false;
}

public function Members_PaymentDetailsList(){

   $query=" select sp.MemberId, sp.UserId, sp.PurchaseInvoiceId,sp.PlotNo,sp.SitePurchaseSection, sp.SitePurchaseName,sp.SitePurchaseWidth,sp.SitePurchaseDepth,sp.PurchaseAmountLeft,sp.PurchaseAmountPaid,sp.ReceiptNo,sp.PurchasedModeId , users.UserName, user_type.userRole,
   m.MemberName,m.FatherName from site_purchasehistory as sp join " . $this->users_memberslist . " as m on sp.MemberId=m.MemberId and sp.UserId=m.UserId join user_type on m.Member_UserType=user_type.userType join users on sp.UserId=users.UserId order By   sp.PurchasedOn desc
 ";
 $stmt=$this->conn->prepare($query);
 $stmt->bindParam(":MemberId", $this->MemberId);

 $stmt->execute();
 return $stmt;
}

}

?>