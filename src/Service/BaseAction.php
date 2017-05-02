<?php

/*
 * BaseAction.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

namespace BlueWS\Service;

use Exception;

/**
 * The base class of all actions.
 * 
 * @see PostLoginAction
 */
abstract class BaseAction
{
	/**
	 * @var mixed Client data.
	 */
	protected $data;
	/**
	 * @var mixed The action parameter that was defined in method BlueWS\Service\WebService.onActionCalling.
	 */
	protected $actionParameter;
	
	/**
	 * @param mixed $data
	 * @param mixed $actionParameter
	 */
	public function __construct($data,$actionParameter)
	{
		$this->data=$data;
		$this->actionParameter=$actionParameter;
	}
	
	public function execute()
	{
		try{
			$result=$this->run();
		} catch (Exception $ex) {
			$result=$this->handleException($ex);
			if($result===false)
				throw $ex;
		}
		
		// output
		header("Content-type: application/json");
		$json=json_encode($result);
		echo $json;
	}
	
	/**
	 * Runs this action.
	 * 
	 * @return array
	 */
	public abstract function run();
	
	/**
	 * This method is meant to be overriden. It will be called when an exception is thrown while running this action.
	 * 
	 * @param Exception $ex Exception that was thrown.
	 * @return bool|array FALSE if the exception was not handled and should still be thrown, or the array that will be returned to the client.
	 */
	protected function handleException($ex)
	{
		return false;
	}
}
