<?php

/*
 * TestAction4.php
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
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\PostLoginAction;

/**
 * A simple post login action with user verification.
 */
class TestAction4 extends PostLoginAction
{
	protected function runInternal()
	{
		$result=[];
		$result["Message"]="Success";
		return $result;
	}
	
	protected function getUser()
	{
		$user=[];
		$user["Username"]="Grega";
		$user["Role"]="Admin";
		return $user;
	}

	protected function verifyUserAccess()
	{
		if($this->user["Role"]!=="Admin"){
			return "The user must be admin.";
		}
		return true;
	}
}
