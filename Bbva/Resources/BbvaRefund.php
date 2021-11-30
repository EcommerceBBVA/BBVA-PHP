<?php

namespace Bbva\Resources;


use Bbva\Data\BbvaApiResourceBase;

class BbvaRefund extends BbvaApiResourceBase {
    protected function getResourceUrlName($p = true){
        return parent::getResourceUrlName(false);
    }
}
?>
