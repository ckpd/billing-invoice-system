<?php
include('db.php');

class DB_Connect{
    protected $conn;
    
    public function __construct(){
         $this->connect();
    }
    
    public function connect(){
        $conn = new mysqli(SERVER, USER, PASS, DB);
        if($conn->connect_error){
            die("cannot connect").$conn->connect_error();
        }
        return $this->conn = $conn;
    }
}
class DB_Query extends DB_Connect{
    
    public function login($username, $password){
        $sql = "SELECT * FROM admin WHERE username='$username' and password='$password'";
        $result = $this->conn->query($sql);
        if($result -> num_rows == 0){
	       return false;
        }else{
            return true;
        }
    }
    
        public function readFromDatabase($last_id){
            $arr = array();
            $sql = "SELECT * 
                    FROM jobs 
                    JOIN customer ON jobs.customerid 
                    JOIN invoice ON jobs.invoiceno
                    WHERE jobs.customerid = {$last_id}";
            $result = $this->conn->query($sql);
                if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                $arr[] = $row;

            }
            }
            return $arr;
    }
    

      function createinvoice($firstname,$lastname,$city,$parish,$vehiclereg,$jobs, $total){
            $stmt = $this->conn->prepare("INSERT INTO customer(firstname,lastname,city,parish,vehiclereg ) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstname, $lastname, $city, $parish, $vehiclereg );  
            $stmt->execute();
            $last_id = mysqli_insert_id($this->conn);
            $stmt->close();
          
            $time = date('Y-m-d  H:i:s');

            $jobState = $this->conn->prepare("INSERT INTO invoice(invoicedate, customerid, totalamount) VALUES (?, ?,?)");
            $jobState->bind_param("sss", $time, $last_id, $total );  
           
            $rc =  $jobState->execute();
                if ( false===$rc ) {
                  die('execute() failed: ' . htmlspecialchars($jobState->error));
                }
                $invoiceno = mysqli_insert_id($this->conn);
          
          
            foreach($jobs as $x){

                $time = date('Y-m-d  H:i:s');
                $jobly = $this->conn->prepare("INSERT INTO jobs(invoiceno,description,quantity,unitprice,customerid) VALUES (?,?,?,?,?)");
                $jobly->bind_param("sssss", $invoiceno, $x['description'], $x['quantity'], $x['price'], $last_id );  
                $rc = $jobly->execute();
                if ( false===$rc ) {
                  die('execute() failed: ' . htmlspecialchars($jobly->error));
                }

            }
          
            return $last_id;

        
      }
}

?>  