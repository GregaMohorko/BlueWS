<?php

/* 
 * index.php
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
 * To test single actions, call this file with ?action=[actionName] etc..
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 2, 2017 Grega Mohorko
 */

// enable error reporting
error_reporting(E_ALL|E_STRICT);
ini_set("display_errors","On");

try{
	require_once '../src/BlueWS.php';
	require_once 'MyWebService.php';
	
	$service=new MyWebService();
	
	$service->serve();
} catch (Exception $ex) {
	echo getDescription($ex);
}

/**
* @param Exception $exception
* @return string
*/
function getDescription($exception)
{
	$desc="";

	$tabs="";

	$exCount=1;
	while($exception!=null){
		if($exCount>1){
			$desc.=$tabs."Inner Exception:".PHP_EOL;
			$tabs.="&nbsp;&nbsp;&nbsp;&nbsp;";
		}

		$stackTrace=$exception->getTraceAsString();
		$stackTrace=$tabs.str_replace(PHP_EOL,PHP_EOL.$tabs,$stackTrace);

		$desc.=$tabs."Message: ".$exception->getMessage().PHP_EOL;
		$desc.=$tabs."Code: ".$exception->getCode().PHP_EOL;
		$desc.=$tabs."File: ".$exception->getFile()."(".$exception->getLine().")".PHP_EOL;
		$desc.=$tabs."StackTrace: ".PHP_EOL.$stackTrace.PHP_EOL;

		$exception=$exception->getPrevious();
		$exCount++;
	}

	$desc=str_replace(PHP_EOL, "<br/>", $desc);
	
	return $desc;
}
