<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="js/jquery.js"></script>
</head>
<body>
	<input type="number" id="num" name="num" min="1" value="1">
	<h4 id="number">1</h4>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#num').change(function(e){
				var num = Number($('#num').val())
				console.log("Number: " + num);
				$('#number').text(num)
				console.log("CurrVal: " + Number($('#number').text()))
			});
		});
	</script>

	<?php
		$arr = [1,2,3]
		?> <?=var_dump($arr)?><br>
	<?php
		unset($arr[1]);
		?> <?=var_dump($arr)?>
</body>
</html>