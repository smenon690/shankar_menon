<?php
class CCategory {
	private $_db,
			$_category,
			$_error;
			
	public function __construct() {
		$this->_db = CDatabase::getDbInstance();			
		$this->_category = $this->_db->query("select * from category");
	}
	
	public function getCategory() {
		$category = $this->_category->result();
		if (isset($category)){
			return $category;
		}
	}
	
	public function getCategoryCount() {
		$categoryCount = $this->_category->count();
		if (isset($categoryCount)){
			return $categoryCount;
		}
	}
}