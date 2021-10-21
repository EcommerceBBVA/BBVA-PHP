<?php

/**
 * Bbva API v1 Client for PHP (version 1.0.0)
 *
 * Copyright © BBVA, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA All rights reserved.
 * plataformas.especiales.mx@bbva.com
 */
namespace BBVA\Resources;

use BBVA\Data\BbvaApiResourceBase;

class BbvaCharge extends BbvaApiResourceBase
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
?>
