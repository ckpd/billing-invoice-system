<?  

include('db.php');

$mysqli = new mysqli(SERVER, USER, PASS, DB);

$action = isset($_POST['action']) ? $_POST['action'] : "";

// Create invoice
if ($action == 'create_invoice'){
        $firstname = strtolower($_REQUEST["customerfname"]);
        $email = strtolower($_REQUEST["customeremail"]);
        $lastname = strtolower($_REQUEST["customerlname"]);
        $city = strtolower($_REQUEST["customercity"]);
        $parish = strtolower($_REQUEST["customerparish"]);
        $vehiclereg = strtolower($_REQUEST["vehiclereg"]);
    
        $query = "INSERT INTO invoices (
                        custom_email
                    ) VALUES (
                        '".$email."'
                    );
                ";
            // execute the query
            if($mysqli -> multi_query($query)){
                //if saving success
                echo json_encode(array(
                    'status' => 'Success',
                    'message' => 'Invoice has been created successfully!'
                ));
            }
}else{
       
     header("location: createinvoice.php");
}



?>