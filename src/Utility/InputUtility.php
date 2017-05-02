<?php

/*
 * InputUtility.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

namespace BlueWS\Utility;

use Exception;

abstract class InputUtility
{
	/**
	 * Throws an exception if a variable with the specified name does not exist.
	 * 
	 * @param string $name Name of the variable to get.
	 * @param int $method One of INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER or INPUT_ENV.
	 * @return mixed
	 * @throws Exception
	 */
	public static function getParameter_notNull($name,$method)
	{
		$value=self::getParameter($name,$method);
		if($value===null)
			throw new Exception("The input parameter '$name' was null.");

		return $value;
	}
	
	/**
	 * @param string $name Name of the variable to get.
	 * @param int $method One of INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER or INPUT_ENV.
	 * @return mixed
	 */
	public static function getParameter($name,$method)
	{
		return filter_input($method, $name);
	}
}
