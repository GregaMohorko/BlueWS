<?php

/*
 * PostLoginAction.php
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

/**
 * This is an example of a BaseAction implementation with some business logic. In this case, this class is meant for actions after the login, when the user is already logged in. It forces the implementer to handle user verification.
 */
abstract class PostLoginAction extends BaseAction
{
	/**
	 * @var mixed The user that is logged in and executing this action.
	 */
	protected $user;
	
	/**
	 * Runs this action.
	 * 
	 * @return array
	 */
	public function run()
	{
		$this->user=$this->getUser();
		
		$this->init();
		
		if($this->isUserVerificationRequired()){
			$result=$this->verifyUserAccess();
			if($result!==true){
				// verification failed
				$error=[];
				$error["Error"]="User denied: $result";
				return $error;
			}
		}
		
		return $this->runInternal();
	}
	
	/**
	 * Gets the user that is trying to execute this action.
	 * 
	 * @return mixed
	 */
	protected abstract function getUser();
	
	/**
	 * This method is meant to be overriden. Set any fields that will be used in this action.
	 */
	protected function init() { }
	
	/**
	 * Override this method to determine whether user verification should be done or not.
	 * 
	 * @return bool
	 */
	protected function isUserVerificationRequired()
	{
		return true;
	}
	
	/**
	 * @return bool|string TRUE if it passed, otherwise the reason for failing.
	 */
	protected abstract function verifyUserAccess();
	
	/**
	 * Called when/if verification is passed.
	 * 
	 * @return array
	 */
	protected abstract function runInternal();
}
