<?php

/* 
 * index.php
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
