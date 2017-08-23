<!--
<?php
   
//    session_start();    
//
//    include('config.php');
//    $obj = new DB_Query();
//
//
//
//    if($_SERVER["REQUEST_METHOD"] == "POST"){
//        $firstname = strtolower($_REQUEST["firstname"]);
//        $lastname = strtolower($_REQUEST["lastname"]);
//        $city = strtolower($_REQUEST["city"]);
//        $parish = strtolower($_REQUEST["parish"]);
//        $vehiclereg = strtolower($_REQUEST["vehiclereg"]);
//        $jobs = $_REQUEST["job"];
//        $total = $_REQUEST["textTotal"];
//        
//        $obj->createinvoice($firstname,$lastname,$city,$parish,$vehiclereg, $jobs, $total);    
//        $_SESSION['$lastID'] = $obj->createinvoice($firstname,$lastname,$city,$parish,$vehiclereg, $jobs, $total);
//            
//              header("location: confirminvoice.php");
//        
//        
//    } 
?>

-->


<html>
<head>
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.css" style="text.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
    <link href="styles.css" type="text/css" rel="stylesheet">
    <link href="dataTables.bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="jquery.dataTables.min.css" type="text/css" rel="stylesheet">

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="//code.jquery.com/jquery-1.12.0.min.js"> </script>  
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"> </script>  
    <script src="style.js"> </script>
    <script src="jquery.dataTables.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    
    

</head>
<body>  
    <div class="container">
    <header>
        <div class="wrapper">
            <div class="content">
                <h1>Create Invoice</h1>
            </div>
        </div>
        <hr>    
    </header>
    <section id="formdata">
        <div class="wrapper">
                <form method="post" id="create_invoice">
                    <h1>
                        <img src="http://via.placeholder.com/150x100" class="img-responsive">
                    </h1>
                    <div class="row">
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="float-left">Customer Information</h4>
							<a href="#" class="float-right select-customer">Select existing customer</a>
							<div class="clear"></div>
						</div>
						<div class="panel-body form-group form-group-sm">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_name" id="customer_name" placeholder="Enter name" tabindex="1">
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_1" id="customer_address_1" placeholder="Address 1" tabindex="3">	
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_town" id="customer_town" placeholder="Town" tabindex="5">		
									</div>
                                </div>		
                                <div class="col-xs-6">
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_name" id="customer_name" placeholder="Enter name" tabindex="1">
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_1" id="customer_address_1" placeholder="Address 1" tabindex="3">	
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_town" id="customer_town" placeholder="Town" tabindex="5">		
									</div>
                                </div>		    
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xs-6 text-right">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Invoice Status</h4>
						</div>
						<div class="panel-body form-group form-group-sm">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" class="form-control margin-bottom required" name="customer_name_ship" id="customer_name_ship" placeholder="Invoice Date" tabindex="9">
									</div>
								</div>
								<div class="col-xs-6">	
                                    <div class="form-group">
								    	<input type="text" class="form-control margin-bottom required" name="customer_address_1_ship" id="customer_address_1_ship" placeholder="Invoice Status Open" tabindex="10">
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
                    
                    <!-- / end client details section -->
			<table class="table table-bordered" id="invoice_table">
				<thead>
					<tr>
                        <th></th>
						<th width="500">
							<h4><a href="#" class="btn btn-success btn-xs " id="addRow">Add Item</a></h4>
						</th>
						<th>
							<h4>Qty</h4>
						</th>
						<th>
							<h4>Price</h4>
						</th>
						<th>
							<h4>Sub Total</h4>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
                        <td>
                            <a href="#" class="btn btn-danger btn-xs delete-row"  id="deleteRow"><span>x</span></a>

                        </td>
						<td>
							<div class="form-group form-group-sm  no-margin-bottom" >
								<input type="text" class="form-control form-group-sm item-input invoice_product" name="invoice_product[]" placeholder="Enter item title or description" >
							</div>
						</td>
						<td class="text-right">
							<div class="form-group form-group-sm no-margin-bottom">
								<input type="text" class="form-control invoice_product_qty calculate" name="invoice_product_qty[]" value="1">
							</div>
						</td>
						<td class="text-right">
							<div class="input-group input-group-sm  no-margin-bottom">
								<span class="input-group-addon">&dollar;</span>
								<input type="text" class="form-control calculate invoice_product_price required" name="invoice_product_price[]" aria-describedby="sizing-addon1" placeholder="0.00">
							</div>
						</td>
			
						<td class="text-right">
							<div class="input-group input-group-sm">
								<span class="input-group-addon">&dollar;</span>
								<input type="text" class="form-control calculate-sub" name="invoice_product_sub[]" id="invoice_product_sub" value="0.00" aria-describedby="sizing-addon1" disabled>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="invoice_totals" class="padding-right row text-right">
				<div class="col-xs-6">
			
				</div>
				<div class="col-xs-6 no-padding-right">
<!--
					<div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong>Sub Total:</strong>
						</div>
						<div class="col-xs-3">
							&dollar;<span class="invoice-sub-total">0.00</span>
							<input type="hidden" name="invoice_subtotal" id="invoice_subtotal">
						</div>
					</div>
-->
<!--
					<div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong>Discount:</strong>
						</div>
						<div class="col-xs-3">
							&dollar;<span class="invoice-discount">0.00</span>
							<input type="hidden" name="invoice_discount" id="invoice_discount">
						</div>
					</div>
			
-->
<!--
                    <div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong>TAX/VAT:</strong><br>Remove TAX/VAT <input type="checkbox" class="remove_vat">
						</div>
						<div class="col-xs-3">
							&dollar;<span class="invoice-vat" data-enable-vat="1" data-vat-rate="20" data-vat-method="">0.00</span>
							<input type="hidden" name="invoice_vat" id="invoice_vat">
						</div>
					</div>
-->
										<div class="row">
						<div class="col-xs-4 col-xs-offset-5">
							<strong>Total:</strong>
						</div>
						<div class="col-xs-3">
							&dollar;<span class="invoice-total">0.00</span>
							<input type="hidden" name="invoice_total" id="invoice_total">
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-xs-12 margin-top btn-group">
					<input type="submit" id="action_create_invoice" class="btn btn-success float-right" value="Create Invoice" data-loading-text="Creating...">
				</div>
			</div>
		</form>
        </div>        
    </section>
    </div>  
    </body>
<!--
    <section id="invoice_form" ng-app="invoice">
        <div class="wrapper">
            <div class="content">
                <h1 class="headline">Create Customer Invoice</h1>
                <h4>Account Details</h4>
                <form method="post">
            <table class="datatable">
                <tr>
                  <td> <label for="firstname">First Name</label></td>
                  <td> <input type="text" value="firstname" name="firstname"/></td>
                  <td> <label for="lastname">Last Name</label></td>
                  <td> <input type="text" value="lastname" name="lastname"/></td>
                </tr>   
                <tr>
                  <td> <label for="city" >City</label></td>
                  <td> <input type="text" value="c" name="city"/></td>   
                  <td> <label for="parish" >Parish</label></td>
                  <td> <input  type="text" value="x" name="parish"/></td>
                </tr>
                <tr>
                  <td> <label for="vehiclereg">Vehicle Reg #</label></td>
                  <td colspan="3"> <input  type="text" name="vehiclereg"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="btn btn-primary" id="add">Add item</button></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            
                <tr >    
                    <td><input type="text" name="job[0][description]"></td>
                    <td><input   type="text" min="0" max="10000" class="quantity" name="job[0][quantity]"></td>
                    <td><input  type="text" min="0" max="10000" class="price" name="job[0][price]"></td>
                    <td><input type="text" min="0" class="amount" name="job[0][amount]" ></td>
                    <td></td> 
                </tr>
             
                <tr>
                    <td></td>
                    <td></td>
                    <td><input style="visibility:hidden;"  type="text" min="0" id="subtotal" name="textTotal" ></td>
                </tr>      

            </table>                                    <p class="subtotal">0.00</p>

                    <input type="submit" name="submit" value="Generate Invoice" >
                </form>
            </div>
        </div>
    </section>

    </body>
-->

</html>
