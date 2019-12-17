<?php

//die("HI");
class Visit{

 
    // database connection and table name

    private $conn;

    private $table_name = "visit_master";

    // object sproperties                $customer->customerId = $_POST['customerId'];

    

    
    public $customer_id;
    
    public $emp_id_created;
    
    public $visit_date;
    
    public $product_name;
    
    public $application;
    
    public $description;
    
    public $status;
    
    public $status_date;
    
    public $last_updated_by;
    
    public $image_name;
    
    public $region;
    
    
   



    public function __construct($db){

        $this->conn = $db;
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    }



    // create product

    function create(){

 

        //write query

        $query = "INSERT INTO

                    " . $this->table_name . "

                SET

                    cust_id=:cust_id, emp_id_created=:emp_id_created, date_time=:date_time, prod_name=:prod_name, application=:application, description=:description, status=:status, status_date=:status_date, last_updated_by=:last_updated_by, image_name=:image_name, region=:region";





        $stmt = $this->conn->prepare($query);

 

        // posted values

  



        $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
        
        $this->emp_id_created=htmlspecialchars(strip_tags($this->emp_id_created));

        $this->visit_date=htmlspecialchars(strip_tags($this->visit_date));

        $this->product_name=htmlspecialchars(strip_tags($this->product_name ));

        $this->application=htmlspecialchars(strip_tags($this->application));        

        $this->description=htmlspecialchars(strip_tags($this->description));
        
        $this->status=htmlspecialchars(strip_tags($this->status));
        
        $this->status_date=htmlspecialchars(strip_tags($this->status_date));
        
        $this->last_updated_by=htmlspecialchars(strip_tags($this->last_updated_by));
        
        $this->image_name=htmlspecialchars(strip_tags($this->image_name));
        
        $this->region=htmlspecialchars(strip_tags($this->region));
        
        





        // bind values 

        $stmt->bindParam(":cust_id", $this->customer_id);
        
        $stmt->bindParam(":emp_id_created", $this->emp_id_created);

        $stmt->bindParam(":date_time", $this->visit_date);

        $stmt->bindParam(":prod_name", $this->product_name);

        $stmt->bindParam(":application", $this->application);

        $stmt->bindParam(":description", $this->description);
        
        $stmt->bindParam(":status", $this->status);
        
        $stmt->bindParam(":status_date", $this->status_date);
        
        $stmt->bindParam(":last_updated_by", $this->last_updated_by);
        
        $stmt->bindParam(":image_name", $this->image_name);
        
        $stmt->bindParam(":region", $this->region);




        if($stmt->execute()){

            return true;

        }else{

            return false;

        }

 

    }

    public function EmpId(){



 

    $query = "SELECT MAX( emp_id ) AS max FROM employee;";

   

 

    $stmt = $this->conn->prepare( $query );

    $stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

        $largestNumber =  $row['max'];

            $empId =  $largestNumber+1;

            

 

    return $empId;

}

// public function stateCode(){
//
// 
//
//    $query = "select * from state_information where state_name = state_name;";
//
// 
//
//    $stmt = $this->conn->prepare( $query );
//
//    $stmt->execute();
//
// 
//
//    $num = $stmt->rowCount();
//
// 
//
//    return $num;
//
//}























// read products by search term

public function search($search_term, $from_record_num, $records_per_page){

 

    // select query

    



   $query = "SELECT

          customer.customer_id, customer.customer_name,  customer.cust_contact_no, customer.cust_address_bill, customer.cust_email, customer.cust_contact_person,  customer.cust_contact_person_cont,  customer.cust_gst_no, customer.cust_gst_no, customer.cust_pan_no, customer.cust_address_ship, customer.state_name, customer.state_code ,customer.guest_name   

            FROM

                 " . $this->table_name . "

                 WHERE

     customer.customer_name LIKE ? OR customer.cust_contact_no LIKE ? OR customer.last_stay LIKE ? OR customer.guest_name LIKE ?

                       ORDER BY                                                             customer.customer_name ASC

                       limit ?, ?";

 

    // prepare query statement

    $stmt = $this->conn->prepare( $query );

 

    // bind variable values

    $search_term = "%{$search_term}%";

    $stmt->bindParam(1, $search_term);

    $stmt->bindParam(2, $search_term);

    $stmt->bindParam(3, $search_term);

    $stmt->bindParam(4, $search_term);

    $stmt->bindParam(5, $from_record_num, PDO::PARAM_INT);

    $stmt->bindParam(6, $records_per_page, PDO::PARAM_INT);

 

    // execute query

    $stmt->execute();

 

    // return values from database

    return $stmt;

}



 public function countAll_BySearch($search_term){

 

    // select query

    $query = "SELECT

                COUNT(*) as total_rows

            FROM

                " . $this->table_name . " 

                

            WHERE

               customer_name LIKE ? OR customer.cust_contact_no LIKE ? OR customer.last_stay LIKE ? OR customer.guest_name LIKE ?";

 

    // prepare query statement

    $stmt = $this->conn->prepare( $query );

 

    // bind variable values

    $search_term = "%{$search_term}%";

    $stmt->bindParam(1, $search_term);

    $stmt->bindParam(2, $search_term);

    $stmt->bindParam(3, $search_term);

    $stmt->bindParam(4, $search_term);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

 

    return $row['total_rows'];

}



public function countAll(){

 

    $query = "SELECT cust_id FROM " . $this->table_name . "";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->execute();

 

    $num = $stmt->rowCount();

 

    return $num;

}



    function readAll(){

 

    $query = "SELECT

               `visit_id`, `cust_id`, `emp_id_created`, `date_time`, `prod_name`, `application`, `description`, `status`, `status_date`, `last_updated_by`, `image_name`

            FROM

                " . $this->table_name . "

            ORDER BY

                cust_id ASC

            ";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->execute();

 

    return $stmt;

}

function readName(){

     

    $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(1, $this->id);

    $stmt->execute();

 

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

     

    $this->name = $row['name'];

}

function readOne(){

 

    $query = "SELECT

                emp_id, emp_name, emp_roll, contact_person_name, contact_person_mail_id, location, region


            FROM

                " . $this->table_name . "

            WHERE

                sr_no = ?

            LIMIT

                0,1";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(1, $this->empId);

    $stmt->execute();

 

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

 



        $this->empId = $row['emp_id'];

        $this->empName = $row['emp_name'];

        $this->empRoll = $row['emp_roll'];       

        $this->contactPersonName = $row['contact_person_name'];
        
        $this->contactPersonMailId = $row['contact_person_mail_id'];
        
        $this->location = $row['location'];
        
        $this->region = $row['region'];
       
        

        


}

function update(){

 

    $query = "UPDATE

                " . $this->table_name . "

            SET
                    
                 emp_id=:emp_id, emp_name=:emp_name, emp_roll=:emp_roll, contact_person_name=:contact_person_name, contact_person_mail_id=:contact_person_mail_id, location=:location, region=:region

            WHERE

                emp_id = :emp_id";

 //probles is in this file

    $stmt = $this->conn->prepare($query);

 

    // posted values

    
        $this->empId=htmlspecialchars(strip_tags($this->empId));

        $this->empName=htmlspecialchars(strip_tags($this->empName));

        $this->empRoll=htmlspecialchars(strip_tags($this->empRoll));

        $this->contactPersonName=htmlspecialchars(strip_tags($this->contactPersonName));        

        $this->contactPersonMailId=htmlspecialchars(strip_tags($this->contactPersonMailId));
        
        $this->location=htmlspecialchars(strip_tags($this->location));
        
        $this->region=htmlspecialchars(strip_tags($this->region));




        // bind values 

        $stmt->bindParam(":emp_id", $this->empId);

        $stmt->bindParam(":emp_name", $this->empName);

        $stmt->bindParam(":emp_roll", $this->empRoll);

        $stmt->bindParam(":contact_person_name", $this->contactPersonName);

        $stmt->bindParam(":contact_person_mail_id", $this->contactPersonMailId);
        
        $stmt->bindParam(":location", $this->location);
        
        $stmt->bindParam(":region", $this->region);
        
        
        
    // execute the query

    if($stmt->execute()){

        return true;

    }

 

    return false;

     

}

// delete the product

function delete(){

 

    $query = "DELETE FROM " . $this->table_name . " WHERE customer_id = ?";

     

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->customerId);

 

    if($result = $stmt->execute()){

        return true;

    }else{

        return false;

    }

}



 }



 ?>