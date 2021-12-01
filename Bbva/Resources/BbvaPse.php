<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;

class BbvaPse extends BbvaApiResourceBase
{

    protected $authorization;
    protected $creation_date;
    protected $currency;
    protected $customer_id;
    protected $operation_type;
    protected $status;
    protected $transaction_type;
    protected $derivedResources = array();

}

?>
