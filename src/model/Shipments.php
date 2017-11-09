<?php
namespace BoxzookaAPI\model;

class Shipments extends AbstractRequestModel {

	public function getNodeName() {
		return 'Shipments';
	}

	public function getResponseModel() {
		return new ShipmentsResponse();
	}

	public function __construct() {
		$this->addField('Shipment', array(
			'type' => 'BoxzookaAPI\model\Shipment',
			'required' => true,
			'min' => 1,
			'max' => null,
			'array' => true
		));
	}
}