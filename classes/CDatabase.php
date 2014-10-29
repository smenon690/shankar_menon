<?php

class CDatabase {
	
	private static $_instance = NULL;
	private $_pdo,
			$_query,
			$_result,
			$_count,
			$_error;
	
	private function __construct() { 
		try {
			$this->_pdo = new PDO('mysql:host = '. CConfig::getConfig('mysql/host') . ';dbname=' . CConfig::getConfig('mysql/db'),CConfig::getConfig('mysql/user_name'),CConfig::getConfig('mysql/password'));
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	public static function getDbInstance() {
		
		if (false == isset( self::$_instance )) {
			self::$_instance = new CDatabase();
		}
		return self::$_instance;
	}
	
	public function query( $strSql, $params = array() ) {
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare( $strSql )) {
			$x = 1;
			if ( count( $params ) ) {
				foreach ( $params as $param ) {
					$this->_query->bindValue( $x, $param );
					$x++;
				}
			}
			if ( $this->_query->execute() ) {
				$this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else {
				$this->_error = true;
			}	
				
		}
		return $this;
	}
	
	public function error() {
		return $this->_error;
	}
	
	public function count() {
		return $this->_count;
	}
	
	public function result() {
		if (isset($this->_result)) {
			return $this->_result;
		}else {
			return $this;
		}
		
	}
	
public function searchResult() {
		if (isset($this->_result[0])) {
			return $this->_result;
		}else {
			return $this;
		}
		
	}
	
}