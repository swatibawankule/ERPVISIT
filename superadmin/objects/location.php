<?php
class Location {
	
 private $conn;

    private $table_name = "customer_locations_details";


    public $srNo;
    public $customerId;
    public $location;
    public $ContactPersonName;
    public $ContactPersonNumber;
    public $ContactPersonEmail;


   
   public function __construct($db){


        $this->conn = $db;
 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    function create(){

        $query = "INSERT INTO

                    " . $this->table_name . "

                SET

                    sr_no=:sr_no, cust_id=:cust_id, location=:location, contact_person_name=:contact_person_name, contact_person_number=:contact_person_number, contact_person_email=:contact_person_email";


        $stmt = $this->conn->prepare($query);

       
        $this->srNo=htmlspecialchars(strip_tags($this->srNo));

        $this->customerId=htmlspecialchars(strip_tags($this->customerId));

        $this->location=htmlspecialchars(strip_tags($this->location));

        $this->ContactPersonName=htmlspecialchars(strip_tags($this->ContactPersonName));

        $this->ContactPersonNumber=htmlspecialchars(strip_tags($this->ContactPersonNumber));

          
        $this->ContactPersonEmail=htmlspecialchars($this->ContactPersonEmail);        









  //die($this->associated_agent);
        // bind values 


        $stmt->bindParam(":sr_no", $this->srNo);

        $stmt->bindParam(":cust_id", $this->customerId);

        $stmt->bindParam(":location", $this->location);

        $stmt->bindParam(":contact_person_name", $this->ContactPersonName);

        $stmt->bindParam(":contact_person_number", $this->ContactPersonNumber);

        $stmt->bindParam(":contact_person_email", $this->ContactPersonEmail);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        }
    }

	 public function LocId(){



 

    $query = "SELECT MAX( sr_no ) AS max FROM customer_locations_details;";

   

 

    $stmt = $this->conn->prepare( $query );

    $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $largestNumber =  $row['max'];

            $LocId =  $largestNumber+1;

            

 

    return $LocId;

}
}


?>





<!-- 

Fatal error: Uncaught PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'sr_no' in 'field list' in C:\xampp\htdocs\erpsystem\objects\location.php:77 Stack trace: #0 C:\xampp\htdocs\erpsystem\objects\location.php(77): PDOStatement->execute() #1 C:\xampp\htdocs\erpsystem\customer_location.php(50): Location->create() #2 {main} thrown in C:\xampp\htdocs\erpsystem\objects\location.php on line 77 -->