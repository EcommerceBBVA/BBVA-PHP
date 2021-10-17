<?php
/**
 * Bbva API v1 Client for PHP (version 1.0.0)
 *
 * Copyright © BBVA, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA All rights reserved.
 * http://www.bbva.com/
 * bbva@eglobal.com.mx
 */

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
require(dirname(__FILE__) . '/Resources/BbvaRefund.php');
require(dirname(__FILE__) . '/Resources/BbvaToken.php');
?>
