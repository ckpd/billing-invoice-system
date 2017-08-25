<?  
    include('config.php');
    $obj = new DB_Query();
?>
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
        <div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>
        <div class="wrapper">
            <div class="content">
                <h1>Create Invoice</h1>
            </div>
        </div>
        <hr>    
    </header>
    <section id="formdata">
        <div class="wrapper">
                <form method="post" action="response.php" id="create_invoice">
                <input type="hidden" name="action" value="create_invoice">
                    <h1>
                        <img src="http://via.placeholder.com/150x100" class="img-responsive">
                    </h1>
                    <br>
                    <div class="row">
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="float-left">Customer Information</h4>
							<a href="#" class="float-right select-customer">Select existing customer</a>
							<div class="clear"></div>
                            <br>
                            <input type="text" class="form-control margin-bottom" name="customerid" id="customerid" placeholder="Customer ID number" readonly>
						</div>
						<div class="panel-body form-group form-group-sm">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customerfname" id="customerfname" placeholder="Enter First Name" tabindex="1">
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customercity" id="customercity" placeholder="City" tabindex="3">	
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="vehiclereg" id="vehiclereg" placeholder="Vehicle Registration" tabindex="5">
									</div>
                                </div>		
                                <div class="col-xs-6">
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customerlname" id="customerlname" placeholder="Enter Last name" tabindex="1">
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customerparish" id="customerparish" placeholder="Parish" tabindex="3">	
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
										<input type="text" class="form-control margin-bottom" name="customerinvoicedate" id="customerinvoicedate" placeholder="Invoice Date"  tabindex="9">
									</div>	
                                    <div class="form-group">
										<input type="email" class="form-control margin-bottom required" name="customeremail" id="customeremail" placeholder="Enter Email address" tabindex="9">
									</div>    
                                    <div class="form-group">
										<input type="text" class="form-control margin-bottom" name="customerphone" id="customerphone" placeholder="Enter phone number" tabindex="10">
									</div>
								</div>
								<div class="col-xs-6">	
                                    <div class="form-group">
								    	<input type="text" class="form-control margin-bottom" name="customerinvoicestatus" id="customerinvoicestatus" placeholder="Invoice Status Open" tabindex="10">
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
                    
            <!-- / end client details section -->
			<table class="table table-bordered   " id="invoice_table">
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
                                <p class="item-select">or <a href="#">select an item</a></p>

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
								<input type="text" class="form-control calculate-sub" name="invoice_product_sub[]" id="invoice_product_sub" value="0.00" aria-describedby="sizing-addon1" readonly>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="invoice_totals" class="padding-right row text-right">
            <div class="col-xs-6">

            </div>
            <div class="col-xs-6 no-padding-right">
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

        <div id="insert_customer" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select an existing customer</h4>
              </div>
              <div class="modal-body">
                <?php $obj->popCustomersList(); ?>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        </div>


        <div id="insert" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select an item</h4>
              </div>
              <div class="modal-body">
                <?php $obj->ProductsList(); ?>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </section>
    </div>  
    </body>
</html>
