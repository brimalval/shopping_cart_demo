<?php
	session_start();
	if(!isset($_SESSION['cart']))
		$_SESSION['cart'] = [];
	$json_data = file_get_contents("products.json");
	$json = json_decode($json_data, true);

	function truncate_string($string, $length){
		if (strlen($string) >= $length){
			return substr($string, 0, $length-1)." ...";
		}
		return $string;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<!--For some reason, some of the icons don't work unless the web version
		is imported-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/all.min.css">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class="homepage-body">
		<div class="sidebar">
			<h1>Shop Name</h1>
			<p>Categories:</p>
			<ul>
				<li><a href="#">Men's Shoes</a></li>
				<li><a href="#">Men's Jacket</a></li>
				<li><a href="#">Sport Shoes</a></li>
			</ul>
		</div>
		<div id="notification" class="hidden">
			Added to cart
		</div>
		<div class="product-list">
			<?php $i = 0?>
			<?php foreach($json['products'] as $product){ ?>
				<div class="product">
					<a href="product.php?id=<?=$product['id']?>">
						<div class="product-img">
							<img src="img/<?=$product['img']?>" alt="">
						</div>
					</a>
					<div class="product-details">
						<a href="product.php?id=<?=$product['id']?>">
							<div class='product-name'><?=$product['name']?></div>
						</a>
						<div class='product-price'>
						<?php if(isset($product['oldprice']) && $product['oldprice'] != $product['price']){ ?><strike>₱<?=$product['oldprice']?></strike>
						<?php } ?>
						₱<?=$product['price']?>
						</div>
						<p id='product-description'><?=truncate_string($product['desc'], 64)?></p>
						<div class="product-rating">
							<?php
								for($j=0; $j<$product['rating']; $j++){
									?>
									<i aria-hidden=true class="fa fa-star"></i>
									<?php
								}
								for($j=0; $j<5-$product['rating']; $j++){
									?>
									<i aria-hidden=true class="fa fa-star-o"></i>
									<?php
								}
							?>
						</div>
					</div>
					<div class="product-cart-add-div">
						<button class="cart-add" id="<?=$product['id']?>">Add to 
						<?php $i += 1 ?>
					Cart</button>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</body>
</html>