<?php
class Config{
	public static function get($path = null){
		if($path){
			$config = $GLOBALS['config'];
			$path = explode('/', $path);
			foreach ($path as $bit) {
				#Does mysql exists inside config? if it does, we are setting config to mysql, then does host exists inside config? 
				if(isset($config[$bit])){
					#echo "Set";
					$config = $config[$bit];
				}
			}
			return $config;
		}
		return false;
	}
}