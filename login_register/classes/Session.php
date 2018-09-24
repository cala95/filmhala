<?php
class Session{
	public static function exists($name){
		return (isset($_SESSION[$name])) ? true : false;
	}

	public static function put($name, $value){
		return $_SESSION[$name] = $value;
	}

	public static function get($name){
		return $_SESSION[$name];
	}

	public static function delete($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}

	#Flashing
	public static function flash($name, $string = ''){
		if (self::exists($name)) {
			# if the session does exists we want to set the value that we return
			# to the session data that we've set and also delete it
			# we're creating the message that'll show up on the screen and then delete it 
			# when the user refreshes the page
			$session = self::get($name); #store the session
			self::delete($name); #delete the session
			return $session; #return the session
		}else{
			#set the data
			self::put($name, $string);
		}
		return '';
	}
}
?>