<?php 
/**
 * Bancomer API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © Bancomer SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */

class BancomerRefund extends BancomerApiResourceBase {
	protected function getResourceUrlName($p = true){
		return parent::getResourceUrlName(false);
	}
}
?>