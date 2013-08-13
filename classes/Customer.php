<?php

class Customer extends ObjectModel
{

	protected $_id; 
	protected $_civilite = 'totp' ; 
	protected $_nom = 'totp';
	protected $_prenom= 'totp';
	protected $_telephone = 'totp'; 
	protected $_mail  = 'totp';
	
	 
	protected $_table = 'customer';
	
	protected $_date_add;
	
 
	
	protected $_className = 'customer';
	
	
	/** Tableau qui va servir dans la classe mere pour l'affichage d
		des champs
	**/
	protected $_fieldsTab 		= array('id', 'nom', 'prenom',        'telephone','mail', 'civilite', 'action');
	
	
	protected $_definitions = array('id', 'nom', 'prenom',   'telephone','mail','civilite' );
	
 
	
	 
	/**
		Getters
	**/
	
	public function getId(){return $this->_id;}
	
	public function getCivilite() {return $this->_civilite;	}
	
	public function getNom() { return $this->_nom; }
	
	public function getPrenom()	{return $this->_prenom;	}
	
	public function getTelephone(){return $this->_telephone;}
	
	public function getMail(){return $this->_mail;}
	
	  
	public function getDateAdd(){return $this->_date_add;}
	
	
	public function getTableName(){	return $this->_table;}
	public function getDefinitions(){	return $this->_definitions;}
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
	
	public function setTelephone($telephone)
	{
	
		if(!empty($telephone))
			$this->_telephone = $telephone;	
		 else $this->_error[] = 'Telephone Utilisateur invalide';
		
	}
	
	 
	
	
 
	
	public function setMail($mail)
	{
	
		if(ValidateCall::isEmail($mail))
		{
			$this->_mail = $mail;	
		}else
		{	
			$this->_error[] = '<span class="error">Mail Utilisateur non valide</span>';
		}
		
	}
	
	 
	
	public function setDateAdd($date_add)
	{
		$this->_date_add = $date_add;	
	}
	
	public function __construct()
	{
		// $this->_table = '';
	}
	
	// public function save()
	// {		
	
		// if(!empty($this->_id))
		// {
			// try{
			  // $sql = 'UPDATE user SET  civilite = "'.$this->_civilite.'", nom = "'.$this->_nom.'", prenom = "'.$this->_prenom.'", telephone ="'.$this->_telephone.'",  
			// mail = "'.$this->_mail.'",  
			 
			// date_add = NOW() WHERE id_user = '.$this->_id.'  ';
			// $count = $this->_connexion->handle()->exec($sql); 
			// return '<p>'.$count.'lignes inseré';
			// }
			// catch(PDOException $e)
			// {
				// return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			// }
		
		// }else{
	
			// try{
			    // $sql = 'INSERT INTO user (civilite, nom, prenom, telephone,   mail, date_add  
			  // )
				// VALUES ("'.$this->_civilite.'", "'.$this->_nom.'", "'.$this->_prenom.'", "'.$this->_telephone.'",  "'.$this->_mail.'",NOW()
			  // )  ';
			// $count = $this->_connexion->handle()->exec($sql); 
			
			// $iLastInsertId = $this->_connexion->handle()->lastInsertId();
			
			// return $iLastInsertId;
			// }
			// catch(PDOException $e)
			// {
				// return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			// }
		// }
	// }
	
	public static function getUserById($id)
	{
		try{
				$sql = 'SELECT * FROM user WHERE id_user = '.$id; 
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
	
	
	
	/**
		Retourne un objet
	**/
		
	public static function getUsers($deb = null, $fin = null)
	{
		try{
	 
			$sql = 'SELECT * FROM user WHERE active = 1 '.$re = (!empty($fin)) ? ' LIMIT '.$deb.','.$fin.'' : ''; 
			$prep = Db::getInstance()->handle()->prepare($sql);  
			$prep->execute(); 
			$resultats = $prep->fetchAll();
			
			return $resultats;
			 
		}
		catch(PDOException $e)
		{
			return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
		}
	
	}
	/**
	
		Retourne le client par son numero de telephone
	
	**/
	
	public function getUSerByPhone($telephone)
	{
		try{
				$sql = 'SELECT * FROM user WHERE telephone = "'.$telephone.'"'; 
				$prep = $this->_connexion->handle()->prepare($sql);  
				$prep->execute(); 
				$resultats = $prep->fetch(PDO::FETCH_OBJ);
				
				
				return $resultats;
				 
			}
			catch(PDOException $e)
			{
				return die('<p>Erreur lors de la selection : '.$e->getMessage().'</p>');
			}
		
	}
	
	/**
		Retourne les  utilisateur en fonction du nom
	**/
	
 	public function getUserByName($nom)
	{
		try{
				$sql = 'SELECT * FROM user WHERE nom LIKE \'%'.$nom.'%\' GROUP BY nom'; 
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
	
	
	 
}
