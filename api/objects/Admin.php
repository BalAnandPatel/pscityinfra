<?php

class admin{

    //data base connection and table name
private $conn;
private $site_sectiondetails = "site_sectiondetails";
private $site_purchasedetails= "site_purchasedetails";
private $site_purchasehistory= "site_purchasehistory";
private $users_memberslist= "users_memberslist";
private $users = "users";

//object properties
public $SiteName;
public $sponsorId;
public $UserId;
public $UserType;
public $SiteTotalAmount;
public $PurchaseAmountPaid;



   // constructor with $db as database connection
   public function __construct($db){
   $this->conn = $db;
}

//Dashboard Counter 

function siteCount(){
     
    // select all query
	   $query = "SELECT COUNT(DISTINCT 	SiteName)as site_count FROM " . $this->site_sectiondetails;
    
    $stmt = $this->conn->prepare($query);
  
//    $stmt->bindParam(":agent_id", $this->agent_id);
    // execute query
    $stmt->execute();
  
    return $stmt;
}

// agent Count

function agentCount(){
      
    if($this->UserType==2){
         $query = "SELECT COUNT(*)as agent_count FROM " . $this->users;
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam(":role", $this->role);
    } 
    else {
    // select all query
    $query = "SELECT COUNT(UserId)as agent_count FROM " . $this->users . " where sponsorId=:UserId";
    
    $stmt = $this->conn->prepare($query);
  
   $stmt->bindParam(":UserId", $this->UserId);

    }
    // execute query
    $stmt->execute();
  
    return $stmt;
}

//Agent sale plot count///
function agentPlotCount(){
    if($this->UserType==2){     
    // select all query
	$query = "SELECT
                   COUNT(UserId) as totalPlot FROM " . $this->site_purchasedetails
; 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    } 
    else{
        $query = "SELECT
        COUNT(UserId) as totalPlot FROM " . $this->site_purchasedetails
        ." where UserId=:UserId";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":UserId", $this->UserId);
    }
    // execute query
    $stmt->execute();
  
    return $stmt;
}

//// Customer Count
function customerCount(){
     
    // select all query
	$query = "SELECT COUNT(*) as customer_count FROM " . $this->users_memberslist;
    
    $stmt = $this->conn->prepare($query);
  
//    $stmt->bindParam(":agent_id", $this->agent_id);
    // execute query
    $stmt->execute();
  
    return $stmt;
}


// read total plot amount 

function readTotalPlotAmount(){
    if($this->UserType==2){

      $query = "SELECT sum(SiteTotalAmount)as totalPlotAmount FROM " . $this->site_purchasedetails;
    
        $stmt = $this->conn->prepare($query);
   
    }
    else{

    // select all query
     $query = "SELECT sum(SiteTotalAmount)as totalPlotAmount FROM " . $this->site_purchasedetails . " where UserId=:UserId";
    
    $stmt = $this->conn->prepare($query);
  
    $stmt->bindParam(":UserId", $this->UserId);
   
    }
    
 
    $stmt->execute();
  
    return $stmt;
}


// read total plot paid  amount 
function readTotalPlotPaidAmount(){
    if($this->UserType==2)
    {
    // select all query
    $query = "SELECT sum(PurchaseAmountPaid)as totalPlotPaidAmount FROM " . $this->site_purchasehistory;
    
    $stmt = $this->conn->prepare($query);
    
    }
    else{

    // select all query
     $query = "SELECT sum(PurchaseAmountPaid)as totalPlotPaidAmount FROM " . $this->site_purchasehistory . " where UserId=:UserId";
    
    $stmt = $this->conn->prepare($query);
  
    $stmt->bindParam(":UserId", $this->UserId);


    }
     
    $stmt->execute();
  
    return $stmt;
}

}

?>