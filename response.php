<?  

include('db.php');
include_once('includes/config.php');

$mysqli = new mysqli(SERVER, USER, PASS, DB);

$action = isset($_POST['action']) ? $_POST['action'] : "";
// Create invoice
if ($action == 'create_invoice'){
        $date = date("Y-m-d-s");
    
        $firstname = strtolower($_REQUEST["customerfname"]);
        $email = strtolower($_REQUEST["customeremail"]);
        $customerphone = strtolower($_REQUEST["customerphone"]);
        $lastname = strtolower($_REQUEST["customerlname"]);
        $city = strtolower($_REQUEST["customercity"]);
        $parish = strtolower($_REQUEST["customerparish"]);
        $vehiclereg = strtolower($_REQUEST["vehiclereg"]);
    
        //get invoice data
        $custom_email = strtolower($_REQUEST["customeremail"]);
        $invoice_date = $_REQUEST["customerinvoicedate"];
        $total = $_REQUEST["invoice_total"];
        $status = strtolower($_REQUEST["customerinvoicestatus"]);
        $mileage = $_REQUEST["customermileage"];
        $notes = $_REQUEST["customernotes"];
    
        //insert into customer
        if(empty($_REQUEST["customerid"])){
            $sql = "SELECT * FROM customers WHERE firstname = '{$firstname}' AND lastname = '{$lastname}' AND city = '{$city}' AND customeremail = '{$email}'";
            $queryResult = $mysqli->query($sql);    
       
            if ($queryResult->num_rows > 0) {
                $sql = "UPDATE customers SET lastVisited='{$date}'  WHERE firstname = '{$firstname}' AND lastname = '{$lastname}' AND city = '{$city}' AND customeremail = '{$email}'";
        
            }else{
                $sql = "INSERT INTO customers(firstname,lastname,customeremail,customerphone,city,parish,vehiclereg,lastVisited) VALUES('".$firstname."','".$lastname."','".$email."','".$customerphone."','".$city."','".$parish."','".$vehiclereg."','".$date."');";
                 $mysqli->query($sql);
//               if ($mysqli->query($sql) === TRUE) {
//                    echo "New record created successfully";
//                } else {
//                    echo "Error: " . $sql . "<br>" . $mysqli->error;
//                }
            }
        }else{
          
            $sql = "UPDATE customers SET lastVisited = $date WHERE customerid= {$_REQUEST["customerid"]}";

        }
    
            $query = $sql;

            $selectQuery = "SELECT customerid FROM customers WHERE firstname = '{$firstname}' AND lastname = '{$lastname}' AND city = '{$city}' AND customeremail = '{$email}'";
            $queryResult = $mysqli->query($selectQuery);
            if ($queryResult->num_rows >= 1) {
                while($row = $queryResult->fetch_assoc()) {
                    $sql = "INSERT INTO invoices(customerid,invoice_date,mileage,notes,total,status,file) VALUES('".$row['customerid']."','".$invoice_date."','".$mileage."','".$notes."','".$total."','".$status."','".$lastname."-".$firstname."-".$date."');";
                $mysqli->query($sql);
                }
            }
    
        //invoice item lines
        foreach($_POST['invoice_product'] as $key => $value) {                
            $item_product = $value;
            $item_qty = $_REQUEST['invoice_product_qty'][$key];
            $item_price = $_REQUEST['invoice_product_price'][$key];
            $item_subtotal = $_REQUEST['invoice_product_sub'][$key];
	   
            // insert invoice items into database
            $query .= "INSERT INTO invoice_items (product,qty,price,subtotal) VALUES('".$item_product."','".$item_qty."','".$item_price."','".$item_subtotal."');";
            
            
        }
        

        if($mysqli->multi_query($query)){
                    echo "success";       
        }else{
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    
    
            date_default_timezone_set(TIMEZONE);
            require_once('includes/autoload.php');

            $pdf = new FPDF('P','mm','A4');
            $pdf->AddPage();

            $pdf->SetFont('Times','B',14);
            $pdf->Cell(20,5,'From:',0,0);
            $pdf->Cell(110,5,'Elwin Cooper',0,0);
            $pdf->Cell(59,5,"Invoice # ",0,1);


            $pdf->SetFont('Times','',12);
            $pdf->Cell(130,5,'',0,0);
            $pdf->Cell(59,5,'Lower La Borie',0,1);

            $pdf->Cell(130,5,'',0,0);
            $pdf->Cell(59,5,'St. George\'s',0,1);

            $pdf->Cell(130,5,'',0,0);
            $pdf->Cell(59,5,'Grenada',0,1);

            $pdf->Cell(130,5,'',0,0);
            $pdf->Cell(59,5,'',0,1);

            $pdf->SetFont('Times','B',12);
            $pdf->Cell(40,5,'Bill To',0,0);

            $pdf->SetFont('Times','',12);
            $pdf->Cell(90,5,"",0,0);
            $pdf->Cell(20,5,'Tel:',0,0);
            $pdf->Cell(20,5,'440-9276',0,1);

            $pdf->Cell(40,5,"$firstname $lastname",0,0);
            $pdf->Cell(90,5,"",0,0);
            $pdf->Cell(20,5,'Mobile:',0,0);
            $pdf->Cell(20,5,'409-5517/534-5517',0,1);

            $pdf->Cell(40,5,"$city",0,0);
            $pdf->Cell(90,5,"",0,0);
            $pdf->Cell(20,5,'Date',0,0);
            $pdf->Cell(20,5,"$invoice_date",0,1);

            $pdf->Cell(40,5,"$parish",0,0);
            $pdf->Cell(90,5,"",0,0);
            $pdf->Cell(20,5,'',0,0);
            $pdf->Cell(20,5,'',0,1);

            $pdf->Cell(189,10,'',0,1);

            $pdf->SetFont('Times','B',12);
            $pdf->Cell(40,5,"Vehicle Registration $vehiclereg ",0,0);
            $pdf->Cell(90,5,"",0,0);
            $pdf->Cell(40,5,"Mileage $mileage ",0,1);



            //invoice contents
            $pdf->SetFont('Times','B',13);
            $pdf->Cell(189,5,'',0,1);
            $pdf->Cell(94,5,'Description',1,0);
            $pdf->Cell(40,5,'  Quantity',1,0);
            $pdf->Cell(20,5,'  Price',1,0);
            $pdf->Cell(34,5,'Amount',1,1);

            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(188,5,"$notes",1,1);
            $pdf->Cell(94,5,'',1,0);
            $pdf->Cell(40,5,'',1,0);
            $pdf->Cell(20,5,'',1,0);
            $pdf->Cell(34,5,"",1,1);  
    
                $pdf->Cell(94,5,'',1,0);
            $pdf->Cell(40,5,'',1,0);
            $pdf->Cell(20,5,'',1,0);
            $pdf->Cell(34,5,"",1,1);


            $pdf->SetFont('Times','',12);

                            
                        foreach($_POST['invoice_product'] as $key => $value) {
                        $item_product = $value;
                        $item_qty = $_POST['invoice_product_qty'][$key];
                        $item_price = $_POST['invoice_product_price'][$key];
                        $item_subtotal = $_POST['invoice_product_sub'][$key];


                        $pdf->Cell(94,5,"$item_product",1,0);
                        $pdf->Cell(40,5,"$item_qty",1,0);
                        $pdf->Cell(20,5,"$item_price",1,0);
                        $pdf->Cell(34,5,"$item_subtotal",1,1);

                }


            $pdf->Cell(94,5,'',1,0);
            $pdf->Cell(40,5,'',1,0);
            $pdf->Cell(20,5,'',1,0);
            $pdf->Cell(34,5,"",1,1);


            $pdf->Cell(94,5,'',1,0);
            $pdf->Cell(40,5,'',1,0);
            $pdf->Cell(20,5,'',1,0);
            $pdf->Cell(34,5,"",1,1);


            $pdf->SetFont('Times','B',14);
            $pdf->Cell(94,5,'',1,0);
            $pdf->Cell(40,5,'',1,0);
            $pdf->Cell(20,5,'Total',1,0);
            $pdf->Cell(34,5,"$total",1,1);


//            $pdf->Output();
//            $pdf->Output("invoices/$lastname-$firstname-$date.pdf",'F');


	} else{
    echo "Some error occurred";
}
    

?>