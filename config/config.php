<?php
/**
	Enregistrement d'un deuxieme autoload
**/
spl_autoload_register('__autoload_my_classes');
include_once 'define.php';
/*
*	Configration for Smarty
*
**/
require_once ('public/lib/Smarty/libs/Smarty.class.php');

Context::getContext()->smarty = new Smarty();

Context::getContext()->smarty->template_dir = dirname(__FILE__).'/../view/';
Context::getContext()->smarty->compile_dir = '../cache/compile';

function d($object)
{
	echo '<pre>';
	var_dump($object);
	echo '</pre>';
		die();

}
 