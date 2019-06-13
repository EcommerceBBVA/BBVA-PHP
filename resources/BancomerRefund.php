<?php 
/**
 * Bancomer API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © BBVA Bancomer, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA Bancomer All rights reserved.
 * plataformas.especiales.mx@bbva.com
 */

class BancomerRefund extends BancomerApiResourceBase {
    protected function getResourceUrlName($p = true){
        return parent::getResourceUrlName(false);
    }
}
?>