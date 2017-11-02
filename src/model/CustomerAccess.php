<?php
namespace BoxzookaAPI\model;

class CustomerAccess extends AbstractModel {

	public function getNodeName() {
		return 'CustomerAccess';
	}
	
	public function __construct() {
		$this->addField('CustomerID', array(
			'type' => 'string',
			'required' => true
		));
		$this->addField('CustomerKey', array(
			'type' => 'string',
			'required' => true
		));
	}
}