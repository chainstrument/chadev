<?php


class EmployeController extends FrontController
{


	public function display()
	{
		
		Context::getContext()->smarty->assign("title", "index");
		Context::getContext()->smarty->assign("content", "index");
		
		parent::display();
	}

	public function indexAction($params = array())
	{	
		 
	 
		// Db::getInstance()->insert('INSERT INTO test (nom) VALUES ("testst")');
		// echo '<pre>';
		// debug_print_backtrace();
		// echo '<pre>';
		// Context::getContext()->smarty->assign("list", "test");
		// Context::getContext()->smarty->display( "index.tpl");
		$this->display();
	}

	
	
	public function maisonAction($params = array())
	{	
		echo 'je suis dans '.get_class($this).'';
		// Debug::d(Context::getContext());
	
		// echo _THEME_DIR_;
		// include(''. _THEME_DIR_.'theme.tpl');
		
		// Db::getInstance()->insert('INSERT INTO test (nom) VALUES ("testst")');
		
		
		Context::getContext()->smarty->assign("ici", "test");
		Context::getContext()->smarty->display( "theme.tpl");
	}
	
	public function getHeader()
	{
		parent::getHeader();
	}
	
	public function getFooter()
	{
		parent::getfooter();
	}
	
	
	
	
}