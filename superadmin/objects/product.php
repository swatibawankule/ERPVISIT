<?php

//die("HI");
class Product{

 
    // database connection and table name

    private $conn;

    private $table_name = "product_master";

 

    // object sproperties                $customer->customerId = $_POST['customerId'];

    

    public $productId;

    public $productName;
    
    public $productGroup;

    public $location;

   
    
   



    public function __construct($db){

        $this->conn = $db;

    }



    // create product

    function create(){

 

        //write query

        $query = "INSERT INTO

                    " . $this->table_name . "

                SET

                    product_id=:product_id, product_name=:product_name, product_group=:product_group, location=:location";





        $stmt = $this->conn->prepare($query);

 

        // posted values

  



        $this->productId=htmlspecialchars(strip_tags($this->productId));

        $this->productName=htmlspecialchars(strip_tags($this->productName));

        $this->productGroup=htmlspecialchars(strip_tags($this->productGroup));

        $this->location=htmlspecialchars(strip_tags($this->location));        

        
        


        // bind values 

        $stmt->bindParam(":product_id", $this->productId);

        $stmt->bindParam(":product_name", $this->productName);

        $stmt->bindParam(":product_group", $this->productGroup);

        $stmt->bindParam(":location", $this->location);

        
        




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

              product_id, product_name, product_group, location

            FROM

                " . $this->table_name . "

            ORDER BY

                product_id ASC

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

                product_id, product_name, product_group, location


            FROM

                " . $this->table_name . "

            WHERE

                product_id = ?

            LIMIT

                0,1";

 

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(1, $this->productId);

    $stmt->execute();

 

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

 



        $this->productId = $row['product_id'];

        $this->productName = $row['product_name'];

        $this->productGroup = $row['product_group'];       

        $this->location = $row['location'];
        
        
       
        

        


}

function update(){

 

    $query = "UPDATE

                " . $this->table_name . "

            SET
                    
                  product_id=:product_id, product_name=:product_name, product_group=:product_group, location=:location

            WHERE

                product_id = :product_id";

 //probles is in this file

    $stmt = $this->conn->prepare($query);

 

    // posted values

        $this->productId=htmlspecialchars(strip_tags($this->productId));

        $this->productName=htmlspecialchars(strip_tags($this->productName));

        $this->productGroup=htmlspecialchars(strip_tags($this->productGroup));

        $this->location=htmlspecialchars(strip_tags($this->location));        

        
        


        // bind values 

        $stmt->bindParam(":product_id", $this->productId);

        $stmt->bindParam(":product_name", $this->productName);

        $stmt->bindParam(":product_group", $this->productGroup);

        $stmt->bindParam(":location", $this->location);
        




        
        
        
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