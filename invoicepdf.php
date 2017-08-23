<?php

    session_start();
    
    require('fpdf181/fpdf.php');
    $invoiceno = $_SESSION['invoiceno'];
    $firstname = $_SESSION["firstname"];
    $lastname = $_SESSION["lastname"];
    $city = $_SESSION["city"];
    $parish = $_SESSION["parish"];
    $vehiclereg = $_SESSION["vehiclereg"];  
    $jobs = $_SESSION["jobs"];



    $r = rand(1,100);
    $date = date("Y-m-d");



$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Times','B',14);
$pdf->Cell(20,5,'From:',0,0);
$pdf->Cell(110,5,'Elwin Cooper',0,0);
$pdf->Cell(59,5,"Invoice # $invoiceno",0,1);


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
$pdf->Cell(90,5,'',0,0);
$pdf->Cell(20,5,'Tel:',0,0);
$pdf->Cell(20,5,'440-9276',0,1);

$pdf->Cell(40,5,"{$firstname} {$lastname}",0,0);
$pdf->Cell(90,5,'',0,0);
$pdf->Cell(20,5,'Mobile:',0,0);
$pdf->Cell(20,5,'409-5517/534-5517',0,1);

$pdf->Cell(40,5,"{$city}",0,0);
$pdf->Cell(90,5,'',0,0);
$pdf->Cell(20,5,'Date',0,0);
$pdf->Cell(20,5,'20/01/2017',0,1);

$pdf->Cell(40,5,"{$parish}",0,0);
$pdf->Cell(90,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'',0,1);

$pdf->Cell(189,10,'',0,1);

$pdf->SetFont('Times','B',12);
$pdf->Cell(40,5,"Vehicle Registration {$vehiclereg}",0,1);






//invoice contents
$pdf->SetFont('Times','B',13);
$pdf->Cell(189,5,'',0,1);
$pdf->Cell(94,5,'Description',1,0);
$pdf->Cell(40,5,'  Quantity',1,0);
$pdf->Cell(20,5,'  Price',1,0);
$pdf->Cell(34,5,'Amount',1,1);


$pdf->SetFont('Times','',12);

foreach($jobs as $x){
    $p = number_format($x['unitprice'],2);
    $total = $_SESSION["totalamount"];
    $d = $x['description'];
    $q = $x['quantity'];
    
    $pdf->Cell(94,5,"$d",1,0);
    $pdf->Cell(40,5,"$q",1,0);
    $pdf->Cell(20,5,"$p",1,0);
    $pdf->Cell(34,5,"$ $p",1,1);
             
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
$pdf->Cell(34,5,"$ {$total}",1,1);



$pdf->Output();
$pdf->Output("invoices/{$firstname}-{$lastname}-{$date}-in{$invoiceno}.pdf",'F')
?>