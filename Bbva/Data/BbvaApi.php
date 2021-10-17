<?php

/**
 * Bbva API v1 Client for PHP (version 1.0.3)
 *
 * Copyright © BBVA, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA All rights reserved.
 * http://www.bbva.mx/
 * bbva@eglobal.com.mx
 */
namespace BBVA\Data;

// ----------------------------------------------------------------------------
class BbvaApi extends BbvaApiResourceBase
{

    protected $derivedResources = array('Customer' => array(),
        'Card' => array(),
        'Charge' => array(),
        'Payout' => array(),
        'Fee' => array(),
        'Plan' => array(),
        'Webhook' => array(),
        'Token' => array());

    public static function getInstance($r, $p = null) {
        $resourceName = get_class();
        return parent::getInstance($resourceName);
    }

    protected function getResourceUrlName($p = true) {
        return '';
    }

    public function getFullURL() {
        return $this->getUrl();
    }

}

?>
