<?php

/*
 * ActionExecuter.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

namespace BlueWS\Service;

use Exception;
use BlueWS\Configuration\BlueWSProperties;

abstract class ActionExecuter
{
	/**
	 * 
	 * @param string $action
	 * @param mixed $data
	 * @param mixed $actionParameter
	 */
	public static function execute($action,$data,$actionParameter)
	{
		self::includeAction($action);
		
		/* @var $actionObject BaseAction */
		$actionObject=new $action($data,$actionParameter);
		$actionObject->execute();
	}
	
	/**
	 * @param string $name Action name.
	 */
	private static function includeAction($name)
	{
		$config=BlueWSProperties::instance();
		$actionFilePath=dirname(__FILE__)."/../../".$config->ActionsFolder."/$name.php";
		
		$resolvedPath=stream_resolve_include_path($actionFilePath);
		if(!$resolvedPath)
			throw new Exception("Could not resolve action file path '$actionFilePath'. Possible reasons: a wrong actions folder is specified in the configuration file or the action does not exist.");
		
		require_once $resolvedPath;
		
		if(!class_exists($name))
			throw new Exception("The action '$name' does not exist. You must define a class named '$name' inside the '$name.php' file in actions folder.");
	}
}
