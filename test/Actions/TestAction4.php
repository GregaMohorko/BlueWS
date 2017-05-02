<?php

/*
 * TestAction4.php
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
		if($this->user["Role"]!=="Admin")
			return "The user must be admin.";
		return true;
	}
}
