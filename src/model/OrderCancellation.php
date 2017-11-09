<?php
namespace BoxzookaAPI\model;

class OrderCancellation extends AbstractRequestModel {

	public function getNodeName() {
		return 'OrderCancellation';
	}

	public function getResponseModel() {
		return new OrdersCancellationResponse();
	}

	public function __construct() {
		parent::__construct();
		$this->addField('OrderID', array(
			'type' => 'string',
			'min' => 1,
			'max' => 50,
			'required' => true,
			'array' => true
		));
		$this->addField('Delete', array(
			'type' => 'string',
			'min' => 1,
			'max' => 1,
			'accept' => array(
				'Y',
				'N'
			)
		));
	}
}