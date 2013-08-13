<?php

class Site extends ObjectModel
{

	protected $_id; 
	protected $_id_client ; 
	protected $_url ;
 
	
	protected $_urlbo; 
	protected $_loginbo; 
	protected $_passwordbo;
	
	protected $_hoteftp;
	protected $_identifiantftp;
	protected $_passwordftp;
	
	protected $_serveur;
	protected $_identifiantserveur;
	protected $_passwordserveur;
	
	protected $_lienbdd;
	protected $_identifiantbdd; 
	protected $_passwordbdd;
	
	protected $_date_add;
	
	// va contenir la connexion
	protected $_connexion;
	
	protected $_className = 'site';
	
	
	/** Tableau qui va servir dans la classe mere pour l'affichage d
		des champs
	**/
	protected $_fieldsTab 		= array('id',      'civilite', 'nom', 'prenom', 'telephone', 'mail', 'site', 'action');
	
	
	protected $_fieldsCenterTab = array('civilite', 'nom', 'prenom', 'telephone', 'mail', 'site');
	
 
	
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
	
	public function getIdClient()
	{
		return $this->_id_client;	
	}
	
	public function getUrl()
	{
		return $this->_nom;	
	}
	
	 
	
	//BO
	public function getUrlbo()
	{
		return $this->_urlbo;	
	}
	
	public function getLoginbo()
	{
		return $this->_loginbo;	
	}
	
	public function getPasswordbo()
	{
		return $this->_passwordbo;
	}
	
	//ftp
	public function getHoteftp()
	{
		return $this->_hoteftp;	
	}
	
	public function getIdentifiantftp()
	{
		return $this->_identifiantftp;	
	}
	
	public function getPassworftp()
	{
		return $this->_passwordftp;
	}
	
	//Serveur
	public function getServeur()
	{
		return $this->_serveur;	
	}
	
	public function getIdentifiantserveur()
	{
		return $this->_identifiantserveur;	
	}
	
	public function getPasswordserveur()
	{
		return $this->_passwordserveur;
	}
	
	//bdd
	public function getLienbdd()
	{
		return $this->_lienbdd;	
	}
	
	public function getIdentifiantbdd()
	{
		return $this->_identifiantbdd;	
	}
	
	public function getPasswordbdd()
	{
		return $this->_passwordbdd;	
	}
	
	public function getDateAdd()
	{
		return $this->_date_add;	
	}
	
	 
	/**
		Setters
	**/
	
	 
	public function setId($id)
	{
		 $this->_id = $id;	
	}
	
	public function setIdClient($id_client)
	{
		 $this->_id_client = $id_client;	
	}
	
	public function setUrl($url)
	{
		 $this->_url = $url;	
	}
	
	 
	//BO
	public function setUrlbo($urlbo)
	{
		$this->_urlbo = $urlbo;	
	}
	
	public function setLoginbo($loginbo)
	{
		$this->_loginbo = $loginbo;	
	}
	
	public function setPasswordbo($passwordbo)
	{
		$this->_passwordbo = $passwordbo;	
	}
	
	 //ftp
	public function setHoteftp($hoteftp)
	{
		$this->_hoteftp = $hoteftp;	
	}
	
	public function setIdentifiantftp($identifiantftp)
	{
		$this->_identifiantftp = $identifiantftp;	
	}
	
	public function setPasswordftp($passwordftp)
	{
		$this->_passwordftp = $passwordftp;	
	}
	
	
	// serveur
	public function setServeur($serveur)
	{
		$this->_serveur = $serveur;	
	}
	
	public function setidentifiantserveur($identifiantserveur)
	{
		$this->_identifiantserveur = $identifiantserveur;	
	}
	
	public function setPasswordserveur($passwordserveur)
	{
		$this->_passwordserveur = $passwordserveur;	
	}
	
	//Bdd
	public function setLienbdd($lienbdd)
	{
		$this->_lienbdd = $lienbdd;	
	}
	
	public function setIdentifiantbdd($identifiantbdd)
	{
		$this->_identifiantbdd = $identifiantbdd;	
	}
	
	public function setPasswordbdd($passwordbdd)
	{
		$this->_passwordbdd = $passwordbdd;	
	}
	
	
	public function setDateAdd($date_add)
	{
		$this->_date_add = $date_add;	
	}
	
	
	public function save()
	{		
	
		if(!empty($this->_id))
		{
			try{
			$sql = 'UPDATE site SET  id_client = "'.$this->_id_client.'", url = "'.$this->_url.'", 
			urlbo = "'.$this->_urlbo.'", loginbo = "'.$this->_loginbo.'", passwordbo = "'.$this->_passwordbo.'", 
			hoteftp = "'.$this->_hoteftp.'",
			identifiantftp = "'.$this->_identifiantftp.'",
			passwordftp = "'.$this->_passwordftp.'",
			serveur = "'.$this->_serveur.'",
			identifiantserveur = "'.$this->_identifiantserveur.'",
			passwordserveur = "'.$this->_passwordserveur.'",
			lienbdd = "'.$this->_lienbdd.'",
			identifiantbdd= "'.$this->_identifiantbdd.'",
			passwordbdd = "'.$this->_passwordbdd.'",
			 
			date_add = NOW() WHERE id_site = '.$this->_id.'  ';
			$count = $this->_connexion->handle()->exec($sql); 
			return '<p>'.$count.'lignes inseré';
			}
			catch(PDOException $e)
			{
				return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			}
		
		}else{
	
			try{
			    $sql = 'INSERT INTO site (id_client, url,   urlbo, loginbo, passwordbo, hoteftp, identifiantftp,
			  passwordftp, serveur, identifiantserveur, passwordserveur, lienbdd, identifiantbdd, passwordbdd, date_add
			  )
				VALUES ("'.$this->_id_client.'", "'.$this->_url.'", 
			 "'.$this->_urlbo.'", "'.$this->_loginbo.'", "'.$this->_passwordbo.'", "'.$this->_hoteftp.'", "'.$this->_identifiantftp.'", "'.$this->_passwordftp.'",
			  "'.$this->_serveur.'", "'.$this->_identifiantserveur.'",  "'.$this->_passwordserveur.'", "'.$this->_lienbdd.'",
			 "'.$this->_identifiantbdd.'", "'.$this->_passwordbdd.'", NOW() )  ';
			$count = $this->_connexion->handle()->exec($sql); 
			
			$iLastInsertId = $this->_connexion->handle()->lastInsertId();
			
			return $iLastInsertId;
			}
			catch(PDOException $e)
			{
				return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			}
		}
	}
	
	
 
	
	public function getSiteById($id)
	{
		try{
				$sql = 'SELECT * FROM site WHERE id_site = '.$id; 
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
	
	
	
	/**
		Retourne tous les sites
	**/
		
	public function getSites($deb = null, $fin = null)
	{
		try{
	 
			$sql = 'SELECT * FROM site '.$re = (!empty($fin)) ? ' LIMIT '.$deb.','.$fin.'' : ''; 
			$sql .= 'AND active = 1';
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
 
	
	/**
		Retourne les  site d'un utilisateur en fonction de l'id
	**/
	
 	public function getSiteByIdUser($id)
	{
		try{
				$sql = 'SELECT * FROM site WHERE id_client = '.$id.' AND active = 1'; 
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
