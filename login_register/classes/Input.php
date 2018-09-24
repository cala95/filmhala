<?php
class Input{
	#method that checks if any data exists, if input has been provided
	public static function exists($type = 'post'){
		switch($type){
			case 'post':
				return (!empty($_POST)) ? true : false; 
			break;
			case 'get':
				return (!empty($_GET)) ? true : false; 
			break;
			default:
				return false;
			break;
		}
	}

	#function that returns specific input item
	public static function get($item){
		if(isset($_POST[$item])){
			return $_POST[$item];
		} else if(isset($_GET[$item])){
			return $_GET[$item];
		}
		return '';
	}
}
?>