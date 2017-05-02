<?php

/*
 * BlueWS.php
 * 
 * Bootstrap file for BlueWS library.
 * 
 * Version 1.0
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

// load configuration file
$config=parse_ini_file("config.ini");
if(!$config)
	$config=[];

// initialize
require_once 'Configuration/BlueWSProperties.php';
\BlueWS\Configuration\BlueWSProperties::init($config);

// include all files
require_once 'Service/ActionExecuter.php';
require_once 'Service/BaseAction.php';
require_once 'Service/ClientVerificationResultEnum.php';
require_once 'Service/PostLoginAction.php';
require_once 'Service/WebService.php';
require_once 'Utility/InputUtility.php';
