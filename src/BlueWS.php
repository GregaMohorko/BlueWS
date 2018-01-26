<?php

/*
 * BlueWS.php
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
 * Bootstrap file for BlueWS library.
 * 
 * Version 1.2.0.0
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

define("BLUEWS_DIR", __DIR__."/");

// load configuration file
$config=parse_ini_file(BLUEWS_DIR."config.ini");
if(!$config){
	$config=[];
}

// initialize
require_once BLUEWS_DIR.'Configuration/BlueWSProperties.php';
\BlueWS\Configuration\BlueWSProperties::init($config);

// include all files
require_once BLUEWS_DIR.'Service/ActionExecuter.php';
require_once BLUEWS_DIR.'Service/BaseAction.php';
require_once BLUEWS_DIR.'Service/ClientVerificationResultEnum.php';
require_once BLUEWS_DIR.'Service/PostLoginAction.php';
require_once BLUEWS_DIR.'Service/WebService.php';
require_once BLUEWS_DIR.'Utility/InputUtility.php';
