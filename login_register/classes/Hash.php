<?php
class Hash{
	#make hash
	public static function make($string, $salt = ''){
		#salt improves the security of a password hash, it adds randomly generated
		#and secure string of data onto the end of a password
		return hash('sha256', $string . $salt);
	}

	#make salt
	public static function salt($length){
		return mcrypt_create_iv($length); 
	}

	#make unique hash
	public static function unique(){
		return self::make(uniqid());
	}
}
?>