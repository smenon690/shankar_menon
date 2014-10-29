<?php
Class CInput {
	
	public static function exists( $type = 'post' ) {
		switch ( $type ) {
			case 'post' : 
				return ( !empty($_POST) ) ? true : false;
				break;
			case 'get' : 
				return ( !empty($_GET) ) ? true : false;
				break;
			default:
				return false;	
				break;	
		}
	}
	
	public static function getRequestData( $arg ) {
		if (isset($_POST[$arg])) {
			return 	$_POST[$arg];
		}else if ( isset($_GET[$arg]) ) {
			return 	$_GET[$arg];
		}
		return '';		
	}
}