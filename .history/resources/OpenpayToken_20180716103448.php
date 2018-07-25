<?php

/**
 * Openpay API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © Openpay SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */
class OpenpayToken extends OpenpayApiResourceBase
{
    protected $holder_name;
    protected $card_number;
    protected $cvv2;
    protected $expiration_month;
    protected $expiration_year;
    protected $address;

    public function get($param) {
        return $this->_getAttributes($param);
    }
}

        // ----------------------------------------------------------------------------
class OpenpayTokenList extends OpenpayApiDerivedResource
{
    public function create($params) {
        return $this->add($params);
    }
    
}

?>