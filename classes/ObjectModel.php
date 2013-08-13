<?php

abstract class ObjectModel{

	 
	
	public $fieldsValidate;
	 
	
	public function __construct()
	{
		
	}
	
	abstract public function getTableName();
	abstract public function getDefinitions();
		// protected $_table = 'customer';
	public function save()
	{
		// d($this->_table);
		$sqlValues = '';
	
		if($this->_id){
		$sql = 'INSERT INTO '.$this->_table.' SET ('.rtrim(implode( ',', $this->_definitions), ',').') VALUES (';
			foreach($this->_definitions as $element)
			{
				$method_name = 'get'.ucfirst($element);
				// d($method_name);
				if(method_exists($this, $method_name ))
					$sqlValues .=  '"'.call_user_func(array($this, $method_name)).'", ';
				else throw new Exception('Invalid argument : '. $element);
				
			}
				// d($sqlValues);
			$sql .= trim($sqlValues,', ').');';
		}else{
		
			$sql = 'UPDATE '.$this->_table.' SET '; 
							foreach($this->_definitions as $element)
								$sqlValues .=  $element.' = '.call_user_func(array($this, 'get'.ucfirst($element))).', ';
			
			$sql = substr($sql, 0, -2);
			 $sql .= ' WHERE id = '.$this->_id;
			
		}
			d($sql);
			
		Db::getInstance()->execute($sql);
	}
	
	public function select()
	{
		try{
				$sql = 'SELECT * FROM '.$this->_table.' WHERE id_user = '.$id; 
				$prep = Db::getInstance()->handle()->prepare($sql);  
				$prep->execute(); 
				$resultats = $prep->fetch();
				
				return $resultats;	
			}
			catch(PDOException $e)
			{
				return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
			}
	}
	
	// public function __call()
	// {
		
	// }
	
	public function getFieldsFormat()
	{
		
	}
	
	




}