<?php 

class Autoload{

    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }

    public function __construct()
    {
        spl_autoload_register(array($this,'core'));
        spl_autoload_register(array($this,'modcontroller'));
		echo 'ici';
     
    }

    

    public function core($class)
    { 
      //  $class = preg_replace('/_helper$/ui','',$class);
        set_include_path(get_include_path().PATH_SEPARATOR.'/core/');
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }
	
	
    public function modcontroller($class)
    { 
      //  $class = preg_replace('/_helper$/ui','',$class);
        set_include_path(get_include_path().PATH_SEPARATOR.'modcontroller/');
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }
 
}


?>