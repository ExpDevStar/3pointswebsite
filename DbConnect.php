<?php
//--------------------------------------------------------------------------
// Create connection and select DB
//--------------------------------------------------------------------------
class DbConnect {
  private $host = 'localhost';
  private $dbName = 'pdpm';
  private $user = 'root';
  private $pass = 'z%WA4747E*GW';

  public function connect() {
    try {
      $conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
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
  }
