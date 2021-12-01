<?php

namespace Bbva\Resources;

use Bbva\Data\BbvaApiResourceBase;
use Bbva\Data\BbvaApiDerivedResource;

class BbvaPlan extends BbvaApiResourceBase {
	protected $creation_date;
	protected $currency;
	protected $amount;
	protected $repeat_every;
	protected $repeat_unit;
	protected $retry_times;
	protected $status;
	protected $status_after_retry;

	protected $derivedResources = array('Subscription' => array());

	public function save() {
		return $this->_update();
	}
	public function delete() {
		$this->_delete();
	}
}
?>
