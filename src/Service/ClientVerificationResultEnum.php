<?php

/*
 * ClientVerificationResultEnum.php
 * 
 * @project BlueWS
 * @author Grega Mohorko <grega@mohorko.info>
 * @copyright May 1, 2017 Grega Mohorko
 */

namespace BlueWS\Service;

abstract class ClientVerificationResultEnum
{
	const UNKNOWN=0;
	const PASSED=1;
	const FAILED=2;
	const RELOGIN_REQUIRED=3;
}
