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
    
    function ProductsList() {
	// Connect to the database
	$mysqli = new mysqli(SERVER, USER, PASS, DB);
	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	// the query
	$query = "SELECT * FROM products ORDER BY productname ASC";
	// mysqli select query
	$results = $mysqli->query($query);
	if($results) {
		echo '<select class="form-control item-select">';
		while($row = $results->fetch_assoc()) {
		    print '<option value="'.$row['unitprice'].'">'.$row["productname"].' - '.$row["productdesc"].' - '.$row["unitprice"].'</option>';
		}
		echo '</select>';
	} else {
		echo "<p>There are no products, please add a product.</p>";
	}

	// close connection 
	$mysqli->close();
}
    
    function popCustomersList() {
	// Connect to the database
	$mysqli = new mysqli(SERVER, USER, PASS, DB);
	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	// the query
	$query = "SELECT * FROM customer ORDER BY firstname ASC";
	// mysqli select query
	$results = $mysqli->query($query);
	if($results) {
		print '<table class="table table-striped table-bordered" id="data-table"><thead><tr>
				<th><h4>First name</h4></th>
				<th><h4>LastName name</h4></th>
				<th><h4>phone</h4></th>
				<th><h4>Vehicle Registration</h4></th>
				<th><h4>Action</h4></th>
			  </tr></thead><tbody>';
		while($row = $results->fetch_assoc()) {
		    print '<tr>
					<td>'.$row["firstname"].'</td>
					<td>'.$row["lastname"].'</td>
					<td>'.$row["customerphone"].'</td>
				    <td>'.$row["vehiclereg"].'</td>
                    <td><a href="#" class="btn btn-primary btn-xs customer-select" setfirstname="'.$row['firstname'].'" setlastname="'.$row['lastname'].'" setphone="'.$row['customerphone'].'" setcity="'.$row['city'].'" setparish="'.$row['parish'].'" setemail="'.$row['customeremail'].'" setvehiclereg="'.$row['vehiclereg'].'">Select</a></td>
            </tr>';
		}
		print '</tr></tbody></table>';
	} else {
		echo "<p>There are no customers to display.</p>";
	}

	$mysqli->close();
}
}

?>  