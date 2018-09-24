<?php
session_start();
#it's going to be included in every page, here we autoload classes
#different config settings
#helps us create consistency
#Config class will allow us to pull any data we want from this config
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'filmhala'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);

spl_autoload_register(function($class){
	require_once 'login_register/classes/' . $class . '.php';
});   #we only require classes when we need them, this shortens the code

require_once 'login_register/functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){ 
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash','=', $hash));
	if($hashCheck->count()){
		$user = new User($hashCheck->results()[0]->user_id);
		$user->login();
	}
}

#init.php is going to be included in every page we have
