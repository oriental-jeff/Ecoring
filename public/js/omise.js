$(document).ready(function() {

	// Event
	$(document).on('click', '.omise-payment', function(){
		var _this = $(this);
		var id	= _this.attr('data-id');
		var bill_no	= _this.attr('data-bill');
		var price = _this.attr('data-price');
		var flag	= _this.attr('data-flag');
		paymentShow(id, bill_no, price);
	});

});


function paymentShow(id, bill_no, price, flag){
	price_satang = parseFloat(price) * 100;
	$('#price').val(price);
	$('#price_satang').val(price_satang);
	$('#omise_script').attr('data-amount', price_satang);
	$('#OrDr_Bill').val(bill_no);
	$('#flag').val(flag);
  $('.omise-checkout-button').click();
}