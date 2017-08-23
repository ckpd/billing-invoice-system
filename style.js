$(document).ready(function() {
    //action to create invoice
    $('#action_create_invoice').click(function(e){
        e.preventDefault();
        actionCreateInvoice();
    });
	// Load dataTables
	$("#data-table").dataTable();
    
    // add new product row on invoice
    var cloned = $('#invoice_table tr:last').clone();
    $("#addRow").click(function(e) {
        e.preventDefault();
        cloned.clone().appendTo('#invoice_table'); 
    });
    
    
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
	    
	    var grandTotal = 0,
	    	disc = 0,

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
    
    
       
});