<?php

class Demarrage extends ObjectModel
{

	protected $_id; 
	protected $_id_client ; 
	protected $_id_site ; 
	protected $_id_offre_gestion;
	protected $_install_boutique = 'non';
	protected $_install_theme = 'non';
	protected $_install_SEO = 'non';
	protected $_install_CGV = 'non';
	protected $_install_module_paiement = 'non';
	protected $_date_add;
 
	
	// va contenir la connexion
	protected $_connexion;
	
	protected $_className = 'demarrage';
	
	
	/** Tableau qui va servir dans la classe mere pour l'affichage d
		des champs
	**/
	// protected $_fieldsTab 		= array('id',      'civilite', 'nom', 'prenom', 'telephone', 'mail', 'site', 'action');
	
	
	// protected $_fieldsCenterTab = array('civilite', 'nom', 'prenom', 'telephone', 'mail', 'site');
	
 
	
	public function __construct()
	{
		$this->_connexion = Db::getInstance();
		// var_dump($connexion);
	}
	/**
		Getters
	**/
	
	public function getId()	{ return $this->_id;}
	
	public function getIdClient() {	return $this->_id_client;}
	
	public function getIdSite()
	{
		return $this->_id_site;	
	}
	
		public function getIdOffreGestion()
	{
		return $this->_id_offre_gestion;	
	}
	
	
	public function getInstallBoutique()
	{
		return $this->_install_boutique;	
	}
	
	public function getInstallTheme()
	{
		return $this->_install_theme;	
	}
	
	public function getInstallSEO()
	{
		return $this->_install_SEO;	
	}
	
	public function getInstallCGV()
	{
		return $this->_install_CGV;	
	}
	
	public function getInstallModulePaiement()
	{
		return $this->_install_module_paiement;	
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
	
	public function setIdSite($id_site)
	{
		 $this->_id_site = $id_site;	
	}
	
	public function setIdOffreGestion($id_offre_gestion)
	{
		 $this->_id_offre_gestion = $id_offre_gestion;	
	}
	
	
	
	public function setInstallBoutique($install_boutique)
	{
		 $this->_install_boutique = $install_boutique;	
	}
	
	public function setInstallTheme($install_theme)
	{
		$this->_install_theme = $install_theme;	
	}
	
	
	public function setInstallSEO($install_SEO)
	{
		$this->_install_SEO = $install_SEO;	
	}
	
	public function setInstallCGV($install_CGV)
	{
		$this->_install_CGV = $install_CGV;	
	}
	
	
	public function setInstallModulePaiement($install_module_paiement)
	{
		$this->_install_module_paiement = $install_module_paiement;	
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
			$sql = 'UPDATE demarrage SET  
			id_client = "'.$this->_id_client.'", 
			id_site = "'.$this->_id_site.'",
			id_offre_gestion = "'.$this->_id_offre_gestion.'",
			install_boutique = "'.$this->_install_boutique.'",
			install_theme = "'.$this->_install_theme.'",
			install_SEO = "'.$this->_install_SEO.'" ,
			install_CGV ="'.$this->_install_CGV.'",
			install_module_paiement ="'.$this->_install_module_paiement.'", 
			 
			 
			date_add = "'.$this->_date_add.'" WHERE id_demarrage = '.$this->_id.'  ';
			$count = $this->_connexion->handle()->exec($sql); 
			return '<p>'.$count.'lignes inseré';
			}
			catch(PDOException $e)
			{
				return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			}
		
		}else{
	
			try{
			 $sql = 'INSERT INTO demarrage (id_client, id_site, id_offre_gestion, install_boutique, install_theme, install_SEO, install_CGV,
			 install_module_paiement, date_add)
				VALUES ("'.$this->_id_client.'", "'.$this->_id_site.'", "'.$this->_id_offre_gestion.'","'.$this->_install_boutique.'", "'.$this->_install_theme.'", 
				 "'.$this->_install_SEO.'",  "'.$this->_install_CGV.'",  "'.$this->_install_module_paiement.'", 
				 "'.$this->_date_add.'" )  ';
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
	
	public function getDemarrageById($id)
	{
		try{
				$sql = 'SELECT * FROM demarrage WHERE id_demarrage = '.$id; 
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
	
	public function getDemarrageByIdCustomer($id_client)
	{
		try{
				$sql = 'SELECT * FROM demarrage WHERE id_client = '.$id_client.' and active = 1'; 
				$prep = $this->_connexion->handle()->prepare($sql);  
				$prep->execute(); 
				$resultats = $prep->fetchAll();
				
				return $resultats;	
			}
			catch(PDOException $e)
			{
				return false;
			}
		
	}
	
	
	/**
		Retourne un objet
	**/
		
	public function getDemarrages($deb = null, $fin = null)
	{
		try{
	 
			$sql = 'SELECT * FROM demarrage '.$re = (!empty($fin)) ? ' LIMIT '.$deb.','.$fin.'' : '';
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
	 
	/*
		Creer une offre support essentiel pour le client et enregistre le pack de demarrage
		
	*/
 	public function createPackDemmarrage($id_offre = 12)
	{
			$boolTest = false;
	
			$gestionOffre = new GestionOffre();
			$gestionOffre->setIdOffre($id_offre);
			$gestionOffre->setIdUser($this->_id_client);
			$gestionOffre->setNomOffre("plan de support essentiel");
			$gestionOffre->setDatePriseOffre($this->_date_add);

			if($gestionOffre->save())
				 $boolTest =  true;
			
			if($boolTest == true)
				$boolTest = $this->save();
				
			if($boolTest == true)
				return 'Pack de demarrage enregistre';
			else return 'Pack de demarrage non enregistre';
			
		
	
		
		
	}
	
	
	 
}
