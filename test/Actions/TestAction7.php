<?php

/*
 * TestAction7.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\BaseAction;

/**
 * Testing the action parameter.
 */
class TestAction7 extends BaseAction
{
	public function run()
	{
		$result=[];
		$result["ActionParameter"]=$this->actionParameter;
		return $result;
	}
}
