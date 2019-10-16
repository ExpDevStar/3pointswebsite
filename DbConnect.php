<?php
//--------------------------------------------------------------------------
// Create connection and select DB
//--------------------------------------------------------------------------
class DbConnect {

  public function connect() {
    global $config;
    try {
      $conn = new PDO('mysql:host=' . $config['db']['host'] . '; dbname=' . $config['db']['name'], $config['db']['user'], $config['db']['pw']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch ( PDOException $e) {
        echo 'Database Error:' . $e->getMessage();
    }
    }

    function __construct() {
  		$this->conn = $this->connect();
  	}

  	function runQuery($query) {
  		$result = mysqli_query($this->conn,$query);
  		while($row=mysqli_fetch_assoc($result)) {
  			$resultset[] = $row;
  		}
  		if(!empty($resultset))
  			return $resultset;
  	}

  	function numRows($query) {
  		$result  = mysqli_query($this->conn,$query);
  		$rowcount = mysqli_num_rows($result);
  		return $rowcount;
    }
    
    function run($query){
      $this->conn->query($query);
    }
    
    function getResult($query, $args = []){
      $stmt = $this->conn->prepare($query);
      $stmt->execute($args);
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    function getCount($query, $args = []){
      $stmt = $this->conn->prepare($query);
      $stmt->execute($args);
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return isset($result['count']) ? $result['count'] : 0;
    }

    function insert($query, $args = []){
      $stmt = $this->conn->prepare($query);
      $stmt->execute($args);
      return $this->conn->lastInsertId(); 
    }
  }
