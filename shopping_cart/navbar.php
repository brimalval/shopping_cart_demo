<?php
	if(!isset($_SESSION)){
		session_start();
	}
?>

<link rel="stylesheet" href="css/nav.css">
<script src="js/index.js"></script>
<div id="check-out" class="hidden">
	<div id="cart-hover">
		<div id="check-out-nav">
			<span class="check-out-nav-lbl">
				Checkout
			</span>
			<button id="x-button"><i class="fa fa-times"></i></button>
		</div>
		<div class="check-out-body">
			<div class="check-out-lbl">
				Your Cart
				<span id="cart-count">
					<?=sizeof($_SESSION['cart'])?>
				</span>
			</div>
			<form action="checkout.php" method="POST">
				<div id="cart-list">
					<?php
					include 'cart.php';
					?>
				</div>
				<div id="payment-method">
					<div class="check-out-lbl" style="color: black;">
						Payment
					</div>
					<ul>
						<li><input checked="checked" type="radio" name="payment-method" value="paypal"><i class="fa fa-paypal"></i> Paypal</li>
						<li><input type="radio" name="payment-method" value="paymaya"><i class="fa fa-credit-card"></i>Paymaya</li>
					</ul>
				</div>
				<div class="check-out-submit-div">
					<input type="submit" value="Proceed to Check-out" id="check-out-submit">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="nav-bar">
	<div class="page-lbl-div">
		<span id="homepage-lbl">Shop Homepage</span>
	</div>
	<div class="cart-div">
		<div id="cart">
			<i aria-hidden=true class="fa fa-shopping-cart"></i>
				Cart
				<?php
					if(isset($_SESSION)){
						$cart_size = sizeof($_SESSION['cart']);
						if($cart_size > 0)
							?>(<?=$cart_size?>)<?php
					}
				?>
		</div>
	</div>
</div>