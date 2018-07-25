<?php

/**
 * Openpay API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © Openpay SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */
class OpenpayTokenCharge extends OpenpayApiResourceBase
{

    protected $affiliation_bbva;
    protected $amount;
    protected $currency;
    protected $order_id;
    protected $description;
    protected $customer;
    protected $customer_language;
    protected $payment_plan;
    protected $redirect_url;
    protected $use_card_points;
    protected $use_3d_secure;
    protected $token;
    protected $metadata;
    protected $capture;

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

    public function get($param) {
        return $this->_getAttributes($param);
    }

}
    // ----------------------------------------------------------------------------
    class OpenpayTokenChargeList extends OpenpayApiDerivedResource
    {

        public function create($params) {
            return $this->add($params);
        }

    }
?>