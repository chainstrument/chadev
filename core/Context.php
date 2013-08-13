<?php

class Context
{

	protected static $instance;
	
	public $smarty;

	public static function getContext()
	{
		if(!isset(self::$instance))
			self::$instance = new Context();
			
		return self::$instance;
	}	
	











}