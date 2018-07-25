<?php

/**
 * Bancomer API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © Bancomer SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */
class BancomerCharge extends BancomerApiResourceBase
{

    protected $authorization;
    protected $creation_date;
    protected $currency;
    protected $customer_id;
    protected $operation_type;
    protected $status;
    protected $transaction_type;
    // temporal hack
    // TODO: checar porque no instancia Bancomercard al recibir el parametro
    protected $card;
    protected $derivedResources = array('Refund' => null, 'Capture' => null);

    public function refund($params) {
        $resource = $this->derivedResources['refunds'];
        if ($resource) {
            return parent::_create($resource->resourceName, $params, array('parent' => $this));
        }
    }

    public function capture($params) {
        $resource = $this->derivedResources['captures'];
        if ($resource) {
            return parent::_create($resource->resourceName, $params, array('parent' => $this));
        }
    }

    public function update($params) {
        return $this->_updateCharge($params);
    }

}

// ----------------------------------------------------------------------------
class BancomerChargeList extends BancomerApiDerivedResource
{

    public function create($params) {
        return $this->add($params);
    }

}

?>