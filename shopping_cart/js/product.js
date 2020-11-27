$(document).ready(function(){
	$('#product-page-qty').change(function(e){
		e.stopImmediatePropagation();
		var qty = $('#product-page-qty');
		if(qty.val() <= 0){
			qty.val(qty.data('prev_val'));
			return;
		}
	});
});