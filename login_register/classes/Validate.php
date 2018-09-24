<?php

class Validate{
	private $_passed = false, #we need to check if the input is passed
			$_errors = array(), #if there are some errors
			$_db = null;
	
	public function __construct(){
		$this->_db = DB::getInstance(); #we need an instance of DB
	}

	public function check($source, $items = array()){ #Source - data that we want to loop through and check, Items - array of rules
		foreach ($items as $item => $rules) { #items are in our case username,password,password_again and name, rules are arrays in arrays for each item
			foreach ($rules as $rule => $rule_value) { #we need to go through those arrays of rules also
				
				$value = trim($source[$item]); #value of each item; trim function removes white spaces 
				$item = escape($item);

				if($rule === 'required' && empty($value)){ # if it's not filled we've got a problem, we need error function
					$this->addError("{$item} je nephodno polje...");
				}else if(!empty($value)){
					switch ($rule) {
						case 'min':
							# check if the string value is less then value we've defined
						if(strlen($value) < $rule_value){
							$this->addError("{$item} mora imati najmanje {$rule_value} karaktera. ");
						}
						break;
						case 'max':
							if(strlen($value) > $rule_value){
							$this->addError("{$item} može imati najviše {$rule_value} karaktera. ");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value]){
								$this->addError("{$rule_value} se mora podudarati sa {$item}");
							}
						break;
						case 'unique':
							#we're gonna use DB wrapper that we've already created
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count()){ #if there is a positive count that means that value does exsist in db, and therefor item already exists
								$this->addError("{$item} već postoji.");
							}
						break;
					}
				}
			}
		}
		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;
	}

	private function addError($error){
		#adds an error to the errors array
		$this->_errors[] = $error;
	}

	public function errors(){
		return $this->_errors;
	}

	public function passed(){
		return $this->_passed;
	}

}
?>