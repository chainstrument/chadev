<?php

class Offre extends ObjectModel
{

	protected $_id; 
	protected $_nom ; 
	protected $_duree ;
	protected $_montant;
	protected $_nb_heure;
	protected $_nb_heure_mois; 
	
 
	
	protected $_date_add;
	
	// va contenir la connexion
	protected $_connexion;
	
	protected $_className = 'offre';
	
	
	/** Tableau qui va servir dans la classe mere pour l'affichage d
		des champs
	**/
	protected $_fieldsTab 		= array('id', 'nom', 'duree', 'montant ( € )', 'Nb heures', 'Nb heures/Mois', 'gestion');
	
	
	protected $_fieldsCenterTab = array( 'nom_offre', 'duree', 'montant', 'nb_heure', 'nb_heure_mois');
	
 
	
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
	
	public function getDuree()
	{
		return $this->_duree;	
	}
	
	public function getMontant()
	{
		return $this->_montant;	
	}
	
	public function getNbHeure()
	{
		return $this->_nb_heure;	
	}
	
	public function getNbHeureMois()
	{
		return $this->_nb_heure_mois;	
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
	
	 
	
	public function setNom($nom)
	{
		 $this->_nom = $nom;	
	}
	
	public function setDuree($duree)
	{
		$this->_duree = $duree;	
	}
	
	public function setMontant($montant)
	{
			$this->_montant = $montant;	
		
	}
	
	public function setNbHeure($nbHeure)
	{
		$this->_nb_heure = $nbHeure;	
	}
	
		public function setNbHeureMois($nbHeureMois)
	{
		$this->_nb_heure_mois = $nbHeureMois;	
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
			$sql = 'UPDATE offre SET  nom_offre = "'.$this->_nom.'", duree = "'.$this->_duree.'", montant ="'.$this->_montant.'", nb_heure ="'.$this->_nb_heure.'",
			nb_heure_mois = "'.$this->_nb_heure_mois.'",
			 
			date_add = NOW() WHERE id_offre = '.$this->_id.'  ';
			$count = $this->_connexion->handle()->exec($sql); 
			return '<p>'.$count.'lignes inseré';
			}
			catch(PDOException $e)
			{
				return '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';
			}
		
		}else{
	
			try{
			  $sql = 'INSERT INTO offre (nom_offre, duree, montant, nb_heure, nb_heure_mois, date_add 
			  )
				VALUES ("'.$this->_nom.'", "'.$this->_duree.'", "'.$this->_montant.'", "'.$this->_nb_heure.'", "'.$this->_nb_heure_mois.'",NOW()  )  ';
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
	
	public function getOffreById($id)
	{
		try{
				$sql = 'SELECT * FROM offre WHERE id_offre = '.$id; 
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
		Retourne un objet contenant toutes les offres
	**/
		
	public function getOffres($deb = null, $fin = null)
	{
		try{
	 
			$sql = 'SELECT * FROM offre WHERE active = 1 '.$re = (!empty($fin)) ? ' LIMIT '.$deb.','.$fin.'' : ''; 
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
