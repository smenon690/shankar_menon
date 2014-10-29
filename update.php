<?php
include 'core/init.php';
$id				= $_REQUEST['id'];
$categoryId  	= $_REQUEST['category_id'];
$productName  	= $_REQUEST['product_name'];
$quantity 		= $_REQUEST['product_quantity'];
$productPrice  	= $_REQUEST['product_price'];
$productSize  	= $_REQUEST['product_size'];

$objProducts = new CProduct();
$product = $objProducts->updateProduct($id,$categoryId, $productName, $quantity, $productPrice, $productSize);
	if (!$product){
		echo 'product saved';
	}else {
		echo 'error';
	}
