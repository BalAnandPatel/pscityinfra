<?php

class Site_SectionDetails{

   private $conn;
   private $site_sectiondetails="site_sectiondetails";

   public $SiteId;
   public $SiteName;
   public $SiteSection;
   public $SiteDepth;
   public $SiteTotalArea;
   public $SitePricePerSquareFeet;
   public $SiteCurrentAvailableArea;
   public $SoldArea;
   public $SiteStatus;
   public $SiteCreatedBy;
   public $SiteCreatedOn;
   public $SiteUpdatedOn;
   public $SiteUpdatedBy;


   public function __construct($db){
      $this->conn = $db;
  }

 public function Site_SectionDetailsEntry(){

    $query = "INSERT INTO
    ". $this->site_sectiondetails ."
    set
    SiteName=:SiteName,
    SiteSection=:SiteSection,
    SiteDepth=:SiteDepth,
    SiteTotalArea=:SiteTotalArea,
    SiteCurrentAvailableArea=:SiteCurrentAvailableArea,
    SoldArea=:SoldArea,
    SitePricePerSquareFeet=:SitePricePerSquareFeet,
    SiteStatus=:SiteStatus,
    SiteCreatedBy=:SiteCreatedBy,
    SiteCreatedOn=:SiteCreatedOn
    ";

    $stmt = $this->conn->prepare($query);
    $this->SiteName=htmlspecialchars(strip_tags($this->SiteName));
    $this->SiteSection=htmlspecialchars(strip_tags($this->SiteSection));
    $this->SiteDepth=htmlspecialchars(strip_tags($this->SiteDepth));
    $this->SiteTotalArea=htmlspecialchars(strip_tags($this->SiteTotalArea));
    $this->SiteCurrentAvailableArea=htmlspecialchars(strip_tags($this->SiteCurrentAvailableArea));
    $this->SoldArea=htmlspecialchars(strip_tags($this->SoldArea));
    $this->SitePricePerSquareFeet=htmlspecialchars(strip_tags($this->SitePricePerSquareFeet));
    $this->SiteStatus=htmlspecialchars(strip_tags($this->SiteStatus));
    $this->SiteCreatedBy=htmlspecialchars(strip_tags($this->SiteCreatedBy));
    $this->SiteCreatedOn=htmlspecialchars(strip_tags($this->SiteCreatedOn));


    $stmt->bindParam(":SiteName",$this->SiteName);
    $stmt->bindParam(":SiteSection",$this->SiteSection);
    $stmt->bindParam(":SiteDepth",$this->SiteDepth);
    $stmt->bindParam(":SiteTotalArea",$this->SiteTotalArea);
    $stmt->bindParam(":SiteCurrentAvailableArea",$this->SiteCurrentAvailableArea);
    $stmt->bindParam(":SoldArea",$this->SoldArea);
    $stmt->bindParam(":SitePricePerSquareFeet",$this->SitePricePerSquareFeet);
    $stmt->bindParam(":SiteStatus",$this->SiteStatus);
    $stmt->bindParam(":SiteCreatedBy",$this->SiteCreatedBy);
    $stmt->bindParam(":SiteCreatedOn",$this->SiteCreatedOn);

    if($stmt->execute()){
    return true;
    }
    return false;

   }


   public function Site_NameRead(){

      $query= "SELECT distinct(SiteName) as SiteName FROM ". $this->site_sectiondetails;       

      $stmt=$this->conn->prepare($query);
      $stmt->execute();
      return $stmt;

   }


   // Read Site Section
      function Site_SectionRead(){

	   $query = "SELECT SiteId, SiteSection, SitepricePerSquareFeet, SiteDepth, SoldArea, SiteCurrentAvailableArea, SiteTotalArea 
      FROM " . $this->site_sectiondetails . " where 
      SiteName=:SiteName order by SiteSection asc";

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":SiteName", $this->SiteName);
      $stmt->execute();
      return $stmt;
      
     }

     function Read_Site_SectionDepth(){
	  $query = "SELECT SiteId, SiteSection, SiteDepth, SitepricePerSquareFeet, SiteCurrentAvailableArea, SoldArea, SiteTotalArea FROM $this->site_sectiondetails 
     where 
     SiteName=:SiteName and SiteSection=:SiteSection";
     $stmt = $this->conn->prepare($query);
     $stmt->bindParam(":SiteName", $this->SiteName);
     $stmt->bindParam(":SiteSection", $this->SiteSection);
     $stmt->execute();
     return $stmt;
     
    }

   public function Site_SectionDetailsRead(){

      if($this->SiteName!=""){

         $query="SELECT 
         SiteId, SiteName, SiteSection, SiteTotalArea, SiteDepth, SoldArea, SitePricePerSquareFeet ,SiteStatus,
         SiteCurrentAvailableArea, SiteCreatedBy, SiteCreatedOn 
         FROM ". $this->site_sectiondetails . "
         WHERE
         SiteName=:SiteName";
         
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(":SiteName",$this->SiteName);

      }else{
         
         $query="SELECT 
         SiteId, SiteName, SiteSection, SiteTotalArea, SiteDepth, SitePricePerSquareFeet, SiteStatus,
         SiteCurrentAvailableArea, SoldArea, SiteCreatedBy,SiteCreatedOn 
         FROM ". $this->site_sectiondetails;
         
         $stmt=$this->conn->prepare($query);
      }      

      $stmt->execute();
      return $stmt;
   }

// ******************query for update job details***********************************8
function Site_SectionDetailsUpdate(){
   // update query
  $query = "UPDATE
               " . $this->site_sectiondetails ."
           SET
           SiteCurrentAvailableArea=:SiteCurrentAvailableArea, 
           SoldArea=:SoldArea, 
           SiteUpdatedOn=:SiteUpdatedOn,
           SiteUpdatedBy=:SiteUpdatedBy  WHERE SiteId=:SiteId";
 
   // prepare query statement
   $stmt = $this->conn->prepare($query);
 
   // sanitize html data for remove uncessory space
   $this->SiteCurrentAvailableArea=htmlspecialchars(strip_tags($this->SiteCurrentAvailableArea));
   $this->SoldArea=htmlspecialchars(strip_tags($this->SoldArea));
   $this->SiteUpdatedOn=htmlspecialchars(strip_tags($this->SiteUpdatedOn));
   $this->SiteUpdatedBy=htmlspecialchars(strip_tags($this->SiteUpdatedBy));


   //bind values to connect variable
   $stmt->bindParam(":SiteId", $this->SiteId);
   $stmt->bindParam(":SiteCurrentAvailableArea", $this->SiteCurrentAvailableArea);
   $stmt->bindParam(":SoldArea", $this->SoldArea);
   $stmt->bindParam(":SiteUpdatedOn", $this->SiteUpdatedOn);
   $stmt->bindParam(":SiteUpdatedBy", $this->SiteUpdatedBy);
 
   // execute the query
   if($stmt->execute()){
       return true;
   }
 
   return false;
}



}

?>