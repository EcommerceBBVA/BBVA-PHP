<?php

namespace Bbva\Data;

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
