<?php

/*
 * TestAction3.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\BaseAction;

/**
 * Action with a handled error.
 */
class TestAction3 extends BaseAction
{
	public function run()
	{
		throw new Exception("Some error.");
	}

	protected function handleException($ex)
	{
		$result=[];
		$result["Explanation"]="You did something wrong.";
		return $result;
	}
}
