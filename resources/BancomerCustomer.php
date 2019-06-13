<?php

class BancomerCustomer extends BancomerApiResourceBase {
	protected $status;
	protected $creation_date;
	protected $balance;
	protected $clabe;
	protected $derivedResources = array('Card' => array(), 
										'BankAccount' => array(), 
										'Charge' => array(), 
										'Transfer' => array(), 
										'Payout' => array(), 
										'Subscription' => array());

	public function save() {
		return $this->_update();
	}
	public function delete() {
		$this->_delete();
	}
}
// ----------------------------------------------------------------------------
class BancomerCustomerList extends BancomerApiDerivedResource {
}
?>