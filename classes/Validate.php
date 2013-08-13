<?php

class Validate
{
 
	 /**
	 * Check for e-mail validity
	 *
	 * @param string $email e-mail address to validate
	 * @return boolean Validity is ok or not
	 */
	public static function isEmail($email)
	{
		return !empty($email) && preg_match('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+[._a-z\p{L}0-9-]*\.[a-z0-9]+$/ui', $email);
	}


	



}