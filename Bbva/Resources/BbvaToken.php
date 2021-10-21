<?php

/**
 * Bbva API v1 Client for PHP (version 1.0.0)
 *
 * Copyright © BBVA, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA All rights reserved.
 * plataformas.especiales.mx@bbva.com
 */
namespace BBVA\Resources;

use BBVA\Data\BbvaApiResourceBase;

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

        // ----------------------------------------------------------------------------

?>
