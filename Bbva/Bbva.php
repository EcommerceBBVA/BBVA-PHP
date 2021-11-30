<?php

if (!function_exists('curl_init')) {
	throw new Exception('CURL PHP extension is required to run Bbva client.');
}
if (!function_exists('json_decode')) {
	throw new Exception('JSON PHP extension is required to run Bbva client.');
}
if (!function_exists('mb_detect_encoding')) {
	throw new Exception('Multibyte String PHP extension is required to run Bbva client.');
}

require(dirname(__FILE__) . '/Data/BbvaApiError.php');
require(dirname(__FILE__) . '/Data/BbvaApiConsole.php');
require(dirname(__FILE__) . '/Data/BbvaApiResourceBase.php');
require(dirname(__FILE__) . '/Data/BbvaApiConnector.php');
require(dirname(__FILE__) . '/Data/BbvaApiDerivedResource.php');
require(dirname(__FILE__) . '/Data/BbvaApi.php');

require(dirname(__FILE__) . '/Resources/BbvaCapture.php');
require(dirname(__FILE__) . '/Resources/BbvaCharge.php');
require(dirname(__FILE__) . '/Resources/BbvaChargeList.php');
require(dirname(__FILE__) . '/Resources/BbvaCustomer.php');
require(dirname(__FILE__) . '/Resources/BbvaCustomerList.php');
require(dirname(__FILE__) . '/Resources/BbvaRefund.php');
require(dirname(__FILE__) . '/Resources/BbvaToken.php');
require(dirname(__FILE__) . '/Resources/BbvaTokenList.php.php');
?>
