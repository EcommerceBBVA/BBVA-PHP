<?php

namespace Bbva\Resources;


use Bbva\Data\BbvaApiResourceBase;
use Bbva\Data\BbvaApiDerivedResource;

class BbvaTransfer extends BbvaApiResourceBase {
	protected $authorization;
	protected $creation_date;
	protected $currency;
	protected $operation_type;
	protected $status;
	protected $transaction_type;
	protected $error_message;
	protected $method;
}
?>
