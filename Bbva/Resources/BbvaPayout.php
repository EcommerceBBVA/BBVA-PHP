<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;
use Bbva\Data\BbvaApiDerivedResource;

class BbvaPayout extends BbvaApiResourceBase {
	protected $authorization;
	protected $creation_date;
	protected $currency;
	protected $operation_type;
	protected $status;
	protected $transaction_type;
	protected $error_message;
	protected $method;

	// temporal hack
	// TODO: checar porque no instancia Bbvacard al recibir el parametro
	protected $card;
}

?>
