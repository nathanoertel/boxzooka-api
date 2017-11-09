<?php
namespace BoxzookaAPI\model;

class ShipmentListResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'ShipmentListResponse';
	}
	public function __construct() {
		$this->addField('Results', array(
			'type' => 'BoxzookaAPI\model\Shipments'
		));
		// item addition result fields
		$this->addField('Status', array(
			'type' => 'string',
			'setter' => false
		));
		$this->addField('ErrorMessage', array(
			'type' => 'string',
			'setter' => false
		));
	}
}