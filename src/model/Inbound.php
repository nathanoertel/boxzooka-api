<?php
namespace BoxzookaAPI\model;

class Inbound extends AbstractRequestModel {

	public function getNodeName() {
		return 'Inbound';
	}

	public function getResponseModel() {
		return new InboundResponse();
	}

	public function __construct() {
		parent::__construct();
		$this->addField('PO', array(
			'type' => 'string',
			'min' => 1,
			'max' => 50,
			'required' => true
		));
		$this->addField('ContainerID', array(
			'type' => 'string',
			'min' => 1,
			'max' => 50,
			'required' => true
		));
		$this->addField('Carrier', array(
			'type' => 'string',
			'min' => 3,
			'max' => 10,
			'required' => true
		));
		$this->addField('TrackingCode', array(
			'type' => 'string',
			'min' => 13,
			'max' => 28,
			'required' => true
		));
		$this->addField('ShipDate', array(
			'type' => 'timestamp',
			'required' => true
		));
		$this->addField('EstimatedDeliveryDate', array(
			'type' => 'timestamp',
			'required' => true
		));
		$this->addField('Item', array(
			'type' => 'BoxzookaAPI\model\Item',
			'array' => true,
			'required' => true,
			'min' => 1
		));
	}
}