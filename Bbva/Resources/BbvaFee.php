<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;
use Bbva\Data\BbvaApiDerivedResource;

class BbvaFee extends BbvaApiResourceBase
{

    protected $authorization;
    protected $creation_date;
    protected $currency;
    protected $operation_type;
    protected $status;
    protected $transaction_type;
    protected $error_message;
    protected $method;
    protected $derivedResources = array('Refund' => null);

    public function refund($params) {
        $resource = $this->derivedResources['refunds'];
        if ($resource) {
            return parent::_create($resource->resourceName, $params, array('parent' => $this));
        }
    }

}

?>
