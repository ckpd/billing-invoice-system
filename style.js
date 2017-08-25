$(document).ready(function() {
    //action to create invoice
//    $('#action_create_invoice').click(function(e){
//        e.preventDefault();
//        actionCreateInvoice();
//    });
	// Load dataTables
	$("#data-table").dataTable();
    
    // add new product row on invoice
    var cloned = $('#invoice_table tr:last').clone();
    $("#addRow").click(function(e) {
        e.preventDefault();
        cloned.clone().appendTo('#invoice_table'); 
    });
    
    /** validate error **/
    function validateForm(){
        var errorCounter = 0;
        
        $(".required").each(function(i, obj){
           if($(this).val() === ''){
               $(this).parent().addClass("has-error");
               errorCounter++;
           } else {
               $(this).parent().removeClass('has-error');
           }
        });
        
        
        return errorCounter;
    }
     // remove product row
    $('#invoice_table').on('click', "#deleteRow", function(e) {
    	e.preventDefault();
       	$(this).closest('tr').remove();
        calculateTotal();
    });
    
    calculateTotal();

    $('#invoice_table').on('input', '.calculate', function () {
	    updateTotals(this);
	    calculateTotal();
	});

	$('#invoice_totals').on('input', '.calculate', function () {
	    calculateTotal();
	});

	$('#invoice_product').on('input', '.calculate', function () {
	    calculateTotal();
	});

function updateTotals(elem) {
        var tr = $(elem).closest('tr'),
            quantity = $('[name="invoice_product_qty[]"]', tr).val(),
	        price = $('[name="invoice_product_price[]"]', tr).val(),
	        subtotal = parseInt(quantity) * parseFloat(price);

	    $('.calculate-sub', tr).val(subtotal.toFixed(2));
	}

	function calculateTotal() {
        var grandTotal = 0;
        var disc = 0;

	    $('#invoice_table tbody tr').each(function() {
            var c_sbt = $('.calculate-sub', this).val(),
                quantity = $('[name="invoice_product_qty[]"]', this).val(),
	            price = $('[name="invoice_product_price[]"]', this).val() || 0,
                subtotal = parseInt(quantity) * parseFloat(price);
            
            grandTotal += parseFloat(c_sbt);
          
	    });
        // VAT, DISCOUNT, SHIPPING, TOTAL, SUBTOTAL:
	    var subT = parseFloat(grandTotal);
        finalTotal = parseFloat(grandTotal);

	    $('.invoice-sub-total').text(subT.toFixed(2));
	    $('#invoice_subtotal').val(subT.toFixed(2));


        $('.invoice-total').text((finalTotal).toFixed(2));
        $('#invoice_total').val((finalTotal).toFixed(2));

    }
    
    
    /*select customer */
    $(document).on('click', ".select-customer", function(e){
        e.preventDefault();
        var customer = $(this);
        $('#insert_customer').modal({ backdrop: 'static', keyboard:false });
        return false;   
    });   
    
    $(document).on('click', ".customer-select", function(e) {
            e.preventDefault();
        
		    var mcustomerid = $(this).attr('setcustomerid');
		    var mfirstname = $(this).attr('setfirstname');
		    var mlastname = $(this).attr('setlastname');
            var mphone = $(this).attr('setphone');
            var memail = $(this).attr('setemail');
            var mcity = $(this).attr('setcity');
            var mparish = $(this).attr('setparish');
            var mreg = $(this).attr('setvehiclereg');

		    $('#customerid').val(mcustomerid);
		    $('#customerfname').val(mfirstname);
		    $('#customerlname').val(mlastname);
		    $('#customerphone').val(mphone);
		    $('#customeremail').val(memail);
		    $('#customercity').val(mcity);
		    $('#customerparish').val(mparish);
		    $('#vehiclereg').val(mreg);

		    $('#insert_customer').modal('hide');

	});
    
    /*item select */
    
    $(document).on('click', ".item-select", function(e) {

   		e.preventDefault;

   		var product = $(this);

   		$('#insert').modal({ backdrop: 'static', keyboard: false }).one('click', '#selected', function(e) {

		    var itemText = $('#insert').find("option:selected").text();
		    var itemValue = $('#insert').find("option:selected").val();

		    $(product).closest('tr').find('.invoice_product').val(itemText);
		    $(product).closest('tr').find('.invoice_product_price').val(itemValue);

		    updateTotals('.calculate');
        	calculateTotal();

   		});

   		return false;

   	});
    
    function actionCreateInvoice(){
  
		var errorCounter = validateForm();

		if (errorCounter > 0) {
		    $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
		    $("#response .message").html("<strong>Error</strong>: It appear's you have forgotten to complete something!");
		    $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
		} else {

			var $btn = $("#action_create_invoice").button("loading");

			$(".required").parent().removeClass("has-error");
			$("#create_invoice").find(':input:disabled').removeAttr('disabled');

			$.ajax({
				url: 'response.php',
				type: 'POST',
				data: $("#create_invoice").serialize(),
				dataType: 'json',
				success: function(data){
					$("#response .message").html("<strong>Created Invoice SuccessFully success</strong>" );
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();

					$("#create_invoice").remove();
					$btn.button("reset");
				},
				error: function(data){
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
//					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				} 

			});
		}

	}
});