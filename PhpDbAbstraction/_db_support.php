<?php
$db_name  = "test1";
$dsn      = "mysql:dbname=$db_name;host=127.0.0.1";
$user     = 'root';
$password = '4t74ygv6';
$db_pdo   = new PDO($dsn, $user, $password);

/* Database abstraction */
class Dbo {
	private $pdo;
	private $tblName = "";
	private $fields  = [];
	private $conditions  = [];
	private $sort_by_field  = [];

	private $prepared_query; 
	public function __construct(string $tblName = "") { global $db_pdo; $this->pdo = $db_pdo; $this->tblName = $tblName;}

	public function setTableName(string $tblName) { $this->tblName = $tblName; return $this; }

	public function addField(string $dbName, string $alias = "") { if (empty($alias)) $this->fields[] = $dbName; else $this->fields[$alias] = $dbName; return $this; }
	public function addFields(array $fields) { foreach ($fields as $field) $this->addField($field); return $this; }

	public function addCondition(string $sqlCondition) { $this->conditions[] = $sqlCondition; return $this; }

	public function addSortByCol(string $colName, string $direction = "ASC") { $this->sort_by_field[] = " $colName $direction "; return $this; }

	public function prepare_query()    {
		$sqlQuery = "SELECT ";
		/* 1. Add Fields */
		foreach($this->fields as $alias => $field) $cols[] =  " `$field` ". (is_int($alias)?"":" AS $alias ");
		if(empty($cols)) $sqlQuery .= " * ";
		else $sqlQuery .= implode(" , ", $cols);
	
		/* 2. Add Table Name */
		$sqlQuery .= " FROM `".$this->tblName."`";

		/* 3. Add Conditions */
		if (!empty($this->conditions)) $sqlQuery .= " WHERE ".implode(" AND ", $this->conditions);

		/* 4. Add SORT BY */
		if (!empty($this->sort_by_field)) $sqlQuery .= " ORDER BY ".implode(" , ", $this->sort_by_field);

	    /* 5. Run the query and check for errors */
	    $this->prepared_query = $this->pdo->prepare($sqlQuery);
	    if (!$this->prepared_query->execute()) {
			file_put_contents("php://stderr","Error when trying to execute query :\n$sqlQuery\n");
	    	throw new Exception(print_r($this->prepared_query->errorInfo(),1));
		}

	}
	public function fetchAll() {
		$this->prepare_query();
		return $this->prepared_query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function fetchList()   {
		$this->prepare_query();
		return $this->prepared_query->fetchAll(PDO::FETCH_COLUMN,0);
	}
}




