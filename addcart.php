<?php
	session_start();
	if(!empty($_GET['proID'])){
		$proid= $_GET['proID'];
		
		if(isset($_SESSION['cart'][$proid])){
			$qty=$_SESSION['cart'][$proid] +1;
		}else{
			$qty =1;
		}
	}else{
		header("Location:homepage.php");
	}
	
	$_SESSION['cart'][$proid] = $qty;
	header("location:cart.php");

?>