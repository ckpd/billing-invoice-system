<?php
/*******************************************************************************
* Md Invoice 
* Billing Management System                                             *
*                                                                              *
* Version: 1.0	                                                               *
* Author:  Abhishek Raj                                    				   *
*******************************************************************************/

// Debugging
ini_set('error_reporting', E_ALL);


// COMPANY INFORMATION
define('COMPANY_LOGO', 'images/sample.jpg');
define('COMPANY_LOGO_WIDTH', '300');
define('COMPANY_LOGO_HEIGHT', '90');
define('COMPANY_NAME','Md Invoice Lmt.');
define('COMPANY_ADDRESS_1','123 Something Street');
define('COMPANY_ADDRESS_2','Sitapura, Tonk Road');
define('COMPANY_ADDRESS_3','Jaipur');
define('COMPANY_COUNTY','India');
define('COMPANY_POSTCODE','302022');

define('COMPANY_NUMBER','Company No: 655454545'); // Company registration number
define('COMPANY_VAT', 'Company VAT: 645515154'); // Company TAX/VAT number

// EMAIL DETAILS
define('EMAIL_FROM', 'sales@abhishekraj.info'); // Email address invoice emails will be sent from
define('EMAIL_NAME', 'Md Invoice Lmt'); // Email from address
define('EMAIL_SUBJECT', 'Invoice default email subject'); // Invoice email subject
define('EMAIL_BODY_INVOICE', 'Invoice default body'); // Invoice email body
define('EMAIL_BODY_QUOTE', 'Quote default body'); // Invoice email body
define('EMAIL_BODY_RECEIPT', 'Receipt default body'); // Invoice email body

// OTHER SETTINFS
define('INVOICE_PREFIX', 'MD'); // Prefix at start of invoice - leave empty '' for no prefix
define('INVOICE_INITIAL_VALUE', '1'); // Initial invoice order number (start of increment)
define('INVOICE_THEME', '#222222'); // Theme colour, this sets a colour theme for the PDF generate invoice
define('TIMEZONE', 'Asia/Kolkata'); // Timezone - See for list of Timezone's http://php.net/manual/en/function.date-default-timezone-set.php
define('DATE_FORMAT', 'DD/MM/YYYY'); // DD/MM/YYYY or MM/DD/YYYY
define('CURRENCY', 'Rs.'); // Currency symbol
define('ENABLE_VAT', true); // Enable TAX/VAT
define('VAT_INCLUDED', false); // Is VAT included or excluded?
define('VAT_RATE', '10'); // This is the percentage value

define('PAYMENT_DETAILS', 'Md Invoice Lmt.<br>Sort Code: 00-00-00<br>Account Number: 12345678'); // Payment information
define('FOOTER_NOTE', 'http://www.abhishekraj.info/');

// CONNECT TO THE DATABASE

$mysqli = new mysqli(SERVER, USER, PASS, DB);
?>