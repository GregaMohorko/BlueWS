<?php

/*
 * WebService.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

namespace BlueWS\Service;

use Exception;
use BlueWS\Configuration\BlueWSProperties;
use BlueWS\Utility\InputUtility;

/**
 * Base class for a Web Service.
 */
abstract class WebService
{
	/**
	 * @var string
	 */
	protected $action;
	/**
	 * @var mixed
	 */
	protected $data;
	
	/**
	 * @var string Action input parameter name.
	 */
	private $actionName;
	/**
	 * @var string Data input parameter name.
	 */
	private $dataName;
	/**
	 * @var string Either GET or POST.
	 */
	private $inputMethodName;
	/**
	 * @var int Either INPUT_GET or INPUT_POST.
	 */
	private $inputMethod;
	
	/**
	 * @param string $actionName [optional] The name of the action input parameter.
	 * @param string $dataName [optional] The name of the data input parameter.
	 * @param int $inputMethod [optional] Either "GET" or "POST". If null, default value (from configuration) will be used.
	 */
	public function __construct($actionName="action",$dataName="data",$inputMethod=null)
	{
		$this->actionName=$actionName;
		$this->dataName=$dataName;
		if($inputMethod===null){
			$config=BlueWSProperties::instance();
			$inputMethod=$config->DefaultInputMethod;
		}
		switch($inputMethod){
			case "GET":
				$inputMethodValue=INPUT_GET;
				break;
			case "POST":
				$inputMethodValue=INPUT_POST;
				break;
			default:
				throw new Exception("Invalid input method.");
		}
		$this->inputMethodName=$inputMethod;
		$this->inputMethod=$inputMethodValue;
	}
	
	/**
	 * Main function to call to execute a web service action.
	 */
	public function serve()
	{
		// get or post?
		if($_SERVER["REQUEST_METHOD"]!==$this->inputMethodName){
			throw new Exception("Wrong request method.");
		}
		
		$this->getActionAndData();
		$this->onStartUp();
		
		// check cross origin
		$config=BlueWSProperties::instance();
		if($config->AllowCrossOrigin!==null){
			header("Access-Control-Allow-Origin: ".$config->AllowCrossOrigin);
		}
		
		try{
			// check client verification
			if($this->isClientVerificationRequired()){
				if(!$this->clientVerification())
					return;
			}

			$actionParameter=null;
			$this->onActionCalling($actionParameter);
			
			// execute the action
			ActionExecuter::execute($this->action,$this->data,$actionParameter);
		} catch (Exception $ex) {
			throw $ex;
		}finally{
			$this->onExit();
		}
	}
	
	/**
	 * This method is meant to be overriden. It will be called right after the action and data are read, decrypted and decoded.
	 * Use this method e.g. to establish a connection, log, etc..
	 */
	protected function onStartUp() { }
	
	/**
	 * This method is meant to be overriden. It will be called after the action has been executed.
	 * Use this method e.g. to close a connection, log, etc..
	 */
	protected function onExit() { }
	
	/**
	 * Override this method to determine whether client verification should be done or not. This is called for every single request. You can use action and data fields.
	 * @return bool Defaults to FALSE.
	 */
	protected function isClientVerificationRequired()
	{
		return false;
	}
	
	/**
	 * Override this method if you want to verify the client. This method will be called when 'isClientVerificationRequired' is TRUE. You can use action and data fields.
	 * @return ClientVerificationResultEnum
	 */
	protected function verifyClient()
	{
		throw new Exception("Method 'verifyClient' must be overriden if client verification is required.");
	}
	
	/**
	 * Override this method. It will be called when client verification result will be RELOGIN_REQUIRED.
	 */
	protected function onReloginRequired()
	{
		throw new Exception("Method 'onReloginRequired' must be overriden if client verification is required and RELOGIN_REQUIRED result is possible.");
	}
	
	/**
	 * Override this method. It will be called when client verification failes.
	 * Use it e.g. for logging purposes.
	 */
	protected function onClientVerificationFailed()
	{
		throw new Exception("Method 'onClientVerificationFailed' must be overriden if client verification is required and FAILED result is possible.");
	}
	
	/**
	 * This method is meant to be overriden. It will be called right before actually running the called action. The $actionParameter variable will be passed to the action being executed, so use it to pass anything of your own, e.g. connection object.
	 * 
	 * @param mixed $actionParameter
	 */
	protected function onActionCalling(&$actionParameter) { }
	
	private function getActionAndData()
	{
		$action=InputUtility::getParameter_notNull($this->actionName, $this->inputMethod);
		$data=InputUtility::getParameter($this->dataName, $this->inputMethod);
		if($data!==null){
			//$data=utf8_encode($data);
			$jsonData=json_decode($data,true);
			// return raw data if json decoding was not successful
			$data=$jsonData===null ? $data : $jsonData;
		}
		// TODO decryption
		$this->action=$action;
		$this->data=$data;
	}
	
	/**
	 * @return bool TRUE if passed, FALSE otherwise.
	 */
	private function clientVerification()
	{
		$result=$this->verifyClient();
		switch($result){
			case ClientVerificationResultEnum::PASSED:
				return true;
			case ClientVerificationResultEnum::RELOGIN_REQUIRED:
				$this->onReloginRequired();
				return false;
			case ClientVerificationResultEnum::FAILED:
				$this->onClientVerificationFailed();
				return false;
		}
		
		throw new Exception("Unknown client verification result.");
	}
}
