<?php
 
class FrontController  
{
    const DEFAULT_CONTROLLER = "IndexController";
    const DEFAULT_ACTION     = "indexAction";
    
    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $basePath      = __BASE_URI__;
    
    protected $js_file      = array();
    protected $css_file      = array();
    
	public function __construct(array $options = array()) {
		 
        if (empty($options)) {
           $this->parseUri();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);     
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }
    
	
 
 
	
    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
		 
        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);
        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        } 
		 $path = substr($path, 1);
	 
        @list($controller, $action, $params) = explode("/", $path, 3);
	  
        if (!empty($controller)) {
	 
            $this->setController($controller.'Controller');
        }
        if (isset($action)) {
            $this->setAction($action.'Action');
        }
        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }
	
      /**
	*
	*	Parse l'url 
	*	
	*
	*/
    public function setController($controller) 
	{ 
		// d($controller);
        $controller = ucfirst($controller);
        if (!class_exists($controller)) {
            throw new \InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }
    
	
	/**
	*
	*	 
	*	
	*
	*/
    public function setAction($action) { 

        try{ 
            $reflector = new \ReflectionClass($this->controller);
        } catch(\LogicException $Exception){  
      }   
	  
        if (!$reflector->hasMethod($this->action)) {
            throw new \InvalidArgumentException(
                "The controller action '$this->action' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }
    
	
	  /**
	*
	*	Parse l'url 
	*	
	*
	*/
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
    
	/**
	*
	*	Lance l'application
	*
	*
	*/
	
    public function run() {
		$class_call = new $this->controller;
		
        call_user_func_array(array($class_call, $this->action), $this->params);
    }
	
	
	public function addJs($js_file)
	{
		if(is_array($js_file))
		{
			foreach($js_file as $file)
				$this->js_file[] = _JS_DIR_.$file;
		}else	
			$this->js_file[] = _JS_DIR_.$js_file;
	}
	
	
	public function addCss($css_file)
	{
		if(is_array($css_file))
		{
			foreach($css_file as $file)
				$this->css_file[] = _CSS_DIR_.$file;
		}else
			$this->css_file[] = _CSS_DIR_.$css_file;
	}
	
	public function getHeader()
	{
		$myCss = array('bootstrap/css/bootstrap.min.css', 
						'jquery-ui.css', 
						'css/style.css', 
						 );
		$this->addCss($myCss);
		
		$myJs = array('jquery-1.9.1.min.js', 
						'jquery-ui.js', 
						'bootstrap/js/bootstrap.js', 
						 );
		$this->addJs($myJs);
		
		
		
		Context::getContext()->smarty->assign('js_file' ,$this->js_file);
		Context::getContext()->smarty->assign('css_file' ,$this->css_file);
		// Context::getContext()->smarty->assign('myMenu' ,$myMenu);
	}
	
	public function addPrefix(&$param)
	{
		if(is_array($param))
		{
			foreach($param as $key => $element)
			{
				 $key  = $this->basePath.'/'.$key;
			}
		}else
			return $this->basePath.'/'.$param;
		
		return $param;
	}
	
	public function getMenu()
	{
		 
		
		$myMenu = array(_DOCUMENT_ROOT_.'employe' => 'employe', 
						_DOCUMENT_ROOT_.'customer' => 'client', 
						_DOCUMENT_ROOT_.'intervention' => 'intervention');
	// $menu = $this->addPrefix($myMenu);
	// d($menu);
		Context::getContext()->smarty->assign('myMenu' ,$myMenu);
		
	}
	
	public function getFooter()
	{
		$foot = 'juste une chaine de charactere pour le footer';
		Context::getContext()->smarty->assign('foot' ,$foot);
		
	}
	
	public function display()
	{
	
		$this->getHeader();
		$this->getMenu();
		$this->getFooter(); 
		Context::getContext()->smarty->display('gabarit.tpl');
		
	
	}
	
	
	
}
 