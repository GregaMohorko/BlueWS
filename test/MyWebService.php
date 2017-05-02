<?php

/*
 * MyWebService.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

use BlueWS\Service\WebService;

class MyWebService extends WebService
{
	protected function onActionCalling(&$actionParameter)
	{
		$actionParameter=42;
	}
}
