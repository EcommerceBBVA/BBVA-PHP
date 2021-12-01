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

require(dirname(__FILE__) . '/Data/Bbva.php');
require(dirname(__FILE__) . '/Data/BbvaApi.php');
require(dirname(__FILE__) . '/Data/BbvaApiAuthError.php');
require(dirname(__FILE__) . '/Data/BbvaApiConnectionError.php');
require(dirname(__FILE__) . '/Data/BbvaApiConnector.php');
require(dirname(__FILE__) . '/Data/BbvaApiConsole.php');
require(dirname(__FILE__) . '/Data/BbvaApiDerivedResource.php');
require(dirname(__FILE__) . '/Data/BbvaApiError.php');
require(dirname(__FILE__) . '/Data/BbvaApiRequestError.php');
require(dirname(__FILE__) . '/Data/BbvaApiResourceBase.php');
require(dirname(__FILE__) . '/Data/BbvaApiTransactionError.php');

require(dirname(__FILE__) . '/Resources/BbvaBankAccount.php');
require(dirname(__FILE__) . '/Resources/BbvaBankAccountList.php');
require(dirname(__FILE__) . '/Resources/BbvaBine.php');
require(dirname(__FILE__) . '/Resources/BbvaCapture.php');
require(dirname(__FILE__) . '/Resources/BbvaCard.php');
require(dirname(__FILE__) . '/Resources/BbvaCardList.php');
require(dirname(__FILE__) . '/Resources/BbvaCharge.php');
require(dirname(__FILE__) . '/Resources/BbvaChargeList.php');
require(dirname(__FILE__) . '/Resources/BbvaCustomer.php');
require(dirname(__FILE__) . '/Resources/BbvaCustomerList.php');
require(dirname(__FILE__) . '/Resources/BbvaFee.php');
require(dirname(__FILE__) . '/Resources/BbvaFeeList.php');
require(dirname(__FILE__) . '/Resources/BbvaPayout.php');
require(dirname(__FILE__) . '/Resources/BbvaPayoutList.php');
require(dirname(__FILE__) . '/Resources/BbvaPlan.php');
require(dirname(__FILE__) . '/Resources/BbvaPlanList.php');
require(dirname(__FILE__) . '/Resources/BbvaPse.php');
require(dirname(__FILE__) . '/Resources/BbvaPseList.php');
require(dirname(__FILE__) . '/Resources/BbvaRefund.php');
require(dirname(__FILE__) . '/Resources/BbvaSubscription.php');
require(dirname(__FILE__) . '/Resources/BbvaSubscriptionList.php');
require(dirname(__FILE__) . '/Resources/BbvaToken.php');
require(dirname(__FILE__) . '/Resources/BbvaTokenList.php');
require(dirname(__FILE__) . '/Resources/BbvaTransfer.php');
require(dirname(__FILE__) . '/Resources/BbvaTransferList.php');
require(dirname(__FILE__) . '/Resources/BbvaWebhook.php');
?>
