<?php
class Movie{
	private $_db,
			$_data;

	public function __construct($movie = null){
		$this->_db = DB::getInstance();
	}

	public function create($fields = array()){
		if(!$this->_db->insert('movies', $fields)){
			throw new Exception('Došlo je do problema prilikom kreiranja filma.');
		}
	}

	public function find($movie = null){
		if($movie){
			$field = (is_numeric($movie)) ? 'id' : 'movie_name';
			$data = $this->_db->get('movies', array($field, '=', $movie)); #we're grabbing the data from db
			if($data->count()){
				$this->_data = $data->results()[0]; #data will contain all of the movies properties
				return true;
			}
		}
		return false;
	}

	public function data(){
		return $this->_data;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}
}
?>