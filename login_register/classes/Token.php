<?php
#CSRF protection
#Building Token class that will allow us to generate a token
#and check if a token is valid or exists and then delete it

#We want the name of the token to be the same all the time, that's why we'll add this 
#to our session config in init.php
class Token{
	public static function generate(){
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}
	#check if a token exists or not
	#get a token from a session and check if it is the same as the one defined in the form
	public static function check($token){
		#if the token is the same as the one in the session, we want to delete that session, return true
		$tokenName = Config::get('session/token_name');

		if(Session::exists($tokenName) && $token === Session::get($tokenName)){
			Session::delete($tokenName);
			return true;
		}
		return false;
	}
}
?>