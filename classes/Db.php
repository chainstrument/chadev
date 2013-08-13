<?php

class Db
{

	protected $_host;
	protected $_dbname;
	protected $_user;
	protected $_password;
 
	protected $_connexion;
	protected $_handle;
 
	public static $_instance = null;

	public function __construct($server = null, $name = null, $user = null, $password = null)
	{ 
		$this->_host = ($server) ? $server : _DB_SERVER_ ;
		$this->_dbname = ($name) ? $name:  _DB_NAME_ ;
		$this->_user = ($user) ? $user : _DB_USER_ ;
		$this->_password = ($password) ? $password : _DB_PASSWORD_;
		
		
		try {
			$this->_handle = new PDO("mysql:host=$this->_host;dbname=$this->_dbname", $this->_user, $this->_password);
			$this->_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo 'Connection established and database "' . $this->_dbname . '" selected.';
		} catch (PDOException $e) {
			die('Connection failed or database cannot be selected : ' . $e->getMessage());
		}
 
	}

	public static function getInstance()
	{
	
		if(is_null(self::$_instance))
			return new self();
		else return self::$_instance;
	
	}

	public function select($sql)
	{
		try{ 
				$prep = $this->_handle->prepare($sql);  
				$prep->execute();
			}
			catch(PDOException $e)
			{
				return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
			}
	}
	
	public function update($sql)
	{
		try{
				$prep = $this->_handle->prepare($sql);  
				$prep->execute();
			}
			catch(PDOException $e)
			{
				return die('<p>Erreur lors de la mise a jour : '.$e->getMessage().'</p>');
			}
	}

	public function delete($sql)
	{
		try{
				$prep = $this->_handle->prepare($sql);   
				$prep->execute();
			}
			catch(PDOException $e)
			{
				return die('<p>Erreur durant la suppression : '.$e->getMessage().'</p>');
			}
	}

	public function insert($sql)
	{
		try{
				$prep = $this->_handle->prepare($sql);  
				$prep->execute();
			}
			catch(PDOException $e)
			{
				return die('<p>Erreur durant l\'insertion : '.$e->getMessage().'</p>');
			}
	}











}