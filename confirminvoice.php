<?php


    session_start();
    include('config.php');
    $obj = new DB_Query();

    $row = array();
    $row = $obj->readFromDatabase($_SESSION['$lastID']);
    echo "<pre>";
    print_r($row);
    $_SESSION["jobs"] = $row;
    foreach($row as $x){
        $_SESSION['invoiceno'] = $x['invoiceno'];
        $_SESSION['description'] = $x['description'];
        $_SESSION['quantity'] = $x['quantity'];
        $_SESSION['unitprice'] = $x['unitprice'];
        $_SESSION['customerid'] = $x['customerid']; $_SESSION['firstname'] = $x['firstname']; $_SESSION['lastname'] = $x['lastname']; $_SESSION['city'] = $x['city'];
        $_SESSION['parish'] = $x['parish'];
        $_SESSION['vehiclereg'] = $x['vehiclereg'];
        $_SESSION['totalamount'] = $x['totalamount'];
       
    }   

    
?>

<form action="invoicepdf.php" method="post">
    <input type="submit" name="go" value="create invoice">
</form>