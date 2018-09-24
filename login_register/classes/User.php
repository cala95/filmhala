<?php
class User{
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;


	public function __construct($user = null){
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		#checking if the user is logged in, if the session exists
		if(!$user){ #if the user hasn't been defined
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);
				#checking if the user exists
				if($this->find($user)){
					$this->_isLoggedIn = true;
				}else{
					#process Logout
				}
			}
		}else{ #if the user has been defined
			$this->find($user); #grab data of the user that isn't logged in
		}
	}

	public function create($fields = array()){
		if(!$this->_db->insert('users', $fields)){
			throw new Exception('Došlo je do problema prilikom kreiranja naloga.');
		}
	}

	public function find($user = null){
		if($user){
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->get('users', array($field, '=', $user)); #we're grabbing the data from db
			if($data->count()){
				$this->_data = $data->results()[0]; #data will contain all of the users properties
				return true;
			}
		}
		return false;
	}

	public function data(){
		return $this->_data;
	}

	public function login($username = null, $password = null, $remember = false){
		if(!$username && !$password && $this->exists()){
			//Log user in 
			Session::put($this->_sessionName, $this->data()->id);
		}else{
			$user = $this->find($username);

			if($user){
				if($this->data()->password === Hash::make($password, $this->data()->salt)){
					#passwords match
					Session::put($this->_sessionName, $this->data()->id); #store user's id in session
					
					if($remember){
						$hash = Hash::unique(); #generate unique hash
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

						if(!$hashCheck->count()){ #check that hash doesn't already exists in db, insert this hash in db if it doesn't
							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash
							));
						}else{
							$hash = $hashCheck->results()[0]->hash;
						}

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));

					}
					return true;
				}
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}

	public function logout(){
		Session::delete($this->_sessionName); #delete session
		Session::delete($this->cookieName); #delete hash from cookie
		$this->_db->delete('users_session',array('user_id','=', $this->data()->id)); #delete hash from db
	}

	public function update($fields = array(), $id = null){
		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->id;
		}
		if(!$this->_db->update('users', $id, $fields)){
			throw new Exception('Došlo je do problema pri izmeni podataka'); 
		}
	}

}
?>