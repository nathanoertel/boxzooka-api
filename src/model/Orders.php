<?php
namespace BoxzookaAPI\model;

class Orders extends AbstractRequestModel {

	public function getNodeName() {
		return 'Orders';
	}

	public function getResponseModel() {
		return new OrdersResponse();
	}

	public function __construct() {
		parent::__construct();
		$this->addField('Order', array(
			'type' => 'BoxzookaAPI\model\Order',
			'min' => 1,
			'required' => true,
			'array' => true
		));
	}
}