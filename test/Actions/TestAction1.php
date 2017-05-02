<?php

/*
 * TestAction1.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\BaseAction;

/**
 * Hello world action.
 */
class TestAction1 extends BaseAction
{
	public function run()
	{
		$result=[];
		$result["Message"]="Hello world!";
		return $result;
	}
}
