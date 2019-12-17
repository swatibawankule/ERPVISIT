<?php
//include_once "ChromePhp.php";
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
	private $host = 'localhost';
	private $db_name = 'dwleaalz_new_erp_system';
	    private $username = 'dwleaalz_rahul';
	    private $password = 'Learnwell@123'; 
	   public $conn;
		
    //private $host = 'localhost';
   // private $db_name = 'new_erp_system';
    //private $username = 'root';
   // private $password = ''; 
   // public $conn;
 
    // get the database connection
    public function getConnection(){
  //ChromePhp::log('hello world');
        $this->conn = null;
        try{
//              ChromePhp::log('hello world');
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
//              ChromePhp::log('hello world');
            echo 'Connection error: ' . $exception->getMessage();
        }
//  alert('after connection');
        return $this->conn;
    }
}
?>