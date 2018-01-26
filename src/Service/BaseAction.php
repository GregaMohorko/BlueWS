<?php

/*
 * BaseAction.php
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
			if($result===false){
				throw $ex;
			}
		}
		
		// output
		if($result!==null){
			if(is_string($result)){
				echo $result;
			}else{
				header("Content-type: application/json");
				$json=json_encode($result);
				echo $json;
			}
		}
	}
	
	/**
	 * Runs this action.
	 * 
	 * @return array An array that will be encoded to JSON.
	 */
	protected abstract function run();
	
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
