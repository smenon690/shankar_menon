<?php
include 'core/init.php';
$order='';
$count=0;
$category = new CCategory();
$catResults = $category->getCategory();

if (CInput::exists()){
	$objProducts = new CProduct();
	
	$productName 	= CInput::getRequestData('p_name');
	$categoryId	 	= CInput::getRequestData('category');
	$quantity		= CInput::getRequestData('quantity');
	$productPrice 	= CInput::getRequestData('p_price');
	$productSize 	= CInput::getRequestData('p_size');
	
	$product = $objProducts->saveProduct($categoryId, $productName, $quantity, $productPrice, $productSize);
	if (!$product){
		echo 'product saved';
	}else {
		echo 'error';
	}
	
	
}
	
if(isset($_GET['sort_by'])&&$_GET['sort_by']=='product_name'){
   $order = "product_name";
}

if(isset($_GET['sort_by'])&&$_GET['sort_by']=='category_id'){
   $order = "category_id";
}
if(isset($_GET['sort_by'])&&$_GET['sort_by']=='product_name'){
   $order = "product_name";
}

if(isset($_GET['sort_by'])&&$_GET['sort_by']=='product_price'){
   $order = "product_price";
}
if(isset($_GET['sort_by'])&&$_GET['sort_by']=='product_size'){
   $order = "product_size";
}

if(isset($_GET['sort_by'])&&$_GET['sort_by']=='product_quantity'){
   $order = "quantity";
}


$objProducts = new CProduct();
$viewProduct = $objProducts->viewProducts();
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
	<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
	<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
	<!--[if gt IE 8]><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><![endif]-->

<head>
	<title>shankar assignment</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function(){
		
			$(".edttbl").click(function()	{
				
				var ID = $(this).attr('id');
				$("#edttbl1_"+ID).hide();
				$("#product_name_"+ID).hide();
				$("#category_id_"+ID).hide();
				$("#product_price_"+ID).hide();
				$("#product_quantity_"+ID).hide();
				$("#product_size_"+ID).hide();

				$("#saverow_"+ID).show();
				$("#product_name_ip_"+ID).show();
				$("#category_id_ip_"+ID).show();
				$("#product_price_ip_"+ID).show();
				$("#product_quantity_ip_"+ID).show();
				$("#product_size_ip_"+ID).show();
			 })
			$(".edttbl").change(function()	{
				var ID = $(this).attr('id');
				var product_name 		= $("#product_name_ip_"+ID).val();
				var category_id 		= $("#category_id_ip_"+ID).val();
				var product_price 		= $("#product_price_ip_"+ID).val();
				var product_quantity 	= $("#product_quantity_ip_"+ID).val();
				var product_size 		= $("#product_size_ip_"+ID).val();

				var dataString = 'id='+ID+'&product_name='+product_name+'&category_id='+category_id+'&product_price='+product_price+'&product_quantity='+product_quantity+'&product_size='+product_size;
				//var dataString = 'product_name='+product_name;
				if(product_name.length && category_id.length && product_price.length > 0 && product_quantity.length > 0 && product_size.length > 0)
				{
				$.ajax({
                    url : "update.php",
                    type: "post",                   
                  	data: dataString,
                    success: function(html) {   
					//$("#successInsert").html(data); 
					
					

					$("#edttbl1_"+ID).show();
					$("#product_name_"+ID).show();
					$("#category_id_"+ID).show();
					$("#product_price_"+ID).show();
					$("#product_quantity_"+ID).show();
					$("#product_size_"+ID).show();

					$("#saverow_"+ID).hide();
					$("#product_name_ip_"+ID).hide();
					$("#category_id_ip_"+ID).hide();
					$("#product_price_ip_"+ID).hide();
					$("#product_quantity_ip_"+ID).hide();
					$("#product_size_ip_"+ID).hide();

					$("#product_name_"+ID).html(product_name);
					$("#category_id_"+ID).html(category_id);
					$("#product_price_"+ID).html(product_price);
					$("#product_quantity_"+ID).html(product_quantity);
					$("#product_size_"+ID).html(product_size);
										 					
                  }
                });
				}else{
					alert('enter');
				}	
			});	 	 
	}); 
		
	</script>
	<style type="text/css">
		.ip{
				
				
				background-color:#ffffcc;
				display: none;
				border:solid 1px #000;
				padding:2px;
			}
		.saverow{
			display:none;
		}		
	</style>
</head>

<body>
<div class="addcatelog">
      <h3>Add New Product</h3>
      	<form method="post" action="">
	        <p><input type="text" name="p_name" value="" placeholder="product name" required="true"></p> 
	         <p>
	        	<select name="category">
	        		<?php 
	        		foreach ($catResults as $catResult){
	        		?>      		
	        		<option value="<?php echo $catResult->id?>"><?php echo $catResult->c_name?></option>
	        		<?php 
	        		}
	        		?>
	        	</select>
			<p>
	        <p><input type="text" name="p_price" value="" placeholder="price" required="true"></p>        
	        <p>
	        	<select name="quantity">
	        		<option>1</option>
	        		<option>2</option>
	        		<option>3</option>
	        		<option>4</option>
	        	</select>
			<p>
			<input type="text" name="p_size" value="" placeholder="size" required="true"></p>
					
	        <p class="submit"><input type="submit" name="submit" value="Save"></p>
      	</form>
</div>
<div>
	<h3>Product Catelog</h3>
	<div id="successInsert"></div>
	<table border=1 style="padding:2px; width:800px;">
		<tr>
			<th><a href="?sort_by=product_name">Product Name</a></th>
			<th><a href="?sort_by=category_id">Product category</a></th>
			<th><a href="?sort_by=product_price">Product price</a></th>
			<th><a href="?sort_by=product_quantity">Product quantity</a></th>
			<th><a href="?sort_by=product_size">Product size</a></th>
			<th>Action</th>
		</tr>
		<?php if (isset($order)) {
					$objProducts = new CProduct($order);
					$viewProduct = $objProducts->viewProducts();
				}else {
					$objProducts = new CProduct();
					$viewProduct = $objProducts->viewProducts();
				}
		?>
		<?php foreach ($viewProduct as $pro) {$count++; $id = $pro->id; ?>
		<tr id = "<?php echo $id?>" class="edttbl">
			<td>
				<span id="product_name_<?php echo $id; ?>" class="text"><?php echo $pro->product_name?></span>
				<input type="text" class="ip" id="product_name_ip_<?php echo $id; ?>" value="<?php echo $pro->product_name?>" />
			</td>	
			<td>
				<span id="category_id_<?php echo $id; ?>" class="text"><?php echo $pro->category_id?></span>
				<input type="text" class="ip" id="category_id_ip_<?php echo $id; ?>" value="<?php echo $pro->category_id?>" />
			</td>
			<td>
				<span id="product_price_<?php echo $id; ?>" class="text"><?php echo $pro->product_price?></span>
				<input type="text" class="ip" id="product_price_ip_<?php echo $id; ?>" value="<?php echo $pro->product_price?>" />	
			</td>
			<td>
				<span id="product_quantity_<?php echo $id; ?>" class="text"><?php echo $pro->quantity?></span>
				<input type="text" class="ip" id="product_quantity_ip_<?php echo $id; ?>" value="<?php echo $pro->quantity?>" />
			</td>
			<td>
				<span id="product_size_<?php echo $id; ?>" class="text"><?php echo $pro->product_size?></span>
				<input type="text" class="ip" id="product_size_ip_<?php echo $id; ?>" value="<?php echo $pro->product_size?>" />
			</td>
			<td><a class="edttbl1" id="edttbl1_<?php echo $id?>" >Edit</a><a class="saverow" id="saverow_<?php echo $id?>">save</a></td>
		</tr>
		<?php }?>
	</table>

</div>
</body>
</html>