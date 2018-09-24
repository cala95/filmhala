<?php   #Building DB wrapper
require_once 'login_register/core/init.php';
class DB{
	private static $_instance = null; #Property that is going to store instance of a database if it's available
	private $_pdo, #PHP Data Objects
			$_query, #The last query that is executed
			$_error = false, 
			$_results, 
			$_count = 0; #Number of results

	private function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'),Config::get('mysql/password')); #1st string is database, 2nd is username, 3rd is password
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	#By making this function we are avoiding making multiple connections to one database, we need just one connection

	public function query($sql,$params = array()){ #1st argument is query string, 2nd is array of parameters that we might want to include in PDO
		$this->_error = false; #reset the error
		#check if the query has been prepared properly
		if($this->_query = $this->_pdo->prepare($sql)){
			#echo 'Success';
			$x=1; #position
			if(count($params)){
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param); #By binding paramaters we remove posibility for sql injections
					$x++;
				}
			}
			if($this->_query->execute()){
				#echo 'Success';
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ); #save the result as PDO
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}

	public function action($action, $table, $where = array()){
		if(count($where)===3){ #field,operator,value
			$operators = array('=','<','>','<=','>='); #allowed operators

			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];

			#Check if the operator is in the list of allowed ones
			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->query($sql,array($value))){} #perform a query
					return $this;
			}
		}
		return false;
	}

	public function get($table, $where){
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}

	public function results(){
		return $this->_results;
	}

	public function error(){
		return $this->_error;
	}
	public function count(){
		return $this->_count;
	}


	#inserting and updating db
	public function insert($table, $fields = array()){
		$keys = array_keys($fields);
		$values = ''; #keeps track of question marks that we want to put inside our query
		$x = 1; 

		foreach ($fields as $field) {
			$values .= '?'; #adding ? to values
			if($x < count($fields)){ #are we at the end of the fields that we defined?
				$values .= ', '; #if we are not we want to add , onto this values
			}
			$x++;
		}
		
		$sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES({$values})";
		
		if(!$this->query($sql, $fields)->error()){
			return true;
		} 
		return false;
	}

	public function update($table, $id, $fields){
		$set = '';
		$x = 1;

		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ', ';
			}
			$x++;
		}
		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
		
		if(!$this->query($sql, $fields)->error()){
			return true;
		}
		return false;
	}
}
?>