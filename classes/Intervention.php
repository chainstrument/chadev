<?php

class Intervention extends ObjectModel
{

	protected $_id; 
	protected $_id_offre ; 
	protected $_id_gestion_offre ; 
	protected $_id_user;
	protected $_id_employee;
	protected $_id_site;
	protected $_duree;
	protected $_commentaire;
	protected $_date_debut;
	protected $_date_fin;
	protected $_date_add;
 
	
	// va contenir la connexion
	protected $_connexion;
	
	protected $_className = 'intervention';
	
	
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
	
	 
	
	public function getIdOffre()
	{
		return $this->_id_offre;	
	}
	
	public function getIdGestionOffre()
	{
		return $this->_id_gestion_offre;	
	}
	
	public function getIdUser()
	{
		return $this->_id_user;	
	}
	
	public function getIdEmployee()
	{
		return $this->_id_employee;	
	}
	
	public function getIdSite()
	{
		return $this->_id_site;	
	}
	
	public function getDuree()
	{
		return $this->_duree;
	}
	
	public function getCommentaire()
	{
		return $this->_commentaire;	
	}
	
	
	public function getDateDebut()
	{
		return $this->_date_debut;	
	}
	
	 
	public function getDateFin()
	{
		return $this->_date_fin;	
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
	
	public function setIdOffre($id_offre)
	{
		 $this->_id_offre = $id_offre;	
	}
	
	public function setIdGestionOffre($id_gestion_offre)
	{
		 $this->_id_gestion_offre = $id_gestion_offre;	
	}
	
	public function setIdUser($id_user)
	{
		 $this->_id_user = $id_user;	
	}
	
	public function setIdEmployee($id_employee)
	{
		$this->_id_employee = $id_employee;	
	}
	
	public function setIdSite($id_site)
	{
		$this->_id_site = $id_site;	
	}
	
	public function setDuree($duree)
	{
			$this->_duree = $duree;	
		
	}
	
	public function setCommentaire($commentaire)
	{
		$this->_commentaire = addslashes($commentaire);
	}
	
	public function setDateDebut($date_debut)
	{
		$this->_date_debut = $date_debut;	
	}
	
	public function setDateFin($date_fin)
	{
		$this->_date_fin = $date_fin;	
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
			$sql = 'UPDATE intervention SET  id_offre = "'.$this->_id_offre.'",id_gestion_offre = "'.$this->_id_gestion_offre.'", id_user = "'.$this->_id_user.'", id_employee = "'.$this->_id_employee.'", id_site = "'.$this->_id_site.'",duree ="'.$this->_duree.'",  commentaire ="'.$this->_commentaire.'", date_debut ="'.$this->_date_debut.'",
			date_fin = "'.$this->_date_fin.'" ,
			 
			date_add = NOW() WHERE id_intervention = '.$this->_id.'  ';
			$count = $this->_connexion->handle()->exec($sql); 
			return '<p>'.$count.'lignes inseré';
			}
			catch(PDOException $e)
			{
				return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			}
		
		}else{
	
			try{
			 $sql = 'INSERT INTO intervention (id_offre, id_gestion_offre, id_user, id_employee, id_site, duree, commentaire, date_debut, date_fin, date_add)
				VALUES ("'.$this->_id_offre.'", "'.$this->_id_gestion_offre.'", "'.$this->_id_user.'", "'.$this->_id_employee.'", "'.$this->_id_site.'", "'.$this->_duree.'", "'.$this->_commentaire.'","'.$this->_date_debut.'", "'.$this->_date_fin.'",NOW() )  ';
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
	
	public function getInterventionById($id)
	{
		try{
				$sql = 'SELECT * FROM intervention WHERE id_intervention = '.$id; 
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
	
	public function getInterventionsByIdCustomer($id_user)
	{
		try{
				$sql = 'SELECT * FROM intervention WHERE id_user = '.$id_user.' and active = 1'; 
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
		Retourne un objet
	**/
		
	public function getInterventions($deb = null, $fin = null)
	{
		try{
	 
			$sql = 'SELECT * FROM intervention '.$re = (!empty($fin)) ? ' LIMIT '.$deb.','.$fin.'' : '';
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
		Retourne le temps pris pour un contrat
		
	*/
 	public function getInterventionTimeTotalByIdContrat($id_gestion_contrat)
	{
		try{
				$sql = 'SELECT SUM(duree) as temps_total_intervention  FROM intervention WHERE id_gestion_offre = '.$id_gestion_contrat.' AND active = 1'; 
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
	
	
	 
}
