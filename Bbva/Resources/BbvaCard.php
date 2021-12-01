<?php

/**
 * Bbva API v1 Client for PHP (version 2.2.*)
 *
 * Copyright © Bbva SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */
namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;
use Bbva\Data\BbvaApiDerivedResource;

class BbvaCard extends BbvaApiResourceBase
{

    protected $type;
    protected $brand;
    protected $allows_charges;
    protected $allows_payouts;
    protected $creation_date;
    protected $bank_name;
    protected $bank_code;
    protected $customer_id;

    public function delete() {
        $this->_delete();
    }

    public function get($param) {
        return $this->_getAttributes($param);
    }

}

// ----------------------------------------------------------------------------

?>
