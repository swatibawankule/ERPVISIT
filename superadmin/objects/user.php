<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "employee_master";
 
    // object properties
    public $emp_id;
    public $mail_id;
    public $password;

    // constructor
    public function __construct($db){
        $this->conn = $db;
        //$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // check if given email exist in the database
function emailExists(){
 
    // query to check if email exists
    $query = "SELECT emp_id , mail_id , password
            FROM " . $this->table_name . "
            WHERE mail_id = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->mail_id=htmlspecialchars(strip_tags($this->mail_id));
 
    // bind given email value
    $stmt->bindParam(1, $this->mail_id);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties 
        $this->emp_id = $row['emp_id'];

        $this->mail_id = $row['mail_id'];
      
        $this->password = $row['password'];
         
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

//  // create new user record
// function create(){
 
//     // to get time stamp for 'created' field
//     $this->created=date('Y-m-d H:i:s');
 
//     // insert query
//     $query = "INSERT INTO " . $this->table_name . "
//             SET
//         firstname = :firstname,
//         lastname = :lastname,
//         email = :email,
//         contact_number = :contact_number,
//         address = :address,
//         password = :password,
//         access_level = :access_level,
//                 access_token = :access_token,
//         status = :status,
//         created = :created";
 
//     // prepare the query
//     $stmt = $this->conn->prepare($query);
 
//     // sanitize
//     $this->firstname=htmlspecialchars(strip_tags($this->firstname));
//     $this->lastname=htmlspecialchars(strip_tags($this->lastname));
//     $this->email=htmlspecialchars(strip_tags($this->email));
//     $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
//     $this->address=htmlspecialchars(strip_tags($this->address));
//     $this->password=htmlspecialchars(strip_tags($this->password));
//     $this->access_level=htmlspecialchars(strip_tags($this->access_level));
//     $this->access_token=htmlspecialchars(strip_tags($this->access_token));
//     $this->status=htmlspecialchars(strip_tags($this->status));
 
//     // bind the values
//     $stmt->bindParam(':firstname', $this->firstname);
//     $stmt->bindParam(':lastname', $this->lastname);
//     $stmt->bindParam(':email', $this->email);
//     $stmt->bindParam(':contact_number', $this->contact_number);
//     $stmt->bindParam(':address', $this->address);
 
//     // hash the password before saving to database
//     $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
//     $stmt->bindParam(':password', $password_hash);
 
//     $stmt->bindParam(':access_level', $this->access_level);
//     $stmt->bindParam(':access_token', $this->access_token);
//     $stmt->bindParam(':status', $this->status);
//     $stmt->bindParam(':created', $this->created);
 
//     // execute the query, also check if query was successful
//     if($stmt->execute()){
//         return true;
//     }else{
//         $this->showError($stmt);
//         return false;
//     }
 
// }
 
// // used in email verification feature
// function updateStatusByAccessCode(){
 
//     // update query
//     $query = "UPDATE " . $this->table_name . "
//             SET status = :status
//             WHERE access_token = :access_token";
 
//     // prepare the query
//     $stmt = $this->conn->prepare($query);
 
//     // sanitize
//     $this->status=htmlspecialchars(strip_tags($this->status));
//     $this->access_token=htmlspecialchars(strip_tags($this->access_token));
 
//     // bind the values from the form
//     $stmt->bindParam(':status', $this->status);
//     $stmt->bindParam(':access_token', $this->access_token);
 
//     // execute the query
//     if($stmt->execute()){
//         return true;
//     }
 
//     return false;
// }
// public function showError($stmt){
//     echo "<pre>";
//         print_r($stmt->errorInfo());
//     echo "</pre>";
// }
// // check if given access_token exist in the database
 function accessCodeExists(){
 
    // query to check if access_token exists
    $query = "SELECT mail_id
            FROM " . $this->table_name . "
             WHERE access_token = ?
            LIMIT 0,1";
 
     // prepare the query
     $stmt = $this->conn->prepare( $query );
 
     // sanitize
    $this->access_token=htmlspecialchars(strip_tags($this->access_token));
 
     // bind given access_token value
    $stmt->bindParam(1, $this->access_token);
 
     // execute the query
     $stmt->execute();
 
     // get number of rows
    $num = $stmt->rowCount();
 
    // if access_token exists
    if($num>0){
 
        // return true because access_token exists in the database
        return true;
     }
 
    // return false if access_token does not exist in the database
 return false;
 
 }
// used in forgot password feature
function updatePassword(){
 
    // update query
    $query = "UPDATE " . $this->table_name . "
            SET password = :password
            WHERE access_token = :access_token";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->access_token=htmlspecialchars(strip_tags($this->access_token));
 
    // bind the values from the form
    $password_hash = md5($this->password);
    $stmt->bindParam(':password', $password_hash);
    $stmt->bindParam(':access_token', $this->access_token);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
// used in forgot password feature
function updateAccessCode(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                access_token = :access_token
            WHERE
                mail_id = :mail_id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->access_token=htmlspecialchars(strip_tags($this->access_token));
    $this->mail_id=htmlspecialchars(strip_tags($this->mail_id));
 
    // bind the values from the form
    $stmt->bindParam(':access_token', $this->access_token);
    $stmt->bindParam(':mail_id', $this->mail_id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
}