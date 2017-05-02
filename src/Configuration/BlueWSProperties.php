<?php

/*
 * BlueWSProperties.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

namespace BlueWS\Configuration;

use Exception;

class BlueWSProperties
{
	const FOLDER_ACTIONS="actionsFolder";
	const DEFAULT_INPUT_METHOD="defaultInputMethod";
	const ALLOW_CROSS_ORIGIN="allowCrossOrigin";
	
	/**
	 * @var BlueWSProperties
	 */
	private static $instance;
	
	/**
	 * @return BlueWSProperties
	 */
	public static function instance()
	{
		if(self::$instance===null)
			throw new Exception("The BlueWSProperties was not initialized.");
		
		return self::$instance;
	}
	
	/**
	 * @param array $config
	 */
	public static function init($config)
	{
		self::$instance=new BlueWSProperties($config);
	}
	
	/**
	 * @var string Folder where the actions are. The path is relative to the folder in which the BlueWS library is located.
	 */
	public $ActionsFolder="";
	/**
	 * @var string Either "GET" or "POST".
	 */
	public $DefaultInputMethod="GET";
	/**
	 * @var bool If not null, adds this value as the 'Acces-Control-Allow-Origin' header. If you don't know what that is, read https://www.html5rocks.com/en/tutorials/cors/
	 */
	public $AllowCrossOrigin=null;
	
	/**
	 * @param array $config
	 */
	private function __construct($config)
	{
		// actions folder
		if(array_key_exists(self::FOLDER_ACTIONS, $config)){
			$this->ActionsFolder=$config[self::FOLDER_ACTIONS];
		}
		// default input method
		if(array_key_exists(self::DEFAULT_INPUT_METHOD, $config)){
			$this->DefaultInputMethod=$config[self::DEFAULT_INPUT_METHOD];
		}
		// cross origin
		if(array_key_exists(self::ALLOW_CROSS_ORIGIN, $config)){
			$this->AllowCrossOrigin=$config[self::ALLOW_CROSS_ORIGIN];
		}
	}
	
	private function __clone() { }
	private function __wakeup() { }
}
