<?php

class CConfig {
	protected $path = NULL;	
	public static function getConfig( $path = NULL ) {
		if ( $path ){
			$config = $GLOBALS['config'];
			$path = explode('/', $path);
			foreach ( $path as $bit ) {
				if ( isset( $config[$bit] ) ) {
					$config = $config[$bit];
				}
			}
			return $config;
		}
		return false;
	} 
}