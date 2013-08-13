<?php

class Employee extends ObjectModel
{

	protected $_id ;
	protected $_civilite ;
	protected $_nom ;
	protected $_prenom;
	protected $_password;
	protected $_droit;
	protected $_signaturename;
	protected $_mail;
	protected $_active = 1;
	protected $_date_add;
	
	protected $_repertoiredestination;
	protected $_nomdestination;
	
	protected $_className = 'employee';
	
	/** Tableau qui va servir dans la classe mere pour l'affichage 
		des champs
	**/
	protected $_fieldsTab = array('id', 'nom', 'prenom', 'mail', 'droit', 'action');
	
	
	protected $_fieldsCenterTab = array(  'nom', 'prenom', 'mail', 'droit');
	
	// va contenir la connexion
	protected $_connexion;
	
	public function __construct()
	{
		$this->_connexion = Db::getInstance();
		// var_dump($connexion);
	}
	/**
		Getters
	**/
	
	public function getId()
	{
		return $this->_id;	
	}
	
	
	public function getNom()
	{
		return $this->_nom;	
	}
	
	public function getCivilite()
	{
		return $this->_nom;	
	}
	
	public function getPrenom()
	{
		return $this->_prenom;	
	}
	
	public function getMail()
	{
		return $this->_mail;	
	}
	
	public function getPassword()
	{
		return $this->_password;	
	}
	
	public function getDroit()
	{
		return $this->_droit;	
	}
	
	public function getSignaturename()
	{
		return $this->_signaturename;	
	}
	
	public function getRepertoiredestination()
	{
		return $this->_repertoiredestination;	
	}
	
	public function getNomdestination()
	{
		return $this->_nomDestination;
	}
	
	public function getDateAdd()
	{
		return $this->_date_add;	
	}
	public function getActive()
	{
		return $this->_active;	
	}
	
	
	/**
		Setters
	**/
	
	public function setId($id)
	{
		$this->_id = $id;	
	}
	
	public function setCivilite($civilite)
	{
		$this->_civilite = $civilite;
	}
	
	public function setNom($nom)
	{
		$this->_nom = $nom;	
	}
	
	public function setPrenom($prenom)
	{
		$this->_prenom = $prenom;	
	}
	
	public function setDroit($droit)
	{
		  $this->_droit = $droit;	
	}
	
	public function setActive($active)
	{
		  $this->_active = $active;	
	}
	
	public function setRepertoiredestination($repertoiredest)
	{
		  $this->_repertoiredestination = $repertoiredest;	
	}
	
	public function setNomdestination($nomdest)
	{
		  $this->_nomdestination = $nomdest;	
	}
	public function setMail($mail)
	{
	
		if(ValidateCall::isEmail($mail))
		{
			$this->_mail = $mail;	
		}else
		{	
			$this->_error[] = '<span class="error">Mail non valide</span>';
		}
		
	}
	
	public function setPassword($password)
	{
		$this->_password = $password;
	}
	
	public function setSignaturename($signaturename)
	{
		 
		if(ToolsCall::uploadFile($this->_repertoiredestination, $this->_nomdestination ) ==! true){
			$this->_error[] = '<span class="error">'.ToolsCall::uploadFile($this->_repertoiredestination, $this->_nomdestination ).'</span>';
		}else{
			$this->_signaturename = $signaturename;
		}
	}
	
	public function setDateAdd($dateAdd)
	{
		  $this->_date_add = $dateAdd;	
	}
	
	
	
	
	
	public function save()
	{	
		if(!empty($this->_id))
		{
			try{
			$sql = 'UPDATE employee SET civilite = "'.$this->_civilite.'", nom = "'.$this->_nom.'",  prenom = "'.$this->_prenom.'", 
			droit = "'.$this->_droit.'", mail = "'.$this->_mail.'" , password = "'.$this->_password.'", signaturename = "'.$this->_signaturename.'", active = "'.$this->_active.'",
			date_add = NOW() WHERE id_employee = '.$this->_id.'  ';
			$count = $this->_connexion->handle()->exec($sql); 
			return '<p>'.$count.'lignes inseré';
			}
			catch(PDOException $e)
			{
				return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			}
		
		}else{	
	
		try{
			$sql = 'INSERT INTO employee (civilite, nom, prenom, droit, signaturename, mail, password, active, date_add)
				VALUES ("'.$this->_civilite.'", "'.$this->_nom.'", "'.$this->_prenom.'", "'.$this->_droit.'", "'.$this->_signaturename.'", "'.$this->_mail.'" , "'.$this->_password.'", "'.$this->_active.'", NOW() ) ';
			echo $count = $this->_connexion->handle()->exec($sql); 
			return '<p>'.$count.'lignes inseré';
		}
		catch(PDOException $e)
		{
			return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
		}
		}
	}
	
	public function getEmployeeById($id)
	{
		try{
			$sql = 'SELECT * FROM employee WHERE id_employee = '.$id; 
			$prep = $this->_connexion->handle()->prepare($sql);  
			$prep->execute(); 
			$resultats = $prep->fetch();
			
			
			return $resultats;
			 
		}
		catch(PDOException $e)
		{
			return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
		}
	
	}
	
	
	public function getEmployeeByEmail($mail)
	{
		try{
			$sql = 'SELECT * FROM employee WHERE mail = "'.$mail.'"'; 
			$prep = $this->_connexion->handle()->prepare($sql);  
			$prep->execute(); 
			$resultats = $prep->fetchAll(PDO::FETCH_OBJ);
			
			
			return $resultats;
			 
		}
		catch(PDOException $e)
		{
			return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
		}
	
	}
	
	
	/**
		Retourne un objet
	**/
		
	public function getEmployees($deb = null, $fin = null)
	{
		try{
		
			$sql = 'SELECT * FROM employee WHERE active = 1 '.$re = (!empty($fin)) ? ' LIMIT '.$deb.','.$fin.'' : ''; 
			$prep = $this->_connexion->handle()->prepare($sql);  
			$prep->execute(); 
			$resultats = $prep->fetchAll();
			
			return $resultats;
			 
		}
		catch(PDOException $e)
		{
			return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
		}
	
	}
	
	
	public function getEmployeeForConnection($mail = null, $password = null)
	{
		
		try{
			$sql = 'SELECT * FROM employee WHERE mail = "'.$mail.'" AND password = "'.$password.'"'; 
			$prep = $this->_connexion->handle()->prepare($sql);  
			$prep->execute(); 
			$resultats = $prep->fetch(PDO::FETCH_ASSOC);
			
			return $resultats;
			 
		}
		catch(PDOException $e)
		{
			return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
		}
	
	}
	
	public function getLastInsertId()
	{
			try{
				$prep = $this->_connexion->handle()->prepare('SELECT MAX(id_employee) as id FROM employee');
				$prep->execute();
				 $resultat = $prep->fetch(PDO::FETCH_ASSOC);
				return $resultat['id'];
			}
			catch(PDOException $e)
			{
				return '<p>Erreur  : '.$e->getMessage().'</p>';
			}
	
	
	}
	
	 
}
