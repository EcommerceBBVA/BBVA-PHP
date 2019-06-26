<?php 
/**
 * Bbva API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © BBVA, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA All rights reserved.
 * plataformas.especiales.mx@bbva.com
 */

class BbvaCapture extends BbvaApiResourceBase {
	protected function getResourceUrlName($p = true){
		return parent::getResourceUrlName(false);
	}
}
?>