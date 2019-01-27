<?php

class SSQL
{
	private $SQLhandle;
	private $error;
	public $row_num=0;
	public $column_num=0;
	public $columnnames;
	public $datatable;
	public $sql;
	public $affected_rows;
	/*
	ERROR CODE:
	0x0000 Construct error, number of arguments error.
	0x0001 Database connect error.
	0x0002 Query error.

	*/
	function __destruct(){
		if($this->SQLhandle!=NULL){
			$this->SQLhandle->close();
		}
	}
	function __construct()
	{
		if(func_num_args()==4){
			$varArray = func_get_args();
			$this->connect($varArray[0],$varArray[1],$varArray[2],$varArray[3]);
		}
		elseif (func_num_args()==1)
		{
			$varArray = func_get_args();
			$mysqlconfig=fopen($varArray[0],"r");
			$mysqlconf=array();
			for ($i=0; $i < 4 && (!feof($mysqlconfig)); $i++)
			{ 
				$mysqlconf[$i]=fgets($mysqlconfig);
			};

			if(sizeof($mysqlconf)!=4)
			{
				echo sizeof($mysqlconf);
				$this->error="0x0000 Number of arguments error";
				return false;
			};
			for ($i=0; $i < 3; $i++) { 
				$mysqlconf[$i]=substr($mysqlconf[$i],0,strlen($mysqlconf[$i])-2);
			}
			$this->connect($mysqlconf[0],$mysqlconf[1],$mysqlconf[2],$mysqlconf[3]);
			fclose($mysqlconfig);
		}
		else
		{
			$this->error="0x0000 Number of arguments error";
			return false;
		}
	}

	//PUBLIC FUNCTIONS
	public function query()
	{
		try{
			$this->affected_rows=0;
			$this->error="";
			$this->row_num=0;
			$this->column_num=0;
			$this->sql="";
			if (func_num_args()==1) {
				$varArray = func_get_args();
				$this->sql=$varArray[0];
			}
			elseif (func_num_args()>=3) {
				$varArray = func_get_args();
				$this->sql=$varArray[0];
				$sqltype=$varArray[1];
				for ($i=2; $i < func_num_args(); $i++) { 
					$param[$i-2]=$varArray[$i];
				}
			}
			else{
				$this->error="0x00020 UNKNOW SQL";
				return false;
			}
			if(!isset($sqltype)){
				$result = $this->SQLhandle->query($this->sql);
				if($this->SQLhandle->error){
					$this->error="0x00021 ".$this->SQLhandle->error;
				}
				else{
					if(stripos($this->sql,"SELECT")===false){
						$this->affected_rows=$this->SQLhandle->affected_rows;
					}
					else{
						$this->error="";
						$this->column_num=$result->field_count;
						$this->row_num=$result->num_rows;
						$fields = $result->fetch_fields();
						for ($j=0; $j < $this->column_num; $j++) {
							$this->columnnames[$j]=$fields[$j]->name;
						}
						unset($this->datatable);
						$this->datatable=array();
						for ($i=0; $i < $this->row_num; $i++) {
							$row = $result->fetch_row();
							for ($j=0; $j < $this->column_num; $j++) {
								$this->datatable[$i][$this->columnnames[$j]]=$row[$j];
								$this->datatable[$i][$j]=$row[$j];
							}
						}
						$result ->close();
					}
				}
			}
			else{
				if(!$stmt = $this->SQLhandle->prepare($this->sql)){
					$this->error="0x00022 ".$this->SQLhandle->error;
					die($this->SQLhandle->error);
					return false;
				}
				$onlyinclude=true;
				for ($i=0; $i < strlen($sqltype) ; $i++) { 
					if(substr($sqltype,$i,1)!="i"  & substr($sqltype,$i,1)!="d"  & substr($sqltype,$i,1)!="s"  & substr($sqltype,$i,1)!="b"){
						$onlyinclude=false;
					}
				}
				if(!$onlyinclude){
					$this->error="0x00023 ".$this->SQLhandle->error;
					return false;
				}

				array_unshift($param, $sqltype);
				call_user_func_array(array($stmt, "bind_param"),$this->refValues($param));
				if(!$stmt->execute()){
					$this->error="0x00024 ".$stmt->error;
					return false;
				}
				
				$this->error="";
				if(stripos($this->sql,"SELECT")===0){
					$stmt->store_result();
					$this->row_num=$stmt->num_rows;
					$this->column_num=$stmt->field_count;
					$meta = $stmt->result_metadata();
					$row=array();
					for ($i=0; $i < $this->column_num; $i++) { 
						$field = $meta->fetch_field();
						$this->columnnames[$i] = $field->name;
						$row[] = &$data[$field->name];
					}
					if($this->row_num==0){
						return true;
					}
					call_user_func_array(array($stmt, 'bind_result'), $row);

					unset($this->datatable);
					$this->datatable=array();
					for ($i=0; $i < $this->row_num; $i++) {
						$stmt->fetch();
						for ($j=0; $j < $this->column_num; $j++) {
							$this->datatable[$i][$this->columnnames[$j]]=$row[$j];
							$this->datatable[$i][$j]=$row[$j];
						}
					}

				}
				else{
					$this->affected_rows=$stmt->affected_rows;
				}
				if (isset($result)) {
					$result ->close();
				}
			}
		}
		catch(Exception $e)
		{
			$this->error="0x00025 ".$e->getMessage();
		}
	}

	public function reconnect()
	{
		if($this->SQLhandle!=NULL){
			$this->SQLhandle->close();
		}
		if(func_num_args()!=4){
			$this->error="0x0000";
			return false;
		}
		$varArray = func_get_args();
		$this->connect($varArray[0],$varArray[1],$varArray[2],$varArray[3]);
	}

	public function error($detial=FALSE)
	{
		if($this->error==""){
			return null;
		}
		else{
			if($detial)
				return $this->error;
			else
			{
				return substr($this->error,0,stripos($this->error, " "));
			}
		}
	}
	public function set_charset($charset)
	{
		$this->SQLhandle->set_charset($charset);
	}



	//PRIVATE FUNCTIONS
	private function connect($add, $usn, $pwd, $schema)
	{
		$mysqli = new mysqli($add, $usn, $pwd, $schema);
		if (mysqli_connect_error()) {
			$this->error="0x0001 ".mysqli_connect_error();
			$this->SQLhandle=NULL;
		}
		else{
			$this->error="";
			$this->SQLhandle = $mysqli;
			$mysqli->query("SET NAMES utf8");
			$mysqli->set_charset("utf-8");
		}
	}
	private function refValues($arr){ 
		if (strnatcmp(phpversion(),'5.3') >= 0){ 
			$refs = array(); 
			foreach($arr as $key => $value) 
				$refs[$key] = &$arr[$key]; 
			return $refs; 
		} 
    	return $arr;
	}
	public function insertid(){
		return mysqli_insert_id($this->SQLhandle);
	}
}
?>