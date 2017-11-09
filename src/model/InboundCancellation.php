<?php
namespace BoxzookaAPI\model;

class InboundCancellation extends AbstractRequestModel {

	public function getNodeName() {
		return 'InboundCancellation';
	}

	public function getResponseModel() {
		return new InboundCancellationResponse();
	}

	public function __construct() {
		parent::__construct();
		$this->addField('PO', array(
			'type' => 'string',
			'min' => 1,
			'required' => true,
			'array' => true
		));
		$this->addField('ContainerID', array(
			'type' => 'string',
			'min' => 1,
			'required' => true,
			'array' => true
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