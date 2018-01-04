<?php

/*
 * ActionExecuter.php
 * 
 * Copyright 2018 Grega Mohorko
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
		if(!$resolvedPath){
			throw new Exception("Could not resolve action file path '$actionFilePath'. Possible reasons: a wrong actions folder is specified in the configuration file or the action does not exist.");			
		}
		
		require_once $resolvedPath;
		
		if(!class_exists($name)){
			throw new Exception("The action '$name' does not exist. You must define a class named '$name' inside the '$name.php' file in actions folder.");
		}
	}
}
