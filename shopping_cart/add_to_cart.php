<?php 
	if(!isset($_SESSION))
		session_start();
	if(isset($_POST['id']) && !isset($_POST['delete'])){
		if(!in_array($_POST['id'], $_SESSION['cart'])){
			array_push($_SESSION['cart'], $_POST['id']);
			echo 1;
		}else{
			echo 0;
		}
	}else if(isset($_POST['delete'])){
		if(!isset($_POST['id']))
			$_SESSION = [];
		else{
			for($i=0; $i<sizeof($_SESSION['cart']); $i++){
				if($_SESSION['cart'][$i] == $_POST['id']){
					//Remove index i from cart, "1" signifies
					//length of portion of array to be removed.
					//Only 1 element will be deleted.
					array_splice($_SESSION['cart'], $i, 1);
					break;
				}
			}
		}
	}
?>