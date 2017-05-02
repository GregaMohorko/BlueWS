<?php

/*
 * TestAction6.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\PostLoginAction;

/**
 * A simple post login action without user verification.
 */
class TestAction6 extends PostLoginAction
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
		$user["Role"]="Editor";
		return $user;
	}

	protected function isUserVerificationRequired()
	{
		return false;
	}
	
	protected function verifyUserAccess() { }
}
