<?php

/*
 * TestAction2.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\BaseAction;

/**
 * Action with an unhandled error.
 */
class TestAction2 extends BaseAction
{
	public function run()
	{
		throw new Exception("Some error.");
	}
}
