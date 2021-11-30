<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;

class BbvaToken extends BbvaApiResourceBase
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

?>
