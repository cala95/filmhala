<?php
class Connection {
	private $conn;
	public function __construct() {
		$this->conn = new mysqli ( "localhost", "root", "", "filmhala" );
		$this->conn->set_charset ( "utf8" );
	}
	public function open() {
		return $this->conn;
	}
	public function close() {
		$this->conn->close ();
	}
	public function select($query, $params) {
		$result = $this->conn->prepare ( $query );
		$s = '';
		foreach ($params as $n) {
			$s = $s.'s';
		}
		$result->bind_param ( $s, ...$params );
		$result->execute ();
		return $result;
	}
	public function find($x) {
		$query = "SELECT * FROM movies WHERE movie_name = ?";
		$result = $this->query ( $query, array (
				$x 
		) );
		$result->store_result ();
		if ($result->num_rows) {
			$result->close ();
			return TRUE;
		} else {
			$result->close ();
			echo FALSE;
		}
	}
	public function delete($n,$y) {
		$sql = "DELETE * FROM movies WHERE movie_name = ? AND year = ?";
		$result = $this->query( $sql, array (
				$n,
				$y 
		) );
		if ($result->affected_rows) {
			$result->close ();
			return TRUE;
		} else {
			$result->close ();
			return FALSE;
		}
	}
	public function insert($n, $d, $y, $g, $c, $r) {
		$query = "INSERT INTO movies VALUES (?,?,?,?,?,?)";
		$result = $this->query ( $query, array (
				$n,
				$d,
				$y,
				$g,
				$c,
				$r		 
		) );
		if ($result->affected_rows > 0) {
			$result->close ();
			return TRUE;
		} else {
			$result->close ();
			return FALSE;
		}
	}
	public function update($r, $n) {
		$query = "UPDATE movies SET imdb_rate = ? WHERE movie_name = ?";
		$result = $this->query ( $query, array (
			$r,
			$n
		) );
		if ($result->affected_rows) {
			$result->close ();
			return TRUE;
		} else {
			$result->close ();
			return FALSE;
		}
	}
}
?>