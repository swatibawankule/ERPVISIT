<?php

class Customer{

 

    // database connection and table name

    private $conn;

    private $table_name = "customer_master";

  

    

    public $customerId;

    public $customerName;

    public $custContactPerson;

    public $contactNumber;

    public $custEmail;

    public $associated_agent;

    public $business_line;

    public $end_use;

    public $product_group;

    public $product;

    public $Project;

    public $region;

    

 

    public function __construct($db){


        $this->conn = $db;
 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }



    // create product

    function create(){

 

        //write query

        // INSERT INTO `customer_master`(`cust_id`, `cust_name`, `contact_person`, `contact_number`, `customer_email`, `associated_agent`, `business_line`, `end_use`, `prod_group`, `product`, `project`, `region`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])

        $query = "INSERT INTO

                    " . $this->table_name . "

                SET

                    cust_id=:cust_id, cust_name=:cust_name, contact_person=:contact_person, contact_number=:contact_number, customer_email=:customer_email, associated_agent=:associated_agent, business_line=:business_line, end_use=:end_use, prod_group=:prod_group, product=:product, project=:project, region=:region";





        $stmt = $this->conn->prepare($query);

 

        // posted values


        $this->customerId=htmlspecialchars(strip_tags($this->customerId));

        $this->customerName=htmlspecialchars(strip_tags($this->customerName));

        $this->custContactPerson=htmlspecialchars(strip_tags($this->custContactPerson));

        $this->contactNumber=htmlspecialchars(strip_tags($this->contactNumber));

        $this->custEmail=htmlspecialchars(strip_tags($this->custEmail));

       // $this->associated_agent=htmlspecialchars(strip_tags($this->associated_agent));        
        $this->associated_agent=htmlspecialchars($this->associated_agent);        

        $this->business_line=htmlspecialchars(strip_tags($this->business_line));

        $this->end_use=htmlspecialchars(strip_tags($this->end_use));

        $this->product_group=htmlspecialchars(strip_tags($this->product_group));

        $this->product=htmlspecialchars(strip_tags($this->product));

        $this->Project=htmlspecialchars(strip_tags($this->Project));

        $this->region=htmlspecialchars(strip_tags($this->region));




//die($this->associated_agent);
        // bind values 


        $stmt->bindParam(":cust_id", $this->customerId);

        $stmt->bindParam(":cust_name", $this->customerName);

        $stmt->bindParam(":contact_person", $this->custContactPerson);

        $stmt->bindParam(":contact_number", $this->contactNumber);

        $stmt->bindParam(":customer_email", $this->custEmail);

        $stmt->bindParam(":associated_agent", $this->associated_agent);

        $stmt->bindParam(":business_line", $this->business_line);

        $stmt->bindParam(":end_use", $this->end_use);

        $stmt->bindParam(":prod_group", $this->product_group);

        $stmt->bindParam(":product", $this->product);

        $stmt->bindParam(":project", $this->Project);

        $stmt->bindParam(":region", $this->region);





        if($stmt->execute()){

            return true;

        }else{

            return false;

        }

 

    }

        public function CustId(){



 

    $query = "SELECT MAX( cust_id ) AS max FROM customer_master;";

   

 

    $stmt = $this->conn->prepare( $query );

    $stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

        $largestNumber =  $row['max'];

            $custId =  $largestNumber+1;

            

 

    return $custId;

}

function readOne(){

 

    $query = "SELECT

                 cust_id, cust_name, contact_person, contact_number, customer_email, associated_agent, business_line, end_use, prod_group, product, project, region   

            FROM

                " . $this->table_name . "

            WHERE

                cust_id = ?

            LIMIT

                0,1";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(1, $this->customerId);

    $stmt->execute();

 

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

 



        $this->customerId = $row['cust_id'];

        $this->customerName = $row['cust_name'];

        $this->custContactPerson= $row['contact_person'];

        $this->contactNumber= $row['contact_number'];

        $this->custEmail = $row['customer_email'];

        $this->associated_agent = $row['associated_agent'];       

        $this->business_line = $row['business_line'];

        $this->end_use = $row['end_use'];

        $this->product_group = $row['prod_group'];

        $this->product = $row['product'];

        $this->Project = $row['project'];

        $this->region = $row['region'];



}


function update(){

 

    $query = "UPDATE

                " . $this->table_name . "

            SET
              cust_name=:cust_name, contact_person=:contact_person, contact_number=:contact_number, customer_email=:customer_email, associated_agent=:associated_agent, business_line=:business_line, end_use=:end_use, prod_group=:prod_group, product=:product, project=:project, region=:region

            WHERE

                cust_id = :cust_id";

 

    $stmt = $this->conn->prepare($query);

 

    // posted values

          $this->customerId=htmlspecialchars(strip_tags($this->customerId));

        $this->customerName=htmlspecialchars(strip_tags($this->customerName));

        $this->custContactPerson=htmlspecialchars(strip_tags($this->custContactPerson));

        $this->contactNumber=htmlspecialchars(strip_tags($this->contactNumber));

        $this->custEmail=htmlspecialchars(strip_tags($this->custEmail));

       $this->associated_agent=htmlspecialchars($this->associated_agent);        
        

        $this->business_line=htmlspecialchars(strip_tags($this->business_line));

        $this->end_use=htmlspecialchars(strip_tags($this->end_use));

        $this->product_group=htmlspecialchars(strip_tags($this->product_group));

        $this->product=htmlspecialchars(strip_tags($this->product));

        $this->Project=htmlspecialchars(strip_tags($this->Project));

        $this->region=htmlspecialchars(strip_tags($this->region));




        // bind values 


        $stmt->bindParam(":cust_id", $this->customerId);

        $stmt->bindParam(":cust_name", $this->customerName);

        $stmt->bindParam(":contact_person", $this->custContactPerson);

        $stmt->bindParam(":contact_number", $this->contactNumber);

        $stmt->bindParam(":customer_email", $this->custEmail);

        $stmt->bindParam(":associated_agent", $this->associated_agent);

        $stmt->bindParam(":business_line", $this->business_line);

        $stmt->bindParam(":end_use", $this->end_use);

        $stmt->bindParam(":prod_group", $this->product_group);

        $stmt->bindParam(":product", $this->product);

        $stmt->bindParam(":project", $this->Project);

        $stmt->bindParam(":region", $this->region);

    // execute the query

    if($stmt->execute()){

        return true;

    }

 else {

    return false;

     }

}







}


?>