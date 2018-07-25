<?php 
/**
 * Bancomer API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © Bancomer SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */

if (!function_exists('curl_init')) {
	throw new Exception('CURL PHP extension is required to run Bancomer client.');
}
if (!function_exists('json_decode')) {
	throw new Exception('JSON PHP extension is required to run Bancomer client.');
}
if (!function_exists('mb_detect_encoding')) {
	throw new Exception('Multibyte String PHP extension is required to run Bancomer client.');
}

require(dirname(__FILE__) . '/data/BancomerApiError.php');
require(dirname(__FILE__) . '/data/BancomerApiConsole.php');
require(dirname(__FILE__) . '/data/BancomerApiResourceBase.php');
require(dirname(__FILE__) . '/data/BancomerApiConnector.php');
require(dirname(__FILE__) . '/data/BancomerApiDerivedResource.php');
require(dirname(__FILE__) . '/data/BancomerApi.php');

require(dirname(__FILE__) . '/resources/BancomerCapture.php');
require(dirname(__FILE__) . '/resources/BancomerCard.php');
require(dirname(__FILE__) . '/resources/BancomerCharge.php');
require(dirname(__FILE__) . '/resources/BancomerCustomer.php');
require(dirname(__FILE__) . '/resources/BancomerRefund.php');
require(dirname(__FILE__) . '/resources/BancomerToken.php');
require(dirname(__FILE__) . '/resources/BancomerTokenCharge.php');
?>
