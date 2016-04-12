<?php


class DBModel {
	public  static $tablename;
	protected static $db;
	public static $pk = 'id';
	private $reflection;

	public static function initDB($config = array()){
		$dns =  	$config['DB_ENGINE'].':dbname='.$config['DB_NAME'].';host='.$config['DB_HOST'];
		self::$db = new PDO($dns,$config['DB_USERNAME'],$config["DB_PASSWORD"]);
	}
		
	function __construct() {
		$this->reflection = new ReflectionClass($this);

	}
	
	protected function setFieldProperty($field,$property,$value){
		
		$this->fields[$field][$property] = $value;
	}
	
	public static function get($id)
	{
		if (is_null(self::$tablename)){
			self::$tablename = get_called_class();
		}

		$query = 'SELECT * FROM '.strtolower(self::$tablename).' WHERE '.self::$pk.' = :id';
		$stmt = self::$db->prepare($query);
		$stmt->bindParam(':id', $id);
		if($stmt->execute()){
			$data = $stmt->fetch();
			$className = get_called_class();
			$dataset = new $className();
			foreach($data as $key => $val){
				$dataset->$key = $val;
			}
			return $dataset;
		}
		
	}
	
	private function validate($list)
	{
		foreach ($list as $key => $val){
			if(!$val->isStatic()){
				$name = $val->getName();
				echo "name = $name <br />";
				print_r($this->fields[$name]);
				if (isset($this->fields[$name]["required"]) && $this->fields[$name]["required"]
						&& is_null($this->$name))
					throw new Exception("The field $name can't be null.");
				elseif (isset($this->fields[$name]["type"])
						&& $this->fields[$name]["type"] != gettype($this->$name))
					throw new Exception("The field $name has to be of type ".$this->fields[$name]["type"]);
				
			}
		}	
	}
	
	public function save(){
		$className = get_called_class();
		$list = $this->reflection->getProperties();
		$tdblName = self::$tablename;
		$this->validate($list);
		if (is_null($this->{self::$pk})){
			$fields = "";
			$values = "";
			foreach ($list as $key => $val){
				if(!$val->isStatic()){
					$fields.= "`".$val->getName()."`,";
					$values.= ":".$val->getName().",";
				}
			}
			$fields = rtrim($fields,',');
			$values = rtrim($values,',');
			$query = "INSERT INTO $tdblName ($fields) VALUES($values);";
			echo $query;
			$stmt = self::$db->prepare($query);
			
			foreach ($list as $key => $val){
				if(!$val->isStatic()){
					$stmt->bindParam(":".$key, $val);
				}
			}
			//$stmt->execute();
			

			
			//$stmt->bindParam(':id', $id);
		}else{
			$fields = "";
			$values = "";
			foreach ($list as $key => $val){
				if(!$val->isStatic()){
					$fields.= "`".$val->getName()."` = :".$val->getName().",";
				}
			}
			$fields = rtrim($fields,',');
			$values = rtrim($values,',');
			$pk = self::$pk;
			$query = "UPDATE $tdblName SET {$fields} WHERE $pk = :id";
			echo $query;
			$stmt = self::$db->prepare($query);
			$stmt->bindParam(":id",$this->{self::$pk});
			foreach ($list as $key => $val){
				$stmt->bindParam(":".$key, $val);
			}
			//$stmt->execute();
		}
		
	}
	
	public function __set($property,$value){
		if (property_exists($this, $property))
			$this->$property = $value;
	}
	
	public static function all(){
		if (is_null(self::$tablename)){
			self::$tablename = get_called_class();
		}

		$query = 'SELECT * FROM '.strtolower(self::$tablename).'';
		
		$result = [];
		$className = get_called_class();
		foreach(self::$db->query($query) as $data){
			$dataset = new $className();
			foreach($data as $key => $val){
				$dataset->$key = $val;
			}
			$result[] = $dataset;
		}	
		return $result;
	}
}
