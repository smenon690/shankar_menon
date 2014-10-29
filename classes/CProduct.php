<?php
class CProduct {
	private $_objProduct,
			$_product,
			$_error,
			$_productResult;
			
	public function __construct($order=NULL) {
		$this->_objProduct = CDatabase::getDbInstance();	
		if (isset($order)) {		
			$this->_productResult = $this->_objProduct->query("select * from product_master order by $order");
		}else {
			$this->_productResult = $this->_objProduct->query("select * from product_master");
		}	
	}
	
	public function saveProduct($categoryId,$productName,$quantity,$productPrice,$productSize) {
		$this->_product = $this->_objProduct->query("INSERT INTO product_master (category_id,product_name,quantity,product_price,product_size) values ( $categoryId,'$productName',$quantity,$productPrice,$productSize )");
		$this->_error = $this->_product->error();
		return $this->_error;
		
	}
	
	public function updateProduct($id,$categoryId,$productName,$quantity,$productPrice,$productSize) {
		$this->_product = $this->_objProduct->query("UPDATE product_master SET category_id = $categoryId,product_name = '$productName',quantity = $quantity,product_price = $productPrice,product_size = $productSize WHERE id = $id");
		$this->_error = $this->_product->error();
		return $this->_error;
		
	}
	
	public function sortData($order) {//print_r(CInput::getRequestData('product_name'));
		$this->_productResult = $this->_objProduct->query("select * from product_master order by $order");
		return true;
		//return $this->viewProducts();
		
		//header("Location:index.php");
	}
	
	public function viewProducts() {
		$result = $this->_productResult->result();
		if (isset($result)) {
			return $result;
		}
		return '';
	}
	
}