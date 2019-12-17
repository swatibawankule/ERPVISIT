<?php

//die("HI");
class Group{

 
    // database connection and table name

    private $conn;

    private $table_name = "group_master";

 

    // object sproperties                $customer->customerId = $_POST['customerId'];

    

    public $groupName;

    public $time;
    
    

   
    
   



    public function __construct($db){

        $this->conn = $db;

    }



    // create product

    function create(){

 

        //write query

        $query = "INSERT INTO

                    " . $this->table_name . "

                SET

                    group_name=:group_name, time_zone=:time_zone";





        $stmt = $this->conn->prepare($query);

 

        // posted values

  



        $this->groupName=htmlspecialchars(strip_tags($this->groupName));

        $this->time=htmlspecialchars(strip_tags($this->time));

             

        
        


        // bind values 

        $stmt->bindParam(":group_name", $this->groupName);

        $stmt->bindParam(":time_zone", $this->time);


        
        


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

 

    $query = "SELECT customer_id FROM " . $this->table_name . "";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->execute();

 

    $num = $stmt->rowCount();

 

    return $num;

}



    function readAll(){

 

    $query = "SELECT

               emp_id, emp_name, emp_roll, contact_person_name, contact_person_mail_id, location, region

            FROM

                " . $this->table_name . "

            ORDER BY

                emp_id ASC

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