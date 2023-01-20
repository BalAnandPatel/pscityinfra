<?php
class Users{
  
    // database connection and table name
    private $conn;
    private $users= "users";
    private $user_type= "user_type";
    
    // object properties
     
    public $UserId, $sponsorId, $UserName, $UserEmail , $UserType, $UserDOB, $AadharNo , 
    $PanNo,$Password , $PasswordExpirationLink , $PasswordHistory, $Phone, $Status, $CreatedBy, $CreatedOn, $UpdatedBy, $UpdatedOn, $Address
    ,$parentId,$position,$countNumber ;
    
  
   // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	// insert admin
    function Users_Registration(){
  
        // query to insert record
        $query = "INSERT INTO
                    " . $this->users . "
                SET
                sponsorId=:sponsorId,
                parentId=:parentId,
                position=:position,
                UserName=:UserName, 
                UserEmail=:UserEmail,
                 Password=:Password,
                 Status=:Status,
                 Phone=:Phone,
                AadharNo=:AadharNo,
                 PanNo=:PanNo,
                UserType=:UserType,
                UserDOB=:UserDOB,
                 Address=:Address,
                 CreatedBy=:CreatedBy,
                CreatedOn=:CreatedOn";        
        // prepare query
        $stmt = $this->conn->prepare($query);
       // sanitize
       $this->UserName=htmlspecialchars(strip_tags($this->UserName));
       $this->sponsorId=htmlspecialchars(strip_tags($this->sponsorId));
       $this->parentId=htmlspecialchars(strip_tags($this->parentId));
       $this->position=htmlspecialchars(strip_tags($this->position));
       $this->UserEmail=htmlspecialchars(strip_tags($this->UserEmail));
       $this->Password=htmlspecialchars(strip_tags($this->Password));
       $this->Phone=htmlspecialchars(strip_tags($this->Phone));
       $this->AadharNo=htmlspecialchars(strip_tags($this->AadharNo));
       $this->PanNo=htmlspecialchars(strip_tags($this->PanNo));
       $this->Address=htmlspecialchars(strip_tags($this->Address));
       $this->UserDOB=htmlspecialchars(strip_tags($this->UserDOB));
       $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
       $this->Status=htmlspecialchars(strip_tags($this->Status));
       $this->UserType=htmlspecialchars(strip_tags($this->UserType));
       $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));

        //bind values
        $stmt->bindParam(":UserName", $this->UserName);
        $stmt->bindParam(":sponsorId", $this->sponsorId);
        $stmt->bindParam(":parentId", $this->parentId);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":UserEmail", $this->UserEmail);
        $stmt->bindParam(":Password", $this->Password);
        $stmt->bindParam(":Phone", $this->Phone);
        $stmt->bindParam(":AadharNo", $this->AadharNo);
        $stmt->bindParam(":PanNo", $this->PanNo);
        $stmt->bindParam(":Address", $this->Address);
        $stmt->bindParam(":UserDOB", $this->UserDOB);
        $stmt->bindParam(":CreatedBy", $this->CreatedBy);
        $stmt->bindParam(":CreatedOn", $this->CreatedOn);
        $stmt->bindParam(":Status", $this->Status);
        $stmt->bindParam(":UserType", $this->UserType);

       // $stmt->bindParam(":UpdatedBy", $this->UpdatedBy);

       
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
          
    }
// Retrive User Details (Agent/Admin)

function User_Read(){

    $query= " Select UserId, UserName,UserEmail, Phone,UserDOB,Password,AadharNo, PanNo , users.UserType, user_type.userRole,
   CreatedBy, Status, Address, CreatedOn from " . $this->users . "  join  " . $this->user_type. 
   " on users.UserType=user_type.userType   where Password=:Password and UserId=:UserId";

   $stmt = $this->conn->prepare($query); 
   $stmt->bindParam(":Password", $this->Password);
   $stmt->bindParam(":UserId", $this->UserId);

$stmt->execute();
return $stmt;
}

function updateUserPassword(){
     
    // select all query
	   $query = "UPDATE
       " . $this->users . "
   SET
            Password=:Password WHERE UserId=:UserId";

    $stmt = $this->conn->prepare($query);
  
     $stmt->bindParam(":UserId", $this->UserId);
     $stmt->bindParam(":Password", $this->Password);
    // execute query
    $stmt->execute();
  
    return $stmt;
}

function User_ReadById(){

    $query = "SELECT UserId, UserName, sponsorId, parentId FROM " . $this->users . " where UserId=:UserId and Status=1";

   $stmt = $this->conn->prepare($query);
   $stmt->bindParam(":UserId", $this->UserId);
   $stmt->execute();
   return $stmt;
   
  }

  function User_List_ById(){

  $query = "SELECT  UserId, UserName, sponsorId, position, parentId, Phone, AadharNo, PanNo, Password FROM " . $this->users . " where  UserId=:UserId";

   $stmt = $this->conn->prepare($query);
   $stmt->bindParam(":UserId", $this->UserId);

   $stmt->execute();
   return $stmt;
   
  }

 function get_child(){

$query = "SELECT UserId, UserName, sponsorId, parentId,
position FROM " . $this->users . " where parentId=:parentId and Status=1 order by Position asc";

   $stmt = $this->conn->prepare($query);
   $stmt->bindParam(":parentId", $this->UserId);
   $stmt->execute();
   return $stmt;
   
  }



function Users_List(){

 
 $query = "Select UserId,sponsorId,parentId, UserName,UserEmail, Phone,UserDOB,Password,AadharNo,
  PanNo, position, users.UserType, user_type.userRole, CreatedBy,  CreatedOn from " . $this->users .  " 
   join  " . $this->user_type.  "  on users.UserType=user_type.userType  
    where users.UserType=:UserType";
 $stmt = $this->conn->prepare($query);

 $stmt->bindParam(":UserType", $this->UserType);
 
 $stmt->execute();
 return $stmt;

 }

 function Users_Direct_Team(){

 $query=" Select UserId, UserName,UserEmail, Phone,UserDOB,Password,AadharNo, PanNo , UserType,  CreatedBy,  CreatedOn from " . $this->users . " where sponsorId=:sponsorId and UserType=:UserType";
 $stmt = $this->conn->prepare($query); 

 $stmt->bindParam(":sponsorId", $this->UserId);
 $stmt->bindParam(":UserType", $this->UserType);
 
 $stmt->execute();
 return $stmt;
 }

 function UserType_Read(){
      $query="Select userRole, userType from " . $this->user_type.  "";
   $stmt = $this->conn->prepare($query); 
   $stmt->execute();
   return $stmt;
   }

   function User_Login_Details(){
  $query="SELECT  UserId, UserName,UserEmail, 
  sponsorId, parentId,position,Phone,UserDOB,Password,AadharNo,
   PanNo , users.UserType, user_type.userRole, CreatedBy, 
    CreatedOn,Status,Address from " . $this->users .  "  join  " . $this->user_type. 
     "  on users.UserType=user_type.userType   where UserId=:UserId";
 $stmt = $this->conn->prepare($query); 
 $stmt->bindParam(":UserId", $this->UserId);
 $stmt->execute();
 return $stmt;
 }

 function User_MaxId(){
    $query="Select max(UserId) as UserId from " . $this->users .  "";
 $stmt = $this->conn->prepare($query); 
 $stmt->execute();
 return $stmt;
 }

 function User_Profile_Update(){
  
    // query to insert record
            $query = "UPDATE 
                " . $this->users . "
            SET
            UserId=:UserId,
            UserName=:UserName, 
            UserEmail=:UserEmail,
             Password=:Password,
             Status=:Status,
             Phone=:Phone,
            AadharNo=:AadharNo,
             PanNo=:PanNo,
            UserType=:UserType,
            UserDOB=:UserDOB,
             Address=:Address,
             CreatedBy=:CreatedBy,
            CreatedOn=:CreatedOn,
             UpdatedBy=:UpdatedBy,
             UpdatedOn=:UpdatedOn where UserId=:UserId";        
    // prepare query
    $stmt = $this->conn->prepare($query);
   // sanitize
   $this->UserId=htmlspecialchars(strip_tags($this->UserId));

   $this->UserName=htmlspecialchars(strip_tags($this->UserName));
   $this->UserEmail=htmlspecialchars(strip_tags($this->UserEmail));
   $this->Password=htmlspecialchars(strip_tags($this->Password));
   //$this->PasswordHistory=htmlspecialchars(strip_tags($this->PasswordHistory));
   $this->Phone=htmlspecialchars(strip_tags($this->Phone));
   $this->AadharNo=htmlspecialchars(strip_tags($this->AadharNo));
   $this->PanNo=htmlspecialchars(strip_tags($this->PanNo));
   $this->Address=htmlspecialchars(strip_tags($this->Address));
   $this->UserDOB=htmlspecialchars(strip_tags($this->UserDOB));
   $this->Status=htmlspecialchars(strip_tags($this->Status));
   $this->UserType=htmlspecialchars(strip_tags($this->UserType));
   $this->CreatedBy=htmlspecialchars(strip_tags($this->CreatedBy));
   $this->CreatedOn=htmlspecialchars(strip_tags($this->CreatedOn));

   $this->UpdatedBy=htmlspecialchars(strip_tags($this->UpdatedBy));
   $this->UpdatedOn=htmlspecialchars(strip_tags($this->UpdatedOn));

    //bind values
    $stmt->bindParam(":UserId", $this->UserId);

    $stmt->bindParam(":UserName", $this->UserName);
    $stmt->bindParam(":UserEmail", $this->UserEmail);
    $stmt->bindParam(":Password", $this->Password);
    //$stmt->bindParam(":PasswordHistory", $this->PasswordHistory);
    $stmt->bindParam(":Phone", $this->Phone);
    $stmt->bindParam(":AadharNo", $this->AadharNo);
    $stmt->bindParam(":PanNo", $this->PanNo);
    $stmt->bindParam(":Address", $this->Address);
    $stmt->bindParam(":UserDOB", $this->UserDOB);
    $stmt->bindParam(":CreatedBy", $this->CreatedBy);
    $stmt->bindParam(":CreatedOn", $this->CreatedOn);
    $stmt->bindParam(":Status", $this->Status);
    $stmt->bindParam(":UserType", $this->UserType);
    $stmt->bindParam(":UpdatedBy", $this->UpdatedBy);
    $stmt->bindParam(":UpdatedOn", $this->UpdatedOn);
 // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}


function Users_List_Update(){
  
    // query to insert record
            $query = "UPDATE 
                " . $this->users . "
            SET
            UserId=:UserId,
            UserName=:UserName,
            Password=:Password,
            Phone=:Phone,
            AadharNo=:AadharNo,
            PanNo=:PanNo,
            UpdatedBy=:UpdatedBy,
            UpdatedOn=:UpdatedOn where UserId=:UserId";

    // prepare query
    $stmt = $this->conn->prepare($query);
   // sanitize
   $this->UserId=htmlspecialchars(strip_tags($this->UserId));
   $this->UserName=htmlspecialchars(strip_tags($this->UserName));
   $this->Password=htmlspecialchars(strip_tags($this->Password));
   $this->Phone=htmlspecialchars(strip_tags($this->Phone));
   $this->AadharNo=htmlspecialchars(strip_tags($this->AadharNo));
   $this->PanNo=htmlspecialchars(strip_tags($this->PanNo));
   $this->UpdatedBy=htmlspecialchars(strip_tags($this->UpdatedBy));
   $this->UpdatedOn=htmlspecialchars(strip_tags($this->UpdatedOn));

    //bind values
    $stmt->bindParam(":UserId", $this->UserId);
    $stmt->bindParam(":UserName", $this->UserName);
    $stmt->bindParam(":Password", $this->Password);
    $stmt->bindParam(":Phone", $this->Phone);
    $stmt->bindParam(":AadharNo", $this->AadharNo);
    $stmt->bindParam(":PanNo", $this->PanNo);
    $stmt->bindParam(":UpdatedBy", $this->UpdatedBy);
    $stmt->bindParam(":UpdatedOn", $this->UpdatedOn);

  //execute query
    if($stmt->execute()){
        return true;
    }
    return false;  
}

function user_list_pending_update(){
  
    // query to update record
            $query = "UPDATE 
                " . $this->users . "
            SET
             Status=:Status,
             UpdatedBy=:UpdatedBy,
             UpdatedOn=:UpdatedOn where UserId=:UserId";        
    // prepare query
    $stmt = $this->conn->prepare($query);
   // sanitize
   $this->UserId=htmlspecialchars(strip_tags($this->UserId));
   $this->Status=htmlspecialchars(strip_tags($this->Status));
   $this->UpdatedBy=htmlspecialchars(strip_tags($this->UpdatedBy));
   $this->UpdatedOn=htmlspecialchars(strip_tags($this->UpdatedOn));

    //bind values
    $stmt->bindParam(":UserId", $this->UserId);
    $stmt->bindParam(":Status", $this->Status);
    $stmt->bindParam(":UpdatedBy", $this->UpdatedBy);
    $stmt->bindParam(":UpdatedOn", $this->UpdatedOn);
 // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

function user_sponsor_parent_details(){
    $query="SELECT  UserId, UserName,UserEmail, sponsorId, parentId,UserDOB,Password,AadharNo, PanNo , 
    users.UserType,
     user_type.userRole, CreatedBy,  CreatedOn,Status,Address from " . $this->users .  "  join
       " . $this->user_type.  "  on users.UserType=user_type.userType 
         where UserId=:sponsorId";
   $stmt = $this->conn->prepare($query); 
   $stmt->bindParam(":sponsorId", $this->sponsorId);

   $stmt->execute();
   return $stmt;
   }

   function user_position_count(){
    $query="select position, COALESCE(count(parentId), 0) AS countNumber from
    " . $this->users .  " where parentId=:parentId group by parentId having count(parentId)<2;
    ";
   $stmt = $this->conn->prepare($query); 
   $stmt->bindParam(":parentId", $this->parentId);

   $stmt->execute();
   return $stmt;
   }

   function Call_sp_get_next_position()
  {
    $stmt = $this->conn->prepare("CALL sp_get_next_position(?, ?)");
    $stmt->bindParam(1, $this->sponsorId, PDO::PARAM_STR);
    $stmt->bindParam(2, $this->position, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
  }


  function Call_sp_get_network_tree()
  {
    $stmt = $this->conn->prepare("CALL sp_get_network_tree(?, ?)");
    $stmt->bindParam(1, $this->UserId, PDO::PARAM_STR);
    $stmt->bindParam(2, $this->ilevel, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
  }
  function Update_User_Password(){
     
    // select all query
	   $query = "UPDATE
       " . $this->users . "
   SET
            Password=:Password WHERE UserId=:UserId";

    $stmt = $this->conn->prepare($query);
  
     $stmt->bindParam(":UserId", $this->UserId);
     $stmt->bindParam(":Password", $this->Password);
    // execute query
    $stmt->execute();
  
    return $stmt;
}

function User_forgot_Password(){
    $query="SELECT  UserId, UserName,UserEmail, Password from " . $this->users .  " where UserEmail=:UserEmail";
   $stmt = $this->conn->prepare($query); 
   $stmt->bindParam(":UserEmail", $this->UserEmail);
   $stmt->execute();
   return $stmt;
   }

}
?>