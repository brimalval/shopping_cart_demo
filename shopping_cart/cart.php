<script src="js/index.js"></script>
<?php
	$json_data = file_get_contents('products.json');
	$json = json_decode($json_data, true);
	$products = $json['products'];
	$total = 0;

	function get_product($product_id, $products){
		foreach($products as $item){
			if($item['id'] == $product_id){
				return $item;
			}
		}
	}

	function truncate_str($string, $length){
		if (strlen($string) >= $length){
			return substr($string, 0, $length-1)." ...";
		}
		return $string;
	}

	if(!isset($_SESSION)){
		session_start();
		if(!isset($_SESSION['cart']))
			$_SESSION['cart'] = [];
	}
	foreach($_SESSION['cart'] as $id){
		$product = get_product($id, $products);
		$total += $product['price'];
		?>
		<div class="cart-product">
			<div class="name-and-desc">
					<div class="name-div">
					<h5><?=$product['name']?></h5>
					<?=truncate_str($product['desc'], 48)?>
				</div>
			</div>
			<div class="qty-and-price">
				<input name="<?=$product['id']?>" type="number" value="1" min="1" id="<?=$id?>" data-prev_val="1" data-price="<?=$product['price']?>" class="qty">
				<h8><?=$product['price']?> PhP</h8>
			</div>
			<div class="delete-cart">
				<i class="fa fa-trash delete-cart-btn" id=<?=$id?>></i>
			</div>
		</div>
		<?php
	}
?>
	<div class="cart-product">
		<div class="total">
			<div id="total-lbl">
				<h7>Total: <h7>
			</div> 
			<div id="total-number-div">
				<span id="total-val"><?=$total?></span> 
				<span id="currency-lbl">PhP</span>
			</div>
		</div>
	</div>