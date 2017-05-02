<?php

/*
 * TestAction8.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\BaseAction;

/**
 * Testing the data.
 */
class TestAction8 extends BaseAction
{
	public function run()
	{
		$result=[];
		$result["data"]=$this->data;
		return $result;
	}
}
