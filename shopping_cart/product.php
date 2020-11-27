<?php
	$json_data = file_get_contents("products.json");
	$json = json_decode($json_data, true);
	$products = $json['products'];
	$prod = null;

	if(!isset($_GET['id'])){
		header("Location: index.php");
		die();
	}

	foreach($products as $item){
		if($item['id'] == $_GET['id']){
			$prod = $item;
			break;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/all.min.css">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/product.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/product.js"></script>
	<title>Document</title>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="product-body">
		<div class="image-side">
			<div class="back-btn-div">
				<a href="index.php">
					<i class="fa fa-chevron-circle-left"></i> Back
				</a>
			</div>
			<div class="product-img-div">
				<img src="img/<?=$prod['img']?>" alt="">
			</div>
		</div>
		<div class="details-side">
			<div class="rating-stars">
				<?php
				for($i=0; $i<$prod['rating']; $i++){
					?>
					<i class="fa fa-star"></i>
					<?php
				}
				for($i=0; $i<5-$prod['rating']; $i++){
					?>
					<i class="fa fa-star-o"></i>
					<?php
				}
				?>
			</div>
			<div class="rating-text">
				<?=$prod['rating']?> | 3 customer reviews
			</div>
			<div class="product-name">
				<?=$prod['name']?>
			</div>
			<div class="price">
				<?php if($prod['oldprice'] != $prod['price']) { ?>
						<span class="old-price">
							₱<?=$prod['oldprice']?>
						</span>
				<?php } ?> 
				₱<?=$prod['price']?>
			</div>
			<div class="description">
				<?=$prod['desc']?>
			</div>
			<form action="checkout.php" method="POST">
			<div class="qty-select">
				Qty:
				<input id="product-page-qty" type="number" value="1" min="1" name="<?=$prod['id']?>" data-prev_val="1">
			</div>
			<div class="sku">
				SKU: #<?=$prod['sku']?>
			</div>
			<div class="btns">
				<button type="button" class="cart-add" id="<?=$prod['id']?>">Add to Cart</button>
				<input type="hidden" value="Paymaya" name="payment-method">
				<input type="submit" value="Buy Now">
			</div>
			</form>
		</div>
	</div>
</body>
</html>