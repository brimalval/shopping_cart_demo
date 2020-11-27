$(document).ready(function(){
	$('.cart-add').click(function(e){
		e.stopImmediatePropagation();
		var id = this.id;
		$.ajax({
			type: "POST",
			data: {id: id},
			url: "/shopping_cart/add_to_cart.php",
			success: function(response){
				if(response == 1){
					$('#cart-list').load('cart.php');
					$('#notification').addClass('notification-active');
					$('#notification').removeClass('hidden');
					$('#notification').delay(4000).queue(function(next){
						$(this).removeClass('notification-active');
						$(this).addClass('hidden');
						next();
					});	
				}
				console.log(response);
			}
		});
		$('#cart').load(location.href + " #cart");
		$('#cart-count').load("navbar.php" + " #cart-count");	
	});

	//Code used to be $('#cart').click()
	//but after separating the code for the 
	//navigation bar and loading it into
	//several pages via include, it doesn't work
	$(document.body).on('click', '#cart',function(e){
		e.stopImmediatePropagation();
		$('#check-out').removeClass('hidden');
		$('#cart').load(location.href + " #cart");
		$(document.body).addClass('lock');
	});

	$('#x-button').click(function(){
		$('#check-out').addClass('hidden');
		$(document.body).removeClass('lock');
	});

	$(document.body).on('click', '.delete-cart-btn', function(e){
		e.stopImmediatePropagation();
		var id = this.id;
		$.ajax({
			type: "POST",
			data: {delete: true, id: id},
			url: "/shopping_cart/add_to_cart.php",
			success: function(response){
				console.log(response);
				$('#cart-list').load('cart.php');
			}
		});
		$('#cart').load(location.href + " #cart");
		$('#cart-count').load("navbar.php" + " #cart-count");
	});

	//For reasons I don't know yet, 
	//the dataset of elements matched by class
	//are accessed with .dataset, while elements
	//matched by id are accessed with .data()
	$('.qty').change(function(e){
		e.stopImmediatePropagation();
		if(this.value <= 0){
			this.value = this.dataset.prev_val;
			return;
		}
		var price = Number(this.dataset.price);
		var total = Number($('#total-val').text());
		var diff = this.dataset.prev_val - this.value;
		console.log(diff);
		$('#total-val').text(total - (price * diff));
		this.dataset.prev_val = this.value;
	});
});