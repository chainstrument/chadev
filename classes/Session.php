<?php

class Session { 
 
    private static $instance;
	
	protected $_connexion;
	protected $_logged = null;
	public $_error;
	
 
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Session();
        }
		
        return self::$instance;
    }
 
    private function __construct() { 
        session_start(); 
		$this->_connexion = Db::getInstance();
    } 
 
    public function getValue($key) { 
        return isset($_SESSION[$key]) ? $_SESSION[$key] : FALSE; 
    } 
 
    public function setValue($key, $value) { 
        $_SESSION[$key] = $value; 
    } 
 
    public function login($pValues = array()) { 
        // $_SESSION['authentication_ip'] = $_SERVER['REMOTE_ADDR']; 
		// var_dump($pValues);
		
        foreach ($pValues as $key => $value) { 
            $_SESSION[$key] = $value; 
        } 
    } 
 
    public function logout(){ 
        session_unset(); 
        session_destroy(); 
		header('location:index.php');
    } 
 
 
	public function validEmployee($mail, $password)
	{
		if(empty($_SESSION['id'])){
		$employee = new Employee();
		
	 
		$resultat = $employee->getEmployeeForConnection($mail, $password);
			// echo var_dump($resultat);
		 if(!empty($resultat) and is_array($resultat))
		 {
				$this->login($resultat);
				$this->_logged = true;
				 // var_dump($_SESSION);
			return true;
		 }else{
			return $this->_error = '<span class="error">Employee non existant</span>';
		 }
		}else{
			return true;
		}	
	}
 
    public function isLogged() { 
	 
		return $this->_logged;
	 
    } 
	
	 
	
	 
	
}