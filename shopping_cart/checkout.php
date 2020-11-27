<?php
	$json = file_get_contents('products.json');
	$json_data = json_decode($json, true)['products'];

	function find_product($product_id, $json_data){
		foreach($json_data as $product){
			if($product['id'] == $product_id){
				return $product;
			}
		}
	}

	$summary = [];
	$total = 0;
	//Iterates through product IDs, skipping over
	//POST keys that aren't product IDs
	foreach($_POST as $product_id => $product_qty){
		if(!(gettype($product_id) == "integer")){
			continue;
		}
		$product = find_product($product_id, $json_data);
		$total += $product['price'] * $product_qty;
		$summary_item = array(
			"name"=>$product['name'],
			"price"=>$product['price'],
			"qty"=>$product_qty
		);
		array_push($summary, $summary_item);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Check-out Summary</title>
	<style>
		table, td, tr, th{
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<h1>Check-out Summary</h1>
	<p>(information fetched from POST)</p>
	<table>
		<tr>
			<th>Product Name</th>
			<th>Product Price</th>
			<th>Quantity Ordered</th>
		</tr>
	<?php
		foreach($summary as $item){
			?>
			<tr>
				<td><?=$item['name']?></td>
				<td><?=$item['price']?></td>
				<td><?=$item['qty']?></td>
			</tr>
			<?php
		}
	?>
	</table>
	<h4>Total: <?= $total ?></h4>
	<h4>Payment method: <?= $_POST['payment-method'] ?></h4>
</body>
</html>